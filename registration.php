<?php session_start(); ?>
<html>
    <head>
        <title>IYF</title>
        <?php
        include './template/_head.php';
        include './db_info.php';

        $countries_query = "SELECT * FROM countries ORDER BY name;" or die("Error " . mysqli_error($link));
        $countries = $link->query($countries_query);

        $scolarships_query = "SELECT * FROM scolarships;" or die("Error " . mysqli_error($link));
        $scolarships = $link->query($scolarships_query);

        $contacts_type_query = "SELECT * FROM contact_type;" or die("Error " . mysqli_error($link));
        $contact_types = $link->query($contacts_type_query);

        if (!isset($_SESSION['user'])) {
            $modalities_query = "SELECT * FROM modalities WHERE admin_required = 0;" or die("Error " . mysqli_error($link));
        } else {
            $modalities_query = "SELECT * FROM modalities;" or die("Error " . mysqli_error($link));
        }
        $modalities = $link->query($modalities_query);

        $usertypes_query = "SELECT * FROM usertypes;" or die("Error " . mysqli_error($link));
        $usertypes = $link->query($usertypes_query);

        $hqs_query = "SELECT * FROM headquarters;" or die("Error " . mysqli_error($link));
        $hqs = $link->query($hqs_query);

        $publicities_query = "SELECT * FROM publicities" or die("Error " . mysqli_error($link));
        $publicities = $link->query($publicities_query)
        ?>
        <script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script>
            jQuery(function() {
                jQuery('#birthdate').mask('9999/99/99', {placeholder: " "});
            })
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './template/navbar.php'; ?>
            <center>
                <form id="form">
                    <h1>Registro de usuarios</h1>
                    <h2>Llene los campos para hacer el registro de un usuario</h2>
                    <span class="row">
                        <input type="hidden" id="registered_by" 
                            value=" <?php if (isset($_SESSION['user'])) {
                                        echo $_SESSION['user']['id_user'];
                                    }else { 
                                        echo '100002';
                                    }?>
                        ">
                        <table>
                            <tr colspan="2" ><h3>Informacion personal</h3></tr>
                            <tr>
                                <td>
                                    <label>Nombres: </label>
                                </td>
                                <td>
                                    <input id="names" type="text" >
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Apellido paterno: </label>
                                </td>
                                <td>
                                    <input id="parent_name" type="text">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Apellido materno: </label>
                                </td>
                                <td>
                                    <input id="maternal_name" type="text" >
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Sexo: </label>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="radio" value="M" name="sex"> 
                                        </span>
                                        <span class="form-control" >Masculino</span>

                                        <span class="input-group-addon">
                                            <input type="radio" value="F" name="sex">
                                        </span>
                                        <span class="form-control">Femenino</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Fecha de nacimiento: </label>
                                </td>
                                <td>
                                    <input id="birthdate" placeholder="YYYY/MM/DD" > (Formato <strong>AAAA/MM/DD</strong>)
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Nivel escolar: </label>
                                </td>
                                <td>
                                    <?php while ($scolarship = mysqli_fetch_array($scolarships)) { ?>
                                        <input name="education" type="radio" value="<?php echo $scolarship['id_scolarship'] ?>">
                                        <?php echo $scolarship['name'] ?><br>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Contacto casa: </label>
                                </td>
                                <td>
                                    <div>
                                        <input id="home_phone" type="tel" required> 
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Contacto celular: </label>
                                </td>
                                <td>
                                    <div>
                                        <input id="cell_phone" type="tel" required > 
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Otros Contactos: </label>
                                </td>
                                <td>
                                    <div>
                                        <input id="phone" type="tel" > 
                                        <a onclick="addPhone();" class="btn btn-xs">
                                            Agregar
                                        </a>
                                        <br>
                                        <select id="contact_type" style="margin-top: 2px;" >
                                            <?php while ($contact_type = mysqli_fetch_array($contact_types)) { ?>
                                                <option value="<?php echo $contact_type['id_contact_type'] ?>">
                                                    <?php echo $contact_type['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <br>
                                        <ul id="phones">
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Pa&iacute;s de origen: </label>
                                </td>
                                <td>
                                    <select id="country" onchange="updateStates();">
                                        <option value='null'>---</option>
                                        <?php while ($country = mysqli_fetch_array($countries)) { ?>
                                            <option value="<?php echo $country['id_country'] ?>"><?php echo $country['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Estado: </label>
                                </td>
                                <td>
                                    <select id="state" onchange="updateCities();">
                                        <option value='null'>---</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Ciudad: </label>
                                </td>
                                <td>
                                    <select id="city">
                                        <option value='null'>---</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Sede más cercana: </label>
                                </td>
                                <td>
                                    <select id="hq">
                                        <option value='null'>---</option>
                                        <?php while ($hq = mysqli_fetch_array($hqs)) { ?>
                                            <option value="<?php echo $hq['id_headquarter'] ?>"><?php echo $hq['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>E-mail: </label>
                                </td>
                                <td>
                                    <input id="email" type="email" style="width:350px;" >
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Modalidad de participaci&oacute;n: </label>
                                </td>
                                <td>
                                    <select id="modality">
                                        <option value='null'>---</option>
                                        <?php while ($modality = mysqli_fetch_array($modalities)) { ?>
                                            <option value="<?php echo $modality['id_modality'] ?>"><?php echo $modality['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Como se entero del evento: </label>
                                </td>
                                <td>
                                    <select id="publicity">
                                        <option value='null'>---</option>
                                        <?php while ($publicity = mysqli_fetch_array($publicities)) { ?>
                                            <option value="<?php echo $publicity['id_publicity'] ?>">
                                                <?php echo $publicity['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Hospedaje:</label>
                                    <br>
                                    <span class="tiny">Cambios de acuerdo al reglamento, consultar con sede</span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input id="hosted" type="radio" value="1" name ="hosted" checked onchange="recalcPrice();" >
                                        </span>
                                        <span class="form-control" >Si</span>

                                        <span class="input-group-addon">
                                            <input id="not_hosted" type="radio" value="0" name ="hosted" selected onchange="recalcPrice();">
                                        </span>
                                        <span class="form-control">No</span>
                                    </div>
                                </td>
                            </tr>
                            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id_usertype'] < 3)) { ?>
                                <tr>
                                    <td>
                                        <label>Asistencia aprobada: </label>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" value="1" name ="assistance">
                                            </span>
                                            <span class="form-control" >Si</span>

                                            <span class="input-group-addon">
                                                <input type="radio" value="0" checked name ="assistance" > 
                                            </span>
                                            <span class="form-control">No</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td>
                                    <label>Precio: </label>
                                </td>
                                <td>
                                    $<span id="price">0</span> MXN
                                </td>
                            </tr>
                        </table>

                        <?php if (isset($_SESSION['user'])) { ?>
                            <input id='register_system_user' type="checkbox" onclick="toggleAccountInfo();" > Habilitar usuario de sistema

                            <div id="account_info" style="display: none">
                                <table>
                                    <tr rowspan="2" ><h3>Informacion de cuenta</h3></tr>

                                    <tr>
                                        <td>
                                            <label>Nombre de usuario: </label>
                                        </td>
                                        <td>
                                            <input id="username" type="text" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>tipo de usuario: </label>
                                        </td>
                                        <td>
                                            <select id="usertype">
                                                <?php while ($usertype = mysqli_fetch_array($usertypes)) { ?>
                                                    <option value="<?php echo $usertype['id_usertype'] ?>" >
                                                        <?php echo $usertype['name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Contrase&ntilde;a: </label>
                                        </td>
                                        <td>
                                            <input id="password" type="password" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Repetir contrase&ntilde;a: </label>
                                        </td>
                                        <td>
                                            <input id="password_confirmation" type="password" >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                    </span>

                    <div id="disclaimers">
                        <span style="text-transform: uppercase">
                            Por favor leer el <a href="http://registro.iyfes.org/downloads/REGLAMENTO.docx" target="_blank">reglamento deneral del campamento</a> y marque la siguiente casilla si esta usted de acuerdo
                        </span>
                        <br>
                        <input id='rules' type="checkbox" required/> He leído el reglamento y estoy de acuerdo
                    </div>

                    <span class="row">
                        <a href="#" class="btn btn-primary" onclick="requestRegistration();" >Registrar</a>
                    </span>
                </form>
                <div id='privacy_police'>
                    <span style="text-transform: uppercase">
                        Si desea conocer nuestra política de privacidad, por favor haga click <a href="http://registro.iyfes.org/downloads/PRIVACY.pdf" target="_blank">aquí</a>
                    </span>
                </div>
            </center>
        </div>
    </body>
</html>