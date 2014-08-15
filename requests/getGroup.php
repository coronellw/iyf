<?php

include '../db_info.php';
include '../validations.php';

$response = array();

$id_group = filter_input(INPUT_GET, "group");

$query = "SELECT u.id_user as id_professor, CONCAT(u.names,' ',u.parent_names, ' ', u.maternal_name) as professor, g.id_group, g.name, gt.name AS tipo FROM users u, groups g, group_types gt  WHERE g.group_master = u.id_user AND g.id_group_type = gt.id_group_type AND g.id_group = $id_group;"
        or die("Error " . mysqli_error($link));


$groups = $link->query($query);

if ($groups) {
    $group = mysqli_fetch_assoc($groups);
    $response['result'] = "ok";
    if ((mysqli_num_rows($groups) > 0)) {
        $response['group'] = $group;
    } else {
        $response['info_msg'] = "No data matched your request";
    }
} else {
    $response['result'] = "fail";
    $response['query']=$query;
    $response['error_msg'] = mysqli_error($link);
}
echo json_encode($response);