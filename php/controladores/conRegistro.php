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
            // Validamos que lleguen los datos
            if (!isset($_POST['nombre']) || !isset($_POST['correo']) || !isset($_POST['pwd'])) {
                echo json_encode([
                    "exito" => false,
                    "error" => "Datos incompletos"
                ]);
                return;
            }

            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $pwd = $_POST['pwd'];
            // La validación de que pwd == pwdConfir ya se hizo en JS.
            // Pasamos $pwd dos veces para satisfacer la firma del método del modelo.
            
            $registroHecho = $this->modelo->insertarRegistro($nombre, $correo, $pwd, $pwd );

            if ($registroHecho)
            {
                echo json_encode([
                    "exito" => true,
                    "mensaje" => "Usuario registrado correctamente"
                ]);
            }
            else
            {
                // El modelo devuelve false si las pass no coinciden (aquí imposible) o si hay duplicado
                echo json_encode([
                    "exito" => false,
                    "error" => "El correo ya está en uso o hubo un error en el registro"
                ]);
            }
        }
    }

    if (isset($_POST['nombre'])) {
        $controlador = new ConRegistro();
        $controlador->cargarRegistro();
    }
?>