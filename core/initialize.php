<?php

// set timezone
date_default_timezone_set("Africa/Lagos");

// path separator
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);  

// url base path
defined('DOMAIN') ? null        : define("DOMAIN", "http://localhost/imanager");

// base path: "c:\xampp2\htdocs\imanager"
defined('SITE_ROOT') ? null     : define('SITE_ROOT', DS.'xampp2'.DS.'htdocs'.DS.'imanager'); 

// sub-folders
defined('INC_PATH') ? null      : define('INC_PATH',        SITE_ROOT.DS.'inc');
defined('CORE_PATH') ? null     : define('CORE_PATH',       SITE_ROOT.DS.'core');
defined('LIB_PATH') ? null      : define('LIB_PATH',        INC_PATH.DS.'libs');
defined('DB_PATH') ? null       : define('DB_PATH',         CORE_PATH.DS.'db');
defined('API_PATH') ? null      : define('API_PATH',        CORE_PATH.DS.'api');
defined('MODELS_PATH') ? null   : define('MODELS_PATH',     CORE_PATH.DS.'models');
defined('UPLOADS_PATH') ? null  : define('UPLOADS_PATH',    SITE_ROOT.DS.'uploads');
defined('PAGES_PATH') ? null    : define('PAGES_PATH',      SITE_ROOT.DS.'pages');
defined('SVC_PATH') ? null      : define('SVC_PATH',        CORE_PATH.DS.'services');

defined('PROFILE_PIX_PATH') ? null : define('PROFILE_PIX_PATH', UPLOADS_PATH.DS.'profile_pix'.DS);
defined('PROFILE_PIX_URL_BASE_PATH') ? null  : define("PROFILE_PIX_URL_BASE_PATH", DOMAIN.'/uploads/profile_pix/');

// Load the config & utils files first (note that the order matters)
require_once(INC_PATH.DS.'dotenv.php');
require_once(INC_PATH.DS.'utils.php');
require_once(CORE_PATH.DS.'config.php');
require_once(INC_PATH.DS.'sendgrid_email.php');
require_once(DB_PATH.DS.'db_operations.php');
require_once(SVC_PATH.DS.'user_manager.php');
require_once(SVC_PATH.DS.'user_functions.php');
require_once(SVC_PATH.DS.'page_functions.php');
require_once(SVC_PATH.DS.'notification_functions.php');
require_once(SVC_PATH.DS.'messaging_functions.php');
require_once(SVC_PATH.DS.'controller.php');

// require_once(SVC_PATH.DS.'invoice_bill.php');

// Core classes
require_once(MODELS_PATH.DS."user.php");

?>