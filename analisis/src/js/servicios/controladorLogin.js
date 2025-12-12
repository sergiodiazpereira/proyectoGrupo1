export class ControladorLogin {

    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    async enviarLogin(correo, password) {

        // Validación CLIENTE
        const validacion = this.validar(correo, password);
        if (validacion !== true) {
            this.vista.mostrarError(validacion);
            return;
        }

        try {
            const result = await this.modelo.login(correo, password);

            if (!result.exito) {
                this.vista.mostrarError(result.msg || result.mensaje);
                return;
            }

            console.log("Permiso del usuario:", result.permiso);

            // Redirección según permiso
            if (result.permiso === 'A' || result.permiso === 'S') {
                window.location.href = "../../index.php?c=Dashboard&m=cargarPagina";
            } else {
                window.location.href = "../../index.php?c=Juego&m=cargarPagina";
            }
        } catch (error) {
            console.error("Error en login:", error);
            this.vista.mostrarError("Error de comunicación con el servidor");
        }
    }

    validar(correo, password) {
        if (!correo || !password) return "Rellena todos los campos";
        const patronEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronEmail.test(correo)) return "Correo inválido";
        if (password.length < 4) return "Contraseña demasiado corta";
        return true;
    }
}