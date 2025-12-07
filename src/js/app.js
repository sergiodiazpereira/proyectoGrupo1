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

document.addEventListener('DOMContentLoaded', () => {
    const vistaMenu = new VistaMenu();
    let finDePagina;

    async function obtenerPaginaDelControladorPHP() {
        try { 
            // 1. Preguntamos al PHP qué página cargar
            const res = await fetch("index.php?c=Juego&m=obtenerPagina");
            if (!res.ok) throw new Error("Error en la red al obtener la página"); 
            
            finDePagina = await res.json();

            // -----------------------------------------------------------
            // LÓGICA PARA LA PÁGINA DE JUEGO
            // -----------------------------------------------------------
            if (finDePagina === "usuario/pagina_juego.php") { 
                
                // A. CARGA DE DATOS Y SERVICIOS
                const modeloJuegoDinamico = new ModeloJuegoDinamico();
                const servicioGanarPerder = new ServicioGanarPerder(modeloJuegoDinamico);
                
                // Esperamos a que la BD devuelva los datos
                await servicioGanarPerder.inicializar();
                
                // Recuperamos los datos del servicio
                const asociacionCorrectaBD = servicioGanarPerder.asociacionCorrecta;
                const listaTodasAsociacionesBD = servicioGanarPerder.datosAsociaciones;

                // Debug: Muestra en la consola qué está llegando exactamente
                console.log("Datos recibidos para el desplegable:", listaTodasAsociacionesBD);

                // B. INICIALIZACIÓN DEL SELECT (CHOICES.JS)
                const elementoSelect = document.getElementById('select-asociacion');
                
                if (elementoSelect && listaTodasAsociacionesBD) {
                    // 1. Configuramos Choices
                    const choices = new Choices(elementoSelect, {
                        searchEnabled: true,
                        itemSelectText: '',
                        shouldSort: false, 
                        searchPlaceholderValue: 'Buscar...',
                    });

                    // 2. Preparamos los datos (Mapeo Inteligente)
                    // Esto detecta si llega un objeto {nombre: "X"} o un string "X"
                    const opcionesParaChoices = listaTodasAsociacionesBD.map(item => {
                        let textoAmostrar = item;
                        
                        // Si el item es un objeto, intentamos sacar el nombre
                        if (typeof item === 'object' && item !== null) {
                            textoAmostrar = item.nombre || item.Nombre || Object.values(item)[0];
                        }

                        return { value: textoAmostrar, label: textoAmostrar };
                    });

                    // 3. Inyectamos los datos en el HTML
                    choices.setChoices(opcionesParaChoices, 'value', 'label', true);
                }

                // C. INICIALIZACIÓN DE VISTAS AUXILIARES
                const vistaInformacion = new VistaInformacion();
                const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);
                const vistaPistas = new VistaPistas(servicioGanarPerder);

                // D. INICIALIZACIÓN DEL JUEGO PRINCIPAL (Lógica de Rafa)
                const modelo = new ModeloJuego(asociacionCorrectaBD, listaTodasAsociacionesBD);
                const vista = new VistaJuego(); 
                new ControladorJuego(modelo, vista);
            }

            // -----------------------------------------------------------
            // OTRAS PÁGINAS
            // -----------------------------------------------------------
            if (finDePagina === 'usuario/colecciones.php') {
                const modelo = new ModeloColeccion();
                const vista = new VistaColeccion();
                new ControladorColeccion(modelo, vista);
            }

            if (finDePagina === 'usuario/cambio.php') { 
                /* Lógica para cambio de contraseña */ 
            }

            if (finDePagina === 'usuario/ranking.php') { 
                /* Lógica para ranking */ 
            }

        } catch (error) {
            console.error("Hubo un problema cargando la aplicación:", error);
        }
    }            
    
    obtenerPaginaDelControladorPHP();
});