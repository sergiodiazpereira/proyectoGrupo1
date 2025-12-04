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
            $datos['contribuciones'] = $this->modelo->listar();

            $this->vista = "vistaGestionContribuciones.php";

            return $datos;
        }
        
        public function insertar(){
            
        }

        public function modificar(){
            $datos = $this->modelo->obtenerPorId();

            $this->vista="vistaGesionContribuciones.php";
            
            return $datos;
        }

        public function procesarModificar(){
            $this->modelo->modificar();

            header('Location: index.php?c=Contribucion&m=listar');
            exit;
        }

        public function borrar(){
            $datos = $this->modelo->obtenerPorId();

            $this->vista="vistaBorrarContribucion.php";

            return $datos;
        }

        public function procesarBorrar(){
            $this->modelo->borrar();
        
            header('Location: index.php?c=Contribucion&m=listar');
            exit;
        }
        
    }
?>