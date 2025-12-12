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
            /* El trim lo pongo para que tanto al principio o al final de las cadenas te borre los espacios 
            que pongas sin querer */
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $pwd = $_POST['pwd'];
            $pwdConfir = $_POST['pwdConfir'];

            if (empty($nombre) || empty($correo) || empty($pwd) || empty($pwdConfir)) 
            {
                /* Vuelve hacia atrás (la misma página), si no cumple las validaciones necesarias */
                echo "<script>alert('Todos los campos obligatorios'); window.history.back();</script>";
                exit;
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) 
            {
                /* Esta es una validación de php que comprueba si el correo está en el formato correcto */
                echo "<script>alert('El formato del correo electrónico no es válido'); window.history.back();</script>";
                return;
            }

            if ($pwd !== $pwdConfir) 
            {
                echo "<script>alert('Las contraseñas no coinciden'); window.history.back();</script>";
                return;
            }

            if (strlen($pwd) < 8) 
            {
                /* Esta es una validación para que la contraseña tenga un mínimo de caracteres */
                echo "<script>alert('La contraseña es muy corta, debe tener al menos 8 caracteres'); window.history.back();</script>";
                return;
            }

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
    }

    if (isset($_POST['nombre'])) {
        $controlador = new ConRegistro();
        $controlador->cargarRegistro();
    }

?>