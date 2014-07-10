<html>
    <head>
        <title>IYF - Imprimir volante</title>
        <?php
        include '../template/_head.php';
        include '../db_info.php';
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include '../template/navbar.php';
            if (isset($_SESSION['user'])) {
                
                $id_user = filter_input(INPUT_GET, "user");
                $query = "SELECT u.id_user, u.names, u.parent_names, u.maternal_name, c.name as 'pais', h.name as 'sede' FROM "
                        . "users u, countries c, headquarters h  WHERE "
                        . "u.id_country = c.id_country AND u.id_headquarters = h.id_headquarter AND id_user=" . $id_user;
                $result = $link->query($query);
                $user = mysqli_fetch_array($result);

                //$barcode = new HttpRequest("../requests/generateBarcode.php?user=".$user['id_user'], HttpRequest::METH_GET);
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
                <?php
            } else {
                include '../forbidden.php';
            }
            ?>
        </div>
    </body>
</html>
