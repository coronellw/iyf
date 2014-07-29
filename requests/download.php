<?php

$fichero_in = filter_input(INPUT_GET, "filename");
$fichero = "../downloads/" . $fichero_in;
echo $fichero;

if (file_exists($fichero)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($fichero));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichero));
    ob_clean();
    flush();
    readfile($fichero);
    exit;
} else {
    echo $fichero . "\nFile not found";
}
        