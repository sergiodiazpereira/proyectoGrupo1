<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../'.MODELO.'modAsociacion.php';

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

        if($this->modelo->modificar() && $this->modelo->modificarContribuciones()){

            if($this->guardarImg()){
                if($this->borrarImg()){
                    $this->vista="mensajeError.php";
                    return "Modificacion exitosa";
                }else{
                    $this->vista="mensajeError.php";
                    return "Fallo al actualizar la imagen";
                }
            }else{
                $this->vista="mensajeError.php";
                return "Fallo al guardar la imagen";
            };
            
        }else{
            $this->vista="mensajeError.php";
            return "No inserta";
        };

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

    private function guardarImg(){
        //
        $destino = RUTAIMG . $_FILES["imagen"]['name'];

        if(!move_uploaded_file($_FILES["imagen"]['tmp_name'], $destino)){
            return false;
        }else{
            return true;
        };
    }

    private function borrarImg(){
        //
        $ruta = RUTAIMG . $_POST['antiguaImagen'];

        if(file_exists($ruta)) {
            return unlink($ruta);
        } else {
            return false;
        }
    }
}
?>