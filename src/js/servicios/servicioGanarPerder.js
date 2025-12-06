class ServicioGanarPerder{
    /**
     * 
     * @param {ModeloJuego} modelo - Modelo que trae y envia todos los datos a backend para que la pantalla de juego funcione
     */
    constructor(modelo){
        this.modelo = modelo;
        this.datosAsociaciones = null;
        this.asociacionCorrecta = null;
    }



    async inicializar() {
        this.datosAsociaciones = await this.modelo.obtenerAsociacionesDelControladorPHP(); // espera a que los datos estén cargados
        this.elegirAsociacionCorrecta();
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



    // funciones que llevan datos comprobados del modelo a la vista

}

export default ServicioGanarPerder;