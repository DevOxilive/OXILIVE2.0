<?php

include("../../../config/session.php");
$id = $_POST["id"];
echo "id seleccionado" . $id ."<br>";

$sql = "SELECT * FROM usuarios WHERE id_usuarios = $id";
$stmt = $con->prepare($sql);
$stmt ->execute();  
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($resultado as $filas) {
    echo $filas['Usuario'];
}