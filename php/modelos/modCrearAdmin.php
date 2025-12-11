<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModCrearAdmin extends Conexion{
        function __construct()
        {
            return parent::__construct();
        }

        public function introducirAdmin($nombreAdmin, $correoAdmin, $contraActual, $contraConfirmar){
            if ($contraActual != $contraConfirmar)
            {
                return false;
            }
            /* Encriptamos la contraseña mediante el password_hass, con la constante de PASSWORD_DEFAULT, para que la
            encripte por defecto con algún algoritmo, es decir, el que tiene la versión actual que utilizas de php */
            $contraSegura = password_hash($contraActual, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (nombre, correo, permiso, contrasenia) VALUES ('$nombreAdmin', '$correoAdmin', 'A', '$contraSegura')";

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
    }

?>
