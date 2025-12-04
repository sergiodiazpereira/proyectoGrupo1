<?php
    /**
     * @var string VISTAS guardara la ruta donde se almacenan las vistas
     * @var string CONTROLADOR guardara la ruta donde se almacenan las vistas
     * @var string CONDEF guardara el controlador por defecto
     * @var string METDEF guardara el metodo por defecto
     * @var string RUTAIMG guardara la ruta donde se guardaran o buscaran las imagenes
     * @var $ruta guardara la ruta que almacenara la constante RUTAIMG
     */
    
    define('VISTAS','vistas/admin/');
    define('CONTROLADOR','controladores/');
    define('CONDEF','Asociacion');
    define('METDEF','inicio');

    /*rutas para el archivo*/

    $ruta=__DIR__."/../../src/img/";

    define('RUTAIMG',$ruta);
?>