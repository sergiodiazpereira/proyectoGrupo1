<?php
    require_once './conRegistroS.php';
    $controlador = new conRegistroS();
    $mensaje=$controlador->cargarSuper();
    include 'borrado'.$controlador->vista;
?>