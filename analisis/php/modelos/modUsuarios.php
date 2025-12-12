<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de los usuarios
     */
    class ModUsuarios extends Conexion{

        function __construct(){
            parent::__construct();
        }
        /**
         * Summary of borrarUsu
         * @param mixed $idUsuarioBor esta variable almacena el id del usuario que se va a borrar
         * @return bool recibe true o false en funcion de si se borra o no
         */
        function borrarUsu($idUsuarioBor){
            $sql="DELETE FROM usuario WHERE idUsuario = ?";
            $stmt=$this->conexion->prepare($sql);
            return $stmt->execute([$idUsuarioBor]);
        }
        /**
         * Summary of listar
         * @return array Trae una lista de los usuarios en un orden indicado
         */
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