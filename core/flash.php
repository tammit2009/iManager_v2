<?php 

# Flash Message
function flash($name, $text = "") {
    if (isset($_SESSION[$name])) {
        $msg = $_SESSION[$name];    
        unset($_SESSION[$name]);
        return $msg;                // retrieve the message and unset the session at the response side
    }
    else {
        $_SESSION[$name] = $text;   // set the desired text in session in the handler
    }
    return '';
}

// Send Notification
if (isset($_POST['send_notification'])) {

    $status = $_POST['status'];
    $msg = $_POST['msg'];

    flash("status", $status);
    flash("msg", $msg);

    echo 0;
}

?>