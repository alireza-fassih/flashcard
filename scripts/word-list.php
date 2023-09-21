<?php
require_once( __DIR__ . "/fc-include/include.php");
redirectToLoginInUserNotLoggedIn();



$_VIEW_DATA['words'] = loadWordsPage($DB);

$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/word-list.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>