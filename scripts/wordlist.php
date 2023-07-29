<?php
require_once("incl.php");
redirectToLoginInUserNotLoggedIn();




$words = loadWordsPage($DB);

?>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <?php include("links.php") ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Create date</th>
                <th>Word</th>
                <th>Meaning</th>
                <th>Correct</th>
                <th>Wrong</th>
            </tr>

            <?php
                for($x = 0; $x < count($words); $x++) {
                    $s = $words[$x];
                    echo "<tr>";
                    echo "<td>" . $s->ID ."</td>";
                    echo "<td>" . $s->CREATEDATE ."</td>";
                    echo "<td>" . $s->WORD ."</td>";
                    echo "<td>" . $s->MEANING ."</td>";
                    echo "<td>" . $s->CORRECT_COUNT ."</td>";
                    echo "<td>" . $s->WRONG_COUNT ."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>