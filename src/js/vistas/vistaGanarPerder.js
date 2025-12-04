class VistaGanarPerder{
    constructor(servicio){
        this.servicio = servicio;
        this.selectAsociacion = document.getElementById("select-asociacion");
        this.popupGanar = document.getElementById("pantalla-victoria");
        this.contenidoPopupGanar = document.getElementById("modal-ganar");
        this.botonContinuar = document.getElementById("jugar");

        document.addEventListener('change', (e) => { /* Coge el valor de */
            const select = e.target;
            const valor = select.value;
            const asociacionCorrecta = this.servicio.mandarNombre();
            if (valor === asociacionCorrecta) {
                this.mostrarMenu();
            }
        });

        this.botonContinuar.addEventListener('click', () => {
            this.ocultarMenu();
        });
    }



    mostrarMenu(){
        this.popupGanar.style.display = "flex";
        setTimeout(() => {
            this.contenidoPopupGanar.classList.add("mostrar");
        }, 1); /* timeout para que dé tiempo a hacer la animacion */
        this.contenidoPopupGanar.style.display = "block";
    }



    ocultarMenu(){
        this.popupGanar.style.display = "none";
        this.contenidoPopupGanar.classList.remove("mostrar");
    }
} 

export default VistaGanarPerder;