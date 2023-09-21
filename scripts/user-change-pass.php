<?php
require_once( __DIR__ . "/fc-include/include.php");

redirectToLoginInUserNotLoggedIn();


$current = @$_POST['current'];
$new = @$_POST['new'];
$repeat = @$_POST['repeat'];

if(isset($current, $new, $repeat) && $new == $repeat) {
    if( changeUserPassword($DB, $_SESSION[ USER_ID_SESSION_KEY ], $current, $new) ) {
        unset( $_SESSION[ USER_ID_SESSION_KEY ] );
        redirectTo("/login.php");
        exit();
    }
}


$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/change-pass.php";
include( __DIR__ . "/fc-templates/general-page.php" );
?>