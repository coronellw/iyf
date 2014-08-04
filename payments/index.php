<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Pagos</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user'])) {
                    ?>
                    <h3>Pagos</h3>
                    <p>Por favor ingrese el id de la persona que desea buscar</p>
                    <input id='user_id' onchange='findUser()' >
                    <br>
                    <br>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label>Nombres: </label>
                                </td>
                                <td>
                                    <span id='names'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Apellido paterno:</label>
                                </td>
                                <td>
                                    <span id='parent'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Apellido materno:</label>
                                </td>
                                <td>
                                    <span id='maternal'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Pais:</label>
                                </td>
                                <td>
                                    <span id='country'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Debe pagar:</label>
                                </td>
                                <td>
                                    <span id='pays'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Pagado:</label>
                                </td>
                                <td>
                                    <span id='paid'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Pendiente:</label>
                                </td>
                                <td>
                                    <span id='pending'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Puede asistir:</label>
                                </td>
                                <td>
                                    <span id='can_assist'></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div id='payments'></div>
                    <br>
                    <div class="row">
                        <a id="register_payment" href="#" class="btn btn-primary btn-sm">REGISTRAR PAGOS</a>
                        <?php if ($_SESSION['user']['id_usertype'] < 3) { ?>
                            <a id='assistance' class="btn btn-primary btn-sm">ASISTENCIA</a>
                        <?php } ?>
                        <a id="change_group" href="#" class="btn btn-primary btn-sm">CAMBIAR GRUPO</a>
                        <a id="print_barcode" href="#" class="btn btn-primary btn-sm">IMPRIMIR CODIGO</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
        </div>
    </body>
</html>
