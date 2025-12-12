<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modRegistro.php';

    class ConRegistro{
        public $modelo;

        function __construct()
        {
            $this->modelo = new ModRegistro();
        }
        private function functionValidar(){
            if(empty(trim($_POST['nombre']))){return false;};
            if(empty(trim($_POST['correo']))){return false;};
            if(empty(trim($_POST['pwd']))){return false;};
            if(empty(trim($_POST['pwdConfir']))){return false;};
            if(trim($_POST['pwdConfir'])!=trim($_POST['pwd'])){return false;};
            return true;
        }
        public function cargarRegistro(): void
        {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $pwd = $_POST['pwd'];
            $pwdConfir = $_POST['pwdConfir'];

            $registroHecho = $this->modelo->insertarRegistro($nombre, $correo, $pwd, $pwdConfir );

            if ($registroHecho)
            {
                /* Es un mensaje que te redirige a la página de login.php, lo que hace el replace es sustituir la página en 
                el historial en la que estabas por esa de login */ 
                echo "<script>alert('Ya estás registrado, ahora inicia sesión'); window.location.replace('login.php');</script>";
            }
            else
            {
                echo "<script>alert('Las contraseñas no coinciden o el correo ya está en uso'); window.location.replace('registro.php');</script>";
            }
        }
        public function cargarSuper(){
            if($this->functionValidar()){
                $this->modelo->insertarSuper();
            }
            
        }
    }

    if (isset($_POST['nombre'])) {
        $controlador = new ConRegistro();
        $controlador->cargarRegistro();
    }

?>