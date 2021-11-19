<?php
include_once('initialize.php');
(new DotEnv(CORE_PATH.DS.'.env'))->load();

// Database Credentials
define("DB_HOST", '127.0.0.1');
define("DB_PORT", 3307);
define("DB_DATABASE", 'imanager_db');
define("DB_USERNAME", getenv('DB_USER'));
define("DB_PASSWORD", getenv('DB_PWD'));

// Global Variables
define("MAX_LOGIN_ATTEMPTS_PER_HOUR", 5);
define("MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY", 3);
define("MAX_PASSWORD_RESET_REQUESTS_PER_DAY", 3);
define("PASSWORD_RESET_REQUEST_EXPIRY_TIME", 60*60);
define("CSRF_TOKEN_SECRET", getenv('CSRF_SECRET'));

// Code we want to run on every page/script
// date_default_timezone_set("UTC"); 
// error_reporting(0);
session_set_cookie_params(['samesite' => 'Strict']);