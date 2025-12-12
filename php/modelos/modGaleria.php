<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de la galería
     */
    class ModGaleria extends Conexion{

        function __construct(){
            parent::__construct();
            
        }

        public function datosImagenes(){
            $sql = "SELECT * FROM galeria;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }
    }
?>