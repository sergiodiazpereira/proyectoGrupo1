<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modAsociacion.php';
    class ConAsociacion{
        public $vista;
        public $modelo;
        function __construct(){
            $this->modelo= new ModAsociacion();
        }
        public function inicio(){
            $this->vista="vistaAgregarAsociacion.php";
        }
        public function insertar(){
        
        }

        public function modificar(){
        
        }

        public function borrar(){
        
        }

        public function cargarPaginaAsoc(){
            $tipos=$this->modelo->obtenerTipos();
            
        }
    }
?>