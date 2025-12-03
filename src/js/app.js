import "./modelos/modeloPistas.js";
import "./modelos/modeloGanarPerder.js";
import "./servicios/servicioGanarPerder.js";
import "./servicios/servicioInformacion.js";
import "./servicios/servicioPistas.js";
import "./vistas/vistaGanarPerder.js";
import "./vistas/vistaInformacion.js";
import "./vistas/vistaPistas.js";



document.addEventListener('DOMContentLoaded', () => {
    // menu desplegable falta
    if (window.location.pathname == "../../php/vistas/usuario/pagina_juego") {
        const modeloGanarPerder = new ModeloGanarPerder();
        const modeloPistas = new ModeloPistas();
        const vistaGanarPerder = new VistaGanarPerder();
        const vistaInformacion = new VistaInformacion();
        const vistaPistas = new VistaPistas();
        const servicioInformacion = new ServicioInformacion(vistaInformacion);
        const servicioPistas = new ServicioPistas(vistaPistas, modeloPistas);
        const servicioGanarPerder = new ServicioGanarPerder(vistaGanarPerder, modeloGanarPerder);
    }
});