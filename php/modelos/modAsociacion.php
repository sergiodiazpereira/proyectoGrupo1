<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModAsociacion extends Conexion {

        function __construct() {
            parent::__construct(); 
        }

        public function listar() {
            
        }

        public function listarTipos() {
            $sql = "SELECT * FROM tipo_asoc";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();

            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $datos;
        }

        public function listarContribuciones() {
            return $this->conexion->query("SELECT * FROM contribucion")->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listarContribucionesAsociacion($idAsoc) {
            $sql = "SELECT idContribucion FROM asoc_contribucion WHERE idAsoc = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(":id", $idAsoc);

            $stmt->execute();

            return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), "idContribucion");
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

                // Procesar imagen
                /* if (!empty($_FILES['imagen']['name'])) {
                    $nombreImg = time() . "_" . basename($_FILES["imagen"]["name"]);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], "uploads/" . $nombreImg);
                } else {
                    // Si no se sube nueva imagen, conservar la anterior
                    $sql = "SELECT imagen FROM asociacion WHERE idAsoc = :id";
                    $stmt = $this->conexion->prepare($sql);

                    $stmt->bindParam(":id", $_GET["idAsoc"]);

                    $stmt->execute();

                    $nombreImg = $stmt->fetchColumn();
                }  */

                $sql = "UPDATE asociacion 
                        SET nombre = :nombre,
                            fecha_fun = :fecha_fun,
                            pista_facil = :pista_facil,
                            pista_media = :pista_media,
                            pista_dificil = :pista_dificil,
                            imagen = :imagen,
                            idTipoAsoc = :idTipoAsoc,
                            alcance = :alcance
                        WHERE idAsoc = :idAsoc";

                $stmt = $this->conexion->prepare($sql);

                $idAsoc = $_GET['idAsoc'];
                $nombre = $_POST['nombre'];
                $fecha_fun = $_POST['fecha_fun'];
                $pista_facil = $_POST['pista_facil'];
                $pista_media = $_POST['pista_media'];
                $pista_dificil = $_POST['pista_dificil'];
                $idTipoAsoc = $_POST['idTipoAsoc'];
                $alcance = $_POST['alcance'];
                $imagen = 'nombre_fijo.jpg';

                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->bindParam(':fecha_fun', $fecha_fun, PDO::PARAM_INT);
                $stmt->bindParam(':pista_facil', $pista_facil, PDO::PARAM_STR);
                $stmt->bindParam(':pista_media', $pista_media, PDO::PARAM_STR);
                $stmt->bindParam(':pista_dificil', $pista_dificil, PDO::PARAM_STR);
                $stmt->bindParam(':idTipoAsoc', $idTipoAsoc, PDO::PARAM_INT);
                $stmt->bindParam(':alcance', $alcance, PDO::PARAM_STR);
                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                $stmt->bindParam(':idAsoc', $idAsoc, PDO::PARAM_INT);

                $stmt->execute();
                return true;

            } catch (Exception $e) {
                return false;
            }
        }

        public function modificarContribuciones() {
            // Eliminar las antiguas
            $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':id', $_GET["idAsoc"]);

            $stmt->execute();

            // Insertar nuevas
            if (!empty($_POST['contribuciones'])) {

                foreach ($_POST['contribuciones'] as $idContribucion) {
                    $sql = "INSERT INTO asoc_contribucion (idAsoc, idContribucion)
                            VALUES (:idAsoc, :idContribucion)";

                    $stmt = $this->conexion->prepare($sql);

                    $stmt->bindParam(':idAsoc', $_GET["idAsoc"]);
                    $stmt->bindParam(':idContribucion', $idContribucion);

                    $stmt->execute();
                }

            }
        }

        public function borrar() {
            try {
                $this->conexion->beginTransaction();
                $idAsoc = $_GET['idAsoc'];

                $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idAsoc, PDO::PARAM_INT);
                $stmt->execute();

                $sql = "DELETE FROM asociacion WHERE idAsoc = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idAsoc, PDO::PARAM_INT);
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