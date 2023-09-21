<?php
require_once( __DIR__ . "/fc-include/include.php");


function redirectToHome() {
    redirectTo("/index.php");
}

if(isset($_SESSION[ USER_ID_SESSION_KEY ])) {
    redirectToHome();
}


if( isset($_POST['username'], $_POST['password']) ) {

    $user_id = loadUserIdForLogin($DB, $_POST['username'], $_POST['password']);

    if( !is_null($user_id) && is_numeric($user_id) ) {
        $_SESSION[ USER_ID_SESSION_KEY ] = $user_id;
        redirectToHome();
    }

    addErrorNotification("username or password not found");
}

$GENERAL_PAGE_NO_NAV = true;
$GENERAL_PAGE_INCLUDE =  __DIR__ . "/fc-templates/login.php";
include( __DIR__ . "/fc-templates/general-page.php" );

?>