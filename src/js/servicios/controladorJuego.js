export class ControladorJuego {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.juegoEmpezado = false;

        this.modelo.enlazarCambios(() => this.vista.renderizar(this.modelo));
        
        this.vista.enlazarIntento(this.manejarIntento);
        this.vista.enlazarMenuUsuario();

        this.iniciarReloj(); 
    }
    
    /**
     * 
     * @param {*} intento 
     * @returns Esta función lo que hace es que una vez que se acabe el juego, se restablezca el tiempo
     */
    manejarIntento = (intento) => {
        if (!this.juegoEmpezado) {
            this.juegoEmpezado = true;
            this.modelo.resetearTiempo();
        }

        if (this.modelo.juegoGanado) {
            return;
        }

        const resultado = this.modelo.registrarIntento(intento);

        // Recogemos el numero de intentos realizados
        const totalIntentos = this.modelo.intentosRealizados.length;

        // Si el numero de intentos es de 3,5 u 8 mostramos un popup de forma automatica
        if (!resultado.esCorrecto && (totalIntentos === 3 || totalIntentos === 5 || totalIntentos === 8)) {
            this.vista.mostrarPopupAutomatico();
        }
        
    }

    /**
     * Esta función lo que hace es iniciar el cronómetro
     */
    iniciarReloj() {
        setInterval(() => {
            if (this.juegoEmpezado && !this.modelo.juegoGanado) {
                this.vista.renderizar(this.modelo);
            }
        }, 1000);
    }
}