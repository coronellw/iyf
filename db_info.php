<?php
//$hst = "68.178.216.177";
$hst = "localhost";
$usrnm = "iyfevent";
$psswrd = "S3v3nT1m3s!";
$schm = "iyfevent";
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$acentos = $link->query("SET NAMES 'utf8'");