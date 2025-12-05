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