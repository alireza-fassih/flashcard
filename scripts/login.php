<?php
include_once( "incl.php" );


$has_error = false;

if( isset($_POST['username'], $_POST['password']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    
    echo "Yeah";

    exit(0);
}

?>
<html>
    <head>

    </head>
    <body>
        <form method="post" action="login.php">
            <lable>username</lable>
            <input type="text" name="username" />

            <lable>password</lable>
            <input type="password" name="password" />

            <button type="submit" >login</button>
        </form>
    </body>
</html>
