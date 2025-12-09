<?php
    require_once __DIR__.'/config/rutas.php';
    /**
     * @var $controlador Recibe el controlador al que queremos ir mediante el metodo get
     * @var $metodo  Recibe el metodo del controladore al que queremos ir mediante el metodo get
     */
    $controlador = $_GET["c"] ?? CONDEF;
    $metodo = $_GET["m"] ?? METDEF; 
    
    /**
     * @var $rutaControlador formara la ruta del controlador necesario
     */
    $rutaControlador = CONTROLADOR."con".$controlador.".php"; 
    require_once $rutaControlador;

    /**
     * @var $instanciaControlador creara el nombre de la clase para instanciar 
     */
    $instanciaControlador = "Con".$controlador; 

    /**
     * @var object $objContro crea un objeto instanciado al controlador necesario
     */
    $objContro = new $instanciaControlador();

    $datos=$objContro->$metodo();
    include VISTAS.$objContro->vista;
?>