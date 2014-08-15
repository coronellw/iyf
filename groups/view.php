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
                    $id_group = filter_input(INPUT_GET, "group");
                    $q_group = "SELECT g.*, u.names as nombre, u.parent_names as apellido1, u.maternal_name as apellido2 FROM groups g, users u WHERE g.id_group = $id_group AND u.id_user = g.group_master" or die("Error " . mysqli_error($link));
                    $r_group = $link->query($q_group);

                    $q_asistentes = "SELECT u.id_user, u.names as nombre, u.parent_names as apellido1, u.maternal_name as apellido2, (YEAR(CURDATE())-YEAR(born)) - (RIGHT(CURDATE(),5)<RIGHT(born,5)) as age, genre as sexo FROM users u WHERE id_group = $id_group ORDER BY age ASC" or die("Error " . mysqli_error($link));
                    $r_asistentes = $link->query($q_asistentes);
                    ?>
                    <h3>Grupo</h3>
                    <p>A continuación, se puede observar la información de este grupo y los asistentes que han sido asignados a este grupo</p>
                    <div class="row">
                    <a href="/groups">Regresar al listado de grupos</a>
                    </div>
                    
                    <?php if ($r_group) { 
                        $group = mysqli_fetch_assoc($r_group); ?>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="row">
                                <span class="col-md-6">
                                    <label>Maestro</label>
                                </span>
                                <span class="col-md-6">
                                    <?php echo $group['nombre'] . " " . $group['apellido1'] . " " . $group['apellido2'] ?>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-6">
                                    <label>Nombre del grupo</label>
                                </span>
                                <span class="col-md-6">
                                    <?php echo $group['name'] ?>
                                </span>
                            </div>        
                        </div>
                        <br style="clear: both">
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre completo</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                </tr>
                            </thead>
                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($r_asistentes)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $detail['id_user'] ?>
                                        </td>

                                        <td style="text-transform: capitalize;" >
                                            <?php echo $detail['nombre'] . " " . $detail['apellido1'] . " " . $detail['apellido2'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $detail['age'] ?>
                                        </td>
                                        <td>
                                            <?php echo $detail['sexo'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbdoy>
                        </table>
                    <?php }else{
                        echo "No se encontró ningún grupo registrado";
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
