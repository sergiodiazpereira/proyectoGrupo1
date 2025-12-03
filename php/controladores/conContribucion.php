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
            $fila = $this->modelo->borrar($idContribucion);

            $datos = [
                'idProfesor' => $fila['idContribucion'],
                'descipcion' => $fila['descripcion']
            ];

            $this->vista="vistaGesionContribuciones.php";

            return $datos;
        }

        public function listar(){
            $this->vista="vistaGesionContribuciones.php";
        }
    }
?>