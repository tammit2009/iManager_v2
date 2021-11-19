<?php 
require_once './core/security.php';

$notifications_pages = dirname(__FILE__);

$include_file = PAGES_PATH.DS.'exceptions'.DS.'404.page.inc.php';

// Check if the requested page actually exists
if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$notifications_pages}"))) == false ) {
    header('HTTP/1.1 404 Not Found');
    header('Location: notifications.php?page=notification_list');
    die();
}
else {
    // Import the page of interest
    $include_file = "{$notifications_pages}".DS."{$_GET['page']}.page.inc.php";
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

?>

<?php 
// require_once '../core/security.php';  

// $core_path = dirname(__FILE__);
// $ds = DIRECTORY_SEPARATOR;

// if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$core_path}/pages"))) == false ) {
//     header('HTTP/1.1 404 Not Found');
//     header('Location: index.php?page=notification-list');
//     die();
// }

// include("{$core_path}/inc/notification_functions.inc.php");

// // import from messaging
// include("../messaging/core/inc/messaging_functions.inc.php");

// $include_file = "{$core_path}{$ds}pages{$ds}{$_GET['page']}.page.inc.php";

?>