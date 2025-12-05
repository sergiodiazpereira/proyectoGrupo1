class ServicioGanarPerder{
    constructor(modelo){
        this.modelo = modelo;
    }
    
    mandarNombre(){
        let datos = this.modelo.cogerDatosPartida();
        return datos[0];
    }

    mandarTiempo(){
        let datos = this.modelo.cogerDatosPartida();
        return datos[1];
    }

    // funciones que llevan datos comprobados del modelo a la vista
}

export default ServicioGanarPerder;