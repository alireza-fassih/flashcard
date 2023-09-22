<?php



function redirectToLoginInUserNotLoggedIn() {
    if (!isset($_SESSION[USER_ID_SESSION_KEY])) {
        redirectTo("/login.php");
    }
}


function redirectTo($loc) {
    header("location: $loc");
    exit();
}

function createNewXssToken() {
    $rand = bin2hex(random_bytes(10));
    $_SESSION['xssToken'] = $rand;
    return $rand;
}

function getXssToken() {
    $token = @$_SESSION['xssToken'];
    unset($_SESSION['xssToken']);
    return $token;
}


function printNotifications() {
    global $_NOTIFICATIONS;
    foreach ($_NOTIFICATIONS as $n) {
        echo "<div class='alert alert-" . $n['level'] . "' role='alert'>" . $n['message'] . "</div>";
    }
}

function addSuccessNotification($msg) {
    global $_NOTIFICATIONS;
    $_NOTIFICATIONS[] = array("level" => "success", "message" => $msg);
}

function addErrorNotification($msg) {
    global $_NOTIFICATIONS;
    $_NOTIFICATIONS[] = array("level" => "danger", "message" => $msg);
}

function addInfoNotification($msg) {
    global $_NOTIFICATIONS;
    $_NOTIFICATIONS[] = array("level" => "primary", "message" => $msg);
}

function captureDbError() {
    global $DB;
    addErrorNotification("database error: " . $DB->error);
}
