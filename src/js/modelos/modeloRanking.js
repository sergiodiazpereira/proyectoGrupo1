export class ModeloRanking{
    /**
     * 
     * @returns devuelve los datos del ranking 
     */
    async obtenerRanking(){
        try{
            /*pido los datos al server del ranking */
            const datos = await fetch ('index.php?c=Ranking&m=obtenerRanking');
            if(!datos.ok){
                throw new Error(`Error:${datos.status}`);
            }
            /*los paso a un json y los devuelvo */
            const datosRanking = await datos.json();
            return  datosRanking;
        }catch(error){
            console.log("Fallo al obtener el ranking:",error);
            throw error;
        }
    }
}