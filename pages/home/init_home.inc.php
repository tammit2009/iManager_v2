<?php 
require_once './core/security.php';

$home_pages = dirname(__FILE__);        //$main_pages = dirname(__FILE__).DS.'main';

$include_file = PAGES_PATH.DS.'exceptions'.DS.'404.page.inc.php';

if (isset($_GET['dir']) && !empty($_GET['dir'])) {
    $home_pages = $home_pages.DS.$_GET['dir'];
}

// Check if the requested page actually exists
if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$home_pages}"))) == false ) {
    header('HTTP/1.1 404 Not Found');
    header('Location: home.php?page=index');     // kill it here or comment out to redirect to 404 Error
    die();                                       // and here...
}
else {
    // Import the page of interest
    $include_file = "{$home_pages}".DS."{$_GET['page']}.page.inc.php";
}

// // Access Control: extract full user information
// $mgr = new UserManager();
// $user = $mgr->getUser($_SESSION['userid']); 
// // if ($user == 'NO_DATA' || $user == 'UNABLE_TO_CONNECT') exit;
// // Session Validation: including a check that user belongs to admin group
// // if(!$mgr->isRoleInGroup("admin", $_SESSION['groupid'])) {    
// //      header("location: ".DOMAIN."/exception.php?page=not_logged_in"); exit;
// // }
// $mgr->close();

// Import required methods from Core or Inc folder
// include("{$core_path}/inc/messaging_functions.inc.php");
// include("../notifications/core/inc/notification_functions.inc.php");

?>