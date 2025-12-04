<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modContribucion.php';
    class ConContribucion{
        public $modeloC;
        public $vista;
        function __construct(){
            $this->modeloC = new ModContribucion();
        }
        public function vistaCargar(){
            $this->vista="vistaAgregarContribucion.html";
        }
        public function insertar(){
            /**Verifico que la cadena no esta vacia ,le quito los espacios y compruebo que no tenga numeros */
            if(empty(trim($_POST["contribucion"]) || preg_match('/[0-9]/', $_POST["contribucion"]))){
                $this->vista="mensajeError.php";
                return "Contribucion vacia o la contribucion tiene algun número";
            }else{
                if($this->modeloC->insertar()){
                    
                    $this->vista="mensajeError.php";
                    return "Constribucion guardada con exito";

                };
            }
        }

        public function obtenerContribucion(){
            $this->vista="vistaGestionContribuciones.php";
            $datos=$this->modeloC->obtenerContribuciones();
            return  $datos;
        }
    }
?>