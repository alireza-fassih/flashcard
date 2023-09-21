<?php
require_once( __DIR__ . "/fc-include/include.php");

redirectToLoginInUserNotLoggedIn();


$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/index.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>