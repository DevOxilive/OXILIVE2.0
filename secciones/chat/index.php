<?php
include("../../config/session.php");
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo $url_base ?>" type="image/x-icon">
<link rel="stylesheet" href="css/index.css">
<title>Oxilive</title>

<body>
    regresar: <a href="<?php echo $url_base ?>">puchale aquí</a>
    <br>
    cerrar sesion: <a href="<?php echo $url_base . "cerrar.php" ?>">puchale aquí</a>
    <br>
    <div class="contenedor">
        <div>
            <div class="buscador">
                <label for="buscador">
                    <h1>Buscar usuario</h1>
                    <input type="text" name="buscador" placeholder="Escribe el nombre del usuario..." id="buscador" maxlength="30">
                </label>
            </div>
            <div class="usuariosCaja">
                <ul class="cajaUsuarios" id="listaUsuarios">
                    <!-- listado de usuarios -->
                </ul>
            </div>
            <div class="encabezado">
                <h1>Chats</h1>
            </div>
            <div class="cajaChats">
                <div id="chats">
                    <!-- CHATS disponibles -->
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/usuarios.js"></script>
<script src="js/selecChat.js"></script>
<script src="js/chats.js"></script>

</html>