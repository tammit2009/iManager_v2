<?php 

//require_once 'config.php';
require_once 'php_libs/sendgrid/sendgrid-php.php';

function sendGridEmail($to, $toName, $subj, $msg) {

    $bypass = true;

    if ($bypass) {
        // temporarily bypass sending of emails 
        return true;
    }
    else {
        $email = new \SendGrid\Mail\Mail();

        $email->setFrom("tb.takaya@gmail.com", "Tammi Takaya");
        $email->setSubject($subj);
        $email->addTo($to, $toName);
        $email->addContent("text/plain", $msg);
    
        $sendgrid = new \SendGrid(getenv("SENDGRID_API_KEY"));
    
        try {
            $response = $sendgrid->send($email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
    
            if ($response->statusCode() === 202) {
                return true;
            }
        }
        catch (Exception $e) {
            //echo 'Caught exception: ' . $e->getMessage() . "\n";
            return false;
        }
    
    }
}

?>