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



        public function datosUsuariosNuevos(){
            $sql = "SELECT nombre, fecha_registro FROM usuario ORDER BY fecha_registro DESC LIMIT 10;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }



        public function contarAsociaciones(){
            $sql = "SELECT COUNT(*) as total FROM asociacion";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)$resultado['total']; 
        }



        public function contarUsuarios(){
            $sql = "SELECT COUNT(*) as total FROM usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)$resultado['total']; 
        }



        public function contarContribuciones(){
            $sql = "SELECT COUNT(*) as total FROM contribucion";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)$resultado['total']; 
        }
    }
?>