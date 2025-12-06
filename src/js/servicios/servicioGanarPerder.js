class ServicioGanarPerder{
    /**
     * 
     * @param {ModeloJuego} modelo - Modelo que trae y envia todos los datos a backend para que la pantalla de juego funcione
     */
    constructor(modelo){
        this.modelo = modelo;
    }

    /**
     * 
     * @returns {String} El nombre de la asociacion correcta
     */
    mandarNombre(){
        return this.modelo.obtenerNombreAsociacionCorrecta();
    }



    // funciones que llevan datos comprobados del modelo a la vista

}

export default ServicioGanarPerder;