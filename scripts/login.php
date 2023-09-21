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
<!doctype html>
<html>
    <head>
    <?php include("head.php") ?>
    </head>
    <body>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    Login Form
                </div>
                <div class="card-body">
                    <form method="post" action="login.php">
                        <?php 
                            if($has_error) {
                                echo "<p>username or password not found</p>";
                            }
                        ?>
                        <div class="mb-3">
                            <lable class="form-label">username</lable>
                            <input type="text" class="form-control" name="username" />
                        </div>
                        <div class="mb-3">
                            <lable class="form-label">password</lable>
                            <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" >login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include("footer.php") ?>
    </body>
</html>
