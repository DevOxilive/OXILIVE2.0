<?php
// este archivo espera por la url el valor de el usuario a mandar mensaje para poder pintar el chat, y tiene un control de errores por alguna modificacion en la url
try {
    include("../../../config/session.php");
    if (!isset($_GET['id'])) {
        throw new Exception("Error Processing Request", 1);
    } else {
        $id = $_GET["id"];
    }
    if (empty($id)) {
        throw new Exception("Error Processing Request", 1);
    }
    $sql = "SELECT * FROM usuarios where token = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/chat.css">
        <link rel="stylesheet" href="../css/archivos.css">
        <title>chat rico</title>
    </head>

    <body>
        <?php
        if (count($resultado) > 0) {
            foreach ($resultado as $filas) {
                if ($filas['estatus'] == 1) {
                    $conectado = '<img id="conexion" src="../img/enLinea.png" alt="">';
                } else if ($filas['estatus'] == 0) {
                    $conectado = '<img id="conexion" src="../img/sinLinea.png" alt="">';
                }
                $enviarA = $filas['id_usuarios'];
            }

        ?>
            <div class="conteiner">
                <div class="chat-header">
                    <a href="../index.php"> <- </a>
                            <?php
                            echo '<img src="' . $filas['Foto_perfil'] . '" class="iconoUsuario" alt="foto de perfil">';
                            echo "<div class='usuario'>";
                            echo "<h2>" . $filas['Usuario'] . "</h2>";
                            echo $conectado;
                            echo "</div>";
                            ?>
                            <button class="boton-folder" id="btnMostrar">archivos</button>
                            </h2>
                </div>
                <form action="deletefile.php" method="post">
                    <div class="vistaArchivos" id="miGaleria">
                        <div id="list-documentos">

                        </div>
                    </div>
                </form>
                <div id="chat-container">
                    <div id="chat-messages">
                        <!-- aqui se generan los mensajes -->
                    </div>
                </div>
                <div id="chat-form">
                    <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                    <label for="fileInput" class="custom-file-upload" id="fileLabel">
                        +<!-- 📎 -->
                    </label>
                    <input type="file" id="fileInput" name="file">
                    <input type="text" id="message" placeholder="Escribe tu mensaje" maxlength="500">
                    <input type="hidden" value="<?php echo $enviarA; ?>" id='output'>
                    <button id="send"><img src="../img/pngwing.com.png" alt="" width="30px"></button>
                </div>
            </div>
    <?php
        } else {
            echo "error de comunicacion";
        }
    } catch (Exception $e) {
        echo "evita manipular la url!!!<br>estamos llamando a la policia<br>";
    }
    ?>
    </body>
    <!-- en mantenimiento -->
    <script src="../js/interfazArchi.js"></script>
    <script src="../js/documentos.js"></script>
    <!-- controlador de los estilos del chat -->
    <script src="../js/chatPriv.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Enlace al archivo JavaScript de Bootstrap (requiere Popper.js y jQuery) desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    </html>