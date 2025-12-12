<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del cambio de contraseñas de administrador
     */
    class ModCambioAdmin extends Conexion{

        function __construct(){
            parent::__construct();
        }

        public function recogerContrasenia($correo)
        {
            $sql = "SELECT contrasenia FROM usuario WHERE correo = :correo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":correo", $correo);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['contrasenia'] : false;
        }

        public function modificarContrasenia($correoAdmin, $hashNuevo)
        {
            $sql = "UPDATE usuario SET contrasenia = :pwdHash WHERE correo = :correo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":pwdHash", $hashNuevo);
            $stmt->bindParam(":correo", $correoAdmin);
            return $stmt->execute();
        }
    }
?>