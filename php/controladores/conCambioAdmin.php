<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'/modCambioAdmin.php';
    class ConCambioAdmin{
        public $modelo;
        public $vista;
        function __construct(){
            $this->modelo = new ModCambioAdmin();
            if (session_status() === PHP_SESSION_NONE) 
            {
                session_start();
            }
        }
        public function cargarPagina(){
            $this->vista="admin/cambioAdmin.php";
        }
        
        public function cambiarContrasenia()
        {

            $correoAdmin = $_SESSION['correo'] ?? null;
            
            if (!$correoAdmin) {
                echo "<script>alert('No hay sesión activa'); window.location.replace('login.php');</script>";
                return;
            }

            $contraActual = $_POST['contraActual'];
            $contraNueva  = $_POST['contraNueva'];
            $contraConfir = $_POST['contraConfir'];

            if (empty($contraActual) || empty($contraNueva) || empty($contraConfir)) 
            {
                echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
                exit;
            }

            if ($contraNueva !== $contraConfir) 
            {
                echo "<script>alert('Las nuevas contraseñas no coinciden'); window.history.back();</script>";
                exit;
            }

            $guardarHash = $this->modelo->recogerContrasenia($correoAdmin);

            if (!$guardarHash) 
            {
                echo "<script>alert('El usuario no existe en la base de datos'); window.location.replace('index.php?c=CambioAdmin&m=cargarPagina');</script>";
                exit;
            }
            if (!password_verify($contraActual, $guardarHash)) 
            {
                echo "<script>alert('La contraseña actual es incorrecta'); window.history.back();</script>";
                exit;
            }

            $nuevoHash = password_hash($contraNueva, PASSWORD_DEFAULT);
            $comprobar = $this->modelo->modificarContrasenia($correoAdmin, $nuevoHash);

            if ($comprobar) 
            {
                echo "<script>alert('Ya se ha modificado la contraseña correctamente'); window.location.replace('index.php?c=Dashboard&m=cargarPagina');</script>";
                exit;
            }
        }
    }
?>