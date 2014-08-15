<?php

include '../db_info.php';
include '../validations.php';

$response = array();

$format = filter_input(INPUT_GET, "format");
$id_user = filter_input(INPUT_GET, "id_user");
$modalities = filter_input(INPUT_GET, "modalities", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

if (!isset($modalities)) {
    $modalities = "(SELECT id_modality FROM modalities)";
}else{
    $modalities = "(".implode(",", $modalities).")";
}

$query = "SELECT "
        . "u.id_user, u.names, u.parent_names, u.maternal_name, c.name as country_name, u.assistance, u.pays, u.genre, u.born, h.name as sede, "
        . "u.scolarship, u.id_group, u.id_usertype, u.id_modality, u.registered, u.id_headquarters, u.hosted, u.id_city, u.checked, email"
        . " FROM "
        . "countries c, users u, headquarters h "
        . "WHERE "
        . "u.id_country = c.id_country AND h.id_headquarter = u.id_headquarters AND u.id_modality IN " . $modalities . " AND u.id_user = " . $id_user . " LIMIT 1;"
        or die("Error " . mysqli_error($link));


$users = $link->query($query);

if ($users) {
    $user = mysqli_fetch_assoc($users);
    $response['result'] = "ok";
    if ((mysqli_num_rows($users) > 0)) {
        $response['user'] = $user;
    } else {
        $response['info_msg'] = "No data matched your request";
    }
} else {
    $response['result'] = "fail";
    $response['query']=$query;
    $response['error_msg'] = mysqli_error($link);
}
echo json_encode($response);