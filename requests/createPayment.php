<?php

include '../db_info.php';
include '../validations.php';

$id_user_paying = filter_input(INPUT_POST, "payer");
$id_user_registering = filter_input(INPUT_POST, "registerer");
$amount = filter_input(INPUT_POST, "amount");
$id_payment_type = filter_input(INPUT_POST, "payment_type");

$query = "CALL make_payment(" . $id_user_paying . ","
        . $amount . ","
        . $id_payment_type . ","
        . $id_user_registering . ");"
        or die("error " . mysqli_error($link));

echo $query."\n";

$result = $link->query($query);
$count = mysqli_num_rows($result);
