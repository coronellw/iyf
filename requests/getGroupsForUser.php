<?php

include '../db_info.php';
include '../validations.php';

$response = array();
$response['info_msg'] = array();
$aprobbed_groups = array();
$commited_conditions = array();

$id_user = filter_input(INPUT_GET, "user");


function updateUser($id_user, $id_group){
    global $link;
    $response = array();
    $qu_user = "UPDATE users SET id_group = " . $id_group . ", checked = 1 WHERE id_user = " . $id_user or die("Error ".mysqli_error($link));
    $ru_user = $link->query($qu_user);
    if ($ru_user) {
        $response['result'] = "ok";
        $response['info_msg'] = "The user was correctly assigned in an existing group";
        $response['group']=array();
        $q_group = "SELECT g.id_group, g.name, CONCAT(u.names,' ', u.parent_names,' ', u.maternal_name) AS professor FROM groups g, users u WHERE g.group_master = u.id_user and g.id_group = $id_group";
        $r_group = $link->query($q_group);
        $response['group'] = mysqli_fetch_assoc($r_group);
    } else {
        $response['result'] = "fail";
        $response['query'] = $qu_user;
        $response["error_msg"] = mysqli_error($link);
    }
    return $response;
}

function createGroup($id_group_type, $id_user){
    global $link;
    $response = array();
    # request a master with no group in order to create a new group, if no master available, then increase the tam_grupo sysparams by 1, and relaunch the assignGroup routine again
    # BUSCAR MAESTROS QUE NO TENGAN GRUPOS ASIGNADO
    
    $q_amasters = "SELECT * FROM users u WHERE u.id_modality = 5 AND u.checked = 1 AND id_user NOT IN (SELECT u.id_user FROM users u, groups g WHERE g.group_master = u.id_user AND u.id_modality = 5 AND u.checked = 1)" or die ("Error ". mysqli_error($link));
    $r_amasters = $link->query($q_amasters);
    if ($r_amasters && mysqli_num_rows($r_amasters)>0 ) {
        # HAY MAESTROS DISPONIBLES, CREAR EL NUEVO GRUPO Y RE ASIGNAR EL ID_USER CON EL GRUPO RECIEN CREADO
        
        $master = mysqli_fetch_assoc($r_amasters);
        $id_master = $master['id_user'];
        
        # THIS SEGMENT PREFIXES THE NUMBER OF THE GROUP
        $q_number = "SELECT (count(*)+1) as 'number', name FROM groups WHERE id_group_type = $id_group_type";
        $r_number = $link->query($q_number);
        if ($r_number) {
            $number = mysqli_fetch_assoc($r_number);
            $counted = $number['number']."-";
        }else{
            $counted="1-";
        }

        # THIS SEGMENT SUFIXES THE GROUP NAME
        $q_group_name = "SELECT name FROM group_types WHERE id_group_type = $id_group_type";
        $r_group_name = $link->query($q_group_name);
        if ($r_group_name) {
            $grupo = mysqli_fetch_assoc($r_group_name);
            $group_name = $grupo['name'];
        } else {
            $group_name = 'error';
        }

        $qc_group = "INSERT INTO groups(`name`,`group_master`,`id_group_type`) VALUES (CONCAT('$counted','$group_name'), $id_master, $id_group_type)";
        $rc_group = $link->query($qc_group);
        if ($rc_group) {
            # SI EL GRUPO SE CREA CORRECTAMENTE, SE AGREGA EL USUARIO CON EL GRUPO Y ACABA EL PROCESO
            $new_id_group = mysqli_insert_id($link);
            $response['result'] = "ok";
            $response['id_group'] = $new_id_group;
            $response['group_master'] = $id_master;
            $response['professor'] = $master['names']." ".$master['parent_names']." ".$master['maternal_name'];
            $response['name'] = $counted.$group_name;
            $response['id_group_type'] = $id_group_type;
        }else{
            $response['result'] = "fail";
            $response['query'] = $qc_group;
            $response['error_msg'] = "Imposible crear nuevo grupo" . mysqli_error($link);
        }
    } else {
        # NO HAY MAESTROS DISPONIBLES O EL QUERY NO SE EJECUTO CORRECTAMENTE, SE PROCEDE A VERIFICAR SI HAY MAESTROS EN EL SISTEMA
        # query para verificar si hay maestros
        $qv_masters = "SELECT * FROM users u WHERE u.id_modality = 5 AND u.checked = 1";
        $rv_masters = $link->query($qv_masters);
        
        if ($rv_masters) {
            if (mysqli_num_rows($rv_masters) > 0) {
                # en efecto si hay maestros, pero a estas alturas, los maestros estan ya todos asignados a grupos
                # por tal motivo se incrementa la vairable SYSPARAMS tam_grupo en 1
                $q_increase_tam = "UPDATE sysparams SET `value` = value + 1 WHERE `key` = 'tam_grupo'";
                $r_increase_tam = $link->query($q_increase_tam);
                if ($r_increase_tam) {
                    # si se incrementa el tam_grupo se procede a llamar la función nuevamente para que asigne un grupo ya que ahora si debe haber cupo
                    return assignGroup($id_user, $id_group_type);
                } else {
                    $response['result'] = "fail";
                    $response['query'] = $q_increase_tam;
                    $response['error_msg'] = "Imposible incrementar tam_grupo" . mysqli_error($link);
                }
            } else {
                $response['result'] = "fail";
                $response['query'] = $qv_masters;
                $response['error_msg'] = "No hay maestros disponibles. ";
            }
        }
    }
    return $response;
}

function assignGroup($id_user, $id_group_type){
    global $link;
    $response = array();
    # ESTE QUERY RETORNA LOS CURSOS QUE ESTEN POR DEBAJO DEL LIMITE DE ASISTENTES REGISTRADOS
    $q_group = "SELECT g.*, (SELECT count(*) FROM users u1 WHERE u1.id_group = g.id_group) as inscritos, CONCAT(u.names, ' ', u.parent_names, ' ', u.maternal_name) as professor FROM groups g, users u WHERE g.group_master = u.id_user AND g.id_group_type = $id_group_type GROUP BY g.id_group HAVING inscritos < (SELECT sp.value FROM sysparams sp where sp.key = 'tam_grupo') ORDER BY inscritos ASC LIMIT 1;";
    $r_group = $link->query($q_group);
    
    if ($r_group && mysqli_num_rows($r_group) > 0) {
        $group = mysqli_fetch_assoc($r_group);
        # associate user with this group since it still has available space
        $response = updateUser($id_user, $group['id_group']);
    } else {
        # CREATE GROUP PUEDE EN REALIDAD HACER 2 COSAS, 
        # LA PRIMERA ES SIMPLEMENTE CREAR EL GRUPO Y RETORNAR LOS VALORES CON LOS CUALES SE CREO DICHO GRUPO
        # LA SEGUNDA ES INCREMENTAR EL TAMAÑO DEL GRUPO, EN CUYO CASO HACE UN LLAMADO A assignGroup QUE A SU VEZ
        # DEBE RETORNAR EL VALOR ACTUALIZADO, PARA CASOS PRACTICOS EL SISTEMA RETORNA id_group o bien regresa
        # group, CUANDO REGRESE CON id_group SIGNIFICA QUE HA CREADO UN NUEVO GRUPO Y SE DEBE LLAMAR AL METODO updateUser 
        # PARA CONECTARLO CON EL NUEVO GRUPO RECIEN CREADO, SI REGRESA group QUIERE DECIR QUE SE INCREMENTO EL TAMAÑO DEL
        # GRUPO A TRAVES DE SYSPARAMS Y DE INMEDIATO VOLVIO A CORRER EL QUERY PARA ASIGNARLE UN CUPO EN UNO DE LOS GRUPOS 
        # QUE AHORA SI TENDRAN ESPACIO PARA ESTE ESTUDIANTE
        $result = createGroup($id_group_type, $id_user);

        if (isset($result["id_group"])) {
            $response = updateUser($id_user, $result['id_group']);
        } else {
            $response = $result;
        }
        
    }
    return $response;
}


# VERIFICAR LA EXISTENCIA DEL USUARIO
$query_user = "SELECT "
        . "names, parent_names, maternal_name, genre, born, (YEAR(CURDATE())-YEAR(born)) - (RIGHT(CURDATE(),5)<RIGHT(born,5)) as age"
        . " FROM users WHERE id_user = $id_user" or die("Error " . mysqli_error($link));
$result_user = $link->query($query_user);

if (mysqli_num_rows($result_user) > 0) {
    $user = mysqli_fetch_assoc($result_user);

    #PEDIR LOS TIPOS DE GRUPO
    $query_groups = "SELECT * FROM group_types;" or die("Error " . mysqli_error($link));
    $result_groups = $link->query($query_groups);
    if (mysqli_num_rows($result_groups) > 0) {
        while ($group = mysqli_fetch_assoc($result_groups)) {
            # RECORRE LOS TIPOS DE GRUPOS PARA VERIFICAR SUS CRITERIOS(CONDICIONES) UNO POR UNO
            $query_criterias = "SELECT c.* "
                    . "FROM "
                    . "group_types gt, group_type_criteria gtc, criterias c "
                    . "WHERE "
                    . "gt.id_group_type = gtc.id_group_type AND c.id_criteria = gtc.id_criteria AND gt.id_group_type = " . $group['id_group_type'] . ";"
                    or die("Error " . mysqli_error($link));

            $result_criteria = $link->query($query_criterias);
            if ($result_criteria && mysqli_num_rows($result_criteria)>0) {
                # RECORRE TODOS LOS CRITERIOS Y LOS UNE CON 'AND'
                $condition = "";
                while ($criteria = mysqli_fetch_assoc($result_criteria)) {
                    $condition .= $criteria['condition'] . " AND ";
                }
                $final_condition = $condition . "id_user=$id_user";
                # VERIFICA SI EL USUARIO CUMPLE CON LOS CRITERIOS(CONDICIONES)
                $query_final = "SELECT * FROM users WHERE $final_condition";
                $result_final = $link->query($query_final);

                if ($result_final && mysqli_num_rows($result_final) > 0) {
                    # SI EN EFECTO ES ASI, SE EJECUTA UNA RUTINA PARA ASIGNARLE UN GRUPO A ESTE USUARIO
                    $response['asignacion'] = assignGroup($id_user, $group['id_group_type']);
                    # GUARDAR EL USUARIO
                    $response['user'] = $user;
                    
                }
            } else {
                # EL TIPO DE GRUPO NO POSEE NINGUN CRITERIO ASOCIADO POR LO TANTO NO SE EVALUA SI EL USUARIO CUMPLE CON LOS CRITERIOS
                $response['info_msg'] = 'No criterias were found for groups ' . $group['id_group_type'];
            }
        }
        if (!isset($response['result'])) {
            # TERMINA DE RECORRER LOS TIPOS DE GRUPO, SI NO HUBO ERROR ALGUNO, SE PROCEDE A INFORMAR QUE SE EVALUARON TODOS LOS CRITERIOS
            # ESTO NO SIGNIFICA QUE EL USUARIO AHORA TENGA UN GRUPO, SOLAMENTE QUIERE DECIR QUE NO HUBO UN ERROR DE EJECUCIÓN CUANDO SE EVALUARON LOS
            # TIPOS DE GRUPOS Y SUS CRITERIOS
            $response['result'] = "ok";
        }
    } else {
        # SI NO ENCUENTRA TIPOS DE GRUPO, NO ES POSIBLE EVALUAR AL USUARIO, LA ASIGNACIÓN NUNCA SE EJECUTA
        $response['result'] = 'fail';
        $response['error_msg'] = 'No groups were found';
    }
} else {
    # NO SE ENCONTRO UN USUARIO CON ESE ID, POR LO TANTO NO SE LE PUEDE ASIGNAR NINGUN GRUPO
    $response['result'] = "fail";
    $response['query'] = $query_user;
    $response['error_msg'] = "No user was found with that id, ".mysqli_error($link);
}

echo json_encode($response);