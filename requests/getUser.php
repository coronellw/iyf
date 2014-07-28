<?php

include '../db_info.php';
include '../validations.php';

$format = filter_input(INPUT_GET, "format");
$id_user = filter_input(INPUT_GET, "id_user");

$query = "SELECT "
        . "u.id_user, u.names, u.parent_names, u.maternal_name, c.name as country_name, u.assistance, u.pays"
        . " FROM "
        . "countries c, users u "
        . "WHERE "
        . "u.id_country = c.id_country AND (u.id_user = '" . $id_user . "'"
        . " OR u.names like '%" . $id_user . "%' OR u.parent_names like '%" . $id_user . "%' OR u.maternal_name like '%" . $id_user . "%'"
        . " ) LIMIT 1;"
        or die("Error " . mysqli_error($link));

//echo $query . "\n";
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
        $user['pending'] = $resume['pago_pendiente'] === null ? '0' : $resume['pago_pendiente'];
        $user['paid'] = $resume['total_pagos'] === null ? '0' : $resume['total_pagos'];
    } else {
        $user['pending'] = '0';
        $user['paid'] = '0';
    }

    echo json_encode($user);
} else {
    echo "fail";
}
