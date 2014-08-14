<?php

include '../db_info.php';
include '../validations.php';

$response = array();
$id_user = filter_input(INPUT_POST, "id_user");
$query = "SELECT * FROM users WHERE id_user = " . $id_user . ";";
$result = $link->query($query);

if ($result && (mysqli_num_rows($result) > 0)) {
    $user = mysqli_fetch_array($result);
    if ($user['checked'] === '1') {
        $query = "UPDATE users SET checked = 0 WHERE id_user = $id_user";
    } else {
        $query = "UPDATE users SET checked = 1 WHERE id_user = $id_user";
    }
    $query = $query or die("Error " . mysqli_error($link));
    $result = $link->query($query);
    
    if ($result) {
        $response['result'] = "ok";
    }else{
        $response['result'] = "fail";
        $response['info_message'] = "No se pudo actualizar, verifique errores";
        $response['error_msg'] = mysqli_error($link);
    }
    $response[$query];
}else{
    $response['result'] = "fail";
    $response['info_message'] = "No se pudo actualizar, verifique errores";
    $response['error_msg'] = mysqli_error($link);
    $response['query'] = $query;
}

echo json_encode($response);