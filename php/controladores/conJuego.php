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
                $nombresAsociaciones[] = $asociacion->nombre;
            }
            return $nombresAsociaciones;
        }
        public function cargarPagina(){
            $this->vista="usuario/pagina_juego.php";
            return $this->nombresDeAsociaciones();
        }
        public function obtenerPagina(){
            $this->vista="usuario/pagina_juego.php";
            echo json_encode($this->vista); // Para cargar pagina_juego en javascript y poder controlarlo con el app.js
            exit;
        }
        public function obtenerDatosAsociaciones(){
            $datosAsociaciones = $this->modeloJ->datosAsociaciones();
            echo json_encode($datosAsociaciones); // Para cargar los datos de las asociaciones en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>