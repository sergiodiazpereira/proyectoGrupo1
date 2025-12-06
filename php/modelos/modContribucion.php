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