<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModContribucion extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function insertar(){
        
        }

        public function modificar(){
        
        }

        public function borrar(){
        
        }

        public function obtenerContribuciones(){
            $sql="SELECT * FROM contribucion;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
?>