export class VistaRegistro {

    constructor(controlador) {
        this.controlador = controlador;
        this.form = document.getElementById("formLoginRegis");
        console.log("VistaRegistro inicializada, formulario encontrado:", this.form);

        this.form.addEventListener("submit", (evento) => {
            evento.preventDefault();
            const nombre = this.form.querySelector("input[name='nombre']").value.trim();
            const correo = this.form.querySelector("input[name='correo']").value.trim();
            const pwd = this.form.querySelector("input[name='pwd']").value.trim();
            const pwdConfir = this.form.querySelector("input[name='pwdConfir']").value.trim();
            this.controlador.enviarRegistro(nombre, correo, pwd, pwdConfir);
        });
    }

    mostrarError(mensaje) {
        alert("ERROR: " + mensaje);
    }

}