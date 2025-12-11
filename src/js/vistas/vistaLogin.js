export class VistaLogin {

    constructor(controlador) {
        this.controlador = controlador;
        this.form = document.getElementById("formLoginRegis");
        console.log("VistaLogin inicializada, formulario encontrado:", this.form);

        this.form.addEventListener("submit", (evento) => {
            evento.preventDefault();
            console.log("Formulario enviado"); // <--- revisar consola
            const correo = this.form.querySelector("input[name='correo']").value.trim();
            const pwd = this.form.querySelector("input[name='pwd']").value.trim();
            this.controlador.enviarLogin(correo, pwd);
        });
    }

    mostrarError(mensaje) {
        alert("ERROR: " + mensaje);
    }

}