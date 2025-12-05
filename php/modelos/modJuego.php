<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del juego
     */
    class ModJuego extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        
        public function obtenerContribuciones(){
            $sql="SELECT * FROM contribucion;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }
?>