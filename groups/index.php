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
                        g.id_group as id, g.name as grupo, gt.name as tipo, u.id_user, u.names as nombre, u.parent_names as apellido1, 
                        u.maternal_name as apellido2, (select count(*) from users x where x.id_group = g.id_group) as inscritos,
                        (SELECT count(*) FROM users u1 WHERE hosted = 1 and u1.id_group = g.id_group) as 'hosted', 
                        (SELECT count(*) FROM users u2 WHERE hosted = 0 and u2.id_group = g.id_group) as 'not_hosted'
                    FROM 
                        users u, groups g, group_types gt
                    WHERE 
                        g.group_master = u.id_user AND gt.id_group_type = g.id_group_type;" or die("Error " . mysqli_error($link));

                    $result = $link->query($query);
                    ?>
                    <h3>Grupos</h3>
                    <p>A continuación, se puede observar los grupos registrados en el sistema y sus maestros</p>
                    <?php if ($result) { ?>
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Nombre del grupo</th>
                                    <th>Tipo</th>
                                    <th>Maestro</th>
                                    <th>Inscritos</th>
                                    <th>Hospedados</th>
                                    <th>No hospedados</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($result)) { ?>
                                    <tr>                                        
                                        <td>
                                            <?php echo $detail['grupo'] ?>
                                        </td>

                                        <td>
                                            <?php echo $detail['tipo'] ?>
                                        </td>
                                        
                                        <td style="text-transform: capitalize;" >
                                            <?php echo $detail['nombre'] . " " . $detail['apellido1'] . " " . $detail['apellido2'] ?>
                                        </td>

                                        <td>
                                            <?php echo $detail['inscritos'] ?>
                                        </td>

                                        <td>
                                            <?php echo $detail['hosted'] ?>
                                        </td>

                                        <td>
                                            <?php echo $detail['not_hosted'] ?>
                                        </td>

                                        <td>
                                            <a href="/groups/view.php?group=<?php echo $detail['id'] ?>">Ver</a>
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
