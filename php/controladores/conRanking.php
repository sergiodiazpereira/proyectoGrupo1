<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modRanking.php';
    class ConRanking{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModRanking();
        }

        public function cargarPagina(){
            $this->vista="usuario/ranking.php";
        }

        public function obtenerPagina(){
            $this->vista="usuario/ranking.php";
            echo json_encode($this->vista); // Para cargar la pagina en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>