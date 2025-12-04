import { ModeloJuego } from './modelos/modeloJuego.js';
import { VistaJuego } from './vistas/VistaJuego.js';
import { ControladorJuego } from './controladores/ControladorJuego.js';

import { ModeloColeccion } from './modelos/ModeloColeccion.js';
import { VistaColeccion } from './vistas/VistaColeccion.js';
import { ControladorColeccion } from './controladores/ControladorColeccion.js';


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