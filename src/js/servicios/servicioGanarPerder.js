class ServicioGanarPerder{
    /**
     * 
     * @param {ModeloJuego} modelo - Modelo que trae y envia todos los datos a backend para que la pantalla de juego funcione
     */
    constructor(modelo) {
        this.modelo = modelo;
        this.datosAsociaciones = [];
        this.asociacionCorrecta = null;
    }


    /**
     * Esta funcion recoge todas las asociaciones disponibles en la BD y elige una aleatoria que será la correcta
     */
    async inicializar() {
        // 1. Pedimos los datos al PHP
        const datos = await this.modelo.obtenerAsociacionesDelControladorPHP();
        
        // 2. Guardamos los datos en la propiedad de la clase
        // Si datos es null, guardamos array vacío
        this.datosAsociaciones = datos || [];
        
        console.log("Servicio: Datos recibidos:", this.datosAsociaciones);

        // 3. Elegimos la correcta al azar
        if (this.datosAsociaciones.length > 0) {
            const randomIndex = Math.floor(Math.random() * this.datosAsociaciones.length);
            this.asociacionCorrecta = this.datosAsociaciones[randomIndex];
        }
    }

    elegirAsociacionCorrecta(){
        const indiceAleatorio = Math.floor(Math.random() * this.datosAsociaciones.length);
        this.asociacionCorrecta = this.datosAsociaciones[indiceAleatorio];
        console.log(this.asociacionCorrecta);
    }

    /**
     * 
     * @returns {String} El nombre de la asociacion correcta
     */
    mandarNombreAsociacionCorrecta(){
        return this.asociacionCorrecta.nombre;
    }

    mandarImagenAsociacionCorrecta(){
        return this.asociacionCorrecta.imagen;
    }

    mandarPistaDificilAsociacionCorrecta(){
        return this.asociacionCorrecta.pista_dificil;
    }

    mandarPistaMediaAsociacionCorrecta(){
        return this.asociacionCorrecta.pista_media;
    }

    mandarPistaFacilAsociacionCorrecta(){
        return this.asociacionCorrecta.pista_facil;
    }

    /* async registrarVictoria(idAsoc, tiempo) {
        const res = await fetch("index.php?c=Juego&m=registrarVictoria", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                idAsoc,
                tiempo
            })
        });

        return await res.json();
    } */

}

export default ServicioGanarPerder;