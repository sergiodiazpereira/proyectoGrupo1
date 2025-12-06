<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de conAsociacion que extiende de conexion
     */
    class ModAsociacion extends Conexion {

        function __construct() {
            parent::__construct(); 
        }

        /**
         * Obtiene la lista de asociaciones con su tipo.
         *
         * @return array
         */
        public function listar() {
            $sql = "SELECT a.*,
                   t.nombre AS tipo_asociacion
                FROM asociacion a
                INNER JOIN tipo_asoc t 
                    ON a.idTipoAsoc = t.idTipoAsoc
                ORDER BY a.nombre DESC";
            
            $consulta = $this->conexion->prepare($sql);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Devuelve todos los tipos de asociación.
         *
         * @return array
         */
        public function listarTipos() {
            $sql = "SELECT * FROM tipo_asoc";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();

            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $datos;
        }

        /**
         * Obtiene una asociación por su ID.
         * 
         * Recoge:
         *  - GET['idAsoc']
         * 
         * @return array
         */
        public function obtenerPorId() { 
            $sql = "SELECT * FROM asociacion WHERE idAsoc = :idAsoc";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':idAsoc', $_GET['idAsoc'], PDO::PARAM_STR);

            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

            return $datos;
        }

        /**
         * Actualiza una asociación existente.
         *
         * Recoge:
         *  - GET['idAsoc']
         *  - POST[nombre, fecha_fun, pistas..., idTipoAsoc, alcance]
         *  - FILES['imagen']
         *
         * @return bool true si la actualización fue correcta.
         */
        public function modificar() {

            try {
                // Actualizamos los datos de la asociación
                $sql = "UPDATE asociacion 
                        SET nombre = :nombre,
                            fecha_fun = :fecha_fun,
                            pista_facil = :pista_facil,
                            pista_media = :pista_media,
                            pista_dificil = :pista_dificil,
                            imagen = :imagen,
                            idTipoAsoc = :idTipoAsoc,
                            alcance = :alcance
                        WHERE idAsoc = :idAsoc";

                $stmt = $this->conexion->prepare($sql);

                $stmt->bindParam(':nombre', $_POST['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_fun', $_POST['fecha_fun'], PDO::PARAM_INT);
                $stmt->bindParam(':pista_facil', $_POST['pista_facil'], PDO::PARAM_STR);
                $stmt->bindParam(':pista_media', $_POST['pista_media'], PDO::PARAM_STR);
                $stmt->bindParam(':pista_dificil', $_POST['pista_dificil'], PDO::PARAM_STR);
                $stmt->bindParam(':idTipoAsoc', $_POST['idTipoAsoc'], PDO::PARAM_INT);
                $stmt->bindParam(':alcance', $_POST['alcance'], PDO::PARAM_STR);
                $stmt->bindParam(':imagen', $_FILES['imagen']['name'], PDO::PARAM_STR);
                $stmt->bindParam(':idAsoc', $_GET['idAsoc'], PDO::PARAM_INT);

                $stmt->execute();
                return true;

            } catch (Exception $e) {
                return false;
            }
        }

        /**
         * Actualiza las contribuciones asociadas.
         *
         * Recoge:
         *  - GET['idAsoc']
         *  - POST['contribuciones'][] = ids
         *
         * @return bool true si la actualización fue correcta.
         */
        public function modificarContribuciones() {

            try {
                // Eliminar las antiguas contribuciones
                $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
                $stmt = $this->conexion->prepare($sql);

                $stmt->bindParam(':id', $_GET["idAsoc"]);

                $stmt->execute();

                // Si el array de contribuciones no está vacio insertamos
                if (!empty($_POST['contribuciones'])) {

                    // Insertamos las nuevas contribuciones
                    foreach ($_POST['contribuciones'] as $idContribucion) {
                        $sql = "INSERT INTO asoc_contribucion (idAsoc, idContribucion)
                                VALUES (:idAsoc, :idContribucion)";

                        $stmt = $this->conexion->prepare($sql);

                        $stmt->bindParam(':idAsoc', $_GET["idAsoc"]);
                        $stmt->bindParam(':idContribucion', $idContribucion);

                        $stmt->execute();
                    }
                }
                return true;

            } catch (Exception $e) {
                return false;
            }
        
        }

        /**
         * Borra una asociación y sus relaciones.
         * 
         * Recoge:
         *  - GET['idAsoc']
         * 
         * @return bool true si el borrado fue correcto.
         */
        public function borrar() {
            try {
                // Iniciamos una transacción porque trabajaremos varias consultas de borrado
                $this->conexion->beginTransaction();
                $idAsoc = $_GET['idAsoc'];

                $sql = "DELETE FROM asoc_contribucion WHERE idAsoc = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idAsoc, PDO::PARAM_INT);
                $stmt->execute();

                $sql = "DELETE FROM asociacion WHERE idAsoc = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $idAsoc, PDO::PARAM_INT);
                $stmt->execute();

                // Si hemos llegado a este punto sin errores en las consultas guardamos los cambios
                $this->conexion->commit();
                return true;

            } catch (Exception $e) {
                // Si hubo algun error en las consultas se hace un rollback y se descartan los cambios
                $this->conexion->rollBack();
                return false;
            }
        }
        
        /**
         * Summary of insertar
         * @return bool esta funcion retornara o true o false dependiendo si la insercion ha sido exitosa
         */
        public function insertar(){
            try{
                $this->conexion->beginTransaction();
                $sql="INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media,pista_dificil , imagen, idTipoAsoc, alcance) VALUES (?,?,?,?,?,?,?,?)";

                $stmt=$this->conexion->prepare($sql);
                
                $stmt->bindParam(1,$_POST["nombre"]);
                $stmt->bindParam(2,$_POST["anio"]);
                $stmt->bindParam(3,$_POST["pistaF"]);
                $stmt->bindParam(4,$_POST["pistaM"]);
                $stmt->bindParam(5,$_POST["pistaD"]);
                $stmt->bindParam(6,$_FILES['logo']['name']);
                
                $stmt->bindParam(7,$_POST["categoria"]);
                $stmt->bindParam(8,$_POST["alcanceGeografico"]);
                
                if($stmt->execute()){
                    
                    if($this->insertarTablaMediaContri($this->conexion->lastInsertId())){
                        $this->conexion->commit();
                        return true;
                    }else{
                        return false;
                    };
                };
                
            }catch(PDOException $e){
                $this->conexion->rollBack();
                return false;
            }
        }

        /**
         * Summary of insertarTablaMediaContri
         * @param mixed $ultimoId este parametro recoje el id de la ultima fila editada que 
         *servira para hacer la insercion en la tabla intermedia
         * @return bool esta funcion hace la insercion en la tabla intermedia de las asociaciones con sus contribuciones
         *de vuelve true o false si se realiza o no
         */
        private function insertarTablaMediaContri($ultimoId){
            try{
                $sql = "INSERT INTO asoc_contribucion VALUES (?, ?)";
                $stmt = $this->conexion->prepare($sql);

                foreach($_POST["contribucion"] as $valor) {
                    $stmt->bindValue(1, $ultimoId, PDO::PARAM_INT);
                    $stmt->bindValue(2, $valor, PDO::PARAM_INT);
                    $stmt->execute();
                }
                return true;

            }catch(PDOException $e){
                return false;
            }   
        }
        
        /**
         * Summary of obtenerTipos
         * @return bool|PDOStatement esta funcion obtiene los tipos de asociacion que tenemos
         */
        public function obtenerTipos(){
            $sql="SELECT * FROM tipo_asoc;";
            $stmt=$this->conexion->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }
?>