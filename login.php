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
                <h2 class="form-signin-heading">Por favor ingrese...</h2>
                <input type="username" id="username" class="form-control" placeholder="Nombre de usuario" required autofocus>
                <input type="password" id="password" class="form-control" placeholder="Contraseña" required>

                <a href="#" class="btn btn-lg btn-primary btn-sm" onclick="requestLogin();">
                    Ingresar
                </a>
                <a href="#" class="btn btn-lg btn-primary btn-sm" onclick="window.location.href = 'registration.php'">
                    Registrarse
                </a>
            </div>
        </div>
    </body>
</html>
