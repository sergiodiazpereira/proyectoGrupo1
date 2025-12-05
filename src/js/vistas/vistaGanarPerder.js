class VistaGanarPerder{
    constructor(servicio){
        this.servicio = servicio;
        this.selectAsociacion = document.getElementById("select-asociacion");

        this.popupGanar = document.getElementById("pantalla-victoria");
        this.contenidoPopupGanar = document.getElementById("modal-ganar");
        this.botonContinuarGanar = document.getElementById("jugar");

        this.popupPerder = document.getElementById("pantalla-derrota");
        this.contenidoPopupPerder = document.getElementById("modal-perder");
        this.botonContinuarPerder = document.getElementById("jugar-derrota");

        let contadorIntentos = 1; /* Este valor se cogerá del valor real de intentos */
        document.addEventListener('change', (e) => {
            const select = e.target;
            const valor = select.value;
            const asociacionCorrecta = this.servicio.mandarNombre();
            if (valor === asociacionCorrecta) {
                this.mostrarPantallaVictoria();
                contadorIntentos = 1;
            } else {
                if (contadorIntentos == 10) {
                    this.mostrarPantallaDerrota();
                    contadorIntentos = 1;
                } else {
                    contadorIntentos++;
                }
            }
        });

        this.botonContinuarGanar.addEventListener('click', () => {
            this.ocultarPantallaVictoria();
        });

        this.botonContinuarPerder.addEventListener('click', () => {
            this.ocultarPantallaDerrota();
        });
    }



    mostrarPantallaVictoria(){
        this.popupGanar.style.display = "flex";
        setTimeout(() => {
            this.contenidoPopupGanar.classList.add("mostrar");
        }, 1); /* timeout para que dé tiempo a hacer la animacion */
        this.contenidoPopupGanar.style.display = "block";
    }



    ocultarPantallaVictoria(){
        this.popupGanar.style.display = "none";
        this.contenidoPopupGanar.classList.remove("mostrar");
    }



    mostrarPantallaDerrota(){
        this.popupPerder.style.display = "flex";
        setTimeout(() => {
            this.contenidoPopupPerder.classList.add("mostrar");
        }, 1); /* timeout para que dé tiempo a hacer la animacion */
        this.contenidoPopupPerder.style.display = "block";
    }



    ocultarPantallaDerrota(){
        this.popupPerder.style.display = "none";
        this.contenidoPopupPerder.classList.remove("mostrar");
    }
} 

export default VistaGanarPerder;