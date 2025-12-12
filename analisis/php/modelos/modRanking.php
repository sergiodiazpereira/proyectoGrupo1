<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del ranking
     */
    class ModRanking extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function sacarRanking(){
            $sql="SELECT u.nombre AS jugador, a.nombre AS asociacion, i.fecha_intento AS fecha, i.tiempo_empleado AS tiempo
                FROM intento i INNER JOIN usuario u
				ON i.idUsuario = u.idUsuario
                INNER JOIN asociacion a
                ON i.idAsoc = a.idAsoc
                ORDER BY i.tiempo_empleado ASC
                LIMIT 10";
            $stmt= $this->conexion->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }
?>