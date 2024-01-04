<?php
class Archivero
{
    public function crearCarpeta($ruta, $nombreCarpeta)
    {
        $carpeta = $ruta . $nombreCarpeta;
        if (!file_exists($carpeta)) {
            //si la carpeta no existe la creea.
            if (mkdir($carpeta, 0777, true)) {
                $respuesta = true;
            } else {
                $respuesta = "error";
            }
        } else {
            $respuesta = "la carpeta ya existe";
        }
        return $respuesta;
    }
    public function eliminarCarpeta($ruta)
    {
        // si es una carpeta valida
        if (is_dir($ruta)) {
            //cargamos los archivos de la carpeta seleccionada
            $archivos = scandir($ruta);
            foreach ($archivos as $archivo) {
                if ($archivo != '.' && $archivo != '..') {
                    $archivo_ruta = $ruta . '/' . $archivo;
                    // revisa si es una carpeta
                    if (is_dir($archivo_ruta)) {
                        // si es carpeta regresa a eliminar
                        $this->eliminarCarpeta($archivo_ruta);
                    } else {
                        // si dentro de la carpeta hay archivos se eliminan primero
                        unlink($archivo_ruta);
                    }
                }
            }
            // si la carpeta esta vacia, se elimina.
            if (rmdir($ruta)) {
                echo 'Carpeta eliminada correctamente.';
            } else {
                echo 'Error al intentar eliminar la carpeta.';
            }
        } else {
            echo 'La carpeta no existe o no es un directorio válido.';
        }
    }
    public function guardarArchivo($nombre, $archivo, $ruta)
    {
        $rutaCompleta = $ruta . '/' . $nombre;

        if (file_exists($rutaCompleta)) {
            // echo 'Error: Ya existe un archivo con el mismo nombre. Intenta con otro nombre.';
            return false;
        } else if (move_uploaded_file($archivo, $rutaCompleta)) {
            // echo 'Archivo "' . $nombre . '" guardado correctamente en ' . $ruta;
            return true;
        } else {
            // echo 'Error al guardar el archivo "' . $nombre . '" en la carpeta ' . $ruta;
            return false;
        }
    }
    public function eliminarArchivo($nombre_archivo)
    {
        if (file_exists($nombre_archivo)) {
            if (unlink($nombre_archivo)) {
                echo 'Archivo eliminado correctamente.';
                return true;
            } else {
                echo 'Error al intentar eliminar el archivo.';
                return false;
            }
        } else {
            echo 'El archivo no existe o no es válido.';
            return false;
        }
    }
}
