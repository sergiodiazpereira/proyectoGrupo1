class VistaGaleria{
    /**
     * 
     * @param {ServicioGaleria} servicio - Servicio de la galeria
     */
    constructor(servicio){
        //this.servicio = servicio;
        /*Recojo el modal el boton abrir y el boton de cerrar */
        this.servicio = servicio;
        this.ruta = '../src/img/galeria/';
        this.contenedorImagenes = document.getElementById("contenedorImagenes");
        this.modal = document.getElementById("modal-galeria");
        this.btnAbrir = document.getElementById("abrirModal");
        this.btnCerrar = document.getElementById("cerrarModal");
        this.btnCerrar2 = document.getElementById("cerrarModal2");
        this.select = document.getElementById("selectAsociacion");
        this.h2 = document.getElementById("h2listagaleria");
        this.inputArchivo = document.getElementById('subirArchivo');
        this.labelArchivo = document.getElementById('labelArchivo');

        /*Si pulso abrir quito la clase oculto y si lo cierro la añado */
        this.btnAbrir.onclick = () => this.modal.classList.remove("oculto");
        this.btnCerrar.onclick = () => this.modal.classList.add("oculto");
        this.btnCerrar2.onclick = () => this.modal.classList.add("oculto");

        this.mostrarTodasLasImagenes(this.servicio.datosImagenes);
        this.botonesEliminarImagen = document.querySelectorAll('.eliminar'); // Despues de que se hayan desplegado todos los botones de las imagenes, nos los traemos a una variable
        this.botonesEliminarImagen.forEach(boton => {
            boton.addEventListener('click', function() {
                const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó
                div.remove();
            });
        });

        this.select.addEventListener("change", async () => { // Detecta que se ha cambiado de asociación
            try {
                await this.servicio.inicializar();  // Llamamos a inicializar y esperamos a que cargue los datos
            } catch (error) {
                console.error("Error al cargar imágenes:", error);
            }
            if (this.select.value == "") {
                contenedorImagenes.innerHTML = "";
                this.h2.innerText = "Lista de imagenes";
                this.mostrarTodasLasImagenes(this.servicio.datosImagenes);
            } else {
                contenedorImagenes.innerHTML = "";
                let textoDeSelect = this.select.options[this.select.selectedIndex].text; // Coge el texto del option que tiene el value enviado
                this.h2.innerText = "Lista de imagenes de " + textoDeSelect;
                this.mostrarImagenesDeAsociacion(this.servicio.datosImagenes);
            }
                // TENEMOS QUE ASIGNAR DE NUEVO LOS BOTONES DENTRO DEL LISTENER "CHANGE" PORQUE CADA VEZ QUE SE CAMBIA EL SELECT, CAMBIAN LOS BOTONES
                this.botonesEliminarImagen = document.querySelectorAll('.eliminar'); // Despues de que se hayan desplegado todos los botones de las imagenes, nos los traemos a una variable
                this.botonesEliminarImagen.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó
                        div.remove();
                    });
                });
        });


        
        /*Esto es por si clico fuera del modal se cierra */
        window.onclick = (event) => {
            if (event.target === this.modal) {
                this.modal.classList.add("oculto");
            }
        }

        this.inputArchivo.addEventListener('change', () => {
            if (this.inputArchivo.files.length > 0) {
                this.labelArchivo.innerText = this.inputArchivo.files[0].name;
            } else {
                console.log('No se seleccionó ningún archivo.');
            }
        });
    }





    /**
     * Esta funcion muestra en la vista todas las imagenes de la galería
     * @param {array} imagenesAMostrar 
     */
    mostrarTodasLasImagenes(imagenesAMostrar){
        imagenesAMostrar.forEach(imagen => {
            const tarjeta = document.createElement("div");
            tarjeta.classList.add("tarjeta", "disponible");

            tarjeta.innerHTML = `
                <img src="`+this.ruta + imagen.nombreImagen + `" alt="Imagen">
                <div class="acciones">
                    <button class="btn eliminar"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                </div>
        `;
        contenedorImagenes.appendChild(tarjeta);
        });
    }





    /**
     * Esta funcion muestra en la vista todas las imagenes asociadas a una asociacion
     * @param {array} imagenesAMostrar 
     */
    mostrarImagenesDeAsociacion(imagenesAMostrar){
        this.organizarPorDisponibilidad(imagenesAMostrar);
        imagenesAMostrar.forEach(imagen => {
            const tarjeta = document.createElement("div");
            if (imagen.idAsoc == null) {
                tarjeta.classList.add("tarjeta", "disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                        <button class="btn vincular"><i class="fa-solid fa-link"></i> Vincular</button>
                    </div>
                `;
                contenedorImagenes.appendChild(tarjeta);
            } else if (imagen.idAsoc == this.select.value){
                tarjeta.classList.add("tarjeta", "no-disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                        <button class="btn desvincular"><i class="fa-solid fa-link-slash"></i> Desvincular</button>
                    </div>
                `;
                contenedorImagenes.appendChild(tarjeta);
            }
        });
    }
    




    /**
     * Esta funcion reorganiza el array de imagenes y los ordena dando prioridad a los que tienen imagen asociada
     * @param {array} imagenes Este array contiene todas las imagenes 
     */
    organizarPorDisponibilidad(imagenes){
        imagenes.sort((a, b) => {
            if (a.idAsoc != null && b.idAsoc == null) return -1; // a primero
            if (a.idAsoc == null && b.idAsoc != null) return 1;  // b primero
            return 0; // mantener orden si ambos son null o ambos no null
        });
    }
} 

export default VistaGaleria;