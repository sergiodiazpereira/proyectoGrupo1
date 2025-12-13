export class ControladorRegistro {

    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    async enviarRegistro(nombre, correo, password, pwdConfir) {

        // Validación CLIENTE
        const validacion = this.validar(nombre, correo, password, pwdConfir);
        if (validacion !== true) {
            this.vista.mostrarError(validacion);
            return;
        }

        try {
            const result = await this.modelo.registro(nombre, correo, password);

            if (result.exito) {
                // Registro exitoso, redirigimos al login
                window.location.href = "login.php";
            } else {
                // Error del servidor (ej: correo duplicado)
                this.vista.mostrarError(result.error || "Error al registrar usuario");
            }

        } catch (error) {
            console.error("Error en registro:", error);
            this.vista.mostrarError("Error de comunicación con el servidor");
        }
    }

    /**
     * Método encargado 
     * @param {*} nombre 
     * @param {*} correo 
     * @param {*} password 
     * @param {*} pwdConfir 
     * @returns 
     */
    validar(nombre, correo, password, pwdConfir) {
        if (!nombre || !correo || !password || !pwdConfir) return "Rellena todos los campos";
        const patronEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronEmail.test(correo)) return "Correo inválido";
        if (password.length < 4) return "Contraseña demasiado corta";
        if (password !== pwdConfir) return "Las contraseñas no coinciden";
        return true;
    }
}