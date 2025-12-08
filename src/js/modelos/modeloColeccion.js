export class ModeloColeccion {
    async obtenerColeccion() {
        try {
            // Llamamos al controlador nuevo que hemos creado
            const respuesta = await fetch("index.php?c=Coleccion&m=obtenerColeccionUsuario");
            
            if (!respuesta.ok) throw new Error("Error red");
            
            const datosBD = await respuesta.json();

            // Mapeamos: Si tiene 'idIntento', está desbloqueada.
            return datosBD.map(item => ({
                nombre: item.nombre,
                imagen: item.imagen,
                // Si idIntento NO es nulo, es que la has acertado -> Desbloqueada
                estaBloqueada: (item.idIntento == null),
                datos: {
                    fundacion: item.fecha_fun,
                    alcance: item.alcance,
                    tipo: item.nombre_tipo
                }
            }));
        } catch (error) {
            console.error(error);
            return [];
        }
    }
}