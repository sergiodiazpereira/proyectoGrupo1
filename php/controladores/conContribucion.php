<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modContribucion.php';
    class ConContribucion{
        public $modeloC;
        public $vista;
        function __construct(){
            $this->modeloC = new ModContribucion();
        }

        public function insertar(){
        
        }

        public function obtenerContribucion(){
            $this->vista="vistaGestionContribuciones.php";
            $datos=$this->modeloC->obtenerContribuciones();
            return ['datos' => $datos];
        }
    }
?>