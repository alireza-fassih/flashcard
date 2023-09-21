<?php


require_once(__DIR__ . '/functions.php');
require_once( __DIR__ . '/userdao.php');
require_once( __DIR__ . '/word.php');
require_once(__DIR__ . '/sessiondao.php');

const USER_ID_SESSION_KEY = "user_id";

session_start();

$_NOTIFICATIONS = array();
$_VIEW_DATA = array();


$_CONFIG = parse_ini_file( __DIR__ . '/app.env');
$DB = new mysqli($_CONFIG["DB_HOST"], $_CONFIG["DB_USER"], $_CONFIG["DB_PASS"], $_CONFIG["DB_NAME"]);

if ($DB->connect_errno) {
  echo "Failed to connect to MySQL: " . $DB->connect_error;
  exit();
}

$DB->query("SET NAMES utf8");