export class ControladorRanking{
    constructor(modelo,vista){
        this.modelo=modelo;
        this.vista=vista;
    }

    async cargarRanking(){
        try{
            const ranking = await this.modelo.obtenerRanking();
            this.vista.crearRanking(ranking);
        }catch(error){
            this.vista.mostrarErrores("Error al obtener datos del ranking");
        }
    }
}