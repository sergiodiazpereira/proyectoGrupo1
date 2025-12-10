const rutaImg = "../src/img/";
class VistaGanarPerder{
    /**
     * 
     * @param {ServicioGanarPerder} servicio - Servicio de los pop-ups ganar y perder 
     */
    constructor(servicio){
        this.servicio = servicio;
        this.selectAsociacion = document.getElementById("select-asociacion");

        this.popupGanar = document.getElementById("pantalla-victoria");
        this.contenidoPopupGanar = document.getElementById("modal-ganar");
        this.victoriaAsociacionEra = document.getElementById("victoriaAsociacionEra");
        this.victoriaImagen = document.getElementById("imagen-victoria");
        this.textoVictoria = document.getElementById("texto-tiempo-victoria");
        this.botonContinuarGanar = document.getElementById("jugar");

        this.popupPerder = document.getElementById("pantalla-derrota");
        this.contenidoPopupPerder = document.getElementById("modal-perder");
        this.textoCronometro = document.querySelector('#crono span');

        this.derrotaAsociacionEra = document.getElementById("derrotaAsociacionEra");
        this.derrotaImagen = document.getElementById("imagen-derrota");
        this.botonContinuarPerder = document.getElementById("jugar-derrota");
        let contadorIntentos = 1; /* Este valor se cogerá del valor real de intentos */
        this.selectAsociacion.addEventListener('change', () => {
            const valor = this.selectAsociacion.value;
            const asociacionCorrecta = this.servicio.mandarNombreAsociacionCorrecta(); /* nombre de la asociacion correcta */
            if (valor === asociacionCorrecta) {
                this.mostrarPantallaVictoria();
                let idAsoc = this.servicio.mandarIdAsociacionCorrecta();
                let idUsuario =  1; //$_SESSION["idUsuario"]
                let tiempo = this.textoCronometro.innerText;
                let fecha_intento = new Date();
                let [m, s] = tiempo.split(":");
                // Convertir a HH:MM:SS
                let tiempoFormateado = `00:${m}:${s}`;
                this.servicio.registrarVictoria(fecha_intento,tiempoFormateado,idAsoc,idUsuario);
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

        /** Registramos el tiempo al ganar la partida */
        this.botonContinuarGanar.addEventListener('click', async () => {
            /* // Recogemos el tiempo que ha tardado en completar el juego
            const tiempo = this.textoCronometro.innerText;
            // Recogemos el id de la asociación acertada
            const idAsoc = this.servicio.mandarIdAsociacionCorrecta();
            // Guardamos los datos en la base de datos
            await this.servicio.registrarVictoria(idAsoc, tiempo);
            // Ocultamos el popup */
            this.ocultarPantallaVictoria();
        });

        this.botonContinuarPerder.addEventListener('click', () => {
            this.ocultarPantallaDerrota();
        });
    }



    mostrarPantallaVictoria(){
        let tiempo = this.textoCronometro.innerText;
        this.victoriaAsociacionEra.innerText = this.servicio.mandarNombreAsociacionCorrecta();
        this.victoriaImagen.src = rutaImg + this.servicio.mandarImagenAsociacionCorrecta();
        this.textoVictoria.innerText = "Has adivinado la asociación en " + tiempo;
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
        this.derrotaAsociacionEra.innerText = this.servicio.mandarNombreAsociacionCorrecta();
        this.derrotaImagen.src = rutaImg + this.servicio.mandarImagenAsociacionCorrecta();
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