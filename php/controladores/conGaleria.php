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
         * Devuelve rutas completas de las imágenes según sus nombres
         * Busca también en subcarpetas de la galería
         *
         * @param string|array $nombres Uno o varios nombres de imagen
         * @return array Rutas completas de las imágenes existentes
         */
        function obtenerRutasImagenes($nombres) {
            $rutaBase = realpath(__DIR__ . '/../../src/img/galeria/'); // Carpeta base
            $rutas = [];

            if (!is_array($nombres)) {
                $nombres = [$nombres]; // Convertir a array si es un solo string
            }

            $directory = new RecursiveDirectoryIterator($rutaBase); // Recorre carpetas
            $iterator = new RecursiveIteratorIterator($directory); // Recorre carpetas de forma recursiva

            foreach ($iterator as $archivo) {
                if ($archivo->isFile()) {
                    $nombreArchivo = $archivo->getFilename();
                    if (in_array($nombreArchivo, $nombres)) {
                        $rutas[] = $archivo->getRealPath();
                    }
                }
            }

            return $rutas;
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





        public function borrarImagen(){
            try{
                $respuestaBD = $this->modeloGal->borrarImagenBD();
                if (!$respuestaBD) {
                    throw new Exception (" no se ha podido borrar la imagen de la base de datos");
                }

                $ruta = $this->obtenerRutasImagenes($_POST["nombreImagen"]);
                $respuesta = $this->borrarImagenCarpeta($ruta);
                if(!$respuesta){
                    throw new Exception (" no se ha podido borrar la imagen de la carpeta de servidor");
                }
                
                echo json_encode(['imagenBorrada' => true]);
                $datos = "La imagen se ha borrado correctamente";
                $this->vista = "admin/mensajeCorrectoGaleria.php";
                return $datos;

            }catch (Exception $e){
                echo json_encode(['imagenBorrada' => false]);
                $datos = "Error, ".$e->getMessage();
                $this->vista = "admin/mensajeIncorrectoGaleria.php";
                return $datos;
            }
        }





        public function borrarImagenCarpeta($archivo){
            if (unlink($archivo)) {
                return true;
            } else {
                return false;
            }
        }

    }
?>