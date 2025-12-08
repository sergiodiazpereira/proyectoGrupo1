<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modCambioAdmin.php';
    class ConCambioAdmin{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModCambioAdmin();
        }

        public function cargarPagina(){
            $this->vista="admin/cambioAdmin.php";
        }
    }
?>