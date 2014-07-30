<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Parámetros del sistema</title>
        <?php include '../template/_head.php';
            include '../db_info.php';
        ?>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 2) {
                    $query = "SELECT * FROM sysparams;" or die("Error " . mysqli_error($link));
                    $result = $link->query($query);
                    ?>
                    <h3>Parámetros del sistema</h3>
                    <p>El siguiente es un listado de parámetros que se utilizan en el sistema para realizar distintas tareas.</p>
                    <br>
                    <table class='style'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($param = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $param['key'] ?>
                                    </td>
                                    <td>
                                        <?php echo $param['value'] ?>
                                    </td>
                                    <td>
                                        Opciones no disponibles
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
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
