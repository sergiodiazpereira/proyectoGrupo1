<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModAsociacion extends Conexion {

        function __construct() {
            parent::__construct(); 
        }

        public function listar() {
            
        }

        public function insertar() {
            
        }

        public function obtenerPorId() {
            $sql = "SELECT * FROM asociacion WHERE idAsoc = :idAsoc";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':idAsoc', $_GET['idAsoc'], PDO::PARAM_STR);

            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

            return $datos;
        }

        public function modificar() {
            try {

                $sql = "UPDATE asociacion 
                        SET nombre = :nombre,
                            fecha_fun = :fecha_fun,
                            pista_facil = :pf,
                            pista_media = :pm,
                            pista_dificil = :pd,
                            imagen = :imagen,
                            idTipoAsoc = :tipo,
                            alcance = :alcance
                        WHERE idAsoc = :id";

                $stmt = $this->conexion->prepare($sql);

                $stmt->bindParam(':nombre', $_POST['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_fun', $_POST['fecha_fun'], PDO::PARAM_INT);
                $stmt->bindParam(':pf', $_POST['pista_facil'], PDO::PARAM_STR);
                $stmt->bindParam(':pm', $_POST['pista_media'], PDO::PARAM_STR);
                $stmt->bindParam(':pd', $_POST['pista_dificil'], PDO::PARAM_STR);
                $stmt->bindParam(':imagen', $_FILES['imagen'], PDO::PARAM_STR);
                $stmt->bindParam(':tipo', $_POST['idTipoAsoc'], PDO::PARAM_INT);
                $stmt->bindParam(':alcance', $_POST['alcance'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $_POST['idAsoc'], PDO::PARAM_INT);

                $stmt->execute();
                return true;

            } catch (Exception $e) {
                return false;
            }
        }

        public function borrar() {
            $pdo->beginTransaction();

            try {
            
                $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':id', $_GET['idAsoc'], PDO::PARAM_INT);
                
                $stmt->execute();

                $sql = "DELETE FROM asociacion WHERE idAsoc = :id";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':id', $_GET['idAsoc'], PDO::PARAM_INT);
                
                $stmt->execute();
                return true;

            } catch (Exception $e) {
                return false;
            }
        }
    }
?>