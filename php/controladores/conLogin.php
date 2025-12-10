<?php 
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modLogin.php';
    class ConLogin {
        public $modeloL;
        public $vista;
        function __construct(){
            $this->modeloL = new ModLogin();
        }

        public function cargarLogin(){
            $correo = $_POST['correo'];
            $pwd = $_POST['pwd'];

            $usuarioEncontrado = $this->modelo->validarUsuario($correo,$pwd);

            if ($usuarioEncontrado)
            {
                session_start();
                $_SESSION['idUsuario'] = $usuarioEncontrado['idUsuario'];
                $_SESSION['nombre'] = $usuarioEncontrado['nombre'];
                $_SESSION['permiso'] = $usuarioEncontrado['permiso'];

                if ($usuarioEncontrado['permiso'] == 'A')
                {
                    header("Location: ../../index.php?c=Dashboard&m=cargarPagina");
                }
                else
                {
                    header("Location: ../../index.php?c=Juego&m=cargarPagina");
                }
                exit();
            }
            else
            {
                echo "<script>alert('El usuario o la contraseña no son correctos.'); window.location.href='login.php';</script>";
            }
        }

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