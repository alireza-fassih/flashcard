<?php
require_once( "incl.php" );

$has_error = false;

if( isset($_POST['username'], $_POST['password']) ) {

    $username = $DB->real_escape_string($_POST['username']);
    $password = $DB->real_escape_string(hash("sha256", $_POST['password']));

    $stmt = $DB->prepare("SELECT ID FROM FC_USER WHERE USERNAME=? AND PASS=?"); 
    $stmt->bind_param('ss', $username, $password);
    $stmt -> execute();

    $stmt -> bind_result($user_id);
    $stmt -> fetch();
    $stmt -> close();

    if( !is_null($user_id) && is_numeric($user_id) ) {
        echo "User found {$user_id}";
    
        exit(0);
    }

    $has_error = true;
}

$DB->close();
?>
<html>
    <head>

    </head>
    <body>
        <form method="post" action="login.php">
            <?php 
                if($has_error) {
                    echo "<p>username or password not found</p>";
                }
            ?>
            <lable>username</lable>
            <input type="text" name="username" />

            <lable>password</lable>
            <input type="password" name="password" />

            <button type="submit" >login</button>
        </form>
    </body>
</html>
