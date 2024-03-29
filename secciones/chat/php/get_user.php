<?php
try {
    //este archivo genera los usuariospara poder mandarles mensaje, tambien posiciona por el mensaje más actual
    session_start();
    if (!isset($_SESSION['id'])) {
        throw new Exception(":D ");
    }
    $userP = $_SESSION['us'];
    $idus = $_SESSION['id'];

    include '../../../config/baseDatos.php';
    $sentencia = $con->prepare("SELECT id_usuarios, Usuario, token, estatus, fotoPerfil 
    FROM usuarios, empleados
    WHERE id_usuarios != $idus AND (departamento = 1 OR departamento =5 OR departamento = 6 OR departamento = 11 OR departamento = 12) 
    ORDER BY (SELECT MAX(id_msg) 
        FROM mensajes 
        WHERE (id_envia = usuarios.id_usuarios AND id_recibe = $idus) 
            OR (id_recibe = usuarios.id_usuarios AND id_envia = $idus)
    ) DESC");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            $sql2 = "SELECT * FROM mensajes WHERE (id_envia = {$idus} AND id_recibe = {$fila['id_usuarios']}) OR (id_recibe = {$idus} AND id_envia = {$fila['id_usuarios']}) ORDER BY id_msg DESC limit 1";

            $sent = $con->prepare($sql2);
            $sent->execute();
            $lastMessage = $sent->fetch(PDO::FETCH_ASSOC);
            $result = ($lastMessage) ? $lastMessage['msg'] : $result = 'No hay mensajes disponibles';
            $leido = ($lastMessage && $lastMessage['leido'] == '1') ? '<i class="bi bi-check2-all" style="color:blue"></i>' : '<i class="bi bi-check2"></i>';
            $por = ($lastMessage && $lastMessage['persona'] == $userP) ? ' <b>tú:</b> ' : '';
            if ($result === 'No hay mensajes disponibles') {
                $estatusMensaje = '<span> ' . $result . '<span>';
            } else {
                $estatusMensaje = $leido . '<span> ' . $result . '<span>';
            }

            if ($fila['estatus'] == 1) {
                $conectado = '<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($fila['estatus'] == 0) {
                $conectado = '<img id="conexion" src="img/sinLinea.png" alt="">';
            }
            if ($leido == '<i class="bi bi-check2"></i>' && $result != 'No hay mensajes disponibles' && $por != ' <b>tú:</b> ') {
                $clase = ' style="font-weight: bold;"';
            } else {
                $clase = '';
            }
            echo '<div class="opcion">
                    <a href="php/chat.php?id=' . $fila['token'] . '" ' . $clase . '>
                        <div class="cuentas">
                            <div class="foto">
                                <img src="' . $fila['fotoPerfil'] . '" alt="img perfil" id="fotoPerfil">
                            </div>
                            <div class="usuario">
                                <b>' . $fila['Usuario'] . '</b>
                                <span>' . $conectado . '</span>
                            </div>
                        </div>' . '
                        <div class="mensaje-previo"> 
                            ' . $por . $estatusMensaje . '
                        </div>
                    </a>
                </div>';
        }
    } else {
        // si no envia el mensaje de comenzar chat
        echo '<li></b>Aún no hay personas registradas</b></li>';
    }
} catch (Exception $e) {
    echo $e->getMessage();   //throw $th;
}
