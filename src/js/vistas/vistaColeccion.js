export class VistaColeccion {
    constructor() {
        this.contenedorGrid = document.getElementById('gridColec');
    }

    /**
     * 
     * @param {*} datosColeccion 
     * @returns Esta función se encarga de crear las cajas y lo tiene relleno con la información de la base
     * de datos. También difumina las cajas en función de si están bloqueadas.
     */
    renderizarColeccion(datosColeccion) {
        if (!this.contenedorGrid) return;

        this.contenedorGrid.innerHTML = '';

        datosColeccion.forEach(item => {
            const caja = document.createElement('div');
            caja.className = 'cajaAsoc';
            
            // Si está bloqueada -> Candado cerrado y borroso
            // Si está desbloqueada -> Candado abierto y se ve bien

            const icono = item.estaBloqueada ? 'fa-lock' : 'fa-lock-open';
            const estiloBlur = item.estaBloqueada ? 'filter: blur(5px); pointer-events: none;' : '';

            // Contenido de los datos (oculto si está bloqueado)
            const infoTexto = item.estaBloqueada
            ? `<p>???</p><p>???</p>`
            : `<p>Fundación: ${item.datos.fundacion}</p>
                <p>Alcance: ${
                item.datos.alcance === 'I' ? 'Internacional' :
                item.datos.alcance === 'N' ? 'Nacional' :
                'Local'
                }</p>
                <p>Tipo: ${item.datos.tipo}</p>`;

            caja.innerHTML = `
                <div id="imgAsoc">
                    <img  src="${'../src/img/'+item.imagen || '../src/img/logo_sin_fondo.png'}" style="${estiloBlur} border-radius: 50%">
                    <h3>${item.nombre}</h3>
                    <i class="fa-solid ${icono}"></i>
                </div>
                <div class="datosColec" style="${estiloBlur}">
                    ${infoTexto}
                </div>
            `;
            this.contenedorGrid.appendChild(caja);
        });
    }
}