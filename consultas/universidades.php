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
                                    h.name as sede, 
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter) as registrados,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter and date(born) between '1998-01-01' AND '2002-12-31') AS junior,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter and date(born) between '1981-01-01' AND '1997-12-31') AS joven,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter and date(born) between '1969-01-01' AND '1980-12-31') AS senior,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter and date(born) between '1900-01-01' AND '1968-12-31') AS veteranos,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter AND u.genre = 'M') as hombres,
                                    (SELECT count(*) from users u WHERE u.id_headquarters = h.id_headquarter AND u.genre = 'F') as mujeres
                                FROM 
                                    headquarters h;" or die("Error " . mysqli_error($link));

                    $result = $link->query($query);
                    $q_totales = "SELECT 
                                    (SELECT count(*) from users u) as registrados,
                                    (SELECT count(*) from users u WHERE date(born) between '1998-01-01' AND '2002-12-31') AS junior,
                                    (SELECT count(*) from users u WHERE date(born) between '1981-01-01' AND '1997-12-31') AS joven,
                                    (SELECT count(*) from users u WHERE date(born) between '1969-01-01' AND '1980-12-31') AS senior,
                                    (SELECT count(*) from users u WHERE date(born) between '1900-01-01' AND '1968-12-31') AS veteranos,
                                    (SELECT count(*) from users u WHERE u.genre = 'M') as hombres,
                                    (SELECT count(*) from users u WHERE u.genre = 'F') as mujeres
                                FROM 
                                    dual;" or die("Error " . mysqli_error($link));
                    $r_totales = $link->query($q_totales);
                    if ($r_totales) {
                        if (mysqli_num_rows($r_totales)>0) {
                            $total = mysqli_fetch_assoc($r_totales);
                        }
                    }
                    ?>
                    <h3>Universidad</h3>
                    <p>A continuación, se puede observar las universidades y la distribución</p>
                    <?php if ($result) { ?>
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Sede</th>
                                    <th>Total registrados</th>
                                    <th>Juniors</th>
                                    <th>%</th>
                                    <th>Jovenes</th>
                                    <th>%</th>
                                    <th>Seniors</th>
                                    <th>%</th>
                                    <th>Veteranos</th>
                                    <th>%</th>
                                    <th>Hombres</th>
                                    <th>%</th>
                                    <th>Mujeres</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td><strong>TOTALES</strong></td>
                                    <td><strong><?php echo $total['registrados'] ?></strong></td>
                                    <td><strong><?php echo $total['junior'] ?></strong></td>
                                    <td><?php echo number_format(($total['junior']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                    <td><strong><?php echo $total['joven'] ?></strong></td>
                                    <td><?php echo number_format(($total['joven']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                    <td><strong><?php echo $total['senior'] ?></strong></td>
                                    <td><?php echo number_format(($total['senior']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                    <td><strong><?php echo $total['veteranos'] ?></strong></td>
                                    <td><?php echo number_format(($total['veteranos']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                    <td><strong><?php echo $total['hombres'] ?></strong></td>
                                    <td><?php echo number_format(($total['hombres']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                    <td><strong><?php echo $total['mujeres'] ?></strong></td>
                                    <td><?php echo number_format(($total['mujeres']/$total["registrados"])*100,2,'.','')."%" ?></td>
                                </tr>
                            </tfoot>
                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $detail['sede'] ?>
                                        </td>
                                        <td><?php echo $detail['registrados'] ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['junior']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['junior']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['joven']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['joven']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['senior']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['senior']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['veteranos']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['veteranos']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['hombres']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['hombres']/$detail["registrados"])*100,2,'.','')."%" ?></td>

                                        <td>
                                            <?php echo "<strong>".$detail['mujeres']."</strong>" ?>
                                        </td>
                                        <td><?php echo number_format(($detail['mujeres']/$detail["registrados"])*100,2,'.','')."%" ?></td>
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
