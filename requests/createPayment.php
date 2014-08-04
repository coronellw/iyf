<?php

include '../db_info.php';
include '../validations.php';

$id_user_paying = filter_input(INPUT_POST, "payer");
$id_registered_by = filter_input(INPUT_POST, "registerer");
$amount = filter_input(INPUT_POST, "amount");
$id_payment_type = filter_input(INPUT_POST, "payment_type");
$response = array();

// VERIFICAR SI EL USUARIO EXISTE
$user_query = "SELECT * FROM users WHERE id_user=$id_user_paying" or die("Error " . mysqli_error($link));
$result_user = $link->query($user_query);

if (mysqli_num_rows($result_user)) {
    $user = mysqli_fetch_array($result_user);
    // UNA VEZ ENCONTRADO EL USUARIO AL QUE SE LE REPORTA EL PAGO, SE PROCEDE A INSERTAR
    // EL MONTO DEL PAGO EN EL REGISTRO DE PAGOS
    $payment_query = "INSERT INTO 
        payments(amount,date,id_payment_type,registered_by) 
        VALUES ($amount, NOW(), $id_payment_type, $id_registered_by);"or die("Error " . mysqli_error($link));
    $payment_result = $link->query($payment_query);
    // RECUPERAMOS EL ID DEL PAGO QUE SE ACABA DE INGRESAR AL SISTEMA
    $id_payment = mysqli_insert_id($link);
    if ($id_payment !== 0) {
        // EL PAGO YA FUE REGISTRADO, PERO NO HA SIDO ASOCIADO A NINGUN USUARIO, 
        // POR LO TANTO SE PROCEDE A INGRESARLO AL SISTEMA
        $association_query = "INSERT INTO payment_user(id_payment, id_user)
			VALUES ($id_payment, $id_user_paying);" or die("Error " . mysqli_error($link));
        $association_result = $link->query($association_query);

        if ($association_result) {
            $response["result"] = "ok";
            // SI EL USUARIO REALIZO COMPLETA SUS PAGOS SE LE APROBARÁ ASISTENCIA
            $assistance_query = "SELECT 
                                    u.pays - SUM(amount) as pending
                                FROM
                                    users u, payments p, payment_user pu, payment_type pt
                                WHERE
                                    u.id_user = pu.id_user AND 
                                    p.id_payment = pu.id_payment AND 
                                    p.id_payment_type = pt.id_payment_type AND
                                    pu.id_user = $id_user_paying";
            $result_assistance = $link->query($assistance_query);
            if ($result_assistance) {
                $assistance = mysqli_fetch_array($result_assistance);
                if ($assistance['pending'] <= 0) {
                    $update_query = "UPDATE users SET assistance = '1' WHERE id_user = $id_user_paying;";
                    $update_result = $link->query($update_query);
                    if ($update_result) {
                        $response["info_msg"] = "La asistencia ha sido aprobada";
                    } else {
                        $response["query"] = $association_query;
                        $response["info_msg"] = "No se pudo actualizar la asistenica, aunque ya no quedan pagos pendientes, consulte con su supervisor y/o administrador. HINT: " . mysqli_error($link);
                    }
                } else {
                    $response["info_msg"] = "Aún queda saldo pendiente de " . $assistance['pending'];
                }
            }
        } else {
            $response["result"] = "fail";
            $response["query"] = $association_query;
            $response["error_msg"] = "El pago no pudo ser registrado. HINT: " . mysqli_error($link);
            // SI POR ALGUNA RAZON SE PUDO AGREGAR EL PAGO PERO NO SE PUDO RELACIONAR A UN USUARIO...
            // SE BORRARA EL PAGO Y SE RECHAZA LA TRANSACCION PARA QUE NO QUEDEN CABOS SUELTOS Y 
            // EL BALANCE DE CUENTAS SEA MAS LIMPIO
            $delete_query = "DELETE FROM payments WHERE id_payment=$id_payment";
        }
    } else {
        $response["result"] = "fail";
        $response["query"] = $payment_query;
        $response["error_msg"] = "El pago no pudo ser registrado. HINT: " . mysqli_error($link);
    }
} else {
    $response["result"] = "fail";
    $response["query"] = $user_query;
    $response["error_msg"] = "El usuario no se encontró en la base de datos. HINT: " . mysqli_error($link);
}

echo json_encode($response);
