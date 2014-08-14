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
                    $query = "SELECT u.id_user, u.names as 'nombre', u.parent_names as 'apellido_1', u.maternal_name as 'apellido_2', u.email as 'correo', h.name as 'sede', c.name as 'ciudad',c.district as 'estado', sum(p.amount) as 'total_pagado', u.pays as 'a_pagar',pt.name as 'metodo', u.assistance as 'asistencia'
                    FROM 
                        users u 
                        LEFT OUTER JOIN payment_user pu ON pu.id_user = u.id_user 
                        LEFT OUTER JOIN payments p ON pu.id_payment = p.id_payment
                        LEFT OUTER JOIN payment_type pt ON  p.id_payment_type = pt.id_payment_type
                        LEFT OUTER JOIN cities c ON  u.id_city = c.id_city,
                        headquarters h
                    WHERE
                        u.id_headquarters = h.id_headquarter 
                    GROUP BY u.id_user;" or die("Error " . mysqli_error($link));

                    $result = $link->query($query);
                    ?>
                    <h3>Consulta de pagos</h3>
                    <p>A continuación, se puede observar el total pagado por cada participante</p>
                    <?php if ($result) { ?>
                        <table class="style">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre completo</th>
                                    <th>Correo</th>
                                    <th>Sede</th>
                                    <th>Ciudad</th>
                                    <th>Estado</th>
                                    <th>Total pagado</th>
                                    <th>Total a pagar</th>
                                    <th>Método de pago</th>
                                    <th>Asistencia</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbdoy>
                                <?php while ($detail = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $detail['id_user'] ?>
                                        </td>
                                        <td class="text-capitalize"><?php echo $detail['nombre'] . " " . $detail['apellido_1'] . " " . $detail['apellido_2'] ?></td>
                                        <td class="text-lowercase"><?php echo $detail['correo'] ?></td>
                                        <td><?php echo $detail['sede'] ?></td>
                                        <td><?php echo $detail['ciudad'] ?></td>
                                        <td><?php echo $detail['estado'] ?></td>
                                        <td><?php
                                            if (isset($detail['total_pagado'])) {
                                                echo $detail['total_pagado'];
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $detail['a_pagar'] ?></td>
                                        <td><?php
                                            if (isset($detail['metodo'])) {
                                                echo $detail['metodo'];
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            if ($detail['asistencia'] === '1') {
                                                echo 'Si';
                                            } else {
                                                echo 'No';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="/users/view.php?user=<?php echo $detail['id_user'] ?>" title="imprimir">
                                                <span class="glyphicon glyphicon-print"></span>
                                            </a>
                                            <a href="/payments/create.php?user=<?php echo $detail['id_user'] ?>" title="hacer pago">
                                                <span class="glyphicon glyphicon-usd"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbdoy>
                        </table>
                    <?php } ?>
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
