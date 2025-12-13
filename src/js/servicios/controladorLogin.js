/**
 * Controlador encargado de manejar la lógica del inicio de sesión
 */
export class ControladorLogin {

    // Constructor que recibe el modelo y la vista
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    /**
     * Envía los datos del login al modelo
     * @param {*} correo 
     * @param {*} password 
     */
    async enviarLogin(correo, password) {

        // Validamos los datos recibidos
        const validacion = this.validar(correo, password);
        // Si la validación falla, se muestra el error y se detiene el proceso
        if (validacion !== true) {
            this.vista.mostrarError(validacion);
            return;
        }

        try {
            // Llamada al modelo para verificar las credenciales en el servidor
            const result = await this.modelo.login(correo, password);
            // Si el login no fue exitoso, se muestra el mensaje de error
            if (!result.exito) {
                this.vista.mostrarError(result.msg || result.mensaje);
                return;
            }

            // Redirección según el tipo de permiso del usuario
            if (result.permiso === 'A' || result.permiso === 'S') {
                // Administrador o Supervisor al Dashboard
                window.location.href = "../../index.php?c=Dashboard&m=cargarPagina";
            } else {
                // Usuario normal al Juego
                window.location.href = "../../index.php?c=Juego&m=cargarPagina";
            }

        } catch (error) {
            // Capturamos errores de comunicación con el servidor
            this.vista.mostrarError("Error de comunicación con el servidor");
        }
    }

    /**
     * Valida los datos del formulario de login
     * @param {*} correo 
     * @param {*} password 
     * @returns true si los datos son correctos, o un mensaje de error
     */
    validar(correo, password) {
        // Verifica que los campos no estén vacíos
        if (!correo || !password) return "Rellena todos los campos";
        // Expresión regular para validar el formato del correo
        const patronEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronEmail.test(correo)) return "Correo inválido";
        // Verifica la longitud mínima de la contraseña
        if (password.length < 4) return "Contraseña demasiado corta";
        // Si todo es correcto, devuelve true
        return true;
    }
}