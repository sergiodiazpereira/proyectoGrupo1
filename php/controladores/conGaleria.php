<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modGaleria.php';
    class ConGaleria{
        public $modeloGal;
        public $vista;
        function __construct(){
            $this->modeloGal = new ModGaleria();
        }

        public function cargarPagina(){
            $this->vista="admin/listarGaleria.php";
        }
    }
?>