<?php

include '../db_info.php';
include '../validations.php';

$name = filter_input(INPUT_POST, "name");
$parent_name = filter_input(INPUT_POST, "parent_name");
$maternal_name = filter_input(INPUT_POST, "maternal_name");
$genre = filter_input(INPUT_POST, "genre");
$born = filter_input(INPUT_POST, "born");
$id_scholarity = filter_input(INPUT_POST, "scholarity");
$contacts = filter_input(INPUT_POST, "contacts", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$id_country = filter_input(INPUT_POST, "id_country");
$id_city = filter_input(INPUT_POST, "id_city");
$id_hq = filter_input(INPUT_POST, "id_hq");
$email = filter_input(INPUT_POST, "email");
$id_modality = filter_input(INPUT_POST, "id_modality");
$id_publicity = filter_input(INPUT_POST, "id_publicity");
$hosted = filter_input(INPUT_POST, "hosted");
$assistance = filter_input(INPUT_POST, "assistance");
$price = filter_input(INPUT_POST, "price");
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$id_usertype = filter_input(INPUT_POST, "id_usertype");
$response = array();

function deterGroup() {
    return "1";
}

function deterPassword($clave) {
    if (is_null($clave)) {
        return 'null';
    } else {
        return "MD5('" . $clave . "')";
    }
}

function deterUsername($usuario) {
    if (is_string($usuario) && (strlen($usuario) > 0)) {
        return "'" . $usuario . "'";
    } else {
        return 'null';
    }
}

function deterUsertype($tipo_usuario) {
    if ($tipo_usuario !== NULL) {
        return $tipo_usuario;
    } else {
        return "5";
    }
}

function deterAssistance($assistance) {
    return $assistance === '1' ? $assistance : 0;
}

$query = "INSERT INTO `users`
(`names`,`parent_names`,`genre`,`born`,`email`,`scolarship`,`assistance`,
`id_group`,`usrnm`,`id_usertype`,`id_modality`,`registered`,`id_country`,`psswrd`,
`id_headquarters`,`id_city`,`id_publicity`,`hosted`,`pays`,`maternal_name`)
VALUES(
" . parseString($name) . ",
" . parseString($parent_name) . ",
" . parseString($genre) . ",
" . parseString($born) . ",
" . parseString($email) . ",
" . $id_scholarity . ",
" . deterAssistance($assistance) . ",
" . deterGroup() . ",
" . deterUsername($username) . ",
" . deterUsertype($id_usertype) . ",
" . $id_modality . ",
NOW(),
" . parseString($id_country) . ",
" . deterPassword($password) . ",
" . $id_hq . ",
" . $id_city . ",
" . $id_publicity . ",
" . parseString($hosted) . ",
" . parseString($price) . ",
" . parseString($maternal_name) . ");";

$users = $link->query($query);

$id_user = mysqli_insert_id($link);

$partial_query = "INSERT INTO contacts(type, value) VALUES ";

if ($id_user !== 0 && count($contacts) > 0) {
    for ($i = 0; $i < count($contacts); $i++) {
        $contact = $contacts[$i];

        $current_query = $partial_query . "(" . $contact['type'] . ", " . parseString($contact['value']) . ");";
        $result = $link->query($current_query);
        $id_contact = mysqli_insert_id($link);
        if ($id_contact !== 0) {
            $query = "INSERT INTO contact_user(id_contact, id_user) VALUES (" . $id_contact . ", " . $id_user . ");";
            $result = $link->query($query);
        }
    }
}


# Verificar si el evento ya empezo o no, para retornar started como true
$q_check_date = "SELECT sp.key, sp.value FROM sysparams sp WHERE sp.key = 'fecha_evento' AND TIMESTAMP(sp.value, '00:00:00') <= now()";
$r_check_date = $link->query($q_check_date);

if ($r_check_date && mysqli_num_rows($r_check_date) > 0) {
    $response['event_started'] = true;
} else {
    $response['event_started'] = false;
    if (!$r_check_date) {
        $response['warning_msg'] = "Unable to execute query -> ".$q_check_date;
    }
}

$response['id_user'] = $id_user;
if ($id_user !== 0) {
    $response['result'] = "ok";
} else {
    $response['result'] = "fail";
    $response['query'] = $query;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);
