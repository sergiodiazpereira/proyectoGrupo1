<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModLogin extends Conexion{
        function __construct(){
            parent::__construct();
        }

        public function validarUsuario($correo, $pwd){
            $sql = "SELECT * FROM usuario WHERE correo = '$correo' AND contrasenia = '$pwd'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            /* Lo que hace es comprobar que encontró al menos 1 fila (el usuario existe) */
            if ($consulta->rowCount()>0){
                /* Lo que hace el fetch es devolver la consulta en un array asociativo */
                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
                $this->actualizarVisitas($usuario['idUsuario']);
                return $usuario; 
            } 
            else 
            {
            return false;
            }
        }

        public function actualizarVisitas($idUsuario){
            $sql = "UPDATE usuario SET visitas = visitas + 1 WHERE idUsuario = $idUsuario";
            $act = $this->conexion->prepare($sql);
            $act->execute();
        }
    }
?>