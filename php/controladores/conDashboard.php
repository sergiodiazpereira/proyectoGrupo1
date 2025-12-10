<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modDashboard.php';
    class ConDashboard{
        public $modeloJ;
        public $vista;

        function __construct(){
            $this->modeloJ = new ModDashboard();
        }

        public function cargarPagina(){
            $visitas = $this->modeloJ->contarVisitas(); // Este metodo del modelo solo trae las visitas totales
            $this->vista="admin/dashboard.php";
            $datos = [
                "asociacionesTotales" => 32,
                "usuariosRegistrados" => 9,
                "contribucionesTotales" => 55,
                "visitas" => $visitas,
                "usuariosNuevos" => [
                    ["nombreUsuario" => "sergio", "fecha" => "20/06/2025"],
                    ["nombreUsuario" => "sergio2", "fecha" => "20/06/2023"],
                    ["nombreUsuario" => "sergio3", "fecha" => "20/06/2022"],
                    ["nombreUsuario" => "sergio4", "fecha" => "20/06/2021"],
                    ["nombreUsuario" => "sergio5", "fecha" => "20/06/2020"]
                ]
            ];
            return $datos;
        }
    }
?>