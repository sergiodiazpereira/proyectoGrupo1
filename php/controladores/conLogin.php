<?php 
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modLogin.php';
    class ConLogin {
        public $modelo;
        function __construct(){
            $this->modelo = new ModLogin();
        }

        /**
         * Summary of cargarLogin
         * @return void Esta función valida los campos que hay en el formulario del usuario 
         *  y al usuario que loguea en la aplicación y carga su sesión 
         */
        public function cargarLogin(){
            $correo = $_POST['correo'];
            $pwd = $_POST['pwd'];

            $usuarioEncontrado = $this->modelo->validarUsuario($correo,$pwd);

            if ($usuarioEncontrado)
            {
                session_start();
                $_SESSION['idUsuario'] = $usuarioEncontrado['idUsuario'];
                $_SESSION['nombre'] = $usuarioEncontrado['nombre'];
                $_SESSION['correo'] = $usuarioEncontrado['correo'];
                $_SESSION['permiso'] = $usuarioEncontrado['permiso'];

                // Aqui se pasa a validar en js
                echo json_encode([
                    "exito"   => true,
                    "permiso" => $_SESSION['permiso']
                ]);
            } else {
                // Si no se encuentra el usuario se pasa esto al js
                echo json_encode([
                    "exito"   => false,
                    "mensaje" => "Usuario o contraseña incorrectos"
                ]);
            }
        }
        /**
         * Summary of traerRol
         * @return never devuelve el rol del usuario
         */
        public function traerRol(){
            echo json_encode($_SESSION["permiso"]);
            exit();
        }
        
        /**
         * Summary of cerrarSesion
         * @return never Esta función comprueba primero si no hay ninguna sesión iniciada, si no la hay, la recoge para
         * poder eliminar las variables y luego destruir la sesión, para que luego rediriga de vuelta al login
         */
        public function cerrarSesion()
        {
            /* Lo que hacemos aquí es recoger o recuperar la sesión para poder eliminarla */
            if (session_status() === PHP_SESSION_NONE)
            {
                session_start();
            }

            /* Lo que hacemos es borrar todas las variables almacenadas de la sesión */
            session_unset();

            /* Y aquí prácticamente eliminamos la sesión completamente */
            session_destroy();

            /* Redirigimos el cerrar sesión a la página del login */
            header("Location: vistas/usuario/login.php");
            exit();
        }
    }

    /*Esto es porque no lo voy a hacer con el index, para cuando en el formulario se introduzca el usuario, ejecute esto
    directamente. */
    if (isset($_POST['correo']))
    {
        $controlador = new ConLogin();
        $controlador->cargarLogin();
    }
?>