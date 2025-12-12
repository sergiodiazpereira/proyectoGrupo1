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
    }
?>