<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Consultas</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user'])) {
                    include '../db_info.php';
                    $query = "SELECT
                                    u.id_user, u.names as nombre, u.parent_names as apellido_1, u.maternal_name as apellido_2, g.name as grupo, u.checked
                                FROM 
                                    users u LEFT OUTER JOIN groups g ON u.id_user = g.group_master 
                                WHERE
                                    u.id_user = g.group_master  or u.id_modality = 5 
                                GROUP BY 
                                    u.id_user" or die("Error " . mysqli_error($link));

                    $result = $link->query($query);
                    ?>
                    <h3>Maestros</h3>
                    <p>A continuación, se puede observar los maestros registrados en el sistema</p>
                    <?php if ($result) { ?>
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre completo</th>
                                    <th>Grupo</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $detail['id_user'] ?>
                                        </td>
                                        <td style="text-transform: capitalize;" ><?php echo $detail['nombre'] . " " . $detail['apellido_1'] . " " . $detail['apellido_2'] ?></td>
                                        <td><?php
                                            if (isset($detail['grupo'])) {
                                                echo $detail['grupo'];
                                            } else {
                                                echo "Sin asignar";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($detail['checked']==='1') {
                                                echo "Si";
                                            } else {
                                                echo "No";
                                            } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbdoy>
                        </table>
                    <?php }else{
                        echo "No se encontró ningún maestro registrado";
                    } ?>
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
