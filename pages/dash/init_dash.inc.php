<?php 
require_once './core/security.php';

$dashboard_pages = dirname(__FILE__);

// Check if the requested page actually exists
if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$dashboard_pages}"))) == false ) {
    header('HTTP/1.1 404 Not Found');
    header('Location: dashboard.php?page=index');
    die();
}

// // Access Control: extract full user information
// $mgr = new UserManager();
// $user = $mgr->getUser($_SESSION['userid']); 
// // if ($user == 'NO_DATA' || $user == 'UNABLE_TO_CONNECT') exit;

// // Session Validation: including a check that user belongs to admin group
// // if(!$mgr->isRoleInGroup("admin", $_SESSION['groupid'])) {    
// //      header("location: ".DOMAIN."/exception.php?page=not_logged_in"); exit;
// // }

// // // Route to home dashboard if already logged in
// // if ($_GET['page'] === 'login' && isset( $_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { 
// //     // Choose dashboard page based on user profile
// //     // if ($mgr->isRoleInGroup("admin", $_SESSION['groupid']))
// //     //     header("location: ".DOMAIN."/dashboard.php?page=index");
// //     // else 
// //     //     header("location: ".DOMAIN."/dashboard.php?page=index");

// //     header("location: ".DOMAIN."/dashboard.php?page=index");
// // }

// // Session Validation: including a check that user belongs to admin group and setting the user in js
// if(!isset( $_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // if (!$mgr->isRoleInGroup("admin", $_SESSION['groupid'])) {    
//     //     header("location: ".DOMAIN."/"); exit;
//     // }
//     header("location: ".DOMAIN."/exception.php?page=not_logged_in");
// }



// $mgr->close();

// Import the page of interest
$include_file = "{$dashboard_pages}".DS."{$_GET['page']}.page.inc.php";

?>