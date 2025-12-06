<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modColecciones.php';
    class ConColecciones{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModColecciones();
        }

        public function cargarPagina(){
            $this->vista="usuario/colecciones.php";
        }

        public function obtenerPagina(){
            $this->vista="usuario/colecciones.php";
            echo json_encode($this->vista); // Para cargar la pagina en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>