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
            <h1 class="header-logo" id="logo">
                <a class="navbar-brand" href="/index.php">
                    <img src="/img/logo1.png" />
                </a>
            </h1>            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="/registration.php">Registro</a></li>
                    
                    <li class="dropdown">
                        <a href="/#" class="dropdown-toggle" data-toggle="dropdown">Registrar <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/assistance/maestros.php">Asistencia de Maestro</a></li>
                            <li><a href="/assistance/estudiantes.php">Asistencia de estudiante</a></li>
                            <li><a href="/payments/">Pagos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/groups">Grupos</a></li>
                            <li><a href="/consultas/maestros.php">Maestros</a></li>
                            <li><a href="/consultas/general.php">General</a></li>
                            <li><a href="/consultas/payment.php">Pagos</a></li>
                            <li class="divider"></li>
                            <li><a href="/consultas/universidades.php">Dashboard</a></li>
                            <li class="divider"></li>
                            <li><a href="/consultas/asistentes.php">Asistencias</a></li>
                            <li><a href="/sysuser/">Usuarios</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $_SESSION['user']['names']; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Perfil</a></li>
                            <!-- /users/intercambiar.php -->
                            <li><a href="#">Intercambios</a></li>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 2) { ?>
                                <li class="divider"></li>
                                <li><a href="/sysparam/index.php">Configuración</a></li>
                            <?php } ?>
                            <li class="divider"></li>
                            <li><a href="/login.php" onclick="logout();">Salir</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li><a href="/login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
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