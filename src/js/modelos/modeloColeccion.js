export class ModeloColeccion {
    constructor() {
        // Datos simulados. 'estaBloqueada' determina el candado y el difuminado.
        this.coleccionUsuario = [
            // idAsoc, nombre, adivinada, idTipoAsoc, fecha_fun, etc.
            { id: 1, nombre: 'Cruz Roja', adivinada: true, estaBloqueada: false, datos: { fundacion: '1863', alcance: 'Internacional' } },
            { id: 2, nombre: 'Unicef', adivinada: false, estaBloqueada: true, datos: { fundacion: '2002', alcance: 'Nacional' } },
            { id: 3, nombre: 'Fundación Once', adivinada: false, estaBloqueada: true, datos: { fundacion: '2000', alcance: 'Local' } },
        ];
    }
    
    obtenerColeccion() {
        return Promise.resolve(this.coleccionUsuario);
    }
}