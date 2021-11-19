<?php
include_once('../../security.php');
include_once('db_functions.php');

// Validate post variables & CSRF token
$results = [];

if(empty($_POST['id'])) {
    $results[] = array ( 'code' => 1, 'message' => '1 Invalid password reset request. If this is a mistake send a new request and click the link in the email.' );
}

if(empty($_POST['hash'])) {
    // No hash
    $results[] = array ( 'code' => 2, 'message' => '2 Invalid password reset request. If this is a mistake send a new request and click the link in the email.' );
}

if(!isset($_POST['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['password'])) {
    // Password must have upper & lower letters + at least one number + at least one symbol and be 8 or more chars long
    $results[] = array ( 'code' => 3, 'message' => 'Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul>' );
}
else if(!isset($_POST['confirm-password']) || $_POST['confirm-password'] !== $_POST['password']) {
    // Passwords do not match
    $results[] = array ( 'code' => 4, 'message' => 'Passwords do not match. Please re-enter your confirmed password.' );
}

if(count($results) === 0) {
    if(isset($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {

        $request = getPendingResetRequest($_POST['id']);

        if ($request !== -1) {
            if (!empty($request)) { 
                // password_verify hash
                if(password_verify(urlSafeDecode($_POST['hash']), $request['hash'])) {

                    // check if request is expired
                    if($request['timestamp'] >= time() - PASSWORD_RESET_REQUEST_EXPIRY_TIME) {

                        $res = updatePassword($request['userid'], $_POST['password']);
                        if ($res == 0) {
                            // success
                            $results[] = array ( 'code' => 0, 'message' => 'Your password has been reset! You can now <a href="./login">login</a>' );
                        }
                        else if ($res == -1) {
                            // Failed to connect to database
                            $results[] = array ( 'code' => 8, 'message' => 'Failed to connect to the database. Please try again later.' );
                        }
                        else if ($res == -2) {
                            // Failed to update password
                            $results[] = array ( 'code' => 5, 'message' => 'Failed to update password in the database. Please try again later.' );
                        }
                        else if ($res == -3) {
                            // unable to delete all linked reset requests for the user
                            $results[] = array ( 'code' => 10, 'message' => 'Failed to delete all linked reset requests for the user.' );
                        }
                        else {
                            // Unknown error
                            $results[] = array ( 'code' => 11, 'message' => 'An unknown error occurred. Please try again later.' );
                        }
                    }
                    else {
                        // This reset request has expired
                        $results[] = array ( 'code' => 6, 'message' => 'This password reset request has expired. Please send another email.' );
                    }
                }
                else {
                    // Invalid password reset request
                    $results[] = array ( 'code' => 7, 'message' => '3 Invalid password reset request. If this is a mistake send a new request and click the link in the email.' );
                }
            }
            else {
                // Invalid password reset request
                $results[] = array ( 'code' => 7, 'message' => '4 Invalid password reset request. If this is a mistake send a new request and click the link in the email.' );
            }
        }
        else {
            // Failed to connect to database
            $results[] = array ( 'code' => 8, 'message' => 'Failed to connect to the database. Please try again later.' );
        }
    }
    else {
        // Invalid CSRF token
        $results[] = array ( 'code' => 9, 'message' => 'Invalid CSRF Token. Please try again later.' );
    }
}

echo json_encode($results);

	
	