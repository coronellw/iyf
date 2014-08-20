<?php

include '../db_info.php';
include '../validations.php';

$id_user = filter_input(INPUT_POST, "id_user", FILTER_SANITIZE_STRING);
$override = filter_input(INPUT_POST, "override");
$datos = filter_input(INPUT_POST, "userInfo", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$response = array();
$response['override'] =$override;

if ($override && $override === "true") {
    $verification = "";
}else{
    $verification = " AND md5('".$datos['currentPassword']."') = psswrd";  
}


$query = "UPDATE users SET usrnm = " . parseString($datos['username']) . ", psswrd = md5('" . $datos['password'] . "'), "
        ." id_usertype = ".parseString($datos['usertype'])
        ." WHERE id_user = " . $id_user . $verification or die(mysqli_error($link));

$result = $link->query($query);

if ($result) {
    if (mysqli_affected_rows($link) > 0) {
    	$response['result'] = 'ok';
    	$response['id_user'] = $id_user;
    	$response['info_message'] = "Usuario actualizaddo";
    }else{
    	$response['result'] = 'fail';
    	$response['id_user'] = 0;
    	$response['error_msg'] = "No se pudo actualizar el usuario, a causa de mala información proporcionada";
    }
} else {
    $response['result'] = 'fail';
    $response['error_msg'] = mysqli_error($link);
}
$response['query'] = $query;

echo json_encode($response);
