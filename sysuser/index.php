<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Usuarios del sistema</title>
        <script type="text/javascript" src="../js/sysuser.js"></script>
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
                    $query = "SELECT u.id_user, CONCAT(u.names,' ',u.parent_names,' ', u.maternal_name) AS full_name, u.usrnm as username, u.id_usertype, ut.name as tipo
                            FROM users u, usertypes ut WHERE u.id_usertype = ut.id_usertype AND u.usrnm is not null" or die("Error " . mysqli_error($link));
                    $result = $link->query($query);
                    ?>
                    <h3>Usuarios del sistema</h3>
                    <p>El siguiente es un listado de usuario del sistema para realizar distintas tareas.</p>
                    <br>
                    <table class='style'>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Tipo de usuario</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $user['id_user'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['full_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['username'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['tipo'] ?>
                                    </td>
                                    <td>
                                        <?php if ($_SESSION['user']['id_user'] !== $user['id_user'] && $_SESSION['user']['id_usertype'] <= $user['id_usertype']) { ?>
                                            <a href="#" onclick="deleteSysUser(<?php echo $user['id_user'] ?>)" title="Borrar usuario">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        <?php } ?>
                                        <?php if ($_SESSION['user']['id_usertype'] <= $user['id_usertype']) { ?>
                                            <a href="./edit.php?user=<?php echo $user['id_user'] ?>" title="Editar usuario">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        <?php } ?>
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
