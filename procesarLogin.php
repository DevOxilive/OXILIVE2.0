<?php
include_once("config/baseDatos.php");
session_start(); // Asegúrate de iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];

    try {

        $stmt = $con->prepare("SELECT * FROM usuarios WHERE usuario = $usuario");
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($datos) > 0) {
            if ($datos && password_verify($contraseña, $datos["paswword"])) {
                $_SESSION['id'] = $datos['id_usuarios'];
                $_SESSION['us'] = $datos["Usuario"];

?>

                <script>
                    alert("bienvenido");
                    window.location = 'index.php';
                </script>

            <?php
            } else {
            ?>

                <script>
                    alert("error en la contraseña");
                    window.location = 'index.php';
                </script>
            <?php
                echo "error en la contraseña";
            }
        } else {
            ?>
            <script>
                alert("Error en el usuario");
                window.location = 'index.php';
            </script>
    <?php
        }
    } catch (Exception $e) {
        echo "ERROR encontrado <br>";
    }
} else {
    ?>
    <script>
        alert("Error en el sistema");
        window.location = 'index.php';
    </script>
<?php
}
?>