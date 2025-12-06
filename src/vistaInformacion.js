class VistaInformacion{
    constructor(){
        this.popupInformacion = document.getElementById("pantalla-informacion");
        this.contenidoPopupInformacion = document.getElementById("modal-info");
        this.botonInformacion = document.getElementById("boton-info");
        this.iconoBotonInformacion = document.getElementById("icono-boton-info");
        this.botonCerrar = document.getElementById("boton-cerrar");

        this.botonInformacion.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.iconoBotonInformacion.addEventListener('click', () => {
            this.mostrarMenu();
        });


        this.botonCerrar.addEventListener('click', () => {
            this.ocultarMenu();
        });
    }

    mostrarMenu(){
        this.popupInformacion.style.display = "flex";
        setTimeout(() => {
            this.contenidoPopupInformacion.classList.add("mostrar");
        }, 1); /* timeout para que dé tiempo a hacer la animacion */
        this.contenidoPopupInformacion.style.display = "block";
    }



    ocultarMenu(){
        this.popupInformacion.style.display = "none";
        this.contenidoPopupInformacion.classList.remove("mostrar");
    }
}

export default VistaInformacion;