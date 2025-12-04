export class VistaColeccion {
    constructor() {
        this.contenedorGrid = document.getElementById('gridColec');
        this.botonMenu = document.getElementById('usuario');
        this.menuDesplegable = document.getElementById('desplegable');
    }
    
    enlazarMenuUsuario() { /* ... Lógica del menú ... */ }

    renderizarColeccion(datosColeccion) {
        if (!this.contenedorGrid) return;
        
        this.contenedorGrid.innerHTML = ''; 
        
        datosColeccion.forEach(item => {
            const caja = document.createElement('div');
            caja.className = 'cajaAsoc';
            
            const claseIconoCandado = item.estaBloqueada ? 'fa-solid fa-lock' : 'fa-solid fa-lock-open';
            
            const estiloDifuminado = item.estaBloqueada ? 'filter: blur(5px); pointer-events: none;' : 'filter: none;';
            const contenidoDatos = item.estaBloqueada ? 'Datos ocultos' : `
                <p>Fundación: ${item.datos.fundacion}</p>
                <p>Alcance: ${item.datos.alcance}</p>
            `;

            caja.innerHTML = `
                <div id="imgAsoc">
                    <img src="/src/img/logo_sin_fondo.png"> 
                    <h3>${item.nombre}</h3>
                    <i class="${claseIconoCandado}"></i> 
                </div>
                <div style="${estiloDifuminado}" id="datosColec">
                    ${contenidoDatos}
                </div>
            `;
            this.contenedorGrid.appendChild(caja);
        });
    }
    
    mostrarError(mensaje) {
        if (this.contenedorGrid) {
            this.contenedorGrid.innerHTML = `<p style="color: red;">${mensaje}</p>`;
        }
    }
}