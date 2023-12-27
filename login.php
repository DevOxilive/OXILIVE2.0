<?php
session_start();
if (isset($_SESSION['us'])) {
    header('location: index.php');
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="assets/img/OXILIVE.ico" type="image/x-icon">
    <title>iniciar sesion</title>
</head>

<body>

    <div id="login-container">
        <h3>Iniciar sesion</h3>
        <img src="assets/img/OXILIVE.ico" alt="Logo">
        <form action="procesarLogin.php" method="post">
            <input type="text" name="username" placeholder="Usuario" maxlength="20" minlength="8" required>
            <br>
            <input type="password" name="password" placeholder="Contraseña" maxlength="20" minlength="8" required>
            <br>
            <input type="submit" value="Iniciar sesión">
        </form>
    </div>

</body>

</html>