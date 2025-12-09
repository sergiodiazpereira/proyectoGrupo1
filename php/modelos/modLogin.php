<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModLogin extends Conexion{
        function __construct(){
            parent::__construct();
        }
        function traerUsuario(){
            $sql="SELECT * FROM SUM (visitas) WHERE rol='U'";
            $s
        }
    }
?>