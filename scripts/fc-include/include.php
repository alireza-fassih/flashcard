<?php

const USER_ID_SESSION_KEY = "user_id";

require_once( __DIR__ . '/userdao.php');
require_once( __DIR__ . '/word.php');
require_once(__DIR__ . '/sessiondao.php');

session_start();

$_NOTIFICATIONS = array();
$_VIEW_DATA = array();


function redirectToLoginInUserNotLoggedIn() {
  if(!isset($_SESSION[ USER_ID_SESSION_KEY ])) {
    redirectTo("/login.php");
  }
}


function redirectTo( $loc ) {
  header("location: $loc");
  exit();
}

function createNewXssToken() {
  $rand = bin2hex(random_bytes(10)); 
  $_SESSION['xssToken'] = $rand;
  return $rand;
}

function getXssToken() {
  $token = @$_SESSION['xssToken'];
  unset($_SESSION['xssToken']);
  return $token;
}


function printNotifications() {
  global $_NOTIFICATIONS;
  foreach($_NOTIFICATIONS as $n){
    echo "<div class='alert alert-" . $n['level'] . "' role='alert'>" . $n['message'] . "</div>";
  }
}

function addSuccessNotification($msg) {
  global $_NOTIFICATIONS;
  $_NOTIFICATIONS[] = array("level"=>"success", "message"=> $msg);
}

function addErrorNotification($msg) {
  global $_NOTIFICATIONS;
  $_NOTIFICATIONS[] = array("level"=>"danger", "message"=> $msg);
}


function captureDbError() {
  global $DB;
  addErrorNotification("database error: " . $DB->error);
}



$_CONFIG = parse_ini_file( __DIR__ . '/app.env');
$DB = new mysqli($_CONFIG["DB_HOST"], $_CONFIG["DB_USER"], $_CONFIG["DB_PASS"], $_CONFIG["DB_NAME"]);

if ($DB->connect_errno) {
  echo "Failed to connect to MySQL: " . $DB->connect_error;
  exit();
}

$DB->query("SET NAMES utf8");