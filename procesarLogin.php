<?php
include("config/baseDatos.php");
session_start(); // Asegúrate de iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];
    
    $sql = "SELECT * FROM usuarios WHERE Usuario = :usuario";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        foreach ($resultado as $filas) {
            if ($resultado && password_verify($contraseña, $filas['paswword'])) {
                $_SESSION['us'] = $filas['Usuario'];
                $_SESSION['id'] = $filas['id_usuarios'];
                header('location: index.php');
                exit(); // Es importante detener la ejecución después de redirigir
            } else {
?>
                <script>
                    alert('error');
                    window.location.href = "login.php";
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            alert('error de usuario');
            window.location.href = "login.php";
        </script>
<?php
    }
}
?>