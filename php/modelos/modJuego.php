<?php
    require_once __DIR__.'/../config/conexion.php';

    class ModJuego extends Conexion{

        function __construct(){
            parent::__construct();
        }
        
        public function datosAsociaciones(){
            // 1. PRIMERO: Sacamos las asociaciones limpias (sin mezclar contribuciones aun)
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
            
            // Convertimos a Array Asociativo
            $listaAsociaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);

            // 2. SEGUNDO: Vamos una por una buscándole sus contribuciones
            foreach ($listaAsociaciones as $key => $asoc) {
                
                $id = $asoc['idAsoc'];
                
                // Buscamos las contribuciones SOLO para este ID
                $sqlContri = "SELECT c.descripcion 
                    FROM contribucion c
                    INNER JOIN asoc_contribucion ac ON c.idContribucion = ac.idContribucion
                    WHERE ac.idAsoc = :id";

                $stmt = $this->conexion->prepare($sqlContri);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                // Obtenemos lista simple: ['Salud', 'Educación']
                $nombresContribuciones = $stmt->fetchAll(PDO::FETCH_COLUMN);
                
                // 3. TERCERO: Convertimos la lista en un String separado por comas
                // Si la lista está vacía, ponemos un texto por defecto
                if (!empty($nombresContribuciones)) {
                    $listaAsociaciones[$key]['contribuciones'] = implode(',', $nombresContribuciones);
                } else {
                    $listaAsociaciones[$key]['contribuciones'] = "Sin datos";
                }
            }

            return $listaAsociaciones; 
        }

        /**
         * Summary of insertar
         * @return bool esta funcion retornara o true o false dependiendo si la insercion ha sido exitosa
         */
        public function insertar(){
            try{
                $data = json_decode(file_get_contents("php://input"), true);

                $sql="INSERT INTO intento (tiempo_empleado, idUsuario, idAsoc) VALUES (?,?,?)";

                $stmt=$this->conexion->prepare($sql);
                
                $stmt->bindParam(1,$data["tiempo_empleado"]);
                $stmt->bindParam(2,$data["idUsuario"]);
                $stmt->bindParam(3,$data["idAsoc"]);
                
                $stmt->execute();

                echo json_encode(["exito" => true]);
                return true;
            }catch(PDOException $e){
                echo json_encode(["exito" => false, "error" => $e->getMessage()]);
                return false;
            }
        }

    }
?>