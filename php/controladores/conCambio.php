<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modCambio.php';
    class ConCambio{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModCambio();
        }

        public function cargarPagina(){
            $this->vista="usuario/cambio.php";
        }

        public function obtenerPagina(){
            $this->vista="usuario/cambio.php";
            echo json_encode($this->vista); // Para cargar la pagina en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>