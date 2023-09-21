<?php
require_once("incl.php");
redirectToLoginInUserNotLoggedIn();


?>
<!doctype html>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <main class="container">
            <?php
                foreach($infos as $v){
                    echo '<div class="alert alert-success" role="alert">';
                    echo $v;
                    echo '</div>';
                }
            ?>
            <form method="post">
                <div class="form-group">
                    <label for="word">Word</label>
                    <input type="text" class="form-control" name="word" id="word" />
                </div>
                <div class="form-group">
                    <label for="meaning">Meaning</label>
                    <textarea class="form-control" id="meaning" name="meaning"  rows="4" cols="50"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" >save</button>
                </div>
            </form>
        </main>
        <?php include("footer.php") ?>
    </body>
</html>