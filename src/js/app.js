import ModeloPistas from "./modelos/modeloPistas.js";
import ServicioGanarPerder from "./servicios/servicioGanarPerder.js";
import ServicioPistas from "./servicios/servicioPistas.js";
import VistaGanarPerder from "./vistas/vistaGanarPerder.js";
import VistaInformacion from "./vistas/vistaInformacion.js";
import VistaMenu from "./vistas/vistaMenu.js";
import VistaPistas from "./vistas/vistaPistas.js";


import { ModeloJuego } from './modelos/modeloJuego.js';
import { VistaJuego } from './vistas/vistaJuego.js';
import { ControladorJuego } from './servicios/controladorJuego.js';

import { ModeloColeccion } from './modelos/modeloColeccion.js';
import { VistaColeccion } from './vistas/vistaColeccion.js';
import { ControladorColeccion } from './servicios/controladorColeccion.js';



document.addEventListener('DOMContentLoaded', () => {
    const vistaMenu = new VistaMenu();
    if (window.location.pathname.endsWith("pagina_juego.php")) {
        const modeloGanarPerder = new ModeloJuego();
        const modeloPistas = new ModeloPistas();

        // 1. Crear vista sin servicio
        const vistaInformacion = new VistaInformacion();
        const vistaPistas = new VistaPistas();

        // 2. Crear servicios
        const servicioPistas = new ServicioPistas(vistaPistas, modeloPistas);
        const servicioGanarPerder = new ServicioGanarPerder(modeloGanarPerder);

        // 3. Crear vista con servicio
        const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);
    }


    const nombrePagina = window.location.pathname.split('/').pop();
    if (nombrePagina === 'pagina_juego.php') {
        const modelo = new ModeloJuego();
        const vista = new VistaJuego(); 
        new ControladorJuego(modelo, vista);
    } 
        
    if (nombrePagina === 'colecciones.php') {
        const modelo = new ModeloColeccion();
        const vista = new VistaColeccion();
        new ControladorColeccion(modelo, vista);
    }
});