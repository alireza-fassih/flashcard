<?php
require_once("incl.php");
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


?>
<!doctype html>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <main class="container">
            <?php printNotifications(); ?>
            <?php include( __DIR__ . "/fc-templates/word.php" ) ?>
        </main>
        <?php include("footer.php") ?>
    </body>
</html>