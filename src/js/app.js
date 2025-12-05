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



// No hay documentacion porque ni se le pasa parametros ni retorna nada

document.addEventListener('DOMContentLoaded', () => {
    const vistaMenu = new VistaMenu();
    let finDePagina;


    /* ------------------------------ RECOGE LA PAGINA ENVIADA POR PHP -------------------------- */  
    async function cargarPagina() {
        const res = await fetch("index.php?c=Juego&m=obtenerPagina");
        finDePagina = await res.json();
        console.log("Ya está cargado:", finDePagina);
    /* -------------------------------------------------------------------------------------------*/


        if (finDePagina == "usuario/pagina_juego.php") {
            const modeloGanarPerder = new ModeloJuego();
            const modeloPistas = new ModeloJuego();

            // 1. Crear vista sin servicio
            const vistaInformacion = new VistaInformacion();
            const vistaPistas = new VistaPistas();

            // 2. Crear servicios
            const servicioPistas = new ServicioPistas(vistaPistas, modeloPistas);
            const servicioGanarPerder = new ServicioGanarPerder(modeloGanarPerder);

            // 3. Crear vista con servicio
            const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);




            // PARTE DE RAFA
            const modelo = new ModeloJuego();
            const vista = new VistaJuego(); 
            new ControladorJuego(modelo, vista);
        }

            
        if (finDePagina === 'usuario/colecciones.php') {
            const modelo = new ModeloColeccion();
            const vista = new VistaColeccion();
            new ControladorColeccion(modelo, vista);
        }
    }
    cargarPagina();
});