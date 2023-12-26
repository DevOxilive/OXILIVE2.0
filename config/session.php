<?php
$url_base = 'http://localhost:8080/OXILIVE2.0/';
session_start();
if (isset($_SESSION["us"])) {
    include 'baseDatos.php';
} else {
    header('location: '. $url_base .'login.php');
}

