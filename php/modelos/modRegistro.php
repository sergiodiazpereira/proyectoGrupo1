<?php
    require_once __DIR__.'/../config/conexion.php';
    Class ModRegistro extends Conexion{
        function __construct()
        {
            return parent::__construct();
        }
        /**
         * Summary of insertarRegistro
         * @param mixed $nombre nombre de usuario
         * @param mixed $correo correo de usuario
         * @param mixed $pwd password de usuario
         * @param mixed $pwdConfir password de usuario para confirmacion
         * @return bool registrara el usuario y devolvera true o false
         */
        public function insertarRegistro($nombre, $correo, $pwd, $pwdConfir){
            if ($pwd != $pwdConfir)
            {
                return false;
            }
            /* Encriptamos la contraseña mediante el password_hass, con la constante de PASSWORD_DEFAULT, para que la
            encripte por defecto con algún algoritmo, es decir, el que tiene la versión actual que utilizas de php */
            $pwdSegura = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (nombre, correo, contrasenia) VALUES ('$nombre', '$correo', '$pwdSegura')";

            try {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            
            /* Si está aquí es porque no ha habido ningún error */
            return true; 

            } catch (PDOException $e) {
                /* El código 23000 es el de dato duplicado */
                if ($e->getCode() == 23000) {
                    return false;
                } 
            }
        }
        /**
         * Summary of insertarSuper
         * @return bool insertara al SuperAdmin y devolvera true o false
         */
        public function insertarSuper(){

                $nombre = trim($_POST['nombre']);
                $correo = trim($_POST['correo']);
                $pwd = trim($_POST['pwd']);
                $permiso="S";
                $pwdSegura = password_hash($pwd, PASSWORD_DEFAULT);

                $sql="INSERT INTO usuario (nombre,contrasenia,permiso,correo)VALUES (?,?,?,?)";
                $stmt=$this->conexion->prepare( $sql);
                $stmt->bindValue(1,$nombre,PDO::PARAM_STR);
                $stmt->bindValue(2,$pwdSegura,PDO::PARAM_STR);
                $stmt->bindValue(3,$permiso,PDO::PARAM_STR);
                $stmt->bindValue(4,$correo,PDO::PARAM_STR);
                $stmt->execute();
        }
    }
?>