class ServicioGaleria{
    /**
     * 
     * @param {ModeloGaleria} modelo - Modelo que trae y envia todos los datos a backend para que la pantalla de galería funcione
     */
    constructor(modelo) {
        this.modelo = modelo;
        this.datosImagenes = [];
        this.datosImagenesDisponibles = [];
    }

    
    /**
     * Esta funcion recoge todas las imagenes disponibles en la BD
     */
    async inicializar() {
        // 1. Pedimos los datos al PHP
        const datos = await this.modelo.obtenerImagenesDelControladorPHP();
        
        // 2. Guardamos los datos en la propiedad de la clase
        // Si datos es null, guardamos array vacío
        if (datos) {
            this.datosImagenes = datos;
            this.datosImagenesDisponibles = datos.filter(imagen => imagen.idAsoc == "null");
        } else {
            this.datosImagenes = [];
            this.datosImagenesDisponibles = [];
        }
    }

    imagenesDeAsociacion(idAsociacion){
        let imagenesDeAsociacion;
        imagenesDeAsociacion = this.datosImagenes.filter(imagen => imagen.idAsoc == idAsociacion);
        return imagenesDeAsociacion;
    }

}

export default ServicioGaleria;