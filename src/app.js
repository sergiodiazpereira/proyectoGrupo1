import "./js/modelos/modeloPistas.js";
import "./js/modelos/modeloGanarPerder.js";
import "./js/servicios/servicioGanarPerder.js";
import "./js/servicios/servicioInformacion.js";
import "./js/servicios/servicioPistas.js";

document.addEventListener('DOMContentLoaded', () => {
    // 1. Instanciar el Modelo
    const modelo = new Modelo();

    // 2. Instanciar la Vista (requiere el Controlador para comunicarle las interacciones)
    const vista = new Vista();

    // 3. Instanciar el Controlador (requiere el Modelo)
    const controlador = new Controlador(modelo, vista);
            
});