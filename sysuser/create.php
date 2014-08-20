<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Creacion de usuario del sistema</title>
        <?php include '../template/_head.php';
            include '../db_info.php';
        ?>
        <script type="text/javascript" src="../js/sysuser.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 3) {
                    
                    $q_ut = "SELECT * FROM usertypes" or die("Error " . mysqli_error($link));
                    $r_ut = $link->query($q_ut);
                    if ($r_ut && (mysqli_num_rows($r_ut)>0)) {
                        $usertypes = $r_ut;
                    }else{
                        $usertypes = array();
                    }
                    ?>
                    <h3>Creación</h3>
                    <p>Por favor suministre el código del usuario que desea agregar a los usuarios del sistema.</p>
                    <br class="clearfix">

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="id_user" class="col-md-4 col-md-offset-2 control-label">Código</label>
                                    <div class="col-md-4">
                                        <input id="id_user" type="text" class="form-control" onchange='findUserCandidate()'>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="nombres" class="col-md-4 col-md-offset-2 control-label">Nombres: </label>
                                    <div class="col-md-4 text-left">
                                        <span id="nombres"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellido1" class="col-md-4 col-md-offset-2 control-label">Apellido paterno</label>
                                    <div class="col-md-4 text-left">
                                        <span id="apellido1"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellido2" class="col-md-4 col-md-offset-2 control-label">Apellido materno</label>
                                    <div class="col-md-4 text-left">
                                        <span id="apellido2"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br class="clearfix">
                    <div class="row">
                        <div class="row col-md-6 col-md-offset-3">
                            <form class="form-horizontal" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label class="col-md-4 col-md-offset-2 control-label" for="username">Nombre de usuario:</label>
                                    <div class="col-md-4">
                                        <input id="username" class="form-control" disabled>
                                    </div>
                                </div>
    
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_usertype'] < 3){ ?>
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
                                <?php } else { ?>
                                    <input type="hidden" id="usertype" value="<?php echo $user['id_usertype'] ?>">
                                <?php } ?>
    
                                <div class="form-group">
                                    <label class="col-md-4 col-md-offset-2 control-label" for="newPassword">Contraseña:</label>
                                    <div class="col-md-4">
                                        <input id="newPassword" class="form-control" type="password" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="verification" class="col-md-4 col-md-offset-2 control-label" >Confirmar contraseña:</label>
                                    <div class="col-md-4">
                                        <input id="verification" class="form-control" type="password" disabled>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <a href="#" id="sndBtn" class="btn btn-primary">Crear usuario</a>
                            </div>
                        </div>
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