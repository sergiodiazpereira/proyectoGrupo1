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
         * Esta funcion convierte los nombres de las imagenes a rutas
         * 
         * @param array Este parametro son los datos de todas las imagenes
         * @return array La funcion devuelve los datos de las imagenes con el nombre pasado a URL
         */
        private function convertirNombresARutas($imagenes){
            $nuevosDatos = [];

            foreach ($imagenes as $imagen) {
                $nuevoItem = $imagen;
                $nuevoItem["url"] = $imagen["nombreImagen"];
                unset($nuevoItem["nombre"]);
                $nuevoItem["url"] = realpath(__DIR__ . '/../../src/img/galeria/' . $nuevoItem["url"]);
                $nuevosDatos[] = $nuevoItem;
            }

            return $nuevosDatos;
        }




        /**
         * Esta funcion inserta la imagen pasando por todas las validaciones posibles para una correcta insercción
         * @return array La funcion devuevle los datos necesarios para cargar la vista necesaria
         */
        public function insertarImagen(){
            try{

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
                $datos = "bien?";
                $this->vista = "admin/mensajeIncorrectoGaleria.php";
                return $datos;
                // ========================================================================================================================== //
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

    }
?>