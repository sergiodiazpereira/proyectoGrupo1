<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'/modUsuarios.php';

    class ConUsuarios{
        public $modeloU;
        public $vista;

        function __construct(){
            $this->modeloU = new ModUsuarios();
        }

        public function cargarPagina(){
            // Obtenemos los datos
            $datos = $this->modeloU->listar();

            // Indicamos la vista
            $this->vista = "admin/listarUsuarios.php";

            // Retornamos los datos
            return $datos;
        }
    }
?>