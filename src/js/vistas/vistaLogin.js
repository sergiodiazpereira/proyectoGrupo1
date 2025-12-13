/**
 * 
 */
export class VistaLogin {

    constructor(controlador) {
        // Establecemos el controlador
        this.controlador = controlador;
        // Obtemenos el formulario de login mediante el ID
        this.form = document.getElementById("formLoginRegis");

        // Añadimos un eventListener al boton submit del login
        this.form.addEventListener("submit", (evento) => {
            // Detenemos las acciones por defecto del navegador
            evento.preventDefault();
            // Obtenemos el valor del correo introducido en el input
            const correo = this.form.querySelector("input[name='correo']").value.trim();
            // Obtenemos el valor de la contraseña
            const pwd = this.form.querySelector("input[name='pwd']").value.trim();
            // Se lo pasamos al método del controlador
            this.controlador.enviarLogin(correo, pwd);
        });
    }

    // Método para mostrar los mensajes de error
    mostrarError(mensaje) {
        alert("ERROR: " + mensaje);
    }

}