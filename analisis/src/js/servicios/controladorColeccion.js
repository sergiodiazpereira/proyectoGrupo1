import { ModeloColeccion } from '../modelos/modeloColeccion.js';
import { VistaColeccion } from '../vistas/vistaColeccion.js';

export class ControladorColeccion {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;

        this.cargarColeccion();
    }

    async cargarColeccion() {
        try {
            const coleccion = await this.modelo.obtenerColeccion();
            this.vista.renderizarColeccion(coleccion);
        } catch (error) {
            this.vista.mostrarError('Error al cargar la colección.');
        }
    }
}