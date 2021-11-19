<?php 
require_once './core/security.php';

$messages_pages = dirname(__FILE__);

$include_file = PAGES_PATH.DS.'exceptions'.DS.'404.page.inc.php';

// Check if the requested page actually exists
if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$messages_pages}"))) == false ) {
    header('HTTP/1.1 404 Not Found');
    header('Location: messages.php?page=inbox');
    die();
}
else {
    // Import the page of interest
    $include_file = "{$messages_pages}".DS."{$_GET['page']}.page.inc.php";
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
    // require_once 'core/init.inc.php';
    
    // // Session Validation: including a check that user belongs to admin group
    // //                     and setting the user in js
    // $mgr = new DbManager();

    // if(empty($_SESSION['userid']) || !isset( $_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {    
    //     header("location: " . DOMAIN . "/login.php"); exit;
    // }
    // // if (empty($_SESSION['user_id']) && $_GET['page'] !== 'login') {
    // //     header('HTTP/1.1 403 Forbidden');
    // //     header('Location: index.php?page=login');
    // //     die();
    // // }

    // $user = $mgr->getUser($_SESSION['userid']);
    // if ($user == 'NO_DATA' || $user == 'UNABLE_TO_CONNECT') exit;
    // $mgr->close();

    
    // include("{$core_path}/inc/messaging_functions.inc.php");

    // // import from notifications
    // include("../notifications/core/inc/notification_functions.inc.php");

?>