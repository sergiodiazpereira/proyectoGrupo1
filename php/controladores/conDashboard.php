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
            $asociacionesTotales = $this->modeloJ->contarAsociaciones(); // Trae el numero total de asociaciones
            $usuariosTotales = $this->modeloJ->contarUsuarios(); // Trae el numero total de asociaciones
            $contribucionesTotales = $this->modeloJ->contarContribuciones(); // Trae el numero total de contribuciones
            $usuariosNuevos = $this->modeloJ->datosUsuariosNuevos(); // Trae los 10 ultimos jugadores registrados

            foreach ($usuariosNuevos as &$usuario) { // Pasa el formato fecha yyyy-mm-dd traído de la base de datos al formato dd/mm/yyyy para mostrarlo en la vista
                $fecha = DateTime::createFromFormat('Y-m-d', $usuario['fecha_registro']);
                $usuario['fecha_registro'] = $fecha->format('d/m/Y');
            }

            $this->vista="admin/dashboard.php";
            $datos = [
                "asociacionesTotales" => $asociacionesTotales,
                "usuariosTotales" => $usuariosTotales,
                "contribucionesTotales" => $contribucionesTotales,
                "visitas" => $visitas,
                "usuariosNuevos" => $usuariosNuevos
            ];

            return $datos;
        }
    }
?>