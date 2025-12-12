<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de la galería
     */
    class ModGaleria extends Conexion{

        function __construct(){
            parent::__construct();
            
        }





        /**
         * Esta funcion devuelve los datos de las imagenes de la BD
         */
        public function datosImagenes(){
            $sql = "SELECT * FROM galeria;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }





        /**
         * Esta funcion devuelve el id y nombre de las asociaciones de la BD
         */
        public function datosAsociaciones(){
            $sql = "SELECT idAsoc, nombre FROM asociacion;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }
    }
?>