<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Edicion de ususario</title>
        <?php include '../template/_head.php' ?>
        <script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script>
            jQuery(function() {
                jQuery('#birthdate').mask('9999/99/99', {placeholder: " "});
            })
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user']) && ($_SESSION['user']['id_usertype'] < 3)) {
                    $id_user = filter_input(INPUT_GET, "user");
                    include '../db_info.php';
                    $query = "SELECT 
                                    u.id_user, u.names, u.parent_names, u.maternal_name, 
                                    u.scolarship, u.id_modality, u.hosted, u.id_headquarters,
                                    u.born, id_country
                                FROM 
                                    users u
                                WHERE
                                    u.id_user =$id_user"
                            or die("Error " . mysqli_error($link));

                    $users = $link->query($query);
                    $count = mysqli_num_rows($users);
                    if ($count > 0) {
                        $user = mysqli_fetch_array($users);

                        $q_scolarity = "SELECT * FROM scolarships" or die("Error " . mysqli_error($link));
                        $scolarities = $link->query($q_scolarity);

                        $q_modalities = "SELECT * FROM modalities" or die("Error " . mysqli_error($link));
                        $modalities = $link->query($q_modalities);

                        $q_hq = "SELECT * FROM headquarters" or die("Error " . mysqli_error($link));
                        $hqs = $link->query($q_hq);
                    }
                    ?>
                    <h2>Edición de usuario</h2>
                    <p>Por favor haga los cambios que desee guardar</p>
                    <?php
                    if (isset($user)) {
                        ?>
                        <form>
                            <table>
                                <tr>
                                    <td>
                                        <label>Nombre: </label>
                                    </td>
                                    <td>
                                        <input id="nombre" type="text" value="<?php echo $user['names'] ?>"
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Apellido paterno: </label>
                                    </td>
                                    <td>
                                        <input id="apellido1" type="text" value="<?php echo $user['parent_names'] ?>"
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Apellido materno: </label>
                                    </td>
                                    <td>
                                        <input id="apellido2" type="text" value="<?php echo $user['maternal_name'] ?>"
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Fecha de nacimiento: </label>
                                    </td>
                                    <td>
                                        <input id="birthdate" placeholder="YYYY/MM/DD" value="<?php echo $user['born'] ?>" > (Formato <strong>AAAA/MM/DD</strong>)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Modalidad: </label>
                                    </td>
                                    <td>
                                        <select id="modality">
                                            <?php
                                            if ($modalities) {
                                                while ($modality = mysqli_fetch_array($modalities)) {
                                                    ?>
                                                    <option value="<?php echo $modality['id_modality'] ?>" 
                                                    <?php
                                                    if ($modality['id_modality'] === $user['id_modality']) {
                                                        echo "selected";
                                                    }
                                                    ?>>
                                                                <?php echo $modality['name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Nivel escolar: </label>
                                    </td>
                                    <td>
                                        <?php while ($scolarship = mysqli_fetch_assoc($scolarities)) { ?>
                                            <input name="education" type="radio" value="<?php echo $scolarship['id_scolarship'] ?>"
                                            <?php
                                            if ($user['scolarship'] === $scolarship['id_scolarship']) {
                                                echo "checked";
                                            }
                                            ?>>
                                            <?php echo $scolarship['name'] ?><br>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Sede: </label>
                                    </td>
                                    <td>
                                        <select id="hq">
                                            <?php
                                            if ($hqs) {
                                                while ($hq = mysqli_fetch_array($hqs)) {
                                                    ?>
                                                    <option value="<?php echo $hq['id_headquarter'] ?>" 
                                                    <?php
                                                    if ($hq['id_headquarter'] === $user['id_headquarters']) {
                                                        echo "selected";
                                                    }
                                                    ?>>
                                                                <?php echo $hq['name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php if ($user['id_country'] === 'MEX') { ?>
                                    <tr>
                                        <td>
                                            <label>Hospedaje:</label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input id="hosted" type="radio" value="1" name ="hosted"
                                                    <?php
                                                    if ($user['hosted'] === '1') {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                                </span>
                                                <span class="form-control" >Si</span>

                                                <span class="input-group-addon">
                                                    <input id="not_hosted" type="radio" value="0" name ="hosted"
                                                    <?php
                                                    if ($user['hosted'] === '0') {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                                </span>
                                                <span class="form-control">No</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <br>
                            <button class="btn btn-primary" type="button" 
                                    onclick="sendUserEditRequest(<?php echo $user['id_user'] ?>,'<?php echo $user['id_country'] ?>')">
                                Guardar cambios
                            </button>
                        </form>
                        <?php
                    }
                    ?>
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
            <br>
            <br>
            <br>
        </div>
    </body>
</html>
