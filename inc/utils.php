<?php 
require_once('php_libs/jwt/JWT.php');

function createCsrfToken() {
    $seed = urlSafeEncode(random_bytes(8));
    $t = time();
    $hash = urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, CSRF_TOKEN_SECRET, true));
    return urlSafeEncode($hash . '|' . $seed . '|' . $t);
}

function validateCsrfToken($token) {
    $parts = explode('|', urlSafeDecode($token));
    if(count($parts) === 3) {
        if(empty(session_id())) session_start();
        $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], CSRF_TOKEN_SECRET, true);
        if(hash_equals($hash, urlSafeDecode($parts[0]))) {
            return true;
        }
    }
    return false; 
}

// used to pass the created token safely over the url
function urlSafeEncode($m) {
    // replace and trim off troublesome or unwanted character
    return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
}

// reverse the process
function urlSafeDecode($m) {
    return base64_decode(strtr($m, '-_', '+/'));
}

// generate jwt
function generateJWToken($userId) {

    // Generate JWT 
    $payload = [
        'iat' => time(),
        'iss' => 'localhost',
        'exp' => time() + (60*60),     // expiry in 60 mins
        'userId' => $userId
    ];

    $token = JWT::encode($payload, getenv('JWT_SECRET_KEY'));

    return $token; 
}

function validateJWToken() {
    try {
        $token = getBearerToken();
        $payload = JWT::decode($token, getenv('JWT_SECRET_KEY'), ['HS256']);
        //print_r($payload);

        $opr = new DBOperation();
        if ($opr->dbConnected()) {

            $query = "SELECT * FROM users WHERE id = ?";
            $res = $opr->sqlSelect($query, 'i', $payload->userId);
            if($res && $res->num_rows === 1) {
                $row = mysqli_fetch_assoc($res);
                $user_arr = array (
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'groupid' => $row['groupid'],
                    'verified' => $row['verified'],
                    'avatar' => $row['avatar'],
                    'createdOn' => $row['created_on']
                );

                if ($user_arr['verified'] === 0) {   
                    return -2;              // This user may be deactived. (Please contact to admin.)
                }

                return $payload->userId;    // success or valid
            }
            else {                        
                return -3;                  // User not found in db (Invalid username and/or password.)
            }
        }
        else {
            // could not connect to the db
            return -4;                      // could not connect to the db. (Server Error.)
        }
    }
    catch (Exception $e) {
        //echo $e->getMessage();
        return -1;                          // access token errors
    }
    
}

// Get header Authorization
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

// get access token from header
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    
    return "ATHORIZATION_HEADER_NOT_FOUND"; // 'Access Token Not found');
}

function destroySession() {
   $_SESSION=array();
   if (session_id() != "" || isset($_COOKIE[session_name()]))
	   setcookie(session_name(), '', time()-2592000, '/');
   session_destroy();
}

function sanitizeString($var) {
   global $conn;
   $var = strip_tags($var);
   $var = htmlentities($var);
   $var = stripslashes($var);
   return mysqli_real_escape_string($conn, $var);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// # Flash Message
// function flash($name, $text = "") {
//     if (isset($_SESSION[$name])) {
//         $msg = $_SESSION[$name];    
//         unset($_SESSION[$name]);
//         return $msg;                // retrieve the message and unset the session at the response side
//     }
//     else {
//         $_SESSION[$name] = $text;   // set the desired text in session in the handler
//     }
//     return '';
// }

function stdNumFormat($num) {
    /* 
        number_format(
            float $num,
            int $decimals = 0,
            ?string $decimal_separator = ".",
            ?string $thousands_separator = ","
        ): string
    */
    return number_format($num, 2, '.', ',');;
}

// Harvested functions
// function showProfile($user)
// {
//    if (file_exists("./images/$user.jpg"))
// 	echo "<img src='./images/$user.jpg' border='1' align='left' />";
		
//    $result = queryMysql("SELECT * FROM gprofiles WHERE user='$user'");
	
//    if (mysqli_num_rows($result))
//    {
//       $row = mysqli_fetch_row($result);
//       echo stripslashes($row[1]) . "<br clear=left /><br />";	
//    }
// }
	
?>