<?php

include '../db_info.php';
include '../validations.php';

$response = array();
$aprobbed_groups = array();
$commited_conditions = array();

$id_user = filter_input(INPUT_GET, "user");

$query_user = "SELECT "
        . "names, parent_names, maternal_name, genre, born, (YEAR(CURDATE())-YEAR(born)) - (RIGHT(CURDATE(),5)<RIGHT(born,5)) as age"
        . " FROM users WHERE id_user = $id_user" or die("Error " . mysqli_error($link));
$result_user = $link->query($query_user);

if (mysqli_num_rows($result_user) > 0) {
    $user = mysqli_fetch_array($result_user);
    $response['user'] = $user;

    $query_groups = "SELECT * FROM group_types;" or die("Error " . mysqli_error($link));
    $result_groups = $link->query($query_groups);
    if (mysqli_num_rows($result_groups) > 0) {
        while ($group = mysqli_fetch_array($result_groups)) {
            $query_criterias = "SELECT c.* "
                    . "FROM "
                    . "group_types gt, group_type_criteria gtc, criterias c "
                    . "WHERE "
                    . "gt.id_group_type = gtc.id_group_type AND c.id_criteria = gtc.id_criteria AND g.id_group_type = " . $group['id_group_type'] . ";"
                    or die("Error " . mysqli_error($link));
            $result_criteria = $link->query($query_criterias);
            if (mysqli_num_rows($result_criteria) > 0) {
                $condition = "";
                while ($criteria = mysqli_fetch_array($result_criteria)) {
                    $condition .= $criteria['condition'] . " AND ";
                }
                $final_condition = $condition . " id_user=$id_user";
                $query_final = "SELECT * FROM users WHERE $final_condition";
                $result_final = $link->query($query_final);
                if (mysqli_num_rows($result_final) > 0) {
                    $commited_conditions[] = $query_final;
                    $aprobbed_groups[] = $group;
                }
            } else {
                $response['result'] = 'warning';
                $response['error_msg'] = 'No criterias were found for groups ' . $group['id_group_type'];
            }
        }
        if (!isset($response['result'])) {
            $response['result'] = "ok";
        }
        $response['groups'] = $aprobbed_groups;
        $response['conditions'] = $commited_conditions;
    } else {
        $response['result'] = 'fail';
        $response['error_msg'] = 'No groups were found';
    }
} else {
    $response['result'] = "fail";
    $response['query'] = $query_user;
    $response['error_msg'] = mysqli_error($link);
}

echo json_encode($response);
