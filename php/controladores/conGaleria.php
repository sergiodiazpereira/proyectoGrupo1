<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modGaleria.php';
    class ConGaleria{
        public $modeloGal;
        public $vista;
        function __construct(){
            $this->modeloGal = new ModGaleria();
        }

        /**
         * Esta funcion carga la ruta de la vista al atributo de la clase
         */
        public function cargarPagina(){
            $this->vista="admin/listarGaleria.php";
            $datos = $this->modeloGal->datosAsociaciones();
            return $datos;
        }





        /**
         * Esta funcion obtiene los datos de la galería de la BD y los envia por JSON al navegador
         */
        public function obtenerDatosImagenes(){ 
            $datosImagenes = $this->modeloGal->datosImagenes();
            echo json_encode($datosImagenes); 
            exit;
        }





        /**
         * Devuelve la ruta completa de una imagen según su nombres
         * Busca también en subcarpetas de la galería
         *
         * @param string $nombreImagen El nombres de la imagen la cual queremos obtener ruta
         * @return string Ruta completa de la imagen existentes
         */
        private function obtenerRutaImagen($nombreImagen){
            $rutaBase = realpath(__DIR__ . '/../../src/img/galeria/');
            if ($rutaBase === false) {
                return null;
            }

            $directory = new RecursiveDirectoryIterator($rutaBase, RecursiveDirectoryIterator::SKIP_DOTS); // Lo uso para hacer busquedas recursivas de archivos dentro de la carpeta galeria
            $iterator = new RecursiveIteratorIterator($directory);

            foreach ($iterator as $archivo) {
                if ($archivo->isFile() && $archivo->getFilename() === $nombreImagen) {
                    return $archivo->getRealPath();
                }
            }

            return false;
        }







        /**
         * Esta funcion inserta la imagen pasando por todas las validaciones posibles para una correcta insercción
         * @return array La funcion devuevle los datos necesarios para cargar la vista necesaria
         */
        public function insertarImagen(){
            try{
                // ============================================== VERIFICACION DE ARCHIVO ENVIADO ========================================== //
                if ($_FILES['archivo']['error'] == UPLOAD_ERR_NO_FILE) { // Entra en el "if" si el error del archivo es el de que no hay archivo
                    throw new Exception("no has subido ninguna imagen");
                }
                // ========================================================================================================================== //
                // =============================================== VERIFICACION DE HASH REPETIDO =========================================== //
                $hashNuevo = md5_file($_FILES["archivo"]["tmp_name"]); // Obtiene el hash del archivo subido a una carpeta temporal
                $repetido = $this->buscarHashRepetido($hashNuevo);
                if ($repetido) {
                    throw new Exception("esa imagen ya está subida");
                } 
                // ========================================================================================================================== //
                // ========================================== INSERCCIÓN DEL ARCHIVO EN LA BASE DE DATOS ==================================== //
                $resultado = $this->modeloGal->insertarImagenEnBD();
                if ($resultado == 1062) {
                    throw new Exception("ya hay un archivo con ese nombre");
                }
                // ========================================================================================================================== //
                // ====================================== INSERCCIÓN DEL ARCHIVO EN LA CARPETA DEL SERVIDOR ================================= //
                $insertada = $this->insertarImagenEnCarpeta();
                if (!$insertada){
                   throw new Exception("la imagen no se ha subido correctamente"); 
                }
                // ========================================================================================================================== //
                $datos = "Imagen subida correctamente a la galería.";
                $this->vista = "admin/mensajeCorrectoGaleria.php";
                return $datos;
            } catch (Exception $e){
                $datos = "Error, ".$e->getMessage();
                $this->vista = "admin/mensajeIncorrectoGaleria.php";
                return $datos;
            }

            
        }




        /**
         * Esta funcion escanea los archivos de la carpeta "galeria" y sus subcarpetas buscando un archivo con hash idéntico al que se le pase por parámetros
         * @param string Es el hash que la funcion buscará en las carpetas
         * @return boolean Retorna si está repetido (true) o no (false)
         */
        private function buscarHashRepetido($hashNuevo, $carpeta = null) {
            // Si no se pasa carpeta, se usa la carpeta galeria
            if ($carpeta == null) {
                $carpeta = realpath(__DIR__ . "/../../src/img/galeria") . DIRECTORY_SEPARATOR; // Directory separator lo pongo porque la funcion realpath borra la "/" del final de la ruta asi que la pongo con directory separator
            }

            $archivos = scandir($carpeta);
            foreach ($archivos as $archivo) {
                if ($archivo != '.' && $archivo != '..'){ // Evitamos los archivos "." y ".." que vienen por defecto al hacer scandir()
                    $ruta = $carpeta . $archivo;

                    if (is_file($ruta)) {
                        $hashExistente = md5_file($ruta);
                        if ($hashExistente == $hashNuevo) {
                            return true;
                        }
                    } elseif (is_dir($ruta)) { // Si es carpeta, volvemos a hacer toda esta funcion para escanear los archivos interiores
                        if ($this->buscarHashRepetido($hashNuevo, $ruta . DIRECTORY_SEPARATOR)) {
                            return true;
                        }
                    }
                }
            }

            return false; // No se encontró
        }




        /**
         * Esta funcion guarda la imagen en la carpeta del servidor
         * @return boolean Retorna si ha sido guardado en la ruta o ha habido algun error
         */
        private function insertarImagenEnCarpeta(){
            $nombreArchivo = $_FILES['archivo']['name'];       // Nombre de la imagen
            $rutaTemporal  = $_FILES['archivo']['tmp_name'];   // Ruta temporal de la imagen al ser subida

            // Ruta final donde se guardará
            $rutaFinal = realpath(__DIR__ . "/../../src/img/galeria") . DIRECTORY_SEPARATOR . $nombreArchivo; // Ensamblo la ruta donde se va a guardar la imagen

            // Muevo el archivo de la carpeta temporal a mi carpeta destino. El "if" es para comprobar si se ha movido correctamente o no 
            if (move_uploaded_file($rutaTemporal, $rutaFinal)) {
                return true;
            } else {
                return false;
            }
        }




        /**
         * Este metodo se encarga de borrar la imagen tanto de la base de datos como de la carpeta de imagenes del servidor donde esté
         */
        public function borrarImagen(){
            try{
                $respuestaBD = $this->modeloGal->borrarImagenBD();
                if (!$respuestaBD) {
                    throw new Exception (" no se ha podido borrar la imagen de la base de datos");
                }

                $ruta = $this->obtenerRutaImagen($_POST["nombreImagen"]);
                if (!$ruta) {
                    throw new Exception(" no se encontró la imagen en el servidor");
                }

                $respuesta = $this->borrarImagenCarpeta($ruta);
                if(!$respuesta){
                    throw new Exception (" no se ha podido borrar la imagen de la carpeta de servidor");
                }
                echo json_encode(['imagenBorrada' => true, "mensaje" => "La imagen se ha borrado correctamente"]);
                exit;

            }catch (Exception $e){
                echo json_encode(['imagenBorrada' => false, "mensaje" => $e->getMessage()]);
                exit;
            }
        }




        /**
         * Este método borra la imagen de la ruta que se le pasa
         * @param string Es la ruta que el método se encargará de borrar
         */
        public function borrarImagenCarpeta($archivo){
            if (unlink($archivo)) {
                return true;
            } else {
                return false;
            }
        }





        public function vincularImagen(){
            try{
                $respuestaBD = $this->modeloGal->vincularImagenBD();
                if (!$respuestaBD) {
                    throw new Exception (" no se ha podido vincular la imagen de la base de datos");
                }

                $ruta = $this->obtenerRutaImagen($_POST["nombreImagen"]);
                if (!$ruta) {
                    throw new Exception(" no se encontró la imagen en el servidor");
                }
                $datoAsociacion = $this->modeloGal->obtenerNombrePorId();
                if (empty($datoAsociacion)) {
                    throw new Exception("No se encontró la asociación con el id proporcionado.");
                } else {
                    if (!isset($datoAsociacion['nombre'])) {
                        throw new Exception("No se encontró el nombre de la asociación.");
                    }
                    $respuesta = $this->moverImagenCarpeta($ruta, $datoAsociacion["nombre"]);
                    if(!$respuesta){
                        throw new Exception (" no se ha podido mover la imagen de la carpeta de servidor");
                    }
                echo json_encode(['imagenVinculada' => true, "mensaje" => "La imagen se ha movido correctamente"]);
                exit;
                }

            }catch (Exception $e){
                echo json_encode(['imagenVinculada' => false, "mensaje" => $e->getMessage()]);
                exit;
            }
        }





        public function moverImagenCarpeta($archivo, $nombreAsociacion){
            $carpetaDestino = $nombreAsociacion;
            $nombreArchivo = basename($archivo); // Obtenemos nombre del archivo

            $rutaDestino = realpath(__DIR__ . '/../../src/img/galeria/' . $carpetaDestino); // Formamos la ruta de destino donde queremos mover la imagen

            // Verificamos si el archivo ya existe en la carpeta destino
            if (file_exists($rutaDestino . DIRECTORY_SEPARATOR . $nombreArchivo)) {
                return true;  // No continuamos ejecutando el método porque ya existe en la carpeta destino
            }

            // Si no existe
            $movido = rename($archivo, $rutaDestino . DIRECTORY_SEPARATOR . $nombreArchivo); // Lo movemos
            
            if ($movido) {
                return true;  // Si se mueve correctamente, retornar true
            } else {
                return false;  // Si no se movió, retornar false
            }
        }





        public function desvincularImagen(){
            try{
                $respuestaBD = $this->modeloGal->desvincularImagenBD();
                if (!$respuestaBD) {
                    throw new Exception (" no se ha podido vincular la imagen de la base de datos");
                }

                $ruta = $this->obtenerRutaImagen($_POST["nombreImagen"]);
                if (!$ruta) {
                    throw new Exception(" no se encontró la imagen en el servidor");
                }
                $respuesta = $this->sacarImagenCarpeta($ruta, $_POST["nombreImagen"]);
                if(!$respuesta){
                    throw new Exception (" no se ha podido mover la imagen de la carpeta de servidor");
                }
                echo json_encode(['imagenDesvinculada' => true, "mensaje" => "La imagen se ha movido correctamente"]);
                exit;

            }catch (Exception $e){
                echo json_encode(['imagenDesvinculada' => false, "mensaje" => $e->getMessage()]);
                exit;
            }
        }





        public function sacarImagenCarpeta($ruta, $nombreArchivo){
            // Obtener la ruta del directorio padre
            $directorioDestino = dirname(dirname($archivo));  // Subimos dos niveles
            $rutaDestinoFinal = $directorioDestino . DIRECTORY_SEPARATOR . $nombreArchivo; // Creamos la ruta destino completa

            // Verificamos si el archivo ya existe en el destino
            if (file_exists($rutaDestinoFinal)) {
                return true;  // El archivo ya existe en el directorio destino asi que no seguimos ejecutando
            }

            // Mover el archivo
            $movido = rename($archivo, $rutaDestinoFinal);

            // Verificar si el archivo fue movido correctamente
            if ($movido) {
                return true;
            } else {
                return false;
            }
        }





        public function obtenerNombreAsociacionPorId(){
            try{
                $respuestaBD = $this->modeloGal->obtenerNombrePorId();
                if (!$respuestaBD) {
                    throw new Exception (" no se ha obtenido nada de la BD");
                }

                echo json_encode($respuestaBD);
                exit;
            }catch (Exception $e){
                echo json_encode($e->getMessage());
                exit;
            }
        }
    }
?>