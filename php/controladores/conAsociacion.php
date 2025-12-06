<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modAsociacion.php';
    class ConAsociacion{
        public $vista;
        public function insertar(){
        
        }

        public function modificar(){
        
        }

        public function borrar(){
        
        }

        public function listar(){
            $this->vista="listarAsociaciones.php";
        }
    }
?>