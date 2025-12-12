/**
 * Esta es la VistaCambio
 */
export class VistaCambio {

    constructor(controlador) {
        this.controlador = controlador;
        this.formulario = document.getElementById('formCambio');

        /**
         * Este evento recojera los datos del formulario
         */
        this.formulario.addEventListener('submit', (event) => {
            event.preventDefault();

            const datosFormulario = new FormData(this.formulario);

            const pwdAntigua = datosFormulario.get('contraActual');
            const pwdNueva = datosFormulario.get('contraNueva');
            const pwdNuevaC = datosFormulario.get('contraConfir');

            this.controlador.cambiarPwd(pwdAntigua, pwdNueva, pwdNuevaC);
        });
    }
    /**
     * 
     * @param {*} mensaje Muestro el modal para el exito
     */
    mostrarModal(mensaje) {
        const modal = document.getElementById('modal-exito');
        const textoModal = modal.querySelector('.modal-header h2');
        if (textoModal) {
            textoModal.textContent = mensaje;
        }
        modal.style.display = 'flex';
    }
    /**
     * 
     * @param {*} mensaje Muestro el mensaje para el error
     */
    mostrarError(mensaje) {
        console.log('mostrarError llamado con:', mensaje);
        const modal = document.getElementById('modal-error');
        console.log('modal-error encontrado:', modal);

        if (modal) {
            const textoModal = modal.querySelector('.modal-header h2');
            if (textoModal) {
                textoModal.textContent = mensaje;
            }
            modal.style.display = 'flex';
        } else {
            // Fallback si no encuentra el modal
            alert('ERROR (modal no encontrado): ' + mensaje);
        }
    }
}