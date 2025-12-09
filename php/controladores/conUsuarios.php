<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modUsuarios.php';
    class ConUsuarios{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModUsuarios();
        }

        public function cargarPagina(){
            $superadmin = true;                     // Controla si se mostrará la vista de admin o superadmin
            if ($superadmin) {
                $this->vista="admin/listarUsuarios.php";
            } else {
                $this->vista="admin/listarUsuariosAdmin.php";
            }
        }
    }
?>