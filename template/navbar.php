<?php
function closeSession() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
}

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/iyf/index.php">IYF</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
<?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="#">Registro</a></li>
                    <li><a href="#">Pagos</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Asistentes</a></li>
                            <li><a href="#">Staff</a></li>
                            <li><a href="#">Maestros</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Estad&iacute;sticas</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Asistencias</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php echo $_SESSION['user']['names']; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Otros</a></li>
                            <li class="divider"></li>
                            <li><a href="login.php" onclick="<?php closeSession(); ?>">Salir</a></li>
                        </ul>
                    </li>
<?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>