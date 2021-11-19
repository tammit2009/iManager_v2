<?php 
require_once './core/initialize.php';

$exception_pages = dirname(__FILE__);

$include_file = PAGES_PATH.DS.'exceptions'.DS.'404.page.inc.php';

// Check if the requested page actually exists
if ( empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", (scandir("{$exception_pages}"))) == false ) {
    header('HTTP/1.1 404 Not Found');
    header('Location: exception.php?page=index');
    die();
}
else {
    // Import the page of interest
    $include_file = "{$exception_pages}".DS."{$_GET['page']}.page.inc.php";
}

?>