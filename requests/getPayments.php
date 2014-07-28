<?php
include '../db_info.php';
include '../validations.php';

$id_user = filter_input(INPUT_GET, "id_user");

$query = "SELECT "
        . "u.id_user, p.amount, p.date, pt.name as 'tipo'"
        . " FROM "
        . "users u, payment_user pu, payments p, payment_type pt "
        . "WHERE "
        . "pu.id_user = u.id_user AND pu.id_payment = p.id_payment AND p.id_payment_type = pt.id_payment_type"
        . " AND u.id_user = " . $id_user . ";"
        or die("Error " . mysqli_error($link));

$payments = $link->query($query);
$count = mysqli_num_rows($payments);
if ($count > 0) {
    ?>
    <table>
        <thead>
            <tr>
                <th colspan="3">DETALLE DE PAGOS</th>
            </tr>
            <tr>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($payment = mysqli_fetch_array($payments)) { ?>
                <tr>
                    <td><?php echo $payment['amount'] ?></td>
                    <td><?php echo $payment['date'] ?></td>
                    <td><?php echo $payment['tipo'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <p>
        No se encontraron pagos para este usuario
    </p>
    <?php
}
