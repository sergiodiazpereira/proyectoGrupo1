<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modContribucion.php';

    class ConContribucion{

        private $modeloCont;
        public $vista;

        public function __construct() {
            $this->modeloCont = new ModContribucion();
        }

        /**
         * Lista todas las contribuciones.
         * 
         * @return array Lista de contribuciones.
         */
        public function listar(){
            // Obtenemos los datos de la BD
            $datos['contribuciones'] = $this->modeloCont->listar();

            // Indicamos la vista
            $this->vista = "vistaGestionContribuciones.php";

            // Retornamos el array de datos
            return $datos;
        }
        
        /**
         * Muestra el formulario de inserción.
         * 
         */
        public function insertar(){
            
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
            $this->vista="vistaGesionContribuciones.php";
            
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
            // Actualizamos los datos en la base de datos
            $this->modeloCont->modificar();

            // Redirigimos a la lista de contribuciones
            header('Location: index.php?c=Contribucion&m=listar');
            exit;
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
            $this->vista="vistaBorrarContribucion.php";

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