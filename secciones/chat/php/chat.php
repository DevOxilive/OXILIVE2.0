<?php
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

    echo "id seleccionado " . $id . "<br>";

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
        <title>chat rico</title>
    </head>

    <body>
    <?php
    if (count($resultado) > 0) {
        foreach ($resultado as $filas) {
            echo '<div>
                    <h1>
                    ' . $filas['Usuario'] .'
                    </h1>
                </div>';
        }
    } else {
        echo "error rico";
    }
} catch (Exception $e) {
    echo "evita manipular la url o te llevo preso";
}
    ?>
    </body>

    </html>