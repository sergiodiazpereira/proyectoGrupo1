<?php
    require_once __DIR__.'/../php/config/conexion.php';
    Class ModRegistroS extends Conexion{
        function __construct()
        {
            return parent::__construct();
        }
        /**
         * Summary of insertarSuper
         * @return bool insertara al SuperAdmin y devolvera true o false
         */
        public function insertarSuper(){

                $nombre = trim($_POST['nombreS']);
                $correo = trim($_POST['correoS']);
                $pwd = trim($_POST['pwdS']);
                $permiso='S';
                $pwdSegura = password_hash($pwd, PASSWORD_DEFAULT);

                $sql="INSERT INTO usuario (nombre,contrasenia,permiso,correo)VALUES (?,?,?,?)";
                $stmt=$this->conexion->prepare( $sql);
                $stmt->bindParam(1,$nombre,PDO::PARAM_STR);
                $stmt->bindParam(2,$pwdSegura,PDO::PARAM_STR);
                $stmt->bindParam(3,$permiso,PDO::PARAM_STR);
                $stmt->bindParam(4,$correo,PDO::PARAM_STR);
                $stmt->execute();
        }
    }
?>