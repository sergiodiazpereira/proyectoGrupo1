class VistaInformacion{
    constructor(){
        this.menu = document.getElementById("pantalla-modal");
        this.botonInformacion = document.getElementById("informacion");
        this.iconoBotonInformacion = document.getElementById("icono-boton-informacion");
        this.botonCerrar = document.getElementById("boton-cerrar");
        this.botonInformacion.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.iconoBotonInformacion.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.botonCerrar.addEventListener('click', (e) => {
            this.ocultarMenu();
        });
    }



    mostrarMenu(){
        this.menu.classList.add("mostrar");
    }



    ocultarMenu(){
        this.menu.classList.remove("mostrar");
    }
}

export default VistaInformacion;