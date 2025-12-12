<?php 
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modLogin.php';
    class ConLogin {
        public $modelo;
        function __construct(){
            $this->modelo = new ModLogin();
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

        public function traerRol(){
            echo json_encode($_SESSION["permiso"]);
            exit();
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