<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Nuevo pago</title>
        <?php include '../template/_head.php' ?>
        <script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script>
            jQuery(function() {
                jQuery('#amount').mask('9?999', {placeholder: " "});
            });
            function checkPaymentMethod(maximum) {
                var id_pt = jQuery("#payment_method").val();
                if (id_pt === '1') {
                    get("amount").value = maximum;
                    get("amount").disabled = true;
                } else {
                    get("amount").disabled = false;
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user'])) {
                    $id_user = filter_input(INPUT_GET, "user");
                    include '../db_info.php';
                    $query = "SELECT "
                            . "u.id_user, u.names, u.parent_names, u.maternal_name, c.name as country_name, u.assistance, u.pays"
                            . " FROM "
                            . "countries c, users u "
                            . "WHERE "
                            . "u.id_country = c.id_country AND (u.id_user = '" . $id_user . "'"
                            . " OR u.names like '%" . $id_user . "%' OR u.parent_names like '%" . $id_user . "%' OR u.maternal_name like '%" . $id_user . "%'"
                            . " ) LIMIT 1;"
                            or die("Error " . mysqli_error($link));

                    $users = $link->query($query);
                    $count = mysqli_num_rows($users);
                    if ($count > 0) {
                        $user = mysqli_fetch_array($users);

                        $payments_resume = "SELECT "
                                . "u.pays - SUM(amount) AS pago_pendiente, SUM(amount) AS total_pagos, u.pays AS total_a_pagar "
                                . "FROM "
                                . "users u, payments p, payment_user pu, payment_type pt "
                                . "WHERE "
                                . "u.id_user = pu.id_user AND p.id_payment = pu.id_payment AND p.id_payment_type = pt.id_payment_type AND "
                                . "pu.id_user =" . $user['id_user'] . ";" or die("Error " . mysqli_error($link));

                        $resume_result = $link->query($payments_resume);
                        if (mysqli_num_rows($resume_result) > 0) {
                            $resume = mysqli_fetch_array($resume_result);
                            $user['pending'] = $resume['pago_pendiente'] === null ? $resume['total_a_pagar'] : $resume['pago_pendiente'];
                            $user['paid'] = $resume['total_pagos'] === null ? '0' : $resume['total_pagos'];
                        } else {
                            $user['pending'] = '0';
                            $user['paid'] = '0';
                        }
                    }

                    $payment_types_query = "SELECT * FROM payment_type ORDER BY name;";
                    $payment_types = $link->query($payment_types_query);
                    ?>
                    <h2>Información de pago</h2>
                    <p><label>Usuario:</label><span style="text-transform: capitalize;"><?php echo "  " . $user["names"] . " " . $user['parent_names'] . " " . $user['maternal_name'] ?></span></p>
                    <div class="row">
                        <span class="col-xs-4">
                            <label>Debe pagar: </label><?php echo "  " . $user['pays'] ?>
                        </span>

                        <span class="col-xs-4">
                            <label>Ha pagado: </label><?php echo "  " . $user['paid'] ?>
                        </span>

                        <span class="col-xs-4">
                            <label>Pendiente: </label><?php echo "  " . $user['pending'] ?>
                        </span>
                        <br><br>
                        <?php if ($user['paid'] < $user['pays']) { ?>
                            <table>
                                <tr>
                                    <td>
                                        <label>Cantidad: </label>
                                    </td>
                                    <td>
                                        <input id='amount' >
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Método de pago: </label>
                                    </td>
                                    <td>
                                        <select id='payment_method' type='number' onchange="checkPaymentMethod(<?php echo $user['pays'] ?>);" >
                                            <?php while ($pt = mysqli_fetch_array($payment_types)) { ?>
                                                <?php if (($user['paid'] === '0') || ($pt['id_payment_type'] === '2')) { ?>
                                                    <option value="<?php echo $pt['id_payment_type']; ?>">
                                                        <?php echo $pt['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <a href="#" 
                               class="btn btn-primary" 
                               onclick="makePayment({
                                   'registered_by': '<?php echo $_SESSION['user']['id_user'] ?>',
                                   'registered_to': '<?php echo $user['id_user'] ?>',
                                   'total_payment': '<?php echo $user['pays'] ?>',
                                   'pending': '<?php echo $user['pending'] ?>'
                                   });">
                                Pagar
                            </a>
                           <?php } else { ?>
                            <strong>Este usuario no tiene pagos pendientes...</strong>
                        <?php } ?>
                    </div>
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
            <br>
            <br>
            <br>
        </div>
    </body>
</html>
