<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'/modCrearAdmin.php';

    class ConCrearAdmin{
        public $modelo;
        function __construct()
        {
            $this->modelo = new ModCrearAdmin();
        }
    }


?>