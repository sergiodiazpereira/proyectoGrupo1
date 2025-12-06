<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo de conAsociacion que extiende de conexion
     */
    class ModAsociacion extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        /**
         * Summary of insertar
         * @return bool esta funcion retornara o true o false dependiendo si la insercion ha sido exitosa
         */
        public function insertar(){
            try{
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
                        return true;
                    }else{
                        return false;
                    };
                };
                
            }catch(PDOException $e){
                echo $e->getMessage();
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
                echo $e->getMessage();
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