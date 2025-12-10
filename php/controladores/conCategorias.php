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
         * @return bool esta funcion valida que la categoria no esta vacia o contenga numeros
         */
        public function validaciones(){
            $categoria = trim($_POST["categoria"]);

            if (empty($categoria)) {
                return false;
            }

            if (preg_match('/[0-9]/', $categoria)) {
                return false;
            }
            return true;
        }

        /**
         * Summary of validaciones
         * @return bool esta funcion valida que la categoria no esta vacia o contenga numeros
         */
        public function validacionArray(){

            foreach ($_POST['nombre'] as $id => $nom) {

                if (empty($nom)) {
                    return false;
                }

                if (preg_match('/[0-9]/', $nom)) {
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
         * Carga el formulario de modificación de una categoria.
         *
         * Recoge:
         *  - GET['idCategoria']
         * 
         * @return array Datos de la categoria.
         */
        public function modificar(){
            // Obtenemos los datos a modificar
            $datos = $this->modeloCat->obtenerPorId();

            // Indicamos la vista
            $this->vista="admin/vistaGestionCategoria.php";
            
            // Retornamos el array de datos 
            return $datos;
        }

        /**
         * Procesa la modificación de una categoría.
         * 
         * Recoge:
         *  - POST['nombre'][id] = nuevo texto
         */
        public function procesarModificar(){

            if(!$this->validacionArray()){
                $this->vista="admin/mensajeIncorrectoCategoria.php";
                return "Alguna categoría está vacia o tiene algún número";
            } else {
                // Actualizamos los datos en la base de datos
                $this->modeloCat->modificar();

                $this->vista="admin/mensajeCorrectoCategoria.php";
                return "Categorías actualizadas";
            }
            
        }

        /**
         * Summary of insertar
         * @return string esta funcion inserta las categorías en su tabla
         */
        public function insertar(){
            if(!$this->validaciones()){
                $this->vista="admin/mensajeIncorrectoCategoria.php";
                return "Categoría vacia o la categoría tiene algun número";
            }else{
                if($this->modeloCat->insertar()){
                    
                    $this->vista="admin/mensajeCorrectoCategoria.php";
                    return "Categoría guardada con exito";

                }else{
                    $this->vista="admin/mensajeIncorrectoCategoria.php";
                    return "Fallo al guardar la categoría";
                };
            };
        }
        
        /**
         * Summary of obtenerCategoria
         * @return bool|PDOStatement esta funcion llama al modelo para que le devuelva las categorías
         */
        public function obtenerCategoria(){
            $this->vista="admin/vistaGestionCategorias.php";
            $datos=$this->modeloCat->obtenerCategorias();
            return  $datos;
        }

        /**
         * Muestra la vista para confirmar eliminación.
         * 
         * Recoge:
         *  - GET['idCategoría']
         * 
         * @return array Datos de la categoría.
         */
        public function borrar(){
            // Comprobamos si podemos borrar la categoría (si hay alguna asociacion usando la categoría)
            $asociacionUsandoCategoria = $this->modeloCat->buscarAsociacionUsandoCategoria();
            if (isset($asociacionUsandoCategoria["nombre"])) {
                $this->vista="admin/vistaErrorBorradoCategoria.php";
                return "Hay una o varias asociaciones usando esta categoría";
            } else {
                // Obtenemos los datos de la categoría
                $datos = $this->modeloCat->obtenerPorId();


                // Establecemos la vista
                $this->vista="admin/vistaBorrarCategoria.php";

                // Devolvemos el array de datos
                return $datos;
            }
        }

        /**
         * Procesa el borrado de la categoria.
         * 
         * Recoge:
         *  - GET['idCategoria']
         */
        public function procesarBorrar(){
            // Eliminamos la categoría
            $this->modeloCat->borrar();
        
            // Redirigimos a la lista de categorías
            header('Location: index.php?c=Categorias&m=listar');
            exit;
        }
        
    }
?>