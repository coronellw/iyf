<?php
$id_user = filter_input(INPUT_GET, "user");

require_once('../class/BCGFontFile.php');
require_once('../class/BCGColor.php');
require_once('../class/BCGDrawing.php');
require_once('../class/BCGcode128.barcode.php');

$font = new BCGFontFile('../font/Arial.ttf', 14);

$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);

$code = new BCGcode128();

$code->setScale(2);
$code->setThickness(30);
$code->setForegroundColor($color_black);
$code->setBackgroundColor($color_white);
$code->setFont($font);
$code->setStart(NULL);
$code->setTilde(true);
$code->parse($id_user);

$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();

header('Content-Type: image/png');

$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
