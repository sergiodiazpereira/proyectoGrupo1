class ModeloGaleria {
    constructor() {
    }
    /**
     * 
     * @returns {Array} - Retorna las fotos con su asociacion correspondiente
     */
    /* ---------------- RECOGE LOS DATOS DE LAS IMAGENES ---------------- */  
    async obtenerImagenesDelControladorPHP() {
        try {
            // Hacemos fetch para recoger los datos del servidor
            const respuesta = await fetch("index.php?c=Galeria&m=obtenerDatosImagenes");

            // Controlamos error de respuesta
            if (!respuesta.ok) {
                throw new Error(`Error del servidor: ${respuesta.status}`);
            }

            this.datosImagenes = await respuesta.json();
            return this.datosImagenes;

        } catch (error) {
            console.error("Hubo un error en el modelo de galería:", error);
            return []; // Devolvemos una lista vacía para que la app no explote
        }
    }
    /* ----------------------------------------------------------------------*/
    /* ---------------- RECOGE LOS DATOS DE LAS IMAGENES ---------------- */  
    async obtenerNombrePorIdAsociacion(idAsociacion) {
        try {
            // Hacemos fetch para recoger los datos del servidor
            const respuesta = await fetch("index.php?c=Galeria&m=obtenerNombreAsociacionPorId", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `idAsoc=${encodeURIComponent(idAsociacion)}`
            });

            // Controlamos error de respuesta
            if (!respuesta.ok) {
                throw new Error(`Error del servidor: ${respuesta.status}`);
            }

            this.datosImagenes = await respuesta.json();
            return this.datosImagenes;

        } catch (error) {
            console.error("Hubo un error en el modelo de galería:", error);
            return []; // Devolvemos una lista vacía para que la app no explote
        }
    }
    /* ----------------------------------------------------------------------*/
}

export default ModeloGaleria;