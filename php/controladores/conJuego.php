<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modJuego.php';
    
    class ConJuego{
        private $modeloJ;
        public $vista;
        
        function __construct(){
            $this->modeloJ = new ModJuego();
        }
        /**
         * Esta funcion saca los nombres de las asociaciones de la bd
         * @return array nombre de todas las asociaciones
         */
        public function nombresDeAsociaciones(){
            $nombresAsociaciones = [];
            $datosAsociaciones = $this->modeloJ->datosAsociaciones();
            
            foreach ($datosAsociaciones as $asociacion) {
                // CORRECCIÓN IMPORTANTE: Usamos corchetes [] porque es un Array
                $nombresAsociaciones[] = $asociacion['nombre'];
            }
            return $nombresAsociaciones;
        }

        /**
         * Esta funcion sirve para darle valor al atributo vista, que será usado en el index.php para hacer el include
         */
        public function cargarPagina(){
            $this->vista="usuario/pagina_juego.php";
            return $this->nombresDeAsociaciones();
        }

        /**
         * Esta funcion envía los datos de las asociaciones de la bd mediante json
         */
        public function obtenerDatosAsociaciones(){
            // Limpiamos cualquier "basura" o Warning anterior para que el JSON salga limpio
            ob_clean(); 
            $datosAsociaciones = $this->modeloJ->datosAsociaciones();
            echo json_encode($datosAsociaciones); 
            exit;
        }

        /**
         * Esta método registra las victorias del juego mediante una llamada al modelo del juego y
         * devuelve el resutado en un json
         */
        public function registrarVictoria(){
            $resultado = $this->modeloJ->insertar();

            if ($resultado === true) {
                echo json_encode(["exito" => true]);
            } else {
                echo json_encode(["exito" => false, "error" => $resultado]);
            }

            exit;
        }

    }
?>