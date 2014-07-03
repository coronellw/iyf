<?php 
$hst = "localhost:3306";
$usrnm = "IYF";
$psswrd = "$3v3n_T1m3s";
$schm = "IYF";
$root = "/iyf/";

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$acentos = $link->query("SET NAMES 'utf8'");