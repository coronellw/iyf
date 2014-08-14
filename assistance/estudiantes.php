<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Registrar asistencia estudiantes</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
        <!-- Modal -->
        <div class="modal fade" id="estudianteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos de asistencia</h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                    <h3>Registrar asistencia de estudiante</h3>
                    <p>Proporcione por favor el código del estudiante que desea registrar</p>
                    <input id='user_id' onchange='getEstudiante({modalities:[1,2,3,4]})' >
                    <br>
                    <br>
                    <div class="row col-md-6 col-md-offset-3">
                        <div class="row">
                            <span class="col-md-6 text-right">
                                <label for="id">Id: </label>
                            </span>
                            <span class="col-md-6 text-left">
                                <span id="id"></span>
                            </span>
                        </div>

                        <div class="row">
                            <span class="col-md-6 text-right">
                                <label for="nombres">Nombres: </label>
                            </span>
                            <span class="col-md-6 text-left">
                                <span id="nombres"></span>
                            </span>
                        </div>

                        <div class="row">
                            <span class="col-md-6 text-right">
                                <label for="apellidos">Apellidos: </label>
                            </span>
                            <span class="col-md-6 text-left">
                                <span id="apellidos"></span>
                            </span>
                        </div>

                        <div class="row">
                            <span class="col-md-6 text-right">
                                <label for="sede">Sede: </label>
                            </span>
                            <span class="col-md-6 text-left">
                                <span id="sede"></span>
                            </span>
                        </div>

                        <div class="row">
                            <span class="col-md-6 text-right">
                                <label for="mail">Correo electrónico: </label>
                            </span>
                            <span class="col-md-6 text-left">
                                <span id="mail"></span>
                            </span>
                        </div>

                        <span>
                            <button id="btnCnf" type="button" class="btn btn-primary hidden">Confirmar asistencia</button>
                        </span>
                    </div>
                    <?php
                } else {
                    include '../forbidden.php';
                }
                ?>
            </center>
        </div>
    </body>
</html>
