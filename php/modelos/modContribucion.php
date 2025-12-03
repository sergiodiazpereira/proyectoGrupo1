<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();    
        }

        public function insertar(){
        
        }

        public function modificar(){
            $sql = "UPDATE contribucion
                    SET descripcion = :desc
                    WHERE idContribucion = :id";

            $stmt = $pdo->prepare($sql);

            $desc = $_POST['descripcion'];
            $id   = $_POST['idContribucion'];

            $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            $stmt->bindParam(':id',   $id,   PDO::PARAM_INT);

            return $stmt->execute();
        }

        public function borrar(){
            $sql = "DELETE FROM asoc_contribucion WHERE idContribucion = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_POST['idContribucion'];

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $sql = "DELETE FROM contribucion WHERE idContribucion = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_POST['idContribucion'];

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        }
    }
?>