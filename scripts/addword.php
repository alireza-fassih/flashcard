<?php
require_once("incl.php");

redirectToLoginInUserNotLoggedIn();


?>
<html>
    <head>
    </head>
    <body>
        <form method="post" action="addword.php">
            <lable>word</lable>
            <input type="text" name="word" />
            <br />
            <lable>meaning</lable>
            <input type="text" name="meaning" />
            <br />
            <button type="submit" >save</button>
        </form>
    </body>
</html>