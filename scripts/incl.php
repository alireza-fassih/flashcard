<?php

session_start();

$_CONFIG = parse_ini_file('app.env');

$DB = new mysqli($_CONFIG["DB_HOST"], $_CONFIG["DB_USER"], $_CONFIG["DB_PASS"], $_CONFIG["DB_NAME"]);


if ($DB -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}