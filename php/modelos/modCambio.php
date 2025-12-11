<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del cambio de contraseña del usuario
     */
    class ModCambio extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function traerPwd($idUsuario){
            $sql = "SELECT contrasenia FROM usuario WHERE idUsuario = ?";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute([$idUsuario]);
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
        public function modificarPwd($idUsuario, $contrasenia){
            $sql="UPDATE usuario
                    SET contrasenia = ?
                    WHERE idUsuario = ?;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->bindParam(1 , $contrasenia);
            $stmt->bindParam(2, $idUsuario);
            return $stmt->execute();
        }
    }
?>