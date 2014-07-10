<?php

session_start();

include '../db_info.php';
include '../validations.php';

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$query = "SELECT id_user, names, parent_names, maternal_name, email, "
        . "id_usertype, hosted, pays "
        . "FROM users WHERE usrnm = " . parseString($username)
        . " AND psswrd = MD5(" . parseString($password) . ");"
        or die("Error " . mysqli_error($link));
$result = $link->query($query);

$user = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

if ($count > 0) {
    $_SESSION['user'] = $user;
    $_SESSION['messages'][] = createMsg("Bienevenido usuario " . $user['names'], "success", "IYF");

    header("Location: /iyf/index.php");
    echo json_encode($user);
} else {
    $_SESSION['messages'][] = createMsg("Sus credenciales no son validas, intente nuevamente.", "danger", "IYF");
    header("Location: /iyf/login.php");
    echo "fail";
}