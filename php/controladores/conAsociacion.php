<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../modelos/modAsociacion.php';

class ConAsociacion {
    private $modelo;
    public $vista;

    public function __construct() {
        $this->modelo = new ModAsociacion();
    }

    public function listar() {
        $this->vista = "listarAsociaciones.php";
    }

    public function insertar() {

    }

    public function modificar() {
        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$_GET['idAsoc']) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación
        $datos = $this->modelo->obtenerPorId();

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaModificarAsociacion.php";
        return $datos;
    }

    public function procesarModificar() {
        // Actualizamos lso datos en la base de datos
        $this->modelo->actualizar();

        // Actualizamos la tabla contribuciones
        $this->modelo->actualizarContribuciones();

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

    public function borrar() {
        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$_GET['idAsoc']) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación
        $datos = $this->modelo->obtenerPorId();

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaEliminarAsociacion.php";
        return $datos;
    }

    public function procesarBorrar() {
        // Primero eliminamos las contribuciones asociadas
        $this->modelo->borrarContribuciones();

        // Luego eliminamos la asociación
        $this->modelo->borrar();

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

}
?>