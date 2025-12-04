<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del conContribucion
     */
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function insertar(){
        
        }

        /**
         * Summary of obtenerContribuciones
         * @return bool|PDOStatement esta funcion retorna los tipos de contribuciones que tenemos
         */
        public function obtenerContribuciones(){
            $sql="SELECT * FROM contribucion;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
?>