<?php 

include_once('initialize.php');

session_start();

// **** Debugging ************************************************** 

$test_logout = false;

if ($test_logout) {
    // Debug: Log user out
    // $_SESSION = [];   
    if (isset($_SESSION['loggedin'])) unset($_SESSION['loggedin']);
    if (isset($_SESSION['userid'])) unset($_SESSION['userid']);
    if (isset($_SESSION['groupid'])) unset($_SESSION['groupid']);
} 

$test_login = false;

if ($test_login) {
    // Debug: Log user in
    $_SESSION['loggedin'] = true;
    $_SESSION['userid'] = 45;
    $_SESSION['groupid'] = 2;
}

// $_SESSION['msg'] = 'Two for the price of one!';
// $_SESSION['status'] = 'warning';

// if (isset($_SESSION['msg'])) unset($_SESSION['msg']);
// if (isset($_SESSION['status'])) unset($_SESSION['status']);


// ******************************************************************** 

if(!isset( $_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {    
    // header("location: ".DOMAIN."/exception.php?page=not_logged_in"); exit;
}
else {

    // Access Control: extract full user information
    $user = getUserById($_SESSION['userid']);
    // if ($user == -1 || empty($user)) exit;

    // Session Validation: including a check that user belongs to admin group
    // if(!isRoleInGroup("admin", $_SESSION['groupid'])) {    
    //      header("location: ".DOMAIN."/exception.php?page=not_logged_in"); exit;
    // }

    include_once('permit.php');
    include_once('flash.php');
}

?>