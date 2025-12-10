<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del cambio de contraseña del usuario
     */
    class ModCambio extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function traerPwd($nombreSesion){
            $sql = "SELECT contrasenia FROM usuario WHERE nombre = ?";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute([$nombreSesion]);
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
        public function modificarPwd(nombre){

        }
    }
?>