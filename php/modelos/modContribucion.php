<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();    
        }

        public function listar(){
        
        }

        public function insertar(){
        
        }

        public function modificar(){

            try {

                $sql = "UPDATE contribucion
                        SET descripcion = :desc
                        WHERE idContribucion = :id";

                $stmt = $this->conexion->prepare($sql);

                $desc = $_POST['descripcion'];
                $id   = $_POST['idContribucion'];

                $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
                $stmt->bindParam(':id',   $id,   PDO::PARAM_INT);
                $stmt->execute();

                return true;

            } catch (Exception $e) {
                return false;
            }

        }

        public function borrar($idContribucion){
            $this->conexion->beginTransaction();

            try {

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