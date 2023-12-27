<?php
// include '../../../../cargaDoc/control.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
//     $nombreArchivo = $_FILES['file']['name'];
//     $archivo = $_FILES['file']['tmp_name'];
//     $carpeta = 'documentos/';
//     guardarDocumento($con, $carpeta, $nombreArchivo, $archivo, $persona);
// }
include '../../../config/baseDatos.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $user = $_POST['user'];
    $output = $_POST['output'];
    $userC = $_POST['userC'];
    $dateTime = date("Y-m-d H:i:s");
    echo "funciona este archivo";
}
