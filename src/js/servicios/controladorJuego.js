export class ControladorJuego {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;

        this.modelo.enlazarCambios(() => this.vista.renderizar(this.modelo));
        this.vista.enlazarIntento(this.manejarIntento);
        this.vista.enlazarMenuUsuario();
    }
    
    manejarIntento = (intento) => {
        if (this.modelo.juegoGanado)
        {
            return;
        }
        this.modelo.registrarIntento(intento); 
    }
}