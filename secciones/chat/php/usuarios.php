<?php
session_start();
$id_sesionActual = $_SESSION["id"];
include('../../../config/baseDatos.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['buscar'];

    // $sql = "SELECT * FROM usuarios 
    // WHERE (Nombres LIKE '%$usuario%'
    // OR Apellidos LIKE '%$usuario%' 
    // OR Usuario LIKE '%$usuario%') 
    // AND id_usuarios <> $id_sesionActual;";

    $sql = "SELECT Nombres, Apellidos, Usuario FROM usuarios 
    WHERE CONCAT(Nombres, ' ', Apellidos) LIKE '%$usuario%' 
    OR CONCAT(Apellidos, ' ' ,Nombres) LIKE '%$usuario%' 
    OR (Nombres LIKE '%$usuario%'
    OR Apellidos LIKE '%$usuario%' 
    OR Usuario LIKE '%$usuario%') 
    AND id_usuarios <> $id_sesionActual;";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $key => $value) {
        echo '<li data-id="' . $value['token'] . '">' . $value['Usuario'] . ': ' . $value['Nombres'] . ' ' . $value['Apellidos'] . '</li>';
    }
}
