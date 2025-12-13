<?php
require_once __DIR__ . '/../modelos/modColecciones.php';

class ConColecciones {
    public $vista;
    public $datos; // <--- AQUÍ GUARDAREMOS LAS ASOCIACIONES
    private $modelo;

    public function __construct() {
        $this->modelo = new ModColecciones();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Summary of cargarPagina
     * @return void Esta función carga la vista de colecciones.php
     */
    public function cargarPagina() {
    $this->vista = "usuario/colecciones.php"; 
    
    $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 1;
    $this->datos = $this->modelo->obtenerColeccionUsuario($idUsuario);
    }

    public function obtenerColeccionUsuario() {
        header('Content-Type: application/json');
        
        $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 1;
        $datos = $this->modelo->obtenerColeccionUsuario($idUsuario);
        
        echo json_encode($datos);
        exit;
    }
}
?>