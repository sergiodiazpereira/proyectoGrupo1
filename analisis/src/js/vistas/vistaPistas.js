class VistaPistas{
    constructor(servicio){
        this.servicio = servicio;
        this.selectAsociacion = document.getElementById("select-asociacion");
        this.popupPistas = document.getElementById("pantalla-pistas");
        this.contenidoPopupPistas = document.getElementById("modal-pistas");
        this.botonPistas = document.getElementById("boton-pistas");
        this.botonCerrarPistas = document.getElementById("boton-cerrar-pistas");


        this.interrogacionesDificil = document.getElementById("interrogacionesDificil");
        this.textoDificil = document.getElementById("textoDificil");

        this.interrogacionesMedia  = document.getElementById("interrogacionesMedia");
        this.textoMedia = document.getElementById("textoMedia");

        this.interrogacionesFacil = document.getElementById("interrogacionesFacil");
        this.textoFacil = document.getElementById("textoFacil");


        this.botonPistas.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.botonCerrarPistas.addEventListener('click', () => {
            this.ocultarMenu();
        });

        let contadorIntentos = 1;
        this.selectAsociacion.addEventListener('change', () => {
            console.log(contadorIntentos);
            const valor = this.selectAsociacion.value;
            const asociacionCorrecta = this.servicio.mandarNombreAsociacionCorrecta(); /* nombre de la asociacion correcta */
            if (valor === asociacionCorrecta) {
                contadorIntentos = 1; /* reiniciar intentos */
            } else {
                if (contadorIntentos == 10) {
                    contadorIntentos = 1; /* reiniciar intentos */
                } else {
                    if (contadorIntentos >= 3) {
                        this.interrogacionesDificil.remove(); // Quita las interrogaciones
                        this.textoDificil.innerText = this.servicio.mandarPistaDificilAsociacionCorrecta();
                    } else {
                        this.textoDificil.insertAdjacentElement('beforebegin', this.interrogacionesDificil); // Introduce el elemento this.interrogacionesDificil antes del elemento this.textoDificil
                    }
                    if (contadorIntentos >= 5) {
                        this.interrogacionesMedia.remove();
                        this.textoMedia.innerText = this.servicio.mandarPistaMediaAsociacionCorrecta();
                    } else {
                        this.textoMedia.insertAdjacentElement('beforebegin', this.interrogacionesMedia);
                    }
                    if (contadorIntentos >= 8) {
                        this.interrogacionesFacil.remove();
                        this.textoFacil.innerText = this.servicio.mandarPistaFacilAsociacionCorrecta();
                    } else {
                        this.textoFacil.insertAdjacentElement('beforebegin', this.interrogacionesFacil); 
                    }
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
    // Método para mostrar automaticamente el popup de pistas
    mostrarPopupAutomatico() {
        this.mostrarMenu();
    }
}
export default VistaPistas;