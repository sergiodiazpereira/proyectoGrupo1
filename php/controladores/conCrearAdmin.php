<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'/modCrearAdmin.php';

    class ConCrearAdmin{
        public $modelo;
        public $vista;
        function __construct()
        {
            $this->modelo = new ModCrearAdmin();
        }

        public function cargarPagina()
        {
            $this->vista="admin/crearAdmin.php";
        }

        private function functionValidar(){
            if(empty(trim($_POST['nombreAdmin']))){return false;};
            if(empty(trim($_POST['correoAdmin']))){return false;};
            if(empty(trim($_POST['contraActual']))){return false;};
            if(empty(trim($_POST['contraConfirmar']))){return false;};
            if(trim($_POST['contraConfirmar'])!=trim($_POST['contraActual'])){return false;};
            return true;
        }

        public function guardarAdmin(): void
        {
            
            $nombreAdmin = $_POST['nombreAdmin'];
            $correoAdmin = $_POST['correoAdmin'];
            $contraActual = $_POST['contraActual'];
            $contraConfirmar = $_POST['contraConfirmar'];

            if($this->functionValidar()){
                $adminRegistrado = $this->modelo->introducirAdmin($nombreAdmin, $correoAdmin, $contraActual, $contraConfirmar);
            
                if ($adminRegistrado == true)
                {
                    /* Es un mensaje que te redirige a la página de login.php, lo que hace el replace es sustituir la página en 
                    el historial en la que estabas por esa de login */ 
                    echo "<script>alert('Ya está registrado el administrador'); window.location.replace('index.php?c=Usuarios&m=cargarPagina');</script>";
                }else{
                    echo "<script>alert('Las contraseñas no coinciden o el correo ya está en uso'); window.location.replace('index.php?c=CrearAdmin&m=cargarPagina');</script>";
                }
                
            }else{
                echo "<script>alert('Las contraseñas no coinciden o el correo ya está en uso'); window.location.replace('index.php?c=CrearAdmin&m=cargarPagina');</script>";
            }

            
        }
    }

    if (isset($_POST['nombreAdmin'])) {
        $controlador = new ConCrearAdmin();
        $controlador->guardarAdmin();
    }
?>