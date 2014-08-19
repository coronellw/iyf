<?php

include '../db_info.php';
include '../validations.php';

$id_user = filter_input(INPUT_POST, "id_user", FILTER_SANITIZE_STRING);
$override = filter_input(INPUT_POST, "override");
$datos = filter_input(INPUT_POST, "userInfo", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$response = array();

if (isset($override) && $override == true) {
    $verification = "";
}else{
    $verification = " AND md5('".$datos['currentPassword']."') = psswrd";  
}


$query = "UPDATE users SET usrnm = " . parseString($datos['username']) . ", psswrd = md5('" . $datos['password'] . "'), "
        ." id_usertype = ".parseString($datos['usertype'])
        ." WHERE id_user = " . $id_user . $verification or die(mysqli_error($link));

$result = $link->query($query);

if ($result) {
    $response['result'] = 'ok';
    $response['id_user'] = $id_user;
} else {
    $response['result'] = 'fail';
    $response['query'] = $query;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);
