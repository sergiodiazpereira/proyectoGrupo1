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
     * Summary of guardarImg
     * @return bool esta funcion guardara una imagen que se asociara a una asociacion
     * y devolvera verdadero o falso dependiendo de si se completa exitosamente o no
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

    /**
     * Summary of validaciones
     * @return bool funcion llamada por la funcion insertar que retornara verdadero si todas las 
     * validaciones son correctas y falso si alguna falla 
     */
    private function validaciones(){

        /*Compruebo si esta vacio y le quito los espacios*/
        if(empty(trim($_POST["nombre"]))){ return false; };

        /*Compruebo si esta vacio , le quito los espacios y controlo el rango del año*/
        $anio = trim($_POST["anio"]);
        if($anio < 1800 || $anio > date('Y')) { return false; }

        /*Compruebo que el logo esta cargado y que no devuelve error*/
        /* Compruebo que el tipo de archivo sea correcto*/
        $tipos = ['image/jpeg','image/png','image/webp'];

        /*comprobamos si el tipo de dato esta dentro de los que se pueden cargar*/
        if (!in_array($_FILES["logo"]['type'], $tipos)) {return false;}

        if(!isset($_FILES["logo"]) || $_FILES["logo"]["error"] !== 0){ return false; };

        /*Estas son las pistas y compruebo que no esten vacias y le quito los espacios*/
        if(empty(trim($_POST["pistaD"]))){ return false; };
        if(empty(trim($_POST["pistaM"]))){ return false; };
        if(empty(trim($_POST["pistaF"]))){ return false; };

        /*Compruebo que el array tenga algo dentro*/
        if(empty($_POST["contribucion"]) || !is_array($_POST["contribucion"])){ return false; }

        return true;

    }

    /**
     * Summary of insertar
     * @return string esta funcion insertara los datos recogidos en la base de datos y devolvera un 
     * en funcion de si ha ido todo bien o fallo algo dependiendo del error
     */
    public function insertar(){

        if($this->validaciones()){

            if($this->guardarImg()){

                if($this->modeloAsoc->insertar()){

                    $this->vista="mensajeCorrecto.php";
                    return "Insercion exitosa";
                }else{
                    $rutaImagen = RUTAIMG.$_FILES["logo"]['name'];
                    if(file_exists($rutaImagen)){

                        if(unlink($rutaImagen)){

                            $this->vista="mensajeIncorrecto.php";
                            return "Fallo al insertar los datos";
                        }else{
                            $this->vista="mensajeIncorrecto.php";
                            return "Fallo en la insercion y no se pudo borrar la imagen";
                        }

                    }else{
                        $this->vista="mensajeIncorrecto.php";
                        return "Imagen no encontrada";
                    }
                }
            }else{
                $this->vista="mensajeIncorrecto.php";
                return "Fallo al guardar la imagen";
            }
        }else{

            $this->vista="mensajeIncorrecto.php";
            return "Datos no validos";
        };
    }

    /**
     * Summary of cargarPaginaAsoc
     * @return array{contribuciones: bool|PDOStatement, tiposAsoc: bool|PDOStatement} esta funcion retornara un array
     * que cargara la vista que dejaremos guardada en $this->vista
     */
    public function cargarPaginaAsoc(){
        $tipos=$this->modeloAsoc->obtenerTipos();
        $contribuciones=$this->modeloCont->obtenerContribuciones();

        $arrayAsoc=[
            "tiposAsoc" => $tipos,
            "contribuciones" => $contribuciones
        ];
        
        $this->vista="vistaAgregarAsociacion.php";
        return $arrayAsoc;
    }
    
}
?>