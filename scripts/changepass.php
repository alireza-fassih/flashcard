<?php
require_once("incl.php");

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



?>
<!doctype html>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <form method="post" >
            <lable>current pass</lable>
            <input type="password" name="current" />
            <br />
            <lable>new pass</lable>
            <input type="password" name="new" />
            <br />
            <lable>repeat</lable>
            <input type="password" name="repeat" />
            <br />
            <button type="submit" >save</button>
        </form>
    </body>
</html>