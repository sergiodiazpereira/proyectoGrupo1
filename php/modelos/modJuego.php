<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModJuego extends Conexion{

        function __construct(){
            parent::__construct();
        }
        /**
         * Summary of datosAsociaciones
         * @return array recoge todos los datos de las asociaciones
         */
        public function datosAsociaciones(){
            $sql = "SELECT asociacion.idAsoc, asociacion.nombre, asociacion.fecha_fun, asociacion.pista_facil, 
                        asociacion.pista_media, 
                        asociacion.pista_dificil, 
                        asociacion.imagen, 
                        asociacion.alcance,
                        asociacion.imagen,
                        tipo_asoc.nombre as nombre_tipo
                    FROM asociacion
                    INNER JOIN tipo_asoc ON asociacion.idTipoAsoc = tipo_asoc.idTipoAsoc
                    ORDER BY asociacion.nombre ASC";
            
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            
            // En esta variable recogemos la consulta y la hacemos en array asociativo
            $listaAsociaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);

            foreach ($listaAsociaciones as $key => $asoc) {
                
                $id = $asoc['idAsoc'];
                
                $sqlContri = "SELECT c.descripcion 
                    FROM contribucion c
                    INNER JOIN asoc_contribucion ac ON c.idContribucion = ac.idContribucion
                    WHERE ac.idAsoc = :id";

                $stmt = $this->conexion->prepare($sqlContri);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $nombresContribuciones = $stmt->fetchAll(PDO::FETCH_COLUMN);
                
                if (!empty($nombresContribuciones)) {
                    $listaAsociaciones[$key]['contribuciones'] = implode(',', $nombresContribuciones);
                } else {
                    $listaAsociaciones[$key]['contribuciones'] = "Sin datos";
                }
            }

            return $listaAsociaciones; 
        }

        /**
         * Esta método inserta las asociaciones adivinadas, el tiempo, la fecha y el jugador en la tabla intentos
         * @return bool esta funcion retornara o true o false dependiendo si la insercion ha sido exitosa
         */
        public function insertar(){
            try{

                // Consulta para insertar los aciertos de asociaciones
                $sql = "INSERT INTO intento (fecha_intento, tiempo_empleado, idUsuario, idAsoc) VALUES (?,?,?,?)";

                // Preparamos la consulta
                $stmt = $this->conexion->prepare($sql);
                
                // Asociamos los parametros
                $stmt->bindParam(1, $_POST["fecha_intento"]);
                $stmt->bindParam(2, $_POST["tiempo_empleado"]);
                $stmt->bindParam(3, $_SESSION["idUsuario"]);
                $stmt->bindParam(4, $_POST["idAsoc"]);
                
                // Ejecutamos la consulta
                $stmt->execute();

                // Retornamos true si todo fue correcto
                return true;

            }catch(PDOException $e){
                // Si salta excepción
                return $e->getMessage();
            }
        }

    }
?>