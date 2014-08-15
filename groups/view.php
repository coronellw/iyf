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
                    $q_group = "SELECT g.*, CONCAT(u.names,' ', u.parent_names,' ', u.maternal_name) as maestro, gt.name as tipo, 
                                (SELECT count(*) FROM users u1 WHERE u1.id_group = g.id_group) as qty
                        FROM 
                            groups g, users u, group_types gt
                        WHERE 
                            gt.id_group_type = g.id_group_type and
                            g.id_group = $id_group AND u.id_user = g.group_master" or die("Error " . mysqli_error($link));
                    $r_group = $link->query($q_group);

                    $q_asistentes = "SELECT 
                                        u.id_user, u.names as nombre, u.parent_names as apellido1, u.maternal_name as apellido2, (YEAR(CURDATE())-YEAR(born)) - (RIGHT(CURDATE(),5)<RIGHT(born,5)) as age, 
                                        genre as sexo, (SELECT value FROM contacts c, contact_user cu WHERE c.id_contact = cu.id_contact and cu.id_user = u.id_user and c.type = 2 LIMIT 1) as celular,
                                        h.name as sede, m.name as modalidad, hosted, s.name as escolaridad
                                    FROM 
                                        users u, modalities m, headquarters h, scolarships s
                                    WHERE 
                                        u.id_modality = m.id_modality and
                                        u.id_headquarters = h.id_headquarter and
                                        u.scolarship = s.id_scolarship and id_group = $id_group ORDER BY age ASC" or die("Error " . mysqli_error($link));
                    $r_asistentes = $link->query($q_asistentes);
                    ?>
                    <h3>Grupo</h3>
                    <p>A continuación, se puede observar la información de este grupo y los asistentes que han sido asignados a este grupo</p>
                    <div class="row">
                    <a href="/groups">Regresar al listado de grupos</a>
                    </div>
                    
                    <?php if ($r_group) { 
                        $group = mysqli_fetch_assoc($r_group); ?>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row">
                                <span class="col-md-6">
                                    <span class="col-md-6">
                                        <label>Maestro: </label>
                                    </span>
                                    <span class="col-md-6">
                                        <?php echo $group['maestro'] ?>
                                    </span>
                                </span>

                                <span class="col-md-6">
                                    <span class="col-md-6">
                                        <label>Nombre del grupo: </label>
                                    </span>
                                    <span class="col-md-6">
                                        <?php echo $group['name'] ?>
                                    </span>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-6">
                                    <span class="col-md-6">
                                        <label>Tipo: </label>
                                    </span>
                                    <span class="col-md-6">
                                        <?php echo $group['tipo'] ?>
                                    </span>
                                </span>

                                <span class="col-md-6">
                                    <span class="col-md-6">
                                        <label>Inscritos: </label>
                                    </span>
                                    <span class="col-md-6">
                                        <?php echo $group['qty'] ?>
                                    </span>
                                </span>
                            </div>        
                        </div>
                        <br style="clear: both">
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre completo</th>
                                    <th>Celular</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Sede</th>
                                    <th>Nivel Escolar</th>
                                    <th>Hospedaje</th>
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
                                            <?php echo $detail['celular'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $detail['age'] ?>
                                        </td>

                                        <td>
                                            <?php echo $detail['sexo'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $detail['sede'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $detail['escolaridad'] ?>
                                        </td>

                                        <td>
                                            <?php if ($detail['hosted'] === "1") {
                                                    echo "Si";
                                                }else {
                                                    echo "No";
                                                }
                                            ?>
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
