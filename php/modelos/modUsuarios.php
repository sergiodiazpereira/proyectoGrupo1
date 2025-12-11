<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de los usuarios
     */
    class ModUsuarios extends Conexion{

        function __construct(){
            parent::__construct();
        }
        function borrarUsu($idUsuarioBor){
            $sql="DELETE FROM usuario WHERE idUsuario = ?";
            $stmt=$this->conexion->prepare($sql);
            return $stmt->execute([$idUsuarioBor]);
        }
        function listar(){
            $sql="SELECT *
                    FROM usuario
                    ORDER BY FIELD(permiso, 's', 'a', 'u'), permiso;";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();

            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $datos;
        }
        
    }
?>