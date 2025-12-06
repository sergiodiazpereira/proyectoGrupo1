<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../'.MODELO.'modAsociacion.php';
require_once __DIR__.'/../'.MODELO.'modContribucion.php';

class ConAsociacion {
    private $modeloAsoc;
    private $modeloCont;
    public $vista;

    public function __construct() {
        $this->modeloAsoc = new ModAsociacion();
        $this->modeloCont = new ModContribucion();
    }

    /**
     * Lista todas las asociaciones.
     * 
     * @return array Datos de las asociaciones obtenidas del modelo.
     */
    public function listar() {
        // Obtenemos los datos de la BD
        $datos = $this->modeloAsoc->listar();

        // Indicamos la vista
        $this->vista = "listarAsociaciones.php";

        // Retornamos los datos
        return $datos;
    }

    /**
     * Muestra el formulario de inserción.
     * 
     */
    public function insertar() {

    }

    /**
     * Muestra los datos de una asociación para modificarla.
     * 
     * Recoge:
     *  - GET['idAsoc'] → ID de la asociación a modificar.
     * 
     * @return array Datos de la asociación + tipos + contribuciones.
     */
    public function modificar() {
        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$_GET['idAsoc']) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación, sus tipos y contribuciones
        $asociacion  = $this->modeloAsoc->obtenerPorId();
        $tipo_asoc = $this->modeloAsoc->listarTipos();
        $contribuciones = $this->modeloCont->listar();
        $contribucionesAsoc = $this->modeloCont->listarContribucionesAsociacion();

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

        // Retornamos el array de datos
        return $datos;
    }

    /**
     * Procesa la modificación de una asociación.
     * 
     * Recoge:
     *  - GET['idAsoc']
     *  - POST[nombre, fecha_fun, pistas..., idTipoAsoc, alcance]
     *  - FILES['imagen']
     * 
     * @return string Mensaje de éxito o error.
     */
    public function procesarModificar() {
        // Actualizamos los datos en la base de datos
        $this->modeloAsoc->modificar();

        // Actualizamos la tabla contribuciones
        $this->modeloAsoc->modificarContribuciones();

        // Comrpovamos si se ha hecho el modificar de las asociciaciones y contribuciones
        if($this->modeloAsoc->modificar() && $this->modeloAsoc->modificarContribuciones()){

            // Si se ha hecho se guarda la imagen
            if($this->guardarImg()){
                // Si se ha guardado la imagen borramos su antigua imagen
                if($this->borrarImg()){
                    // Mostramos la vista informativa
                    $this->vista="mensajeInfo.php";
                    // Retornamos el mensaje a la vista
                    return "OK: Modificacion exitosa";
                }else{
                    // Mostramos la vista informativa
                    $this->vista="mensajeInfo.php";
                    // Retornamos el mensaje a la vista
                    return "ERROR: Fallo al actualizar la imagen";
                }
            }else{
                // Mostramos la vista informativa
                $this->vista="mensajeInfo.php";
                // Retornamos el mensaje a la vista
                return "ERROR: Fallo al guardar la imagen";
            };
            
        }else{
            // Mostramos la vista informativa
            $this->vista="mensajeInfo.php";
            // Retornamos el mensaje a la vista
            return "ERROR: No inserta";
        };

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

    /**
     * Muestra la vista para confirmar el borrado.
     * 
     * Recoge:
     *  - GET['idAsoc']
     * 
     * @return array Datos de la asociación.
     */
    public function borrar() {
        // Si el idAsoc es nulo te devuelte a la lista de asociaciones
        if (!$_GET['idAsoc']) {
            header("Location: index.php?c=Asociacion&m=listar");
            exit;
        }

        // Obtenemos los datos de la asociación
        $datos = $this->modeloAsoc->obtenerPorId();

        // Establecemos la vista y devolvemos el array de datos
        $this->vista = "vistaBorrarAsociacion.php";
        return $datos;
    }

    /**
     * Procesa el borrado definitivo de la asociación.
     * 
     * Recoge:
     *  - GET['idAsoc']
     */
    public function procesarBorrar() {
        // Luego eliminamos la asociación
        $this->modeloAsoc->borrar();

        // Redirigimos a la lista de asociaciones
        header("Location: index.php?c=Asociacion&m=listar");
        exit;
    }

    /**
     * Guarda la imagen subida en el directorio correspondiente.
     * 
     * Recoge:
     *  - FILES['imagen']
     * 
     * @return bool true si se movió correctamente.
     */
    private function guardarImg(){
        // Creamos la ruta destino concatenando la constante RUTAIMG con el nombre del archivo
        $destino = RUTAIMG . $_FILES["imagen"]['name'];

        // Usamos move_uploaded_file() para mover la imagen desde la carpeta temporal al directorio final
        if(!move_uploaded_file($_FILES["imagen"]['tmp_name'], $destino)){
            return false;
        }else{
            return true;
        };
    }

    /**
     * Borra la imagen antigua.
     * 
     * Recoge:
     *  - POST['antiguaImagen']
     * 
     * @return bool true si se borró correctamente.
     */
    private function borrarImg(){
        // Creamos la ruta destino concatenando la constante RUTAIMG con el nombre del archivo
        $ruta = RUTAIMG . $_POST['antiguaImagen'];

        // Comprobamos si el archivo existe mediante file_exists()
        if(file_exists($ruta)) {
            // Si existe, lo elimina usando unlink()
            return unlink($ruta);
        } else {
            return false;
        }
    }
}
?>