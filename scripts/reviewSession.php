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
    removeSession($DB, $sId);
    redirectTo("/sessions.php");
}

$xssToken = createNewXssToken();
?>
<!doctype html>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <main class="container">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $topWord['word']->WORD ?></h5>
                    <p class="card-text">
                        correct count: <?= $topWord['word']->CORRECT_COUNT ?>
                        -
                        wrong count: <?= $topWord['word']->WRONG_COUNT ?>
                    </p>
                    <p class="card-text" id="meaning" style="visibility: hidden;">
                        <?= $topWord['word']->MEANING ?>
                    </p>
                </div>

                <div class="card-body">
                    <a href="#" class=" btn btn-primary btn-lg" onclick="showMeaning();">show meaning</a>
                </div>

                <div class="card-body">
                    <form method="post" >
                        <input  type="hidden" name="word" value="<?= $topWord['word']->ID ?>" />
                        <input  type="hidden" name="ws" value="<?= $topWord['info']->ID ?>" /> 
                        <input  type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
                        <button type="submit" class="btn btn-success btn-lg" name="ok" value="true" >ok</button>
                    </form>
                </div>

                <div class="card-body">
                    <form method="post" >
                        <input  type="hidden" name="word" value="<?= $topWord['word']->ID ?>" />
                        <input  type="hidden" name="ws" value="<?= $topWord['info']->ID ?>" /> 
                        <input  type="hidden" name="xssToken" value="<?= $xssToken ?>"/>
                        <button type="submit" class="btn btn-danger btn-lg" name="no" value="true" >no</button>
                    </form>
                </div>
            </div>

            

            <br />

            
        </main>
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