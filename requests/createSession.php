<?php

include '../db_info.php';
include '../validations.php';

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$query = "SELECT id_user, names, parent_names, maternal_name, email, id_group, "
        . "id_usertype, id_modality, id_country, id_city, hosted, pays "
        . "FROM users WHERE usrnm = " . parseString($username)
        . " AND psswrd = MD5(" . parseString($password) . ");"
        or die("Error " . mysqli_error($link));
$result = $link->query($query);

$user = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

if ($count > 0) {
    session_start(); 
    $_SESSION['user'] = $user;
    //header("Location: ../index.php");
    echo json_encode($user);
} else {
    echo "fail";
}