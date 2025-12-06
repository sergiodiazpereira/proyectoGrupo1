import ServicioGanarPerder from "./servicios/servicioGanarPerder.js";
import VistaGanarPerder from "./vistas/vistaGanarPerder.js";
import VistaInformacion from "./vistas/vistaInformacion.js";
import VistaMenu from "./vistas/vistaMenu.js";
import VistaPistas from "./vistas/vistaPistas.js";
import ModeloJuegoDinamico from "./modelos/modeloJuegoDinamico.js";


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
    async function obtenerPaginaDelControladorPHP() {
        const res = await fetch("index.php?c=Juego&m=obtenerPagina");
        finDePagina = await res.json();
    /* -------------------------------------------------------------------------------------------*/


        if (finDePagina == "usuario/pagina_juego.php") {
            const modeloJuego = new ModeloJuegoDinamico();

            // 1. Crear vista sin servicio
            const vistaInformacion = new VistaInformacion();

            (async () => {
                const servicioGanarPerder = new ServicioGanarPerder(modeloJuego);
                const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);
                const vistaPistas = new VistaPistas(servicioGanarPerder);
                await servicioGanarPerder.inicializar();
            })();



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



        if (finDePagina === 'usuario/cambio.php') {
            /* metodos para la pagina cambio */
        }



        if (finDePagina === 'usuario/ranking.php') {
            /* metodos para la pagina ranking */
        }
    }            
    
    obtenerPaginaDelControladorPHP();

});