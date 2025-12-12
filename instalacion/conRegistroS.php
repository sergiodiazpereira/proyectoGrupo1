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

                    if($this->borrarInstalacion()){
                        $this->vista="Correcto.php";
                        return "Felicidades Juego Instalado";
                    }else{
                        $this->vista="Incorrecto.php";
                        return "No se pudo borrar la carpeta";
                    };
                }else{
                    $this->vista="Incorrecto.php";
                    return "No se pudo crear el Super Admin";
                }
            }else{
                $this->vista="Incorrecto.php";
                return "Alguno dato no es valido";
            }
        }
        public function borrarInstalacion(){
            function eliminarDirectorio($dir) {
                $dir="./instalacion";
            if (!is_dir($dir)) {
                return false; 
            }
            /* Obtiene todos los archivos y carpetas*/
            $items = glob($dir . '/*'); 
            foreach ($items as $item) {
                if (is_dir($item)) {
                    unlink($item); 
                }
            }
            rmdir($dir); 
            return true;
            }
        }
    }
?>