<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Imprimir volante</title>
        <?php
        include '../template/_head.php';
        include '../db_info.php';
        ?>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            include '../template/navbar.php';


            $id_user = filter_input(INPUT_GET, "user");
            $query = "SELECT u.id_user, u.names, u.parent_names, u.maternal_name, c.name as 'pais', h.name as 'sede' FROM "
                    . "users u, countries c, headquarters h  WHERE "
                    . "u.id_country = c.id_country AND u.id_headquarters = h.id_headquarter AND id_user=" . $id_user;
            $result = $link->query($query);
            $user = mysqli_fetch_array($result);

            if (mysqli_num_rows($result) > 0) {
                ?>
                <center>
                    <table class="">
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align: center; font-size: 1.8em; font-weight: bold;">
                                    Informarción de asistencia
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <img src="../img/small.png" />
                                </td>

                                <td><label>Nombres: </label></td>
                                <td><?php echo $user['names'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Apellido paterno: </label></td>
                                <td><?php echo $user['parent_names'] ?></td>

                                <td><label>Apellido materno: </label></td>
                                <td><?php echo $user['maternal_name'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Nacionalidad: </label></td>
                                <td><?php echo $user['pais'] ?></td>

                                <td><label>Sede: </label></td>
                                <td><?php echo $user['sede'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Código de barras: </label>
                                </td>
                                <td colspan="2">
                                    <img id="imagen" height="50" width="250" src="../requests/generateBarcode.php?user=<?php echo $user['id_user'] ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <table class="">
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align: center; font-size: 1.8em; font-weight: bold;">
                                    Informarción del asistente
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <img src="../img/small.png" />
                                </td>

                                <td><label>Nombres: </label></td>
                                <td><?php echo $user['names'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Apellido paterno: </label></td>
                                <td><?php echo $user['parent_names'] ?></td>

                                <td><label>Apellido materno: </label></td>
                                <td><?php echo $user['maternal_name'] ?></td>
                            </tr>
                            <tr>
                                <td><label>Nacionalidad: </label></td>
                                <td><?php echo $user['pais'] ?></td>

                                <td><label>Sede: </label></td>
                                <td><?php echo $user['sede'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Código de barras: </label>
                                </td>
                                <td colspan="2">
                                    <img id="imagen" height="50" width="250" src="../requests/generateBarcode.php?user=<?php echo $user['id_user'] ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                </center>
            <?php } else {
                ?>
            <center>
                <h2>Error</h2>
                <p>El usuario especificado no existe en la base de datos, verifique su informacion por favor.</p>
            </center>
                <?php }
            ?>
        </div>
    </body>
</html>
