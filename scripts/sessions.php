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
$sessions = listAllNotDoneSession($DB);
?>
<!doctype html>
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

        <table>
            <tr>
                <th>Id</th>
                <th>Create date</th>
                <th>action</th>
            </tr>

            <?php
                for($x = 0; $x < count($sessions); $x++) {
                    $s = $sessions[$x];
                    echo "<tr>";
                    echo "<td>" . $s->ID ."</td>";
                    echo "<td>" . $s->CREATEDATE ."</td>";
                    echo "<td><a href='/reviewSession.php?id=$s->ID'>Go to Session</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php include("footer.php") ?>
    </body>
</html>