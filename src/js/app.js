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

    async function obtenerPaginaDelControladorPHP() {
        try { // <--- Añadido bloque try
            const res = await fetch("index.php?c=Juego&m=obtenerPagina");
            if (!res.ok) throw new Error("Error en la red"); // <--- Protección extra
            
            finDePagina = await res.json();

            // LÓGICA PARA LA PÁGINA DE JUEGO
            if (finDePagina === "usuario/pagina_juego.php") { // <--- Usando ===
                
                // 1. CARGA DE DATOS 
                const modeloJuegoDinamico = new ModeloJuegoDinamico();
                const servicioGanarPerder = new ServicioGanarPerder(modeloJuegoDinamico);
                
                // Aquí podrías poner un "Cargando..." en pantalla si tarda mucho
                await servicioGanarPerder.inicializar();
                
                const asociacionCorrectaBD = servicioGanarPerder.asociacionCorrecta;
                const listaTodasAsociacionesBD = servicioGanarPerder.datosAsociaciones;

                // 2. VISTAS AUXILIARES
                const vistaInformacion = new VistaInformacion();
                const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);
                const vistaPistas = new VistaPistas(servicioGanarPerder);

                // 3. JUEGO PRINCIPAL
                const modelo = new ModeloJuego(asociacionCorrectaBD, listaTodasAsociacionesBD);
                const vista = new VistaJuego(); 
                new ControladorJuego(modelo, vista);
            }

            // OTRAS PÁGINAS
            if (finDePagina === 'usuario/colecciones.php') {
                const modelo = new ModeloColeccion();
                const vista = new VistaColeccion();
                new ControladorColeccion(modelo, vista);
            }

            if (finDePagina === 'usuario/cambio.php') { /* ... */ }

            if (finDePagina === 'usuario/ranking.php') { /* ... */ }

        } catch (error) {
            console.error("Hubo un problema cargando la página:", error);
        }
    }            
    
    obtenerPaginaDelControladorPHP();
});