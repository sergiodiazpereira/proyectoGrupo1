<?php
    /**
     * @var string VISTAS guardara la ruta donde se almacenan las vistas
     * @var string CONTROLADOR guardara la ruta donde se almacenan las vistas
     * @var string CONDEF guardara el controlador por defecto
     * @var string METDEF guardara el metodo por defecto
     * @var string RUTAIMG guardara la ruta donde se guardaran o buscaran las imagenes
     * @var $ruta guardara la ruta que almacenara la constante RUTAIMG
     */
    
    define('VISTAS','vistas/');
    define('CONTROLADOR','controladores/');
    define('CONDEF','Contribucion');
    define('METDEF','obtenerContribucion');

    /*rutas para el archivo*/

    $ruta="../src/img/";

    define('RUTAIMG',$ruta);
?>