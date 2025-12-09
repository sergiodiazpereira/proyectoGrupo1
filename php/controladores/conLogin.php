<?php 
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modLogin.php';
    class ConLogin {
        public $modeloL;
        public $vista;
        function __construct(){
            $this->modeloL = new ModLogin();
        }
    }
?>