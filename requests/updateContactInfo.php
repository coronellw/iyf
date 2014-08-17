<?php

include '../db_info.php';
include '../validations.php';

$user = filter_input(INPUT_GET, "user", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$response = array();
$name = $user['names'];
$apellido1 = $user['parent_names'];
$apellido2 = $user['maternal_name'];
$response['msg'] = "this is a call";

function insertContact($id_user, $phone, $type){
    global $link;
    global $response;
    $called = "insertContact ha sido llamado con los sgtes valores id_user: $id_user, valor: $phone, tipo: $type";
    $query = "INSERT INTO contacts(value, type) VALUES ('$phone', '$type')";
    $result = $link->query($query);
    if ($result) {
        $id_contact = mysqli_insert_id($link);
        $q_cu = "INSERT INTO contact_user(id_user, id_contact) VALUES ($id_user, $id_contact)";
        $r_cu = $link->query($q_cu);
        if ($r_cu) {
            $resultado = "updated";
        }else{
            $q_b = "DELETE FROM contacts WHERE id_contact = $id_contact";
            $link->query($q_b);
            $resultado = "unable to insert contact, there was an error while associating with the user";
            $error['msg'] = "ERROR ".mysqli_error($link);
            $error['query'] = $q_cu;
        }
    }else{
        $error['msg'] = "ERROR ".mysqli_error($link);
        $error['query'] = $query;
    }
    $attempt['error']=$error;
    $attempt['call'] = $called;
    $attempt['resultado'] = $resultado;
    $response['attempts'][] = $attempt;
}


# find the user by name, parent_names and maternal_name
$query = "SELECT * FROM users u WHERE 
        lower(u.names) like lower('%$name%') AND lower(u.parent_names) like lower('%$apellido1%') AND lower(u.maternal_name) like lower('%$apellido2%')" or die(mysqli_error($link));
$result = $link->query($query);

if ($result) {
    $response['result'] = 'ok';
    $found = mysqli_num_rows($result);
    if ($found>0) {
        $response['msg'] = "Encontro y debe verificar si son 1 o mas, encontro: $found";
        if ($found == 1) {
            $response['msg'] = "entro a uno y debe llamar la insercion de celulares";
            // msg = update
            $retrieved = mysqli_fetch_assoc($result);
            insertContact($retrieved['id_user'],$user['celular'], 2);
            insertContact($retrieved['id_user'],$user['home'], 1);
        }else{
            $response['msg'] = "more than one with the same info";
        }
    }else{
        $response['msg'] = "no one was found with that info";
    }
} else {
    $response['result'] = 'fail';
    $response['query'] = $query;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);