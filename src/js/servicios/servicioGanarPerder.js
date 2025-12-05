class ServicioGanarPerder{
    constructor(vista, modelo){
        this.vista = vista;
        this.modelo = modelo;
    }
    
    async mandarNombre(){
        let datos = await this.modelo.cogerDatosPartida();
        return datos[0];
    }

    async mandarTiempo(){
        let datos = await this.modelo.cogerDatosPartida();
        return datos[1];
    }

    // funciones que llevan datos comprobados del modelo a la vista
}

export default ServicioGanarPerder;