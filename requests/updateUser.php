<?php

include '../db_info.php';
include '../validations.php';

$user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$response = array();

if ($user['hosted'] === '0') {
    $pays = "pays =   " . 350 . ", ";
} else {
    if ($user['country'] === 'MEX') {
        $pays = "pays =   " . 700 . ", ";
    } else {
        $pays = "pays =   " . 780 . ", ";
    }
}

$query = "UPDATE users SET names = " . parseString($user['names']) . ", "
        . "parent_names = " . parseString($user['parent_names']) . ", "
        . "maternal_name = " . parseString($user['maternal_name']) . ", "
        . "scolarship =   " . parseIntOrNull($user['scholarity']) . ", "
        . "id_modality =   " . parseIntOrNull($user['modality']) . ", "
        . "hosted =   " . parseIntOrNull($user['hosted']) . ", "
        . $pays
        . "born =   " . parseString($user['birthdate']) . ", "
        . "id_headquarters = " . parseIntOrNull($user['id_headquarters']) . " WHERE id_user = " . $user['id_user'] . ";" or die(mysqli_error($link));

$result = $link->query($query);

if ($result) {
    $response['result'] = 'ok';
    $response['id_user'] = $user['id_user'];
} else {
    $response['result'] = 'fail';
    $response['query'] = $query;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);
