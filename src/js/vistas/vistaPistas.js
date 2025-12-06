class VistaPistas{
    constructor(){
        this.popupPistas = document.getElementById("pantalla-pistas");
        this.contenidoPopupPistas = document.getElementById("modal-pistas");
        this.botonPistas = document.getElementById("boton-pistas");
        this.botonCerrarPistas = document.getElementById("boton-cerrar-pistas");

        this.botonPistas.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.botonCerrarPistas.addEventListener('click', () => {
            this.ocultarMenu();
        });

        let contadorIntentos = 1; /* Este valor se cogerá del valor real de intentos */
        this.selectAsociacion.addEventListener('change', () => {
            const valor = this.selectAsociacion.value;
            const asociacionCorrecta = this.servicio.mandarNombreAsociacionCorrecta(); /* nombre de la asociacion correcta */
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
    }



    mostrarMenu(){
        this.popupPistas.style.display = "flex";
        setTimeout(() => {
            this.contenidoPopupPistas.classList.add("mostrar");
        }, 1); /* timeout para que dé tiempo a hacer la animacion */
        this.contenidoPopupPistas.style.display = "block";
    }



    ocultarMenu(){
        this.popupPistas.style.display = "none";
        this.contenidoPopupPistas.classList.remove("mostrar");
    }
}

export default VistaPistas;