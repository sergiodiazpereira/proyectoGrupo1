class VistaMenu{
    constructor(){
        this.botonUsuario = document.getElementById("usuario");
        prompt("holas");
        this.botonUsuario.addEventListener('click', () => {
            this.mostrarMenu();
            prompt("hola");
        });
    }

    // funciones de mostrar/ocultar elementos
}