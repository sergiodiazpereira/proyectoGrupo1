<?php
    require_once __DIR__.'/config/rutas.php';
    /**
     * @var $controlador Recibe el controlador al que queremos ir mediante el metodo get
     * @var $metodo  Recibe el metodo del controladore al que queremos ir mediante el metodo get
     * @const  string CONDEF Tiene el controladores por defecto si no se recibe ningun parametro por get
     * @const  string METDEF Tiene el metodo por defecto si no se recibe ningun parametro por get
     */
    $controlador = $_GET["c"] ?? CONDEF;
    $metodo = $_GET["m"] ?? METDEF;
    
    /**
     * @var $rutaControlador formara la ruta del controlador necesario
     * @var string CONTROLADOR contiene la ruta de la ubicacion de los controladores
     */
    $rutaControlador = CONTROLADOR."con".$controlador.".php";
    require_once $rutaControlador;

    /**
     * @var $instanciaControlador creara el nombre de la clase para instanciar 
     */
    $instanciaControlador = "Con".$controlador;

    /**
     * @var $objContro es la variable de la instancia creada por $instanciaControlador este se utilizara para llamar a la vista correspondiente
     */
    $objContro = new $instanciaControlador();
    /**
     * @var $datos recibira los datos o el mensaje desde el controlador
     * @var string VISTA tendra parte de la ruta del directorio donde se encuentran todas las vistas
     */

    $datos=$objContro->$metodo();
    include VISTAS.$objContro->vista;
?>