<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Registrar asistencia maestros</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
        <!-- Modal -->
        <div class="modal fade" id="maestroModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmar asistencia</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <span class="col-md-6 text-right">
                        <label for="id">Id: </label>
                    </span>
                    <span class="col-md-6">
                        <span id="id"></span>
                    </span>
                </div>

                <div class="row">
                    <span class="col-md-6 text-right">
                        <label for="nombres">Nombres: </label>
                    </span>
                    <span class="col-md-6">
                        <span id="nombres"></span>
                    </span>
                </div>

                <div class="row">
                    <span class="col-md-6 text-right">
                        <label for="apellidos">Apellidos: </label>
                    </span>
                    <span class="col-md-6">
                        <span id="apellidos"></span>
                    </span>
                </div>

                <div class="row">
                    <span class="col-md-6 text-right">
                        <label for="sede">Sede: </label>
                    </span>
                    <span class="col-md-6">
                        <span id="sede"></span>
                    </span>
                </div>

                <div class="row">
                    <span class="col-md-6 text-right">
                        <label for="mail">Correo electrónico: </label>
                    </span>
                    <span class="col-md-6">
                        <span id="mail"></span>
                    </span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnCnf" type="button" class="btn btn-primary">Confirmar asistencia</button>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user'])) {
                    include '../db_info.php';
                    ?>
                    <h3>Registrar asistencia de maestros</h3>
                    <p>Proporcione por favor el código del maestro que desea registrar</p>
                    <input id='user_id' onchange='getMaestro({modalities:[5]})' >
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
        </div>
    </body>
</html>
