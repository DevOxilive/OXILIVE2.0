<?php
// este archivo busca un usuario en especifico para poder mandar mensajes
session_start();
$id_sesionActual = $_SESSION["id"];
include('../../../config/baseDatos.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['buscar'];

    //busqueda con OR agrupado y la condicion para evitar mostrar al usuario en sesion actual.
    $sql = "SELECT estatus, id_usuarios, fotoPerfil, nombres, apellidos, usuario, token FROM usuarios, empleados
    WHERE usuarioSistema = id_usuarios 
    AND (CONCAT(nombres, ' ', apellidos, ' ') LIKE '%$usuario%' 
    OR CONCAT(apellidos, ' ' ,nombres, ' ') LIKE '%$usuario%' 
    OR (nombres LIKE '%$usuario%'
    OR apellidos LIKE '%$usuario%' 
    OR usuario LIKE '%$usuario%'))
    AND id_usuarios <> $id_sesionActual;"; // diferente de #sesion actual.

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        foreach ($resultado as $key => $value) {
            if ($value['estatus'] == 1) {
                $conectado = '<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($value['estatus'] == 0) {
                $conectado = '<img id="conexion" src="img/sinLinea.png" alt="">';
            }
            echo '<div class="opcion">
                    <a href="php/chat.php?id=' . $value['token'] . '">
                        <div class="cuentas">
                            <div class="foto">
                                <img src="' . $value['fotoPerfil'] . '" alt="img perfil" id="fotoPerfil">
                            </div>
                            <div class="usuario">
                                <b>' . $value['usuario'] . ': ' . $value['nombres'] . ' ' . $value['apellidos'] . '</b>
                                <span>' . $conectado . '</span>
                            </div>
                        </div>
                    </a>
                </div>';
        }
    } else {
        echo '<h1>No se encontraron resultados<br>:(</h1>';
    }
}
