<?php

try {
    //code...

    include '../../../config/baseDatos.php';
    session_start();
    function mostrarPDF($con, $ruta, $recibe)
    {
        if (!isset($_SESSION['id'])) {
            throw new Exception("   ");

        }
        $sql = "SELECT * FROM documentos where (id_envia ={$_SESSION['id']} and id_recibe = $recibe) or (id_envia =$recibe and id_recibe = {$_SESSION['id']}) order by id DESC";
        $stat = $con->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $cont = 0;
            foreach ($result as $key => $filas) {
                $cont++;
                if ($_SESSION['puesto'] !== 1) {
                    echo '<div class="archivos">    
                    <div class="mensaje-previo">' . $cont . '. ' . $filas['persona'] . '</div>
                    <a href="' . $ruta . $filas['nombreArchi'] . '">
                        <i class="bi bi-file-earmark-richtext" style="font-size: 6em;"></i>
                        <div class="mensaje-previo">
                        ' . $filas['nombreArchi'] . '
                        </div></a>
                    </div>';
                } else if ($_SESSION['puesto'] == 1) {
                    echo '<div class="archivos">    
                    <div class="mensaje-previo">' . $cont . '. ' . $filas['persona'] . '</div>
                    <button type="submit" name="documento_id" value="' . $filas['id'] . '">:V<i class="bi bi-trash-fill"></i></button>    
                    <a href="' . $ruta . $filas['nombreArchi'] . '">
                        <i class="bi bi-file-earmark-richtext" style="font-size: 6em;"></i>
                        <div class="mensaje-previo">
                        ' . $filas['nombreArchi'] . '
                        </div></a>
                    </div>';
                }
            }
        } else {
            echo "<div style='color: white;'>no hay documentos en la carpeta de este chat</div>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $msg = 'error, manejador de errores corriendo.';
}
