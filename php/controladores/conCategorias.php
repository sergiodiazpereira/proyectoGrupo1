<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modCategorias.php';
    class ConCategorias{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModCategorias();
        }

        public function cargarPagina(){
            $this->vista="admin/vistaGestionCategorias.php";
        }
    }
?>