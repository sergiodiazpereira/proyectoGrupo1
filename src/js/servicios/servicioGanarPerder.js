class ServicioGanarPerder{
    constructor(modelo){
        this.modelo = modelo;
    }
    
    mandarNombre(){
        return this.modelo.asociacionObjetivo.nombre;
    }

    mandarTiempo(){
        return this.modelo.obtenerTiempoFormateado();
    }

    // funciones que llevan datos comprobados del modelo a la vista
}

export default ServicioGanarPerder;