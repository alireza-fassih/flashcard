<?php
require_once( __DIR__ . "/fc-include/include.php");
redirectToLoginInUserNotLoggedIn();
$oldToken = getXssToken();

$sId = $_GET['id'];
$receivedXssToken = @$_POST["xssToken"];
$word = @$_POST["word"];
$ws = @$_POST["ws"];
$ok = @$_POST["ok"];
$no = @$_POST["no"];

$remining = @$_POST['remining'];

if(isset($receivedXssToken, $word, $ws) && $oldToken == $receivedXssToken) {
    removeWordFromSession($DB, $ws);
    if( isset($ok) && $ok == "true") {
        increamentCorrectCountOfWord($DB, $word);
    } else if (isset($no) && $no == "true" ) {
        increamentWrongCountOfWord($DB, $word);
    }
}

if(!isset($remining)) {
    $remining = sessions_count_remining_words( intval($sId) );
}


addInfoNotification( "in this session $remining word(s) is remaining" );

$_VIEW_DATA['remining'] = $remining - 1;

$topWord = getToWordOfSession($DB, $sId);

if( $topWord['info'] == null ) {
    removeSession($DB, $sId);
    redirectTo("/session-list.php");
}

$xssToken = createNewXssToken();

$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/session-review.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>