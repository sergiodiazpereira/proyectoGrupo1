<?php
    require_once __DIR__.'/../config/conexion.php';
    Class ModRegistro extends Conexion{
        function __construct()
        {
            return parent::__construct();
        }
        
        public function insertarRegistro($nombre, $correo, $pwd, $pwdConfir){
            if ($pwd != $pwdConfir)
            {
                return false;
            }

            $sql = "INSERT INTO usuario (nombre, correo, contrasenia) VALUES ('$nombre', '$correo', '$pwd')";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
        }
    }

?>