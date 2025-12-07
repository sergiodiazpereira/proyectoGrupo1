export class ModeloColeccion {
    constructor() {
        this.coleccionUsuario = [];
    }
    
    /**
     * Pide a PHP la lista de asociaciones que el usuario ha adivinado (o todas con su estado)
     */
    async obtenerColeccion() {
        try {
            // 1. Petición al Backend (Asegúrate de tener este controlador en PHP)
            const respuesta = await fetch("index.php?c=Coleccion&m=obtenerColeccionUsuario");
            
            // Si la respuesta no es OK, lanzamos error
            if (!respuesta.ok) throw new Error("Error en la red");

            const datosBD = await respuesta.json();

            // 2. Mapear datos de BD a la estructura de la Vista
            this.coleccionUsuario = datosBD.map(item => {
                return {
                    id: item.idAsoc, // o item.id
                    nombre: item.nombre,
                    // Si viene '1' o true es que está adivinada/desbloqueada
                    adivinada: item.adivinada == true, 
                    
                    // Lógica visual: Si está adivinada, NO está bloqueada
                    estaBloqueada: item.adivinada != true, 
                    
                    datos: {
                        fundacion: new Date(item.fecha_fun).getFullYear(),
                        alcance: this._traducirAlcance(item.alcance)
                    }
                };
            });

            return this.coleccionUsuario;

        } catch (error) {
            console.error("Fallo al obtener colección:", error);
            // Retorna array vacío para que no rompa la vista
            return [];
        }
    }

    /**
     * Auxiliar para traducir 'I', 'N', 'L' a texto
     */
    _traducirAlcance(codigo) {
        const mapa = { 'I': 'Internacional', 'N': 'Nacional', 'L': 'Local' };
        return mapa[codigo] || codigo;
    }
}