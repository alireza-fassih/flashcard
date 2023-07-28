<?php
require_once("incl.php");
redirectToLoginInUserNotLoggedIn();
$oldToken = getXssToken();

$sId = $_GET['id'];
$receivedXssToken = @$_POST["xssToken"];
$word = @$_POST["word"];
$ws = @$_POST["ws"];
$ok = @$_POST["ok"];
$no = @$_POST["no"];

if(isset($receivedXssToken, $word, $ws) && $oldToken == $receivedXssToken) {
    removeWordFromSession($DB, $ws);
    if( isset($ok) && $ok == "true") {
        increamentCorrectCountOfWord($DB, $word);
    } else if (isset($no) && $no == "true" ) {
        increamentWrongCountOfWord($DB, $word);
    }

}

$topWord = getToWordOfSession($DB, $sId);

if( $topWord['info'] == null ) {
    echo "session id done";
    removeSession($DB, $sId);
    redirectTo("/sessions.php");
}

$xssToken = createNewXssToken();
?>

<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>

        <div>
            <p>Word: <?= $topWord['word']->WORD ?></p>
            <p>correct count: <?= $topWord['word']->CORRECT_COUNT ?></p>
            <p>wrong count: <?= $topWord['word']->WRONG_COUNT ?></p>
            <p id="meaning" style="visibility: hidden;">meaning: <?= $topWord['word']->MEANING ?></p>
        </div>

        <a href="#" onclick="showMeaning();">show meaning</a>
        <br />

        <form method="post" >
            <input type="hidden" name="word" value="<?= $topWord['word']->ID ?>" />
            <input type="hidden" name="ws" value="<?= $topWord['info']->ID ?>" /> 
            <input type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
            <button type="submit" name="ok" value="true" >ok</button>
        </form>

        <br />

        <form method="post" >
            <input type="hidden" name="word" value="<?= $topWord['word']->ID ?>" />
            <input type="hidden" name="ws" value="<?= $topWord['info']->ID ?>" /> 
            <input type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
            <button type="submit" name="no" value="true" >no</button>
        </form>

    </body>
    <script  type="text/javascript">
        function showMeaning() {
            var node = document.getElementById('meaning');
            if (node.style.visibility=='visible') {
                node.style.visibility = 'hidden';
            } else {
                node.style.visibility = 'visible'
            }
        }
    </script>
</html>