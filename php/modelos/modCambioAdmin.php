<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del cambio de contraseñas de administrador
     */
    class ModCambioAdmin extends Conexion{

        function __construct(){
            parent::__construct();
        }
    }
?>