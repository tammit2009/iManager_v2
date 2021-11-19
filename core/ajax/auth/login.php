<?php 

include_once('../../security.php');
include_once('db_functions.php');

if( isset($_POST['email']) && isset($_POST['password']) 
        && isset($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {

    // one hour ago in timestamps
    $oneHourAgo = time() - 60*60;

    $user = getUserFromLoginAttemptEmail($oneHourAgo, $_POST['email']);

    if ($user !== -1) {
        
        if (!empty($user)) {

            if ($user['verified'] === 1) {

                if($user['COUNT(loginattempts.id)'] < MAX_LOGIN_ATTEMPTS_PER_HOUR) {

                    if(password_verify($_POST['password'], $user['password'])) {

                        session_regenerate_id();    // will replace the current session id with a new one 
                                                    // keeping the current session information

                        // *************************************************
                        // Set cookie for 7 days if remember property exists
                        // *************************************************
                        // if (isset($_POST['remember_me'])) {
                        //     //echo "remember is set!";
                        //     setcookie('email', $email, time() + 60*60*24*7, '/'); 
                        //     setcookie('pass', $password, time() + 60*60*24*7, '/');  // not conventional for this long
                        // }
                        // else {
                        //     setcookie('email', '', time()-3600, '/');
                        //     setcookie('pass', '', time()-3600, '/');
                        // }
                        // *************************************************

                        // Log user in
                        $_SESSION['loggedin'] = true;
                        $_SESSION['userid'] = $user['id'];
                        $_SESSION['groupid'] = $user['groupid'];
                        $_SESSION['domain'] = $user['domain'];

                        session_write_close();

                        manageLoginAttempts("clear_all_attempts", $user['id']);

                        // *************************************************
                        // it is also possible to navigate directly from php
                        // *************************************************
                        // if ($_SESSION['groupid'] == 2) {
                        //     header("location: admin/dashboard.php");
                        // }
                        // else if ($_SESSION['groupid'] == 1) {
                        //     header("location: dashboard.php");
                        // }
                        // else {
                        //     $msg = "Unrecognized role";
                        // }
                        // *************************************************

                        // However, prefer to do this from javascript, so instead send back codes
                        $result = array( "code" => 0, "message" => "success", "groupid" => $_SESSION['groupid'] );
                    }
                    else {
                        $id = manageLoginAttempts("add_to_attempts", $user['id']);
                        if($id !== -1) {
                            $result = array( "code" => 1, "message" => "Incorrect username or password" );
                        }
                        else {
                            $result = array( "code" => 2, "message" => "Failed to connect to database" );
                        }
                    }
                }
                else {
                    $result = array( "code" => 3, "message" => "Maximum number of login attempts per hour exceeded" );
                }
            }
            else {
                $result = array( "code" => 4, "message" => "Email has not been validated" );
            }
        }
        else {
            $result = array( "code" => 1, "message" => "Incorrect username or password" );
        }
    }
    else {
        $result = array( "code" => 2, "message" => "Failed to connect to database" );
    }  
}
else {
    $result = array( "code" => 1, "message" => "Incorrect username or password" );
}

echo json_encode($result);

?>