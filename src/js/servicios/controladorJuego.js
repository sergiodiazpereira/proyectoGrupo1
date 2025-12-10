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
    
    manejarIntento = (intento) => {
        if (!this.juegoEmpezado) {
            this.juegoEmpezado = true;
            this.modelo.resetearTiempo();
        }

        if (this.modelo.juegoGanado) {
            return;
        }
        this.modelo.registrarIntento(intento);

        /* // Obtenemos el numero de intentos realizados
        const n = this.modelo.intentosRealizados.length;

        // Mostrar pistas automáticamente
        if (n === 3) this.modelo.mostrarPista(1);
        if (n === 5) this.modelo.mostrarPista(2);
        if (n === 7) this.modelo.mostrarPista(3); */
    }

    iniciarReloj() {
        setInterval(() => {
            if (this.juegoEmpezado && !this.modelo.juegoGanado) {
                this.vista.renderizar(this.modelo);
            }
        }, 1000);
    }
}