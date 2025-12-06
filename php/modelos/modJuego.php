<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del juego
     */
    class ModJuego extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        
        public function datosAsociaciones(){
            $sql = "SELECT idAsoc, asociacion.nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, tipo_asoc.nombre as nombre_tipo, alcance 
                    FROM asociacion
                    INNER JOIN tipo_asoc
                    ON asociacion.idTipoAsoc = tipo_asoc.idTipoAsoc
                    ORDER BY asociacion.nombre ASC";
            
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(); // Formato objeto por defecto
        }
    }
?>