<?php
require_once( __DIR__ . "/fc-include/include.php");

redirectToLoginInUserNotLoggedIn();


$word = @$_POST['word'];
$meaning = @$_POST['meaning'];


if(isset($word, $meaning)) {
    if( saveNewWord($DB, $word, $meaning) ) {
        addSuccessNotification("{$word} added.");
    }
}

$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/word.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>