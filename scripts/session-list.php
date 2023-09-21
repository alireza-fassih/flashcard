<?php
require_once( __DIR__ . "/fc-include/include.php");
redirectToLoginInUserNotLoggedIn();


$oldToken = getXssToken();
$receivedToken = @$_POST['xssToken'];
$create = @$_POST['create'];

if( isset($receivedToken, $create) && $receivedToken == $oldToken ) {
    $sesstionId = createNewSession($DB);
    if( $sesstionId == -1 ) {
        captureDbError();
    }
    addSuccessNotification("new sesstion created $sesstionId");

    $wordAdded = fillSessionWithWords($DB, $sesstionId);
    if( $wordAdded == -1 ) {
        captureDbError();
    }
    addSuccessNotification("$wordAdded new word added to $sesstionId");
}


$_VIEW_DATA['xss-token'] = createNewXssToken();
$_VIEW_DATA['sessions'] = listAllNotDoneSession($DB);


$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/session-list.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>