import ModeloPistas from "./modelos/modeloPistas.js";
import ModeloGanarPerder from "./modelos/modeloGanarPerder.js";
import ServicioGanarPerder from "./servicios/servicioGanarPerder.js";
import ServicioPistas from "./servicios/servicioPistas.js";
import VistaGanarPerder from "./vistas/vistaGanarPerder.js";
import VistaInformacion from "./vistas/vistaInformacion.js";
import VistaMenu from "./vistas/vistaMenu.js";
import VistaPistas from "./vistas/vistaPistas.js";



document.addEventListener('DOMContentLoaded', () => {
    const vistaMenu = new VistaMenu();

    if (window.location.pathname.endsWith("pagina_juego.html")) {

        const modeloGanarPerder = new ModeloGanarPerder();
        const modeloPistas = new ModeloPistas();

        // 1. Crear vista sin servicio
        const vistaGanarPerder = new VistaGanarPerder(null);

        const vistaInformacion = new VistaInformacion();
        const vistaPistas = new VistaPistas();

        // 2. Crear servicios
        const servicioPistas = new ServicioPistas(vistaPistas, modeloPistas);
        const servicioGanarPerder = new ServicioGanarPerder(vistaGanarPerder, modeloGanarPerder);

        // 3. Asignar servicio a la vista (inyección tardía)
        vistaGanarPerder.servicio = servicioGanarPerder;
    }
});