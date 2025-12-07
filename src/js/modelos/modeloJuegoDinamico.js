class ModeloJuegoDinamico {
    constructor() {
    }
    
    /* ---------------- RECOGE LOS DATOS DE LAS ASOCIACIONES ---------------- */  
    async obtenerAsociacionesDelControladorPHP() {
        try {
            // 1. La ruta con ../../ es la CLAVE para que funcione
            const res = await fetch("../../index.php?c=Juego&m=obtenerDatosAsociaciones");

            // 2. Protección: Si el servidor da error (ej: 500 o 404), lanzamos aviso
            if (!res.ok) {
                throw new Error(`Error del servidor: ${res.status}`);
            }

            this.datosAsociaciones = await res.json();
            return this.datosAsociaciones;

        } catch (error) {
            console.error("Error grave en ModeloJuegoDinamico:", error);
            return []; // Devolvemos una lista vacía para que la app no explote
        }
    }
    /* ----------------------------------------------------------------------*/
}

export default ModeloJuegoDinamico;