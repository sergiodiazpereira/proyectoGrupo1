class ModeloGanarPerder{
    constructor(){
        this.tiempo = null;
        this.asociacion = null;
    }

    async cogerDatosPartida() {
        try {
            const response = await fetch("../../src/js/modelos/datosEjemplo.json"); /* ni idea */
            const data = await response.json();
            this.tiempo = data.tiempo;
            this.asociacion = data.asociacion;
            
            return [this.asociacion, this.tiempo];
        } catch (error) {
            console.error("Error al cargar JSON:", error);
        }
    }
    // funciones para enviar datos al backend (ej. introducir una asociacion en la bd)
}

export default ModeloGanarPerder;