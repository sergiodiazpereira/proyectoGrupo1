<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modJuego.php';
    class ConJuego{
        public $modeloJ;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModJuego();
        }
        public function cargarAsociaciones(){
            $this->vista="usuario/pagina_juego.php";
        }
        public function obtenerPagina(){
            $this->vista="usuario/pagina_juego.php";
            echo json_encode($this->vista); // Para cargar la variable pagina_juego en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>