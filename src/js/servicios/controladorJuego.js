import { ModeloJuego } from '../modelos/modeloJuego.js';
import { VistaJuego } from '../vistas/vistaJuego.js';

export class ControladorJuego {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;

        this.modelo.enlazarCambios(() => this.vista.renderizar(this.modelo));
        this.vista.enlazarIntento(this.manejarIntento);
        this.vista.enlazarMenuUsuario();
    }
    
    manejarIntento = (intento) => {
        this.modelo.registrarIntento(intento); 
    }
}