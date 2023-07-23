<?php
require_once( "incl.php" );


function redirectToHome() {
    redirectTo("/index.php");
}

if(isset($_SESSION[ USER_ID_SESSION_KEY ])) {
    redirectToHome();
}


$has_error = false;

if( isset($_POST['username'], $_POST['password']) ) {

    $user_id = loadUserIdForLogin($DB, $_POST['username'], $_POST['password']);

    if( !is_null($user_id) && is_numeric($user_id) ) {
        $_SESSION[ USER_ID_SESSION_KEY ] = $user_id;
        redirectToHome();
    }

    $has_error = true;
}

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
            <br />
            <lable>password</lable>
            <input type="password" name="password" />

            <button type="submit" >login</button>
        </form>
    </body>
</html>
