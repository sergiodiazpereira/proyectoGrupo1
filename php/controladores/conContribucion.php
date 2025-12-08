<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modContribucion.php';
    require_once __DIR__.'/../'.MODELO.'modAsociacion.php';

    /**
     * Este es el controlador de las contribuciones
     */
    class ConContribucion {
        private $modeloCont;
        private $modeloAsoc;
        public $vista;

        public function __construct() {
            $this->modeloCont = new ModContribucion();
            $this->modeloAsoc = new ModAsociacion();
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
         * Summary of validaciones
         * @return bool esta funcion valida que la contribucion no esta vacia o contenga numeros
         */
        public function validacionArray(){

            foreach ($_POST['descripcion'] as $id => $desc) {

                if (empty($desc)) {
                    return false;
                }

                if (preg_match('/[0-9]/', $desc)) {
                    return false;
                }

            }
            return true;
        }

        /**
         * Lista todas las contribuciones.
         * 
         * @return array Lista de contribuciones.
         */
        public function listar(){
            // Obtenemos los datos de la BD
            $datos['contribucion'] = $this->modeloCont->listar();

            // Indicamos la vista
            $this->vista = "admin/vistaGestionContribuciones.php";

            // Retornamos el array de datos
            return $datos;
        }

        /**
         * Carga el formulario de modificación de una contribución.
         *
         * Recoge:
         *  - GET['idContribucion']
         * 
         * @return array Datos de la contribución.
         */
        public function modificar(){
            // Obtenemos los datos a modificar
            $datos = $this->modeloCont->obtenerPorId();

            // Indicamos la vista
            $this->vista="admin/vistaGesionContribuciones.php";
            
            // Retornamos el array de datos
            return $datos;
        }

        /**
         * Procesa la modificación de una contribución.
         * 
         * Recoge:
         *  - POST['descripcion'][id] = nuevo texto
         */
        public function procesarModificar(){

            if(!$this->validacionArray()){
                $this->vista="admin/mensajeIncorrecto.php";
                return "Alguna contribución es incorrecta";
            } else {
                // Actualizamos los datos en la base de datos
                $this->modeloCont->modificar();

                $this->vista="admin/mensajeCorrecto.php";
                return "Contribuciones actualizadas";
            }
            
        }

        /**
         * Summary of insertar
         * @return string esta funcion inserta las contribuciones en su tabla
         */
        public function insertar(){
            if(!$this->validaciones()){
                $this->vista="admin/mensajeIncorrecto.php";
                return "Contribucion vacia o la contribucion tiene algun número";
            }else{
                if($this->modeloCont->insertar()){
                    
                    $this->vista="admin/mensajeCorrecto.php";
                    return "Constribucion guardada con exito";

                }else{
                    $this->vista="admin/mensajeIncorrecto.php";
                    return "Fallo al guardar la contribucion";
                };
            };
        }
        
        /**
         * Summary of obtenerContribucion
         * @return bool|PDOStatement esta funcion llama al modelo para que le devuelva las contribuciones
         */
        public function obtenerContribucion(){
            $this->vista="admin/vistaGestionContribuciones.php";
            $datos=$this->modeloCont->obtenerContribuciones();
            return  $datos;
        }

        /**
         * Muestra la vista para confirmar eliminación.
         * 
         * Recoge:
         *  - GET['idContribucion']
         * 
         * @return array Datos de la contribución.
         */
        public function borrar(){
            // Obtenemos los datos de la contribución
            $datos = $this->modeloCont->obtenerPorId();

            // Establecemos la vista
            $this->vista="admin/vistaBorrarContribucion.php";

            // Devolvemos el array de datos
            return $datos;
        }

        /**
         * Procesa el borrado de la contribución.
         * 
         * Recoge:
         *  - GET['idContribucion']
         */
        public function procesarBorrar(){
            // Eliminamos la contribución
            $this->modeloCont->borrar();
        
            // Redirigimos a la lista de contribuciones
            header('Location: index.php?c=Contribucion&m=listar');
            exit;
        }
        
    }
?>