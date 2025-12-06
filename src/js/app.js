import { ModeloJuego } from './modelos/modeloJuego.js';
import { VistaJuego } from './vistas/vistaJuego.js';
import { ControladorJuego } from './servicios/controladorJuego.js';

import { ModeloColeccion } from './modelos/modeloColeccion.js';
import { VistaColeccion } from './vistas/vistaColeccion.js';
import { ControladorColeccion } from './servicios/controladorColeccion.js';


document.addEventListener('DOMContentLoaded', () => {
    const nombrePagina = window.location.pathname.split('/').pop();

    if (nombrePagina === 'pagina_juego.php') {
        const modelo = new ModeloJuego();
        const vista = new VistaJuego(); 
        new ControladorJuego(modelo, vista);
        console.log("MVC de Juego inicializado.");
    } 
    
    if (nombrePagina === 'colecciones.php') {
        const modelo = new ModeloColeccion();
        const vista = new VistaColeccion();
        new ControladorColeccion(modelo, vista);
        console.log("MVC de Colecciones inicializado.");
    }
});