<?php session_start(); ?>
<html>
    <head>
        <title>IYF - Intercambio de ususario</title>
        <?php include '../template/_head.php' ?>
        <script src="/js/intercambio.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <?php
                include '../template/navbar.php';
                if (isset($_SESSION['user']) && ($_SESSION['user']['id_usertype'] < 3)) {
                    include '../db_info.php';
                    ?>
                    <h2>Intercambio de grupos</h2>
                    <p>Por favor haga los cambios que desee guardar</p>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="row">
                                <h3>Datos estuidante 1</h3>
                            </span>
                            <div class="row">
                                <span class="col-md-6">
                                    <label for="cod1">Código estudiante 1: </label>
                                </span>
                                <span class="col-md-6 text-left">
                                    <input id="cod1" type="number" onchange="setUserOneInfo()">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="name1">Nombres: </label>
                                </span>
                                <span id="name1" class="col-md-6 text-left">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="apellidos1">Apellidos: </label>
                                </span>
                                <span id="apellidos1" class="col-md-6 text-left">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="sede1">Sede: </label>
                                </span>
                                <span id="sede1" class="col-md-6 text-left">
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <span class="row">
                                <h3>Datos estuidante 2</h3>
                            </span>
                            <div class="row">
                                <span class="col-md-6">
                                    <label for="cod2">Código estudiante 2: </label>
                                </span>
                                <span class="col-md-6 text-left">
                                    <input id="cod2" type="number" onchange="setUserTwoInfo()">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="name2">Nombres: </label>
                                </span>
                                <span id="name2" class="col-md-6 text-left">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="apellidos2">Apellidos: </label>
                                </span>
                                <span id="apellidos2" class="col-md-6 text-left">
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-md-6">
                                    <label for="sede2">Sede: </label>
                                </span>
                                <span id="sede2" class="col-md-6 text-left">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary">Intercambiar grupos</button>
                    </div>
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
