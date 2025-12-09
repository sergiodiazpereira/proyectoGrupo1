<?php 
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modLogin.php';
    class ConLogin {
        public $modelo;
        function __construct(){
            $this->modelo = new ModLogin();
        }
    }
?>