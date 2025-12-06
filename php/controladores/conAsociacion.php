<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modAsociacion.php';
    require_once __DIR__.'/../modelos/modContribucion.php';
    /**
     * Este es el controlador de las asociaciones
     */
    class ConAsociacion{
        /**
         * @var $vista cargara la vista necesaria que se incluira en el index.php
         * @var $modeloA este objeto sera instanciado del modAsociacion
         * @var $modeloC este objeto sera instanciado del moContribucion
         */
        public $vista;
        public $modeloA;
        public $modeloC;
        function __construct(){
            $this->modeloA= new ModAsociacion();
            $this->modeloC= new ModContribucion();
        }
        public function inicio(){
            $this->vista="vistaGestionContribuciones.php";
        }
        /**
         * Summary of validaciones
         * @return bool funcion llamada por la funcion insertar que retornara verdadero si todas las 
         * validaciones son correctas y falso si alguna falla 
         */
        private function validaciones(){

            /*Compruebo si esta vacio y le quito los espacios*/
            if(empty(trim($_POST["nombre"]))){ return false; };

            /*Compruebo si esta vacio , le quito los espacios y controlo el rango del año*/
            $anio = trim($_POST["anio"]);
            if($anio < 1800 || $anio > date('Y')) { return false; }

            /*Compruebo que el logo esta cargado y que no devuelve error*/
            /* Compruebo que el tipo de archivo sea correcto*/
            $tipos = ['image/jpeg','image/png','image/webp'];

            /*comprobamos si el tipo de dato esta dentro de los que se pueden cargar*/
            if (!in_array($_FILES["logo"]['type'], $tipos)) {return false;}

            if(!isset($_FILES["logo"]) || $_FILES["logo"]["error"] !== 0){ return false; };

            /*Estas son las pistas y compruebo que no esten vacias y le quito los espacios*/
            if(empty(trim($_POST["pistaD"]))){ return false; };
            if(empty(trim($_POST["pistaM"]))){ return false; };
            if(empty(trim($_POST["pistaF"]))){ return false; };

            /*Compruebo que el array tenga algo dentro*/
            if(empty($_POST["contribucion"]) || !is_array($_POST["contribucion"])){ return false; }

            return true;

        }
        /**
         * Summary of insertar
         * @return string esta funcion insertara los datos recogidos en la base de datos y devolvera un 
         * en funcion de si ha ido todo bien o fallo algo dependiendo del error
         */
        public function insertar(){

            if($this->validaciones()){

                if($this->guardarImg()){

                    if($this->modeloA->insertar()){

                        $this->vista="mensajeCorrecto.php";
                        return "Insercion exitosa";
                    }else{
                        $rutaImagen = RUTAIMG.$_FILES["logo"]['name'];
                        if(file_exists($rutaImagen)){

                            if(unlink($rutaImagen)){

                                $this->vista="mensajeIncorrecto.php";
                                return "Fallo al insertar los datos";
                            }else{
                                $this->vista="mensajeIncorrecto.php";
                                return "Fallo en la insercion y no se pudo borrar la imagen";
                            }

                        }else{
                            $this->vista="mensajeIncorrecto.php";
                            return "Imagen no encontrada";
                        }
                    }
                }else{
                    $this->vista="mensajeIncorrecto.php";
                    return "Fallo al guardar la imagen";
                }
            }else{

                $this->vista="mensajeIncorrecto.php";
                return "Datos no validos";
            };
        }
        /**
         * Summary of guardarImg
         * @return bool esta funcion guardara una imagen que se asociara a una asociacion
         * y devolvera verdadero o falso dependiendo de si se completa exitosamente o no
         */
        private function guardarImg(){
            $destino = RUTAIMG . $_FILES["logo"]['name'];
            if(!move_uploaded_file($_FILES["logo"]['tmp_name'], $destino)){
                return false;
            }else{
                return true;
            };
        }
        /**
         * Summary of cargarPaginaAsoc
         * @return array{contribuciones: bool|PDOStatement, tiposAsoc: bool|PDOStatement} esta funcion retornara un array
         * que cargara la vista que dejaremos guardada en $this->vista
         */
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