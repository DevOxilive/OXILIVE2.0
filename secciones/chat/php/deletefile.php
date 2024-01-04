<?php
if (isset($_POST['documento_id'])) {
    include('../../../config/baseDatos.php');
    include('../../../ctrlArchivos/control/Archivero.php');

    $obj = new Archivero();
    $documentoID = $_POST['documento_id'];
    echo $documentoID;
    $stst = $con->prepare("SELECT * FROM documentos WHERE id = $documentoID");
    $stst->execute();
    $result = $stst->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $fila) {
        $nombreArchi = $fila['nombreArchi'];
    }
    $archivoAEliminar = 'documentos/' . $nombreArchi;

    if ($obj->eliminarArchivo($archivoAEliminar) !== true) {
?>
        <script>
            alert("algo anda mal intentalo más tarde");
            window.history.back();
        </script>
        <?php
    } else {
        try {
            $stst = $con->prepare("DELETE FROM documentos WHERE id = $documentoID;");
            $stst->execute();
            $stst = $con->prepare("UPDATE mensajes SET msg = 'se elimino este archivo :/' WHERE msg = '$nombreArchi';");
            $stst->execute();
        } catch (Exception $e) {
        ?>
            <script>
                alert("algo anda mal intentalo más tarde");
                window.history.back();
            </script>
        <?php
        }
        ?>
        <script>
            alert("archivo eliminado correctamente");
            window.history.back();
        </script>
<?php
    }
}
