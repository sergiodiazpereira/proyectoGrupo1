<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modContribucion.php';
    /**
     * Este es el controlador de las contribuciones
     */
    class ConContribucion{
        public $modeloC;
        public $vista;
        function __construct(){
            $this->modeloC = new ModContribucion();
        }
        public function vistaCargar(){
            $this->vista="vistaAgregarContribucion.html";
        }
        /**
         * Summary of validaciones
         * @return bool esta funcion valida que la contribucion no esta vacia o contenga numeros
         */
        public function validaciones(){
            $contribucion = trim($_POST["contribucion"]);

            if (empty($contribucion)) {
                return false;
            }

            if (preg_match('/[0-9]/', $contribucion)) {
                return false;
            }
            return true;
        }
        /**
         * Summary of insertar
         * @return string esta funcion inserta las contribuciones en su tabla
         */
        public function insertar(){
            if(!$this->validaciones()){
                $this->vista="mensajeIncorrecto.php";
                return "Contribucion vacia o la contribucion tiene algun número";
            }else{
                if($this->modeloC->insertar()){
                    
                    $this->vista="mensajeCorrecto.php";
                    return "Constribucion guardada con exito";

                }else{
                    $this->vista="mensajeIncorrecto.php";
                    return "Fallo al guardar la contribucion";
                };
            };
        }
        /**
         * Summary of obtenerContribucion
         * @return bool|PDOStatement esta funcion llama al modelo para que le devuelva las contribuciones
         */
        public function obtenerContribucion(){
            $this->vista="vistaGestionContribuciones.php";
            $datos=$this->modeloC->obtenerContribuciones();
            return  $datos;
        }
    }
?>