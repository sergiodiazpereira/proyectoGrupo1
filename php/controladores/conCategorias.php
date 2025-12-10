<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modCategorias.php';
    class ConCategorias{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloCat = new ModCategorias();
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
         * Lista todas las categorias.
         * 
         * @return array Lista de categorias.
         */
        public function listar(){
            // Obtenemos los datos de la BD
            $datos['categoria'] = $this->modeloCat->listar();

            // Indicamos la vista
            $this->vista = "admin/vistaGestionCategorias.php";

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
            $datos = $this->modeloCat->obtenerPorId();

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
                return "Alguna contribución está vacia o tiene algún número";
            } else {
                // Actualizamos los datos en la base de datos
                $this->modeloCat->modificar();

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
                return "Contribución vacia o la contribución tiene algun número";
            }else{
                if($this->modeloCat->insertar()){
                    
                    $this->vista="admin/mensajeCorrecto.php";
                    return "Constribución guardada con exito";

                }else{
                    $this->vista="admin/mensajeIncorrecto.php";
                    return "Fallo al guardar la contribución";
                };
            };
        }
        
        /**
         * Summary of obtenerContribucion
         * @return bool|PDOStatement esta funcion llama al modelo para que le devuelva las contribuciones
         */
        public function obtenerContribucion(){
            $this->vista="admin/vistaGestionContribuciones.php";
            $datos=$this->modeloCat->obtenerContribuciones();
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
            $datos = $this->modeloCat->obtenerPorId();

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
            $this->modeloCat->borrar();
        
            // Redirigimos a la lista de contribuciones
            header('Location: index.php?c=Contribucion&m=listar');
            exit;
        }
        
    }
?>