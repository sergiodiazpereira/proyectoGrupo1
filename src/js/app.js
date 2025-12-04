import "./modelos/modeloPistas.js";
import "./modelos/modeloGanarPerder.js";
import "./servicios/servicioGanarPerder.js";
import "./servicios/servicioPistas.js";
import "./vistas/vistaGanarPerder.js";
import "./vistas/vistaInformacion.js";
import "./vistas/vistaMenu.js";
import "./vistas/vistaPistas.js";



document.addEventListener('DOMContentLoaded', () => {
    prompt("holasaa");
    const vistaMenu = new VistaMenu();
    if (window.location.pathname == "../../php/vistas/usuario/pagina_juego") {
        const modeloGanarPerder = new ModeloGanarPerder();
        const modeloPistas = new ModeloPistas();
        const vistaGanarPerder = new VistaGanarPerder();
        const vistaInformacion = new VistaInformacion();
        const vistaPistas = new VistaPistas();
        const vistaMenu = new VistaMenu();
        const servicioPistas = new ServicioPistas(vistaPistas, modeloPistas);
        const servicioGanarPerder = new ServicioGanarPerder(vistaGanarPerder, modeloGanarPerder);
    }
});