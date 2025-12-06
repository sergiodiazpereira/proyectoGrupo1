class ModeloJuegoDinamico{
    constructor() {
    }
    
    /* ------------------------------ RECOGE LOS DATOS DE LAS ASOCIACIONES ACTUALES EN LA BD ENVIADOS POR PHP -------------------------- */  
    async obtenerAsociacionesDelControladorPHP() {
        const res = await fetch("index.php?c=Juego&m=obtenerDatosAsociaciones");
        this.datosAsociaciones = await res.json();
        return this.datosAsociaciones;
    }
    /* ----------------------------------------------------------------------------------------------------------------------------------*/
}

export default ModeloJuegoDinamico;