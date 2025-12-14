/**
 * 
 */
export class VistaRegistro {

    constructor(controlador) {
        // Establecemos el controlador
        this.controlador = controlador;
        // Obtemenos el formulario de registro mediante el ID
        this.form = document.getElementById("formLoginRegis");

        // Añadimos un eventListener al boton submit del login
        this.form.addEventListener("submit", (evento) => {
            // Detenemos las acciones por defecto del navegador
            evento.preventDefault();
            // Obtenemos el valor del nombre introducido en el input
            const nombre = this.form.querySelector("input[name='nombre']").value.trim();
            // Obtenemos el valor del correo
            const correo = this.form.querySelector("input[name='correo']").value.trim();
            // Obtenemos el valor de la contraseña
            const pwd = this.form.querySelector("input[name='pwd']").value.trim();
            // Obtenemos el valor de la confirmación de la contraseña
            const pwdConfir = this.form.querySelector("input[name='pwdConfir']").value.trim();
            // Se lo pasamos al método del controlador
            this.controlador.enviarRegistro(nombre, correo, pwd, pwdConfir);
        });
    }

    // Método para mostrar los mensajes de error
    mostrarError(mensaje) {
        alert("ERROR: " + mensaje);
    }

}