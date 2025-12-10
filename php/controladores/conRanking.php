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
        
        public function obtenerRanking(){
            $datos= $this->modeloJ->sacarRanking();
            echo json_encode($datos);
            exit;
        }
    }
?>