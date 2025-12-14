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
        /**
         * Summary of borrar
         * @return string esta funcion borra el usuario indicado con el id 
         */
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
        /**
         * Summary of cargarPagina
         * @return array carga la pagina con los usuarios en la lista
         */
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