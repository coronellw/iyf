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
                                h.id_headquarter as id_sede, h.name as sede, 
                                (select count(*) from users u1 where u1.id_headquarters = h.id_headquarter) as registrados,
                                (select count(*) from users u1 where (u1.id_modality = 1 or u1.id_modality = 2) and u1.id_headquarters = h.id_headquarter ) as nuevos, -- nuevos
                                (select count(*) from users u1 where u1.id_headquarters = h.id_headquarter and u1.checked = 1) as asistentes,
                                SUM(u.pays) as recaudo
                            FROM 
                                users u, headquarters h 
                            WHERE 
                                u.id_headquarters = h.id_headquarter 
                            GROUP BY 
                                h.id_headquarter;" or die("Error " . mysqli_error($link));
                    $result = $link->query($query);

                    $q_total = "SELECT 
                                    (select count(*) from users u1 ) as registrados,
                                    (select count(*) from users u1 where u1.id_modality = 1 or u1.id_modality = 2) as nuevos, -- nuevos
                                    (select count(*) from users u1 where u1.checked = 1) as asistentes
                                FROM 
                                    users u" or die("Error " . mysqli_error($link));

                    $r_total = $link->query($q_total);
                    $total = mysqli_fetch_assoc($r_total);

                    function calcularCompletos($id_sede){
                        global $link;
                        if ($id_sede === null) {
                            $sede ="";
                        }else{
                            $sede = " AND u.id_headquarters = $id_sede ";
                        }
                        $query = "  SELECT 
                                        h.name, pu.id_user, u.names, SUM(p.amount) as pagado, u.pays as 'debe_pagar'
                                    FROM 
                                        payments p, payment_user pu, users u, headquarters h
                                    WHERE 
                                        p.id_payment = pu.id_payment and
                                        u.id_user = pu.id_user and
                                        u.id_headquarters = h.id_headquarter $sede
                                    GROUP BY 
                                        u.id_user
                                    HAVING
                                         pagado >= u.pays;" or die("Error ".mysqli_error($link));
                        $result = $link->query($query);
                        if ($result && mysqli_num_rows($result)>0) {
                            return mysqli_num_rows($result);
                        }else{
                            return 0;
                        }
                    }

                    function calcularParciales($id_sede){
                        global $link;
                        if ($id_sede === null) {
                            $sede ="";
                        }else{
                            $sede = " AND u.id_headquarters = $id_sede ";
                        }
                        $query = "  SELECT 
                                        h.name, pu.id_user, u.names, SUM(p.amount) as pagado, u.pays as 'debe_pagar'
                                    FROM 
                                        payments p, payment_user pu, users u, headquarters h
                                    WHERE 
                                        p.id_payment = pu.id_payment and
                                        u.id_user = pu.id_user and
                                        u.id_headquarters = h.id_headquarter $sede                                        
                                    GROUP BY 
                                        u.id_user
                                    HAVING
                                         pagado < u.pays;" or die("Error ".mysqli_error($link));
                        $result = $link->query($query);
                        if ($result && mysqli_num_rows($result)>0) {
                            return mysqli_num_rows($result);
                        }else{
                            return 0;
                        }
                    }

                    function calcularPagoCero($id_sede){
                        global $link;
                        if ($id_sede === null) {
                            $sede ="";
                        }else{
                            $sede = " AND u.id_headquarters = $id_sede ";
                        }
                        $query = "  SELECT 
                                        h.name, u.id_user, u.names, SUM(p.amount) as pagado, u.pays as 'debe_pagar'
                                    FROM 
                                        users u 
                                        LEFT OUTER JOIN payment_user pu ON u.id_user = pu.id_user 
                                        LEFT OUTER JOIN payments p ON pu.id_payment = p.id_payment, 
                                        headquarters h
                                    WHERE 
                                        u.id_headquarters = h.id_headquarter $sede
                                    GROUP BY 
                                        u.id_user
                                    having 
                                        pagado is null;" or die("Error ".mysqli_error($link));
                        $result = $link->query($query);
                        if ($result && mysqli_num_rows($result)>0) {
                            return mysqli_num_rows($result);
                        }else{
                            return 0;
                        }
                    }

                    ?>
                    <h3>Registrados</h3>
                    <p>A continuación, se puede observar los usuarios y sus pagos registrados por sede </p>
                    <?php if ($result) { ?>
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Sede</th>
                                    <th>Registrados</th>
                                    <th>Nuevos</th>
                                    <th>%</th>
                                    <th>Completo</th>
                                    <th>%</th>
                                    <th>Parcial</th>
                                    <th>%</th>
                                    <th>Por pagar</th>
                                    <th>%</th>
                                    <th>Asistencia</th>
                                    <th>%</th>
                                    
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <td>
                                        <strong>TOTAL</strong>
                                    </td>
                                    <td><strong><?php echo $total['registrados'] ?></strong></td>

                                    <td>
                                        <?php echo "<strong>".$total['nuevos']."</strong>" ?>
                                    </td>
                                    <td><?php echo number_format(($total['nuevos']/$total["registrados"])*100,2,'.','')."%" ?></td>

                                    <?php $completos = calcularCompletos(null); ?>

                                    <td>
                                        <?php echo "<strong>".$completos."</strong>" ?>
                                    </td>
                                    <td><?php echo number_format(($completos/$total["registrados"])*100,2,'.','')."%" ?></td>

                                    <?php $parciales = calcularParciales(null); ?>

                                    <td>
                                        <?php echo "<strong>".$parciales."</strong>" ?>
                                    </td>
                                    <td><?php echo number_format(($parciales/$total["registrados"])*100,2,'.','')."%" ?></td>

                                    <?php $por_pagar = calcularPagoCero(null); ?>

                                    <td>
                                        <?php echo "<strong>".$por_pagar."</strong>" ?>
                                    </td>
                                    <td><?php echo number_format(($por_pagar/$total["registrados"])*100,2,'.','')."%" ?></td>

                                    <td>
                                        <?php echo "<strong>".$total['asistentes']."</strong>" ?>
                                    </td>
                                    <td><?php echo number_format(($total['asistentes']/$total["registrados"])*100,2,'.','')."%" ?></td>
                            </tfoot>

                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $detail['sede'] ?>
                                        </td>
                                        <td><?php echo $detail['registrados'] ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['nuevos']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['nuevos']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <?php $completos = calcularCompletos($detail['id_sede']); ?>

                                        <td>
                                            <?php echo "<strong>".$completos."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($completos/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <?php $parciales = calcularParciales($detail['id_sede']); ?>

                                        <td>
                                            <?php echo "<strong>".$parciales."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($parciales/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <?php $por_pagar = calcularPagoCero($detail['id_sede']); ?>

                                        <td>
                                            <?php echo "<strong>".$por_pagar."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($por_pagar/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['asistentes']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['asistentes']/$detail["registrados"])*100,2,'.','')."%" ?></td>
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
