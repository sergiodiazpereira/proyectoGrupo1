<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modJuego.php';
    
    class ConJuego{
        public $modeloJ;
        public $vista;
        
        function __construct(){
            $this->modeloJ = new ModJuego();
        }

        public function nombresDeAsociaciones(){
            $nombresAsociaciones = [];
            $datosAsociaciones = $this->modeloJ->datosAsociaciones();
            
            foreach ($datosAsociaciones as $asociacion) {
                // CORRECCIÓN IMPORTANTE: Usamos corchetes [] porque es un Array
                $nombresAsociaciones[] = $asociacion['nombre'];
            }
            return $nombresAsociaciones;
        }

        public function cargarPagina(){
            $this->vista="usuario/pagina_juego.php";
            return $this->nombresDeAsociaciones();
        }

        public function obtenerPagina(){
            $this->vista="usuario/pagina_juego.php";
            echo json_encode($this->vista); 
            exit;
        }

        public function obtenerDatosAsociaciones(){
            // Limpiamos cualquier "basura" o Warning anterior para que el JSON salga limpio
            ob_clean(); 
            $datosAsociaciones = $this->modeloJ->datosAsociaciones();
            echo json_encode($datosAsociaciones); 
            exit;
        }
    }
?>