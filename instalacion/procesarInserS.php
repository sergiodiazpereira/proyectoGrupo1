<?php
    require_once './conRegistroS.php';
    $controlador = new conRegistroS();
    $mensaje=$controlador->cargarSuper();
    
    if ($controlador->vista == "REDIRECT") {
        header("Location: ../php/exito_instalacion.php");
        exit;
    }

    include 'borrado'.$controlador->vista;
?>