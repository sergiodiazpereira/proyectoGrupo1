<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'/modUsuarios.php';

    class ConUsuarios{
        public $modeloU;
        public $vista;
        public $idUsuarioBor;
        function __construct(){
            $this->modeloU = new ModUsuarios();

        }
        public function borrar(){
            $idUsuarioBor =$_GET['idUsuario'];
            if($this->modeloU->borrarUsu($idUsuarioBor)){
                $this->vista="admin/mensajeCorrecto.php";
                return "Borrado con exito";
            }else{
                $this->vista="admin/mensajeIncorrecto.php";
                return "Algo fallo al borrar";
            };

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