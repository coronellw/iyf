<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Usuarios del sistema</title>
        <?php include '../template/_head.php';
            include '../db_info.php';
        ?>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 3) {
                    $query = "SELECT u.id_user, CONCAT(u.names,' ',u.parent_names,' ', u.maternal_name) AS full_name, u.usrnm as username
                            FROM users u WHERE u.usrnm is not null;" or die("Error " . mysqli_error($link));
                    $result = $link->query($query);
                    ?>
                    <h3>Usuarios del sistema</h3>
                    <p>El siguiente es un listado de usuario del sistema para realizar distintas tareas.</p>
                    <br>
                    <table class='style'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $user['full_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['username'] ?>
                                    </td>
                                    <td>
                                        <a href="#" onclick="deleteSysUser(<?php echo $user['id_user'] ?>)">Borrar</a>
                                        <a href="./edit.php?user=<?php echo $user['id_user'] ?>">Editar</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="row text-center">
                        <a href="create.php" class="btn btn-primary">Nuevo usuario</a>
                    </div>
                    <br>
                    <br>
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
        </div>
    </body>
</html>
