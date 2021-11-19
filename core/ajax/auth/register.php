<?php 

include_once('../../initialize.php');
include_once('db_functions.php');
include_once('send_validation_email.php');

$results = [];

// validate name
if(!isset($_POST['name']) || strlen($_POST['name']) > 255 || !preg_match('/^[a-zA-Z- ]+$/', $_POST['name'])) {
    $results[] = array ( 'code' => 1, 'message' => 'Invalid name (only use letters, spaces, and hyphens)' );
}

// validate email
if(!isset($_POST['email']) || strlen($_POST['email']) > 255 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $results[] = array ( 'code' => 2, 'message' => 'Invalid email entered.' );
}
else if(!checkdnsrr(substr($_POST['email'], strpos($_POST['email'], '@') + 1), 'MX')) { // check for valid domain
    $results[] = array ( 'code' => 3, 'message' => 'Email does not exist. (This domain does not have a mail server)' );
}

// validate password
if(!isset($_POST['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['password'])) {
    $results[] = array ( 'code' => 4, 'message' => 'Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul>' );
}
else if(!isset($_POST['confirm-password']) || $_POST['confirm-password'] !== $_POST['password']) {
    $results[] = array ( 'code' => 5, 'message' => 'Passwords do not match. Please re-enter your confirmed password.' );
}

if(count($results) === 0) {
    
    if(isset($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {

        //Check if user with same email already exists
        $res = checkEmailExists($_POST['email']);
        if ($res > -1) {
            if ($res === 0) {
                // Create the account
                $id = createAccount($_POST['name'], $_POST['email'], $_POST['password']);
                
                if($id !== -1) {
                    // Check if there is a request to join group other than the default
                    if(isset($_POST['usergroupSelect'])) {
                        $group_name = $_POST['usergroupSelect'];
                        if ($group_name !== 'basic') {
                            $requestId = createGroupRequest($id, $group_name);
                            if ($requestId === -1) {
                                $errors[] = 102;    // unable to insert non-default group request
                            }                           
                        }
                    }
                    // Send Email Validation Message
                    $result = sendValidationEmail($_POST['email']);
                    if ($result['code'] === 0) {    // success;
                        $results[] = $result;
                    }
                    else {
                        $result['code'] = $result['code'] + 9;
                        $results[] = $result;
                    }
                }
                else {
                    // Failed to insert into database
                    $results[] = array ( 'code' => 6, 'message' => 'Failed to add account to database. Please try again later.' );
                }
            }
            else { // res > 0
                // This email is already in use
                $results[] = array ( 'code' => 7, 'message' => 'An account with this email already exists' );
            } 
        }
        else {
            // Failed to connect to database
            $results[] = array ( 'code' => 8, 'message' => 'Failed to connect to the database. Please try again later.' );
        }
    }
    else {
        //Invalid CSRF Token
        $results[] = array ( 'code' => 9, 'message' => 'Invalid CSRF Token. Please try again later.' );
    }
}

echo json_encode($results);

?>