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

    public function cargarPagina() {
    // IMPORTANTE: Añade el ".php" al final
    $this->vista = "usuario/colecciones.php"; 
    
    // Y asegúrate de cargar los datos aquí también
    $idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 1;
    $this->datos = $this->modelo->obtenerColeccionUsuario($idUsuario);
    }
}
?>