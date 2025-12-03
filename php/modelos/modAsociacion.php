<?php
    require_once __DIR__.'/../config/conexion.php';
    
    class ModAsociacion extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function insertar(){
        
        }

        public function modificar(){
        
        }

        public function borrar(){
        
        }

        public function obtenerTipos(){
            $sql="SELECT * FROM tipo_asoc";
            $tipos=$this->conexion->query($sql);
            return $tipos;
        }
    }
?>