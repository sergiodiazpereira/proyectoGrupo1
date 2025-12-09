<?php
    require_once __DIR__.'/../config/configdb.php';

    class Conexion{
        protected $conexion;

        function __construct(){

            try{
                $this->conexion = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD,USUARIO,PASSWORD);
                /*Le ponemos esto para trabajar por defecto con fetch objetos */
                $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
        }
    }
?>