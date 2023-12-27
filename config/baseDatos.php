<?php

$host = "localhost";
$usuario = "root";
$contraseña = "";
$bd = "bdoxilive";

try {
    $con = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contraseña);
    echo "base de datos $bd conectada";
    echo "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . " para conectar la base de datos";
}

// base de datos: u199199938_swoe   
// nombre de usuario: u199109938_hackerman
// contraseña: SwOe@xilive12
