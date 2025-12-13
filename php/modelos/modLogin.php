<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModLogin extends Conexion{
        function __construct(){
            parent::__construct();
        }

        /**
         * Summary of validarUsuario
         * @param mixed $correo
         * @param mixed $pwd
         * Esta función simplemente recoge de la base de datos el correo y la contraseña para validar la contraseña
         * con hash de la contraseña del usuario, ya que si la encuentra actualiza el contador de visitas en +1  
         */
        public function validarUsuario($correo, $pwd){
            $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            /* Lo que hace es comprobar que encontró al menos 1 fila (el usuario existe) */
            if ($consulta->rowCount()>0){
                /* Lo que hace el fetch es devolver la consulta en un array asociativo */
                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
                if (password_verify($pwd, $usuario['contrasenia']))
                {
                    $this->actualizarVisitas($usuario['idUsuario']);
                    return $usuario; 
                }
                else{
                    return false;
                }
            } 
            else 
            {
            return false;
            }
        }

        /**
         * Summary of actualizarVisitas
         * @param mixed $idUsuario
         * @return void Esta función es la que devuelve al campo de la base de datos que una vez que
         * el usuario se haya introducido, el contador de visitas incremente +1
         */
        public function actualizarVisitas($idUsuario){
            $sql = "UPDATE usuario SET visitas = visitas + 1 WHERE idUsuario = $idUsuario";
            $act = $this->conexion->prepare($sql);
            $act->execute();
        }
    }
?>