<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de la gestion de categorías
     */
    class ModCategorias extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        
        /**
         * Lista todas las categorias.
         * 
         * @return array
         */
        public function listar(){
            $sql = "SELECT * FROM tipo_asoc ORDER BY nombre";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
            
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        /**
         * Obtiene una categoria por su ID.
         *
         * Recoge:
         *  - GET['idCategoria']
         *
         * @return array
         */
        public function obtenerPorId(){
            $idCategoria = $_GET['idCategoria'];

            $sql = "SELECT * FROM tipo_asoc WHERE idCategoria = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':id', $idCategoria, PDO::PARAM_INT);
            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $datos;
        }

        /**
         * Summary of insertar
         * @return bool esta funcion realiza el insert en la base de datos en la tabla categoria
         */
        public function insertar(){
            try{
                $sql="INSERT INTO tipo_asoc (nombre) VALUES (?)";
                $stmt=$this->conexion->prepare($sql);
                $stmt->execute([$_POST["categoria"]]);
                return true;
            }catch(PDOException $e){
                return false;
            }
        }

        /**
         * Modifica varias categorias a la vez.
         *
         * Recoge POST:
         *  - nombre[id] = texto nuevo
         *
         * @return bool true si la modificacion fue exitosa.
         */
        public function modificar(){

            try {

                foreach ($_POST['nombre'] as $id => $desc) {
                    $sql = "UPDATE tipo_asoc SET nombre = :desc WHERE idTipoAsoc = :id";
                    $stmt = $this->conexion->prepare($sql);

                    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    $stmt->execute();
                }

                return true;
            } catch (Exception $e) {
                return false;
            }

        }

        /**
         * Borra una categoria y sus relaciones.
         *
         * Recoge:
         *  - GET['idCategoria']
         *
         * @return bool true si el borrado fue realizado con exito.
         */
        public function borrar(){

            try {
                $idCategoria = $_GET['idCategoria'];

                $sql = "DELETE FROM tipo_asoc WHERE idTipoAsoc = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idCategoria, PDO::PARAM_INT);
                $stmt->execute();

                return true;

            } catch (Exception $e) {

                return false;

            }
        }

        /** 
         * Summary of obtenerCategorias
         * @return bool|PDOStatement esta funcion retorna las categorias que tenemos
         */
        public function obtenerCategorias(){
            $sql="SELECT * FROM tipo_asoc;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }
?>