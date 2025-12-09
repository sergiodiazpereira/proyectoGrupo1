<?php
    require_once __DIR__.'/../config/conexion.php';
    /**
     * Este es el modelo del dashboard
     */
    class ModDashboard extends Conexion{

        function __construct(){
            parent::__construct();
            
        }
        public function contarVisitas(){
            $sql = "SELECT SUM(visitas) AS total FROM usuario WHERE permiso = 'U'";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)$resultado['total'];
        }
    }
?>