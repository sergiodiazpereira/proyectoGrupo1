<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de la galería
     */
    class ModGaleria extends Conexion{

        function __construct(){
            parent::__construct();
            
        }





        /**
         * Esta funcion devuelve los datos de las imagenes de la BD
         */
        public function datosImagenes(){
            $sql = "SELECT * FROM galeria;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }





        /**
         * Esta funcion devuelve el id y nombre de las asociaciones de la BD
         */
        public function datosAsociaciones(){
            $sql = "SELECT idAsoc, nombre FROM asociacion;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }





        /**
         * Esta funcion inserta una imagen en la BD
         */
        public function insertarImagenEnBD(){
            try{
                $sql = "INSERT INTO galeria (nombreImagen) VALUES (:nombreImagen)";

                $stmt = $this->conexion->prepare($sql);

                $stmt->bindParam(':nombreImagen', $_FILES["archivo"]["name"]);

                $stmt->execute();
            }catch (PDOException $e){
                return $e->errorInfo[1]; // En la segunda posicion del array errorInfo se encuentra el numero de error, que es lo que voy a utilizar para controlar las excepciones
            }
        }





        public function borrarImagenBD(){
            try{
                $sql = "DELETE FROM galeria WHERE idImagen = :idImagen";

                $stmt = $this->conexion->prepare($sql);

                $stmt->bindParam(':idImagen', $_POST["idImagen"]);

                $stmt->execute();
                return true;
            }catch (PDOException $e){
                return false;
            }
        }
    }
?>