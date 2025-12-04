<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();    
        }

        public function listar(){
            $sql = "SELECT * FROM contribucion ORDER BY descripcion";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function obtenerPorId(){
            $idContribucion = $_GET['idContribucion'];

            $sql = "SELECT * FROM contribucion WHERE idContribucion = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':id', $idContribucion, PDO::PARAM_INT);
            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function insertar(){
        
        }

        public function modificar(){

            try {

                foreach ($_POST['descripcion'] as $id => $desc) {
                    $sql = "UPDATE contribucion SET descripcion = :desc WHERE idContribucion = :id";
                    $stmt = $this->conexion->prepare($sql);

                    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    $stmt->execute();
                }

            } catch (Exception $e) {
                return false;
            }

        }

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
    }
?>