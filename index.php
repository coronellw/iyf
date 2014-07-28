<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Index</title>
        <?php include './template/_head.php' ?>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            include './template/navbar.php';
            if (isset($_SESSION['user'])) {
                echo $_SESSION['user']['names'];
            } else {
                ?>
            <h3>Que es IYF?</h3>
            <p>IYF es...</p>
                <?php
            }
            ?>
        </div>
    </body>
</html>
