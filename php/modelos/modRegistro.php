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

            try {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            
            // Si llega aquí, es que NO hubo error
            return true; 

            } catch (PDOException $e) {
                // El código 23000 es el de "Dato duplicado"
                if ($e->getCode() == 23000) {
                    return false;
                } 
            }
        }
    }

?>