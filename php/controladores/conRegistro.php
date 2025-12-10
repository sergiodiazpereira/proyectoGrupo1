<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../'.MODELO.'modRegistro.php';

    class ConRegistro{
        public $modelo;

        function __construct()
        {
            $this->modelo = new ModRegistro();
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
                echo "<script>alert('Ya estás registrado, ahora inicia sesión'); window.location.href='login.php';</script>";
            }
            else
            {
                echo "<script>alert('Las contraseñas no coinciden'); window.location.href='resgistro.php';</script>";
            }
        }
    }

?>