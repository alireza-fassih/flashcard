<?php
require_once("incl.php");
redirectToLoginInUserNotLoggedIn();


$oldToken = getXssToken();
$receivedToken = @$_POST['xssToken'];
$create = @$_POST['create'];

if( isset($receivedToken, $create) && $receivedToken == $oldToken ) {
    $sesstionId = createNewSession($DB);
    if( $sesstionId == -1 ) {
        echo "Error: " . $DB->error;
    }
    echo "new sesstion created $sesstionId <br>";

    $wordAdded = fillSessionWithWords($DB, $sesstionId);
    if( $wordAdded == -1 ) {
        echo "Error: " . $DB->error;
    }
    echo "$wordAdded new word added to $sesstionId";
}


$xssToken = createNewXssToken();
?>

<html>
    <head>
    </head>
    <body>
        <?php include("links.php") ?>
        <form method="post" >
            <input type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
            <button type="submit" name="create" value="true" >new sesstion</button>
        </form>
    </body>
</html>