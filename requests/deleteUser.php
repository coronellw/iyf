<?php

include '../db_info.php';
include '../validations.php';

$response = array();

$id_user = filter_input(INPUT_GET, "user");

$query = "DELETE FROM users WHERE id_user = $id_user" or die("Error " . mysqli_error($link));


$result = $link->query($query);

if ($result) {
    $group = mysqli_fetch_assoc($groups);
    $response['result'] = "ok";
    if (mysqli_affected_rows($link) > 0) {
        $response['info_msg'] = "The user was deleted";
    } else {
        $response['info_msg'] = "There was no user to delete that could matched the info provided";
    }
} else {
    $response['result'] = "fail";
    $response['query']=$query;
    $response['error_msg'] = mysqli_error($link);
}
echo json_encode($response);