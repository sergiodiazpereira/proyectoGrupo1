class ModeloGanarPerder{
    constructor(){
        this.tiempo = null;
        this.asociacion = null;
    }

    cogerDatosPartida() {
        // DATOS ESTÁTICOS
        const nombre = "Cruz Roja";
        const tiempo = "00:14";
        const datos = [nombre, tiempo];
        
        return datos;
    }

    // funciones para enviar datos al backend (ej. introducir una asociacion en la bd)
}

export default ModeloGanarPerder;