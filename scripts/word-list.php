<?php
require_once( __DIR__ . "/fc-include/include.php");
redirectToLoginInUserNotLoggedIn();


$oldToken = getXssToken();
$receivedToken = @$_POST['xssToken'];
$remove = @$_POST['remove'];
$wordId = @$_POST['wordId'];

if( isset($receivedToken, $remove, $wordId) && $receivedToken == $oldToken ) {
    word_remove(intval($wordId));
}


$_VIEW_DATA['xss-token'] = createNewXssToken();
$_VIEW_DATA['words'] = loadWordsPage($DB);

$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/word-list.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>