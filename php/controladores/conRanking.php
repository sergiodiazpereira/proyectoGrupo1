<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modRanking.php';
    class ConRanking{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModRanking();
        }
        /**
         * Summary of cargarPagina
         * @return void carga la pagina ranking
         */
        public function cargarPagina(){
            $this->vista="usuario/ranking.php";
        }
        /**
         * Summary of obtenerRanking
         * @return never devuelve los datos para cargar el ranking en el juego
         */
        public function obtenerRanking(){
            $datos= $this->modeloJ->sacarRanking();
            echo json_encode($datos);
            exit;
        }
    }
?>