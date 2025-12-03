<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModAsociacion extends Conexion {

        function __construct() {
            parent::__construct();
            
        }
        public function insertar() {
        
        }

        public function modificar() {
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

            $nombre = $_POST['nombre'];
            $fecha_fun = $_POST['fecha_fun'];
            $pf = $_POST['pista_facil'];
            $pm = $_POST['pista_media'];
            $pd = $_POST['pista_dificil'];
            $imagen = $_POST['imagen'];
            $tipo = $_POST['idTipoAsoc'];
            $alcance = $_POST['alcance'];
            $id = $_POST['idAsoc'];

            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_fun', $fecha_fun, PDO::PARAM_STR);
            $stmt->bindParam(':pf', $pf, PDO::PARAM_STR);
            $stmt->bindParam(':pm', $pm, PDO::PARAM_STR);
            $stmt->bindParam(':pd', $pd, PDO::PARAM_STR);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $stmt->bindParam(':alcance', $alcance, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        }

        public function borrar() {
            $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_POST['idAsoc'];

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();

            $sql = "DELETE FROM asociacion WHERE idAsoc = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_POST['idAsoc'];

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        }

        public function obtenerId($asociacion) {
            $sql = "SELECT * FROM asociaciones WHERE nombre=".$asociacion;
            $resultado = $this->conexion->query($sql);

            $datos = $resultado->fetch_assoc();

            return $datos;
        }

    }
?>