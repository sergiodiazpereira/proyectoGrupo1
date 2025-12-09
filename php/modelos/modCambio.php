<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del cambio de contraseña del usuario
     */
    class ModCambio extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
    }
?>