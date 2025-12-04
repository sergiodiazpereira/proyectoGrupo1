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
        $asociacion  = $this->modelo->obtenerPorId();
        $tipo_asoc = $this->modelo->listarTipos();
        $contribuciones = $this->modelo->listarContribuciones();
        $contribucionesAsoc = $this->modelo->listarContribucionesAsociacion($_GET['idAsoc']);

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaModificarAsociacion.php";

        // Aplano el array antes de devolverlo
        $datos = array_merge(
            $asociacion,
            [
                'tipo_asoc'          => $tipo_asoc,
                'contribuciones'     => $contribuciones,
                'contribucionesAsoc' => $contribucionesAsoc
            ]
        );

        return $datos;
    }

    public function procesarModificar() {
        // Actualizamos lso datos en la base de datos
        $this->modelo->modificar();

        // Actualizamos la tabla contribuciones
        $this->modelo->modificarContribuciones();

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
        $this->vista = "vistaBorrarAsociacion.php";
        return $datos;
    }

    public function procesarBorrar() {
        // Luego eliminamos la asociación
        $this->modelo->borrar();

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

}
?>