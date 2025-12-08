<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modDashboard.php';
    class ConDashboard{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModDashboard();
        }

        public function cargarPagina(){
            $this->vista="admin/dashboard.php";
        }
    }
?>