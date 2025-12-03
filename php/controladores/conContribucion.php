<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modContribucion.php';

    class ConContribucion{
        public $vista;
        
        public function insertar(){
            $this->vista="vistaGesionContribuciones.php";
        }

        public function modificar(){
            $this->vista="vistaGesionContribuciones.php";
        }

        public function borrar(){
            $idContribucion = $_POST['idContribucion'];
            $this->modelo->borrar($idContribucion);

            $this->vista="vistaGesionContribuciones.php";

            return true;
        }

        public function listar(){
            $this->vista="vistaGesionContribuciones.php";
        }
    }
?>