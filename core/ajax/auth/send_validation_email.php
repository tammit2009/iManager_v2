<?php 

include_once('../../security.php');
include_once('db_functions.php');

function sendValidationEmail($email) {
    // one day ago in timestamps
    $oneDayAgo = time() - 60 * 60 * 24;
    $user = getAccountValidationRequestAttemptsForUser($oneDayAgo, $email);
    if ($user !== -1) {
        if (!empty($user)) {
            if ($user['verified'] === 0) {
                if ($user['COUNT(validation_requests.id)'] <= MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY) {

                    // Send validation request
                    $verifyCode = random_bytes(16);                         // code to be send to requesting user by email

                    // insert verification request
                    $requestID = logAccountValidationRequest($user['id'], $verifyCode);

                    if ($requestID !== -1) {

                        // Prepare the email in format: https://localhost/imanager/validate/52/U1Cl0lFf2T-M8FEKatrMMA
                        // ( tmp: http://localhost/imanager/auth.php?page=validate_email&reqid=52&verify=U1Cl0lFf2T-M8FEKatrMMA )
                        $validation_url = DOMAIN."/auth.php?page=validate_email&reqid=".$requestID.'&verify='.urlSafeEncode($verifyCode);
                        
                        // Send Email
                        if (sendGridEmail(  $email, 
                                            $user['name'], 
                                            'Email Verification', 
                                            '<a href="'.$validation_url.'">Click this link to verify your email</a>') ) {
                                                
                            // 'mail sent!';
                            return array ( 'code' => 0,  'message' => 'mail sent!' );
                        }
                        else {
                            // 'failed to send email';
                            return array ( 'code' => 1, 'message' => 'failed to send email' );
                        }
                    } 
                    else { 
                        // 'failed to insert request'
                        return array ( 'code' => 2, 'message' => 'failed to insert request' );
                    }       
                } 
                else { 
                    // Too many attempts in one day
                    return array ( 'code' => 3, 'message' => 'too many attempts in one day' );
                }       
            } 
            else { 
                // Email already verified
                return array ( 'code' => 4, 'message' => 'email already verified' );
            }       
        } 
        else { 
            // 'no user with this email';
            return array ( 'code' => 5, 'message' => 'no user with this email' );
        } 
    }
    else { 
        // Unable to connect to db
        return array ( 'code' => 6, 'message' => 'unable to connect to db' );
    }                        
}

if(isset($_POST['validateEmail']) && isset($_POST['csrf_token']) && validateCsrfToken($_POST['csrf_token'])) {
    // return an array of result messages (in this case only one message)
    $result = sendValidationEmail($_POST['validateEmail']); 
    echo json_encode($result);
}

?>