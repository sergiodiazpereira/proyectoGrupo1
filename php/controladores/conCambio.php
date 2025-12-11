<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modCambio.php';
    class ConCambio{
        public $modeloJ;
        public $idUsuario;
        public $vista;
        function __construct(){
            $this->modeloJ = new ModCambio();
            $this->idUsuario = $_SESSION['idUsuario'];
        }


        /**
         * Esta funcion sirve para darle valor al atributo vista, que será usado en el index.php para hacer el include
         */
        public function cargarPagina(){
            $this->vista="usuario/cambio.php";
        }

        public function traerPwd(){
            $datos=$this->modeloJ->traerPwd($this->idUsuario);
            echo json_encode($datos);
            exit;
        }
        public function modificarPwd(){

            $contraActual = $_POST['contraActual'] ?? '';
            $contraNueva = $_POST['contraNueva'] ?? '';
            
            $usuario = $this->modeloJ->traerPwd($this->idUsuario);
            
            $pwdGuardada = $usuario[0]['contrasenia'];
            
            /*Aqui uso el veryfy para compararar para ver si coinciden las dos contraseñas  */
            if (!password_verify($contraActual, $pwdGuardada)) {
                echo json_encode(['exito' => false, 'mensaje' => 'La contraseña actual es incorrecta']);
                exit;
            }
            
            //Hasheo la contraseña nueva y uso el default para por si no se pasan parametro que no funcione
            $pwdHasheada = password_hash($contraNueva, PASSWORD_DEFAULT);
            $resultado = $this->modeloJ->modificarPwd($this->idUsuario, $pwdHasheada);
            
            // Devolver el resultado
            if ($resultado) {
                echo json_encode(['exito' => true, 'mensaje' => 'Contraseña actualizada correctamente']);
            } else {
                echo json_encode(['exito' => false, 'mensaje' => 'Error al actualizar la contraseña']);
            }
            exit;
        }
        /**
         * Esta funcion sirve para enviar la pagina que se esta cargando actualmente mediante json
         */
        public function obtenerPagina(){
            $this->vista="usuario/cambio.php";
            echo json_encode($this->vista); // Para cargar la pagina en javascript y poder controlarlo con el app.js
            exit;
        }
    }
?>