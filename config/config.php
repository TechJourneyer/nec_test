<?php 
session_start();

defined('ROOTDIR') or define('ROOTDIR', dirname(__DIR__) .  DIRECTORY_SEPARATOR);
// base url
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/nec_test/');
include ROOTDIR . 'includes/functions.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('HOST', 'localhost');
define('DBNAME', 'nec_test');
define('USERNAME', 'swapnil');
define('PASSWORD', 'password');