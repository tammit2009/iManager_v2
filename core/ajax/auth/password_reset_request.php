<?php
include_once('../../initialize.php');
include_once('db_functions.php');

// Validate post variables & CSRF token
if(!empty($_POST['resetEmail'])) {
    if(!empty($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {

        // one day ago in timestamps
        $oneDayAgo = time() - 60 * 60 * 24;

        $user = getPasswordResetRequestAttemptsForUser($oneDayAgo, $_POST['resetEmail']);
        if ($user !== -1) {
            if (!empty($user)) {
                // Check if # of requests per day is valid
                if($user['COUNT(validation_requests.id)'] < MAX_PASSWORD_RESET_REQUESTS_PER_DAY) {   

                    // create code & insert into requests database
                    $code = random_bytes(32); # 256 bit code to be send to requesting user by email

                    // insert verification request
                    $insertID = logPasswordResetRequest($user['id'], $code);

                    if($insertID !== -1) {
                        // Prepare the email in format: https://localhost/imanager/reset/52/U1Cl0lFf2T-M8FEKatrMMA
                        // ( tmp: http://localhost/imanager/auth.php?page=reset_password&reqid=52&reset=U1Cl0lFf2T-M8FEKatrMMA )
                        $reset_url = "http://localhost/imanager/auth.php?page=reset_password&reqid=".$insertID.'&reset='.urlSafeEncode($code);
                        
                        // Send Email
                        if (sendGridEmail(  $_POST['resetEmail'], 
                                            $user['name'], 
                                            'Email Verification', 
                                            '<a href="'.$reset_url.'">Click Here to Reset your Password</a>') ) {                                                   
                            // 'mail sent!';
                            echo json_encode(array ( 'code' => 0,  'message' => 'mail sent!' ));
                        }
                        else {
                            // 'failed to send email';
                            echo json_encode(array ( 'code' => 1, 'message' => 'failed to send email' ));
                        }
                    }
                    else {
                        // 'failed to insert request'
                        echo json_encode(array ( 'code' => 2, 'message' => 'failed to insert request' ));
                    }
                }
                else {
                    // Too many requests in the last 24 hours... try again later
                    echo json_encode(array ( 'code' => 3, 'message' => 'too many attempts in the last 24 hours... try again later' ));
                }
            }
            else {
                // No user with this email - i.e. Account does not exist. However, indicate that an email 
                // was sent, as if an account with that email exists to confound potential hackers 
                echo json_encode(array ( 'code' => 0, 'message' => 'email sent...' ));
            }
        }
        else {
            // Failed to connect to db
            echo json_encode(array ( 'code' => 4, 'message' => 'unable to connect to db' ));
        }     
    }
    else {
        //Invalid CSRF Token
        echo json_encode(array ( 'code' => 5, 'message' => 'Invalid CSRF Token. Please try again later.' ));
    }
}
else {
    // Email is not valid
    echo json_encode(array ( 'code' => 6, 'message' => 'Invalid CSRF Token. Please try again later.' ));
}

?>
	