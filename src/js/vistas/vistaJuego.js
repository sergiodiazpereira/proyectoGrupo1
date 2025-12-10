export class VistaJuego {
    constructor() {
        this.spanCronometro = document.querySelector('#crono span');
        console.log('Elemento Cronómetro Seleccionado:', this.spanCronometro);
        this.contenedorResultados = document.getElementById('contenedor-resultados');
        this.selectAsociacion = document.querySelector('select[name="opcion-usuario"]');
        this.botonMenu = document.getElementById('usuario');
        this.menuDesplegable = document.getElementById('desplegable');
        this.contadorIntentos = document.getElementById('contador-intentos');
    }

    enlazarIntento(manejador) {
        if (this.selectAsociacion) {
            this.selectAsociacion.addEventListener('change', (e) => {
                const intento = e.target.value;
                if (intento && intento !== "") {
                    manejador(intento); 
                }
            });
        }
    }

    enlazarMenuUsuario() { 
        if (this.botonMenu) {
            this.botonMenu.addEventListener('click', () => {
                this.menuDesplegable.classList.toggle('activo');
            });
        }
    }

    renderizar(modelo) {
        if (this.spanCronometro) {
            this.spanCronometro.innerText = modelo.obtenerTiempoFormateado();
        }

        if (this.contadorIntentos) {
            const intentosMaximos = 10;
            
            const intentoActual = modelo.intentosRealizados.length; 

            this.contadorIntentos.textContent = `Intento ${intentoActual} de ${intentosMaximos}`;
            
            if (modelo.juegoGanado && this.selectAsociacion){
                this.selectAsociacion.disabled = true;
            }
        }

        if (modelo.intentosRealizados.length > 0 && this.contenedorResultados) {
            this.contenedorResultados.style.display = 'grid'; 
        }
        
        this.renderizarTabla(modelo.intentosRealizados);
    }
    
    renderizarTabla(intentos) {
        if (!this.contenedorResultados) return;
        
        this.contenedorResultados.innerHTML = ''; 

        intentos.forEach(intento => {
            intento.celdas.forEach(celda => {
                const div = document.createElement('div');
                div.className = `celda ${celda.color} textoCentrado`; 
                div.textContent = celda.valor;
                this.contenedorResultados.appendChild(div);
            });
        });
    }

    // Método que muestra el pop-up de pistas automaticamente
    mostrarPopupAutomatico() {
        // Obtenemos el contenedor del popup
        const popup = document.getElementById("pantalla-pistas");
        // Obtenemos el modal interno donde están las pistas
        const modal = document.getElementById("modal-pistas");

        // Solo ejecutamos la animación si ambos elementos existen en el DOM
        if (popup && modal) {
            // Mostramos la capa oscurecida del popup
            popup.style.display = "flex";
            // Añado un timeout de 1 milisegundo para mostrarlo sin errores
            setTimeout(() => modal.classList.add("mostrar"), 1);
            // Aseguramos que el modal esté visible
            modal.style.display = "block";
        }
    }
}