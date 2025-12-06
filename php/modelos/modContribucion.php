<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del conContribucion
     */
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();    
        }

        /**
         * Lista todas las contribuciones.
         * 
         * @return array
         */
        public function listar(){
            $sql = "SELECT * FROM contribucion ORDER BY descripcion";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
            
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        /**
         * Lista las contribuciones asociadas a una asociación.
         *
         * Recoge:
         *  - GET['idAsoc']
         *
         * @return array IDs de contribuciones
         */
        public function listarContribucionesAsociacion() {
            $idAsoc = $_GET['idAsoc'];

            $sql = "SELECT idContribucion FROM asoc_contribucion WHERE idAsoc = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(":id", $idAsoc);

            $stmt->execute();

            $datos = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), "idContribucion");
            return $datos;
        }

        /**
         * Obtiene una contribución por su ID.
         *
         * Recoge:
         *  - GET['idContribucion']
         *
         * @return array
         */
        public function obtenerPorId(){
            $idContribucion = $_GET['idContribucion'];

            $sql = "SELECT * FROM contribucion WHERE idContribucion = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':id', $idContribucion, PDO::PARAM_INT);
            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $datos;
        }

        /**
         * Summary of insertar
         * @return bool esta funcion realiza el insert en la base de datos en la tabla contribucion
         */
        public function insertar(){
            try{
                $sql="INSERT INTO contribucion (descripcion) VALUES (?)";
                $stmt=$this->conexion->prepare($sql);
                $stmt->execute([$_POST["contribucion"]]);
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        /**
         * Modifica varias contribuciones a la vez.
         *
         * Recoge POST:
         *  - descripcion[id] = texto nuevo
         *
         * @return bool true si la modificacion fue exitosa.
         */
        public function modificar(){

            try {

                foreach ($_POST['descripcion'] as $id => $desc) {
                    $sql = "UPDATE contribucion SET descripcion = :desc WHERE idContribucion = :id";
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
         * Borra una contribución y sus relaciones.
         *
         * Recoge:
         *  - GET['idContribucion']
         *
         * @return bool true si el borrado fue realizado con exito.
         */
        public function borrar(){

            try {
                $this->conexion->beginTransaction();
                $idContribucion = $_GET['idContribucion'];

                $sql = "DELETE FROM asoc_contribucion WHERE idContribucion = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idContribucion, PDO::PARAM_INT);
                $stmt->execute();

                $sql = "DELETE FROM contribucion WHERE idContribucion = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idContribucion, PDO::PARAM_INT);
                $stmt->execute();

                $this->conexion->commit();
                return true;

            } catch (Exception $e) {

                $this->conexion->rollBack();
                return false;

            }
        }

        /** 
         * Summary of obtenerContribuciones
         * @return bool|PDOStatement esta funcion retorna los tipos de contribuciones que tenemos
         */
        public function obtenerContribuciones(){
            $sql="SELECT * FROM contribucion;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }
?>