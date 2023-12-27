<?php
include("./config/session.php");
?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo $url_base ?>" type="image/x-icon">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<title>Oxilive</title>

<body>
    <br>
    ir al chat: <a href="<?php echo $url_base . "secciones/chat/index.php" ?>">puchale aquí</a>
    <br>
    cerrar sesion: <a href="<?php echo $url_base . "cerrar.php" ?>">puchale aquí</a>
</body>

</html>