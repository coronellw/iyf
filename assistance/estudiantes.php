<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Registrar asistencia estudiantes</title>
        <?php include '../template/_head.php' ?>
    </head>
    <body>
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
                        <hr />
                        <span id="btnCnf" class="row hidden">
                            <button type="button" class="btn btn-primary">Confirmar asistencia</button>
                        </span>
                        <div id="groupInfo" class="row">
                            <div class="row">
                                <span class="col-md-6 text-right">
                                    <label for="grupo">Grupo: </label>
                                </span>
                                <span class="col-md-6 text-left">
                                    <span id="grupo"></span>
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6 text-right">
                                    <label for="maestro">Maestro: </label>
                                </span>
                                <span class="col-md-6 text-left">
                                    <span id="maestro"></span>
                                </span>
                            </div>
                        </div>

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
