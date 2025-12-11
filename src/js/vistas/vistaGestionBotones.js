export class VistaGestionBotones{
    constructor(){
        this.botonesAnadir  = document.querySelectorAll('.boton-añadir');
        this.iconosPape = document.querySelectorAll('.fa-solid,.fa-trash-can');
        console.log("constructor vista");
    }
    async sesion(){
        const rol= await fetch ('index.php?c=Login&m=traerRol');
        const dato = await rol.json();
        this.habilitar(dato);
    }
    habilitar(dato){
        if(dato == 'A'){
            this.iconosPape.forEach(boton => boton.classList.add("desactivado"));
            this.botonesAnadir.forEach(boton => boton.style.display = "none");
        }
    }
}