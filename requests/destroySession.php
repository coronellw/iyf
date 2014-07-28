<?php

include '../validations.php';
session_start();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    echo "ok";
    $_SESSION['messages'][] = createMsg("Sesión finalizada.", "info", "IYF");
}