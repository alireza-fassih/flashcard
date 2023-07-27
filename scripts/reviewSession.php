<?php
require_once("incl.php");
redirectToLoginInUserNotLoggedIn();
$oldToken = getXssToken();

$sId = $_GET['id'];


$topWord = getToWordOfSession($DB, $sId);

print_r( $topWord );

$xssToken = createNewXssToken();
?>

<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <form method="post" >
            <input type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
            <button type="submit" name="create" value="true" >new sesstion</button>
        </form>


        <br />

        
    </body>
</html>