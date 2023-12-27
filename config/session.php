<?php
$url_base = 'https://prueba.oxilive.com.mx/';
session_start();
if (isset($_SESSION["us"])) {
    include 'baseDatos.php';
    ?>    
    <h1>Bienvenido <?php  echo $_SESSION['us']?></h1>
    <?php
} else {
    header('location: '. $url_base .'login.php');
}

