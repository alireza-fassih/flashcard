<?php
require_once( __DIR__ . "/fc-include/include.php");
redirectToLoginInUserNotLoggedIn();

$wordId = @$_GET['id'];
$word = @$_POST['word'];
$meaning = @$_POST['meaning'];

if(isset($word, $meaning, $wordId)) {
    if( updateWordAndMeaning($wordId, $word, $meaning ) ) {
        addSuccessNotification("{$word} updated.");
    }
}


if( isset($wordId) ) {
    $_VIEW_DATA['word'] = loadWordById($DB, intval($wordId));
}


$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/word.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>