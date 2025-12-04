export class VistaJuego {
    constructor() {
        this.spanCronometro = document.querySelector('#crono span');
        this.contenedorTabla = document.getElementById('contenedor-tabla');
        this.selectAsociacion = document.querySelector('select[name="opcion-usuario"]');
        this.botonMenu = document.getElementById('usuario');
        this.menuDesplegable = document.getElementById('desplegable');
    }

    enlazarIntento(manejador) {
        if (this.selectAsociacion) {
            this.selectAsociacion.addEventListener('change', (e) => {
                const intento = e.target.value;
                if (intento) {
                    manejador(intento); 
                }
            });
        }
    }

    enlazarMenuUsuario() { /* ... Lógica del menú ... */ }

    renderizar(modelo) {
        if (this.spanCronometro) {
            this.spanCronometro.textContent = modelo.obtenerTiempoFormateado();
        }
        this.renderizarTabla(modelo.intentosRealizados);
    }
    
    renderizarTabla(intentos) {
        if (!this.contenedorTabla) return;
        
        // Se asume que los encabezados son los primeros 5 elementos fijos del grid
        const encabezados = 5; 
        
        while (this.contenedorTabla.children.length > encabezados) {
            this.contenedorTabla.removeChild(this.contenedorTabla.lastChild);
        }

        intentos.forEach(intento => {
            intento.celdas.forEach(celda => {
                const div = document.createElement('div');
                div.className = `celda ${celda.color} textoCentrado`; 
                div.textContent = celda.valor;
                this.contenedorTabla.appendChild(div);
            });
        });
    }
}