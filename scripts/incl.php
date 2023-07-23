<?php

const USER_ID_SESSION_KEY = "user_id";

require_once('userdao.php');

session_start();

$_CONFIG = parse_ini_file('app.env');
$DB = new mysqli($_CONFIG["DB_HOST"], $_CONFIG["DB_USER"], $_CONFIG["DB_PASS"], $_CONFIG["DB_NAME"]);


if ($DB->connect_errno) {
  echo "Failed to connect to MySQL: " . $DB->connect_error;
  exit();
}




function redirectToLoginInUserNotLoggedIn() {
  if(!isset($_SESSION[ USER_ID_SESSION_KEY ])) {
    redirectTo("/login.php");
  }
}


function redirectTo( $loc ) {
  header("location: $loc");
  exit();
}