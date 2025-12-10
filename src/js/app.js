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

import { ModeloRanking } from './modelos/modeloRanking.js';
import { VistaRanking } from './vistas/vistaRanking.js';
import { ControladorRanking } from './servicios/controladorRanking.js';

import { ModeloCambio } from './modelos/modeloCambio.js';
import { VistaCambio } from './vistas/vistaCambio.js';
import { ControladorCambio } from './servicios/controladorCambio.js';



document.addEventListener('DOMContentLoaded', () => {
    const vistaMenu = new VistaMenu();
    let finDePagina;

    async function obtenerPaginaDelControladorPHP() {
        try {
            // Obtenemos la URL
            const urlParams = new URLSearchParams(window.location.search);
            // Obtenemos el controlador de la URL
            const controladorURL = urlParams.get('c');

            // Establecemos para cada controlador su vista
            const mapaPaginas = {
                'Juego': 'usuario/pagina_juego.php',
                'Colecciones': 'usuario/colecciones.php',
                'Ranking': 'usuario/ranking.php',
                'Cambio': 'usuario/cambio.php'
            };

            // Si el controlador ni la vista no son null se establece la vista en la variable fin de pagina
            if (controladorURL && mapaPaginas[controladorURL]) {
                finDePagina = mapaPaginas[controladorURL];
            } else {
                // Por defecto la pagina juego
                finDePagina = 'usuario/pagina_juego.php';
            }

            if (finDePagina === "usuario/pagina_juego.php") {

                // 2. Instanciamos el servicio de datos
                const modeloJuegoDinamico = new ModeloJuegoDinamico();
                const servicioGanarPerder = new ServicioGanarPerder(modeloJuegoDinamico);

                // 3. ¡¡ESPERAMOS A LOS DATOS!! (Await es obligatorio aquí)
                // Esto detiene la ejecución hasta que los datos llegan de la BD
                await servicioGanarPerder.inicializar();

                // 4. Sacamos los datos limpios que ha traído el servicio
                const datos = servicioGanarPerder.datosAsociaciones;
                const correcta = servicioGanarPerder.asociacionCorrecta;

                console.log("APP.JS: Datos listos. Iniciando juego con:", datos.length, "asociaciones.");

                // 5. INICIALIZAMOS EL SELECT (CHOICES.JS)
                // Lo hacemos aquí para asegurarnos de que el select existe y tenemos datos
                const elementoSelect = document.getElementById('select-asociacion');
                if (elementoSelect && datos.length > 0) {

                    // Preparamos los datos para Choices
                    const opciones = datos.map(item => {
                        return {
                            value: item.nombre,
                            label: item.nombre,
                            selected: false,
                            disabled: false
                        };
                    });

                    // Creamos el desplegable
                    new Choices(elementoSelect, {
                        choices: opciones,
                        searchEnabled: true,
                        itemSelectText: '',
                        shouldSort: false,
                        searchPlaceholderValue: 'Buscar...',
                        placeholder: true,
                        placeholderValue: 'Introduce una Asociación'
                    });
                }

                // 6. INICIALIZAMOS EL JUEGO DE RAFA
                // Ahora le pasamos la correcta y la lista de datos cargada.
                const modelo = new ModeloJuego(correcta, datos);
                const vista = new VistaJuego();
                new ControladorJuego(modelo, vista);

                // 7. Vistas Auxiliares
                new VistaInformacion();
                new VistaGanarPerder(servicioGanarPerder);
                new VistaPistas(servicioGanarPerder);
            }

            // ... Resto de páginas ...
            if (finDePagina === 'usuario/colecciones.php') {
                const modelo = new ModeloColeccion();
                const vista = new VistaColeccion();
                new ControladorColeccion(modelo, vista);
            }
            /*PARTE KIKO*/
            if (finDePagina === 'usuario/cambio.php') {
                const modCambio = new ModeloCambio();
                const conCambio = new ControladorCambio(modCambio);
                const visCambio = new VistaCambio(conCambio);
                conCambio.vista = visCambio;
            }
            if (finDePagina === 'usuario/ranking.php') {
                const modRanking = new ModeloRanking();
                const conRanking = new ControladorRanking(modRanking);
                const visRanking = new VistaRanking(conRanking);
                conRanking.vista = visRanking;
                conRanking.cargarRanking();
            }
        } catch (error) {
            console.error("Error crítico en APP.JS:", error);
        }
    }

    obtenerPaginaDelControladorPHP();
});