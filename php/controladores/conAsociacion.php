<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modAsociacion.php';
    require_once __DIR__.'/../modelos/modContribucion.php';
    class ConAsociacion{
        public $vista;
        public $modeloA;
        public $modeloC;
        function __construct(){
            $this->modeloA= new ModAsociacion();
            $this->modeloC= new ModContribucion();
            
            
        }
        public function inicio(){

            $this->vista="vistaAgregarAsociacion.php";

        }
        public function validaciones(){

            /*Compruebo si esta vacio y le quito los espacios*/
            if(empty(trim($_POST["nombre"]))){ return false; };

            /*Compruebo si esta vacio , le quito los espacios y controlo el rango del año*/
            $anio = (int) trim($_POST["anio"]);
            if($anio < 1800 || $anio > date('Y')) { return false; }

            /*Compruebo que el logo esta cargado y que no devuelve error*/
            /* Compruebo que el tipo de archivo sea correcto*/
            $tipos = ['image/jpeg','image/png','image/webp'];

            /*comprobamos si el tipo de dato esta dentro de los que se pueden cargar*/
            if (!in_array($_FILES["logo"]['type'], $tipos)) {return false;}

            if(!isset($_FILES["logo"]) || $_FILES["logo"]["error"] !== UPLOAD_ERR_OK){ return false; };

            /*Estas son las pistas y compruebo que no esten vacias y le quito los espacios*/
            if(empty(trim($_POST["pistaD"]))){ return false; };
            if(empty(trim($_POST["pistaM"]))){ return false; };
            if(empty(trim($_POST["pistaF"]))){ return false; };

            /*Compruebo que el array tenga algo dentro*/
            if(empty($_POST["contribucion"]) || !is_array($_POST["contribucion"])){ return false; }

            return true;

        }
        public function insertar(){

            if($this->validaciones()){

                if($this->modeloA->insertar()){

                    if($this->guardarImg()){
                        $this->vista="mensajeError.php";
                        return "insercion exitosa";
                    }else{
                        $this->vista="mensajeError.php";
                        return "Fallo al insertar la imagen";
                    };
                    
                }else{
                    $this->vista="mensajeError.php";
                    return "No inserta";
                };
            }else{
                $this->vista="mensajeError.php";
                return "No valida";
            };
        
        }

        public function modificar(){
        
        }

        public function borrar(){
        
        }

        private function guardarImg(){
            $destino = RUTAIMG . $_FILES["logo"]['name'];
            if(!move_uploaded_file($_FILES["logo"]['tmp_name'], $destino)){
                return false;
            }else{
                return true;
            };
        }
        public function cargarPaginaAsoc(){
            $tipos=$this->modeloA->obtenerTipos();
            $contribuciones=$this->modeloC->obtenerContribuciones();

            $arrayAsoc=[
                "tiposAsoc" => $tipos,
                "contribuciones" => $contribuciones
            ];
            
            $this->vista="vistaAgregarAsociacion.php";
            return $arrayAsoc;
        }
    }
?>