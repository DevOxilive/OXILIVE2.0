<?php
include '../../../ctrlArchivos/control/Archivero.php';
include '../../../config/baseDatos.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $output = $_POST['output'];
    $userC = $_POST['userC'];
    $dateTime = date("Y-m-d H:i:s");

    $nombreArchivo = $_FILES['file']['name'];
    $archivo  = $_FILES['file']['tmp_name'];
    $carpeta = 'documentos/';
    // Directorio donde se almacenarán los archivos (chat nada más)
    $envio = $_SESSION['id'];
    $obj = new Archivero();

    $archivos = scandir($carpeta);
    $archivos = array_diff($archivos, array('..', '.'));
    $cant = count($archivos);
    $nombreArchi = $cant . $nombreArchivo;
    if ($obj->guardarArchivo($nombreArchi, $archivo, $carpeta) === true) {
        try {
            $sentencia = $con->prepare("INSERT INTO mensajes (id_entrada, id_salida, msg, fecha_hora, persona) VALUES ('$envio','$output', '$nombreArchi', '$dateTime', '$user')");
            $sentencia->execute();
            $sentencia = $con->prepare("INSERT INTO documentos (nombreArchi, id_envia, id_recibe, persona) VALUES ('$nombreArchi', '$envio','$output', '$user')");
            $sentencia->execute();

        } catch (\Throwable $th) {
            echo "error en el sistema intentalo más tarde";
            $obj->eliminarArchivo('documentos/' . $nombreArchi);
        }
    } else {
        echo "error intentalo de nuevo, cambia el nombre del archivo";
        $obj->eliminarArchivo('documentos/' . $nombreArchi);
    }
} else {
    echo "?";
}
