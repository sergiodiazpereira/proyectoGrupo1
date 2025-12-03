<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../modelos/modAsociacion.php';

class ConAsociacion {
    public $vista;

    public function insertar() {

    }

     public function modificar() {
        // Obtenemos el id de la asociación a modificar
        $idAsoc = $_GET['idAsoc'] ?? null;

        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$idAsoc) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación
        $fila = $this->modelo->obtenerPorId($idAsoc);

        // Guardamos los datos de la asociación en un array
        $datos = [
            'idAsoc' => $fila['idAsoc'],
            'nombre' => $fila['nombre'],
            'fecha_fun' => $fila['fecha_fun'],
            'pista_facil' => $fila['pista_facil'],
            'pista_media' => $fila['pista_media'],
            'pista_dificil' => $fila['pista_dificil'],
            'imagen' => $fila['imagen'],
            'idTipoAsoc' => $fila['idTipoAsoc'],
            'alcance' => $fila['alcance'],
            'contribuciones' => $this->modelo->obtenerContribuciones($idAsoc) // array de IDs
        ];

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaModificarAsociacio.php";
        return $datos;
    }

    public function procesarModificar() {
        // Obtenemos el id de la asociación
        $idAsoc = $_POST['idAsoc'];

        // Subida de la imagen
        $imagen = $_POST['imagen_actual'] ?? null;
        if (!empty($_FILES['imagen']['name'])) {
            $nombreImg = time() . "_" . $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/" . $nombreImg);
            $imagen = $nombreImg;
        }

        // Guardamos los datos de la asociación en un array
        $datos = [
            'nombre' => $_POST['nombre'],
            'fecha_fun' => $_POST['fecha_fun'],
            'pista_facil' => $_POST['pista_facil'],
            'pista_media' => $_POST['pista_media'],
            'pista_dificil' => $_POST['pista_dificil'],
            'imagen' => $imagen,
            'idTipoAsoc' => $_POST['idTipoAsoc'],
            'alcance' => $_POST['alcance']
        ];

        // Actualizamos lso datos en la base de datos
        $this->modelo->actualizar($idAsoc, $datos);

        // Actualizamos la tabla contribuciones
        $contribuciones = $_POST['contribuciones'] ?? [];
        $this->modelo->actualizarContribuciones($idAsoc, $contribuciones);

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

    public function borrar() {
        // Obtenemos el id de la asociación a modificar
        $idAsoc = $_GET['idAsoc'] ?? null;

        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$idAsoc) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación
        $fila = $this->modelo->obtenerPorId($idAsoc);

        // Guardamos los datos necesarios en un array
        $datos = [
            'idAsoc' => $fila['idAsoc'],
            'nombre' => $fila['nombre']
        ];

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaModificarAsociacion.php";
        return $datos;
    }

    public function procesarEliminar() {
        // Obtenemos el id de la asociación a eliminar
        $idAsoc = $_POST['idAsoc'];

        // Primero eliminamos las contribuciones asociadas
        $this->modelo->borrarContribuciones($idAsoc);

        // Luego eliminamos la asociación
        $this->modelo->eliminar($idAsoc);

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

    public function listar() {
        $this->vista = 'listarAsociaciones.php';
    }
}
?>