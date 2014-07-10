<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include './template/_head.php'; ?>
        <title>IYF - Sign in</title>
        <link href="css/signin.css" type="text/css" rel="stylesheet">

    </head>

    <body>
        <div class="container">
            <div class="form-signin" >
                <div id="alerts">
                    <?php
                    if (isset($_SESSION['messages'])) {
                        for ($i = 0; $i < count($_SESSION['messages']); $i++) {
                            $message = $_SESSION['messages'][$i];
                            ?>
                            <div class="alert alert-dismissible alert-<?php echo $message['type'] ?>">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">
                                        &times;
                                    </span>
                                    <span class="sr-only">
                                        Close
                                    </span>
                                </button>
                                <strong>
                                    <?php echo $message['title']; ?>
                                </strong>
                                <span class="alert-content">
                                    <?php echo $message['message']; ?>
                                </span>
                            </div>
                            <?php
                        }
                        unset($_SESSION['messages']);
                    }
                    ?>
                </div>
                <form action="requests/createSession.php" method="post">
                    <h2 class="form-signin-heading">Por favor ingrese...</h2>
                    <input type="username" id="username" name="username" class="form-control" placeholder="Nombre de usuario" required autofocus>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>

                    <button type="submit" class="btn btn-lg btn-primary btn-sm">
                        Ingresar
                    </button>
                    <a href="#" class="btn btn-lg btn-primary btn-sm" onclick="window.location.href = 'registration.php'">
                        Registrarse
                    </a>
                </form>
            </div>
        </div>
    </body>
</html>
