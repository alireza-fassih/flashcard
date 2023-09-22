<?php
if(!isset( $GENERAL_PAGE_INCLUDE )) {
    die( "Nothing to be loaded" );
}
?>
<!doctype html>
<html>
    <head>
    <?php include( __DIR__ . "/head.php" ) ?>
    </head>
    <body>
        <?php
        if(!isset($GENERAL_PAGE_NO_NAV)) { 
            include( __DIR__ . "/links.php");
        }
        ?>
        <main class="container mt-3">
            <?php printNotifications(); ?>
            <?php include( $GENERAL_PAGE_INCLUDE  ) ?>
        </main>
        <?php include( __DIR__ . "/footer.php" ) ?>
    </body>
</html>