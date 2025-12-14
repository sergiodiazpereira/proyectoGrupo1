/**
 * Controlador encargado de manejar la lógica del registro de usuarios
 */
export class ControladorRegistro {

    // Constructor que recibe el modelo y la vista
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    /**
     * Envía los datos del registro al modelo
     * @param {*} nombre 
     * @param {*} correo 
     * @param {*} password 
     * @param {*} pwdConfir 
     */
    async enviarRegistro(nombre, correo, password, pwdConfir) {

        // Realizamos las validaciones
        const validacion = this.validar(nombre, correo, password, pwdConfir);
        // Si la validación no es correcta, se muestra el error y se detiene el proceso
        if (validacion !== true) {
            this.vista.mostrarError(validacion);
            return;
        }

        try {
            // Llamada al modelo para registrar el usuario en el servidor
            const result = await this.modelo.registro(nombre, correo, password);

            if (result.exito) {
                // Si el registro fue exitoso, redirige a la página de login
                window.location.href = "login.php";
            } else {
                // Si el servidor devuelve un error
                this.vista.mostrarError(result.error || "Error al registrar usuario");
            }

        } catch (error) {
            // Captura errores de comunicación con el servidor
            this.vista.mostrarError("Error de comunicación con el servidor");
        }
    }

    /**
     * Valida los datos del formulario de registro
     * @param {*} nombre 
     * @param {*} correo 
     * @param {*} password 
     * @param {*} pwdConfir 
     * @returns true si todo es correcto, o un mensaje de error
     */
    validar(nombre, correo, password, pwdConfir) {
        // Verifica que todos los campos estén llenos
        if (!nombre || !correo || !password || !pwdConfir) return "Rellena todos los campos";
        // Expresión regular para validar el formato del correo
        const patronEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronEmail.test(correo)) return "Correo inválido";
        // Verifica la longitud mínima de la contraseña
        if (password.length < 4) return "Contraseña demasiado corta";
        // Comprueba que las contraseñas coincidan
        if (password !== pwdConfir) return "Las contraseñas no coinciden";
        // Si todo es correcto, devuelve true
        return true;
    }
}