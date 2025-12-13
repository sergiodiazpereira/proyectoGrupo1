<?php
    require_once __DIR__.'/modRegistroS.php';

    class conRegistroS{
        public $modelo;
        public $vista;

        function __construct(){
            $this->modelo = new ModRegistroS();
        }
        private function functionValidar(){
            if(empty(trim($_POST['nombreS']))){return false;};
            if(empty(trim($_POST['correoS']))){return false;};
            if(empty(trim($_POST['pwdS']))){return false;};
            if(empty(trim($_POST['pwdConfirS']))){return false;};
            if(trim($_POST['pwdConfirS'])!=trim($_POST['pwdS'])){return false;};
            return true;
        }
        public function cargarSuper(){
            if($this->functionValidar()){
                if($this->modelo->insertarSuper()){
                    if($this->modelo->ejecutarScript()){
                        // Redirect to the external cleanup script to avoid file lock issues
                        $this->vista="REDIRECT";
                        return "Felicidades Juego Instalado";
                    }else{
                        $this->vista="Incorrecto.php";
                        return "Fallo al ejecutar la carga de datos";
                    }
                }else{
                    $this->vista="Incorrecto.php";
                    return "No se pudo crear el Super Admin";
                }
            }else{
                $this->vista="Incorrecto.php";
                return "Alguno dato no es valido";
            }
        }
        // Function removed as deletion is handled by ../php/exito_instalacion.php
    }
?>