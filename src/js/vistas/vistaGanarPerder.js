class VistaGanarPerder{
    constructor(servicio){
        this.servicio = servicio;
        this.selectAsociacion = document.getElementById("select-asociacion");

        this.popupGanar = document.getElementById("pantalla-victoria");
        this.contenidoPopupGanar = document.getElementById("modal-ganar");
        this.botonContinuarGanar = document.getElementById("jugar");

        this.popupPerder = document.getElementById("pantalla-derrota");
        this.contenidoPopupPerder = document.getElementById("modal-perder");
        this.textoCronometro = document.querySelector('#crono span');
        this.textoPerder = document.getElementById("texto-tiempo-derrota");
        this.botonContinuarPerder = document.getElementById("jugar-derrota");

        let contadorIntentos = 1; /* Este valor se cogerá del valor real de intentos */
        document.addEventListener('change', (e) => {
            const select = e.target;
            const valor = select.value;
            const asociacionCorrecta = this.servicio.mandarNombre(); /* nombre de la asociacion correcta */
            if (valor === asociacionCorrecta) {
                this.mostrarPantallaVictoria();
                contadorIntentos = 1; /* reiniciar intentos */
            } else {
                if (contadorIntentos == 10) {
                    this.mostrarPantallaDerrota();
                    contadorIntentos = 1; /* reiniciar intentos */
                } else {
                    contadorIntentos++; /* sumar intentos */
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
        let tiempo = this.textoCronometro.innerText;
        this.textoPerder.innerText = "Has adivinado la asociación en " + tiempo;
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