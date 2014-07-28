<?php

include '../db_info.php';
include '../validations.php';

$id_user = filter_input(INPUT_POST, "id_user");
$query = "SELECT * FROM users WHERE id_user = " . $id_user . ";";
$result = $link->query($query);
$count = mysqli_num_rows($result);
if ($count > 0) {
    $user = mysqli_fetch_array($result);
    if ($user['assistance'] === '1') {
        $query = "UPDATE users SET assistance = 0 WHERE id_user = $id_user";
    } else {
        $query = "UPDATE users SET assistance = 1 WHERE id_user = $id_user";
    }
    $query = $query or die("Error " . mysqli_error($link));
    $result = $link->query($query);
    echo "ok";
}else{
    echo "fail";
}