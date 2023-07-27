<?php
require_once("incl.php");

redirectToLoginInUserNotLoggedIn();


$word = @$_POST['word'];
$meaning = @$_POST['meaning'];

if(isset($word, $meaning)) {
    if( saveNewWord($DB, $word, $meaning) ) {
        echo "OK";
    }
}

?>
<html>
    <head>
    </head>
    <body>
        <?php include("links.php") ?>
        <form method="post" action="addword.php">
            <lable>word</lable>
            <input type="text" name="word" />
            <br />
            <lable>meaning</lable>
            <textarea type="text" name="meaning"  rows="4" cols="50" ></textarea>
            <br />
            <button type="submit" >save</button>
        </form>
    </body>
</html>