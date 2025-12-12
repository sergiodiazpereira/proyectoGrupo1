<?php
    require_once __DIR__.'/modRegistroS.php';

    class conRegistroS{
        public $modelo;

        function __construct()
        {
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
                $this->modelo->insertarSuper();
                
            }
        }
    }

?>