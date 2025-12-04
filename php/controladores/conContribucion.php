<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modContribucion.php';

    class ConContribucion{

        private $modelo;
        public $vista;

        public function __construct() {
            $this->modelo = new ModContribucion();
        }

        public function listar(){
            $this->vista="vistaGestionContribuciones.php";
        }
        
        public function insertar(){
            
        }

        public function modificar(){
            $datos = $this->modelo->obtenerPorId();

            $this->vista="vistaGesionContribuciones.php";
            
            return $datos;
        }

        public function procesarModificar(){
            $this->modelo->actualizar();

            header('Location: index.php');
            exit;
        }

        public function borrar(){
            $datos = $this->modelo->obtenerPorId();

            $this->vista="vistaGesionContribuciones.php";

            return $datos;
        }

        public function procesarBorrar(){
            $this->modelo->borrar();
        
            header('Location: index.php');
            exit;
        }
        
    }
?>