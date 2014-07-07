<html>
    <head>
        <title>IYF - Index</title>
        <?php include './template/_head.php' ?>
    </head>
    <body>
        <div class="container">
            <?php include './template/navbar.php' ?>
            <?php
            echo 'This is what the $_session has<br><pre>';
            var_dump($_SESSION);
            echo '</pre>';
            ?>
        </div>
    </body>
</html>
