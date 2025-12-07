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
            const res = await fetch("../../index.php?c=Juego&m=obtenerPagina");
            if (!res.ok) throw new Error("Error en la red al obtener la página"); 
            
            finDePagina = await res.json();

            // -----------------------------------------------------------
            // LÓGICA PARA LA PÁGINA DE JUEGO
            // -----------------------------------------------------------
            if (finDePagina === "usuario/pagina_juego.php") { 
                
                // A. CARGA DE DATOS Y SERVICIOS
                const modeloJuegoDinamico = new ModeloJuegoDinamico();
                const servicioGanarPerder = new ServicioGanarPerder(modeloJuegoDinamico);
                
                await servicioGanarPerder.inicializar();
                
                const asociacionCorrectaBD = servicioGanarPerder.asociacionCorrecta;
                const listaTodasAsociacionesBD = servicioGanarPerder.datosAsociaciones;

                console.log("Datos para el select:", listaTodasAsociacionesBD); // Para confirmar

                // B. INICIALIZACIÓN DEL SELECT
                const elementoSelect = document.getElementById('select-asociacion');
                
                if (elementoSelect && listaTodasAsociacionesBD) {
                    
                    // PASO 1: Preparamos los datos ANTES de crear el desplegable
                    const opcionesParaChoices = listaTodasAsociacionesBD.map(item => {
                        return { 
                            value: item.nombre, 
                            label: item.nombre,
                            selected: false,
                            disabled: false
                        };
                    });

                    // Verificamos en consola que la lista esté perfecta
                    console.log("Lista preparada para Choices:", opcionesParaChoices);

                    // PASO 2: Creamos el desplegable pasándole los datos directamente (más seguro)
                    const choices = new Choices(elementoSelect, {
                        choices: opcionesParaChoices, // <--- AQUÍ METEMOS LOS DATOS
                        searchEnabled: true,
                        itemSelectText: '',
                        shouldSort: false,
                        searchPlaceholderValue: 'Buscar...',
                        removeItemButton: true,
                        placeholder: true,
                        placeholderValue: 'Introduce una Asociación'
                    });
                }

                // C. INICIALIZACIÓN DE VISTAS AUXILIARES
                const vistaInformacion = new VistaInformacion();
                const vistaGanarPerder = new VistaGanarPerder(servicioGanarPerder);
                const vistaPistas = new VistaPistas(servicioGanarPerder);

                // D. INICIALIZACIÓN DEL JUEGO PRINCIPAL
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