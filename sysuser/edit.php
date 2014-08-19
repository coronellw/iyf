<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Edicion de usuarios del sistema</title>
        <?php include '../template/_head.php';
            include '../db_info.php';
        ?>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                $id_user = filter_input(INPUT_GET, "user");
                if ((isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 3)||$_SESSION['user']['id_user']==$id_user) {
                    
                    $query = "SELECT u.usrnm, u.id_usertype FROM users u, usertypes ut 
                            WHERE u.id_user = $id_user AND usrnm is not null AND u.id_usertype = ut.id_usertype" or die("Error " . mysqli_error($link));
                    $result = $link->query($query);
                    if ($result && (mysqli_num_rows($result)>0)) {
                        $user = mysqli_fetch_assoc($result);
                    }else{
                        echo "Información inválida";
                    }

                    $q_ut = "SELECT * FROM usertypes" or die("Error " . mysqli_error($link));
                    $r_ut = $link->query($q_ut);
                    if ($r_ut && (mysqli_num_rows($r_ut)>0)) {
                        $usertypes = $r_ut;
                    }else{
                        $usertypes = array();
                    }
                    ?>
                    <h3>Edición</h3>
                    <p>Por favor realice sus cambios y guarde la información necesaria.</p>
                    <a href="index.php">Regresar al listado de usuarios del sistema</a>
                    <br>
                    <br>
                    <?php if (isset($user)) { ?>
                        <div class="col-md-6 col-md-offset-3">
                            <form class="form-horizontal" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label class="col-md-4 col-md-offset-2 control-label" for="username">Nombre de usuario:</label>
                                    <div class="col-md-4">
                                        <input id="username" class="form-control" value=<?php echo $user['usrnm'] ?> >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 col-md-offset-2 control-label">Tipo de usuario:</label>
                                    <div class="col-md-4">
                                        <select id="usertype" class="form-control">
                                            <?php while($ut = mysqli_fetch_assoc($usertypes)){ 
                                                if ($_SESSION['user']['id_usertype'] < 2 || $ut['id_usertype']!=="1") { ?>
                                                    <option value="<?php echo $ut['id_usertype'] ?>"
                                                        <?php if ($ut['id_usertype'] == $user['id_usertype']) { echo "selected"; } ?>>
                                                        <?php echo $ut['name'] ?>
                                                    </option>
                                            <?php } 
                                            }?>
                                        </select>
                                    </div>
                                </div>

                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] !== "1"){ ?>
                                    <div class="form-group">
                                        <label class="col-md-4 col-md-offset-2 control-label" for="password">Contraseña actual:</label>
                                        <div class="col-md-4">
                                            <input id="password" class="form-control" type="password" >
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label class="col-md-4 col-md-offset-2 control-label" for="newPassword">Nueva contraseña:</label>
                                    <div class="col-md-4">
                                        <input id="newPassword" class="form-control" type="password" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="verification" class="col-md-4 col-md-offset-2 control-label" >Confirmar contraseña:</label>
                                    <div class="col-md-4">
                                        <input id="verification" class="form-control" type="password" >
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <button class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>    
                        </div>
                        <?php } else {
                            echo "Ese código no corresponde con un usuario del sistema";
                        }?>
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