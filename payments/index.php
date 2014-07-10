<html>
    <head>
        <title>IYF - Pagos</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
        <div class="container">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user'])) {
                    ?>
                    <h3>Pagos</h3>
                    <p>Por favor ingrese el id de la persona que desea buscar</p>
                    <input id='user_id' onchange='findUser()' >

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
                        </tbody>
                    </table>
                    <div id='payments'></div>
                    <br>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <div class="row">
                            <a href="#" class="btn btn-primary btn-sm">REGISTRAR PAGOS</a>
                            <?php if ($_SESSION['user']['id_usertype'] < 3) { ?>
                                <a href="#" id='assistance' class="btn btn-primary btn-sm">ASISTENCIA</a>
                            <?php } ?>
                            <a href="#" class="btn btn-primary btn-sm">EDITAR</a>
                            <a href="#" class="btn btn-primary btn-sm">CAMBIAR GRUPO</a>
                        </div>
                    <?php } ?>
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
