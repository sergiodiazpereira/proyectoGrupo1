export class VistaGestionBotones {
    constructor() {
        this.botonesAnadir = document.querySelectorAll('.boton-añadir');
        this.filasAdminYSuper = document.querySelectorAll('.rol-admin, .rol-superadmin');
        this.filasSuper = document.querySelectorAll('.rol-superadmin');
    }
    /**
     * @returns esta funcion llama al constructor del login que me traera el $_SESSION['permiso']
     */
    async sesion() {
        const rol = await fetch('index.php?c=Login&m=traerRol');
        const dato = await rol.json();
        this.habilitar(dato);
    }
    /**
     * 
     * @param {*} dato este es el rol del usuario traido del la parte de php
     */
    habilitar(dato) {
        if (dato == 'S') {
            //Recorro todas las filas que tengan el admin o super admin/
            this.filasSuper.forEach(span => {
                //Busco la fila mas cercana para poder extraer el icono y el enlace/
                const fila = span.closest('tr');
                const icono = fila.querySelector('.fa-trash-can');
                const enlace = fila.querySelector('a');
                if (icono) icono.classList.add("desactivado");
                if (enlace) enlace.style.pointerEvents = 'none';
            });
        }
        if (dato == 'A') {
            /*Recorro todas las filas que tengan el admin o super admin */
            this.filasAdminYSuper.forEach(span => {
                /*Busco la fila mas cercana para poder extraer el icono y el enlace*/
                const fila = span.closest('tr');
                const icono = fila.querySelector('.fa-trash-can');
                const enlace = fila.querySelector('a');
                if (icono) icono.classList.add("desactivado");
                if (enlace) enlace.style.pointerEvents = 'none';
            });
            this.botonesAnadir.forEach(boton => boton.style.display = "none");
        }
    }
}