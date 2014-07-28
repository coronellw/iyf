<?php
//$hst = "68.178.216.177";
$hst = "localhost:3306";
$usrnm = "iyfevent";
$psswrd = "S3v3nT1m3s!";
$schm = "IYF";
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$acentos = $link->query("SET NAMES 'utf8'");