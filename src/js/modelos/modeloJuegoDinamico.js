class ModeloJuegoDinamico{
    constructor() {
        let finDePagina;


    /* ------------------------------ RECOGE LOS DATOS DE LAS ASOCIACIONES ACTUALES EN LA BD ENVIADOS POR PHP -------------------------- */  
        async function obtenerPaginaDelControladorPHP() {
            const res = await fetch("index.php?c=Juego&m=obtenerPagina");
            finDePagina = await res.json();
        }
    /* ----------------------------------------------------------------------------------------------------------------------------------*/
    }
    
    obtenerNombreAsociacionCorrecta() {
        return Promise.resolve(this.coleccionUsuario);
    }
}

export default ModeloJuegoDinamico;