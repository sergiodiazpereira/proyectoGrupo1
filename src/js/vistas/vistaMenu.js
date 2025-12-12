class VistaMenu{
    constructor(){
        this.menu = document.getElementById("desplegable");
        this.botonUsuario = document.getElementById("usuario");
        this.iconoBotonUsuario = document.getElementById("icono-boton-usuario");

        this.botonUsuario.addEventListener('click', () => {
            this.mostrarMenu();
        });

        this.iconoBotonUsuario.addEventListener('click', () => {
            this.mostrarMenu();
        });

        document.addEventListener('click', (e) => {
            if (!this.menu.contains(e.target) && e.target !== this.iconoBotonUsuario && e.target !== this.botonUsuario) {
                this.ocultarMenu();
            }
        });
    }

    mostrarMenu(){
        this.menu.style.display = "flex";
    }
    
    ocultarMenu(){
        this.menu.style.display = "none";
    }
}
export default VistaMenu;