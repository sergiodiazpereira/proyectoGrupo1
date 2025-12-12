<?php
    require_once __DIR__.'/php/config/configdb.php';

        $conexion = new mysqli (SERVIDOR,USUARIO,PASSWORD,BBDD);
        $sql="SELECT * FROM usuario WHERE permiso = 'S'";
        $datos=$conexion->query($sql);
        
        if($datos->num_rows == 0){
            header("Location: instalacion/instalacion.html");
        }else{
            header("Location: php/vistas/usuario/login.php");
        }
    
?>