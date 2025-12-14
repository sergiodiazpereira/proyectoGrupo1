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

        this.desplegarGaleriaTodasImagenes();

        this.select.addEventListener("change", async () => { // Detecta que se ha cambiado de asociación
            try {
                await this.servicio.inicializar();  // Llamamos a inicializar y esperamos a que cargue los datos
            } catch (error) {
                console.error("Error al cargar imágenes:", error);
            }
            if (this.select.value == "") {
                contenedorImagenes.innerHTML = "";
                this.h2.innerText = "Lista de imagenes";
                this.desplegarGaleriaTodasImagenes();
            } else {
                contenedorImagenes.innerHTML = "";
                let textoDeSelect = this.select.options[this.select.selectedIndex].text; // Coge el texto del option que tiene el value enviado
                this.h2.innerText = "Lista de imagenes de " + textoDeSelect;
                this.desplegarGaleriaDeAsociacion(this.servicio.datosImagenes, this.select.options[this.select.selectedIndex].text);
            }
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
     * @param {array} imagenesAMostrar El array que lleva todos los datos de todas las imagenes
     */
    async mostrarTodasLasImagenes(imagenesAMostrar){
        for (const imagen of imagenesAMostrar) {
            const tarjeta = document.createElement("div");
            if (imagen.idAsoc == null){
                tarjeta.classList.add("tarjeta", "disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                    </div>
                `;
                contenedorImagenes.appendChild(tarjeta);
            } else{
                const asociacion = await this.servicio.obtenerNombrePorIdAsoc(imagen.idAsoc);
                tarjeta.classList.add("tarjeta", "disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + asociacion.nombre + "/" + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                    </div>
                `;
                contenedorImagenes.appendChild(tarjeta);
            }
        };
    }





    /**
     * Esta funcion muestra en la vista todas las imagenes asociadas a una asociacion
     * @param {array} imagenesAMostrar Array con los datos de todas las imagenes
     * @param {string} nombreAsociacion String con el nombre de la asociacion con las imagenes vinculadas
     */
    mostrarImagenesDeAsociacion(imagenesAMostrar, nombreAsociacion){
        this.organizarPorDisponibilidad(imagenesAMostrar);
        imagenesAMostrar.forEach(imagen => {
            const tarjeta = document.createElement("div");
            if (imagen.idAsoc == null) {
                tarjeta.classList.add("tarjeta", "disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                        <button class="btn vincular" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`" data-id-asociacion="`+imagen.idAsoc+`"><i class="fa-solid fa-link"></i> Vincular</button>
                    </div>
                `;
                contenedorImagenes.appendChild(tarjeta);
            } else if (imagen.idAsoc == this.select.value){
                tarjeta.classList.add("tarjeta", "no-disponible");

                tarjeta.innerHTML = `
                    <img src="`+this.ruta + nombreAsociacion + `/` + imagen.nombreImagen + `" alt="Imagen">
                    <div class="acciones">
                        <button class="btn eliminar" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                        <button class="btn desvincular" data-id-imagen="`+imagen.idImagen+`" data-nombre-imagen="`+imagen.nombreImagen+`"><i class="fa-solid fa-link-slash"></i> Desvincular</button>
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
    




    /**
     * Esta funcion muestra por primera vez la galería y la logica de los botones
     * Este array contiene todas las imagenes 
     */
    async desplegarGaleriaTodasImagenes(){
        await this.mostrarTodasLasImagenes(this.servicio.datosImagenes);
        
        // =================================================== LÓGICA DE BOTONES DE ELIMINAR ============================================================= //
        this.botonesEliminarImagen = document.querySelectorAll('.eliminar');
        
        this.botonesEliminarImagen.forEach(boton => {
            boton.addEventListener('click', async function() {
                const idImagen = this.dataset.idImagen;
                const nombreImagen = this.dataset.nombreImagen;
                try {
                    const respuesta = await fetch("index.php?c=Galeria&m=borrarImagen", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `idImagen=${encodeURIComponent(idImagen)}&nombreImagen=${encodeURIComponent(nombreImagen)}`
                    });
                    this.datos = await respuesta.json();

                    if (this.datos.imagenBorrada) {
                        const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó
                        div.remove();       
                    } else {
                        alert("Error: " + this.datos.mensaje);
                    }

                } catch (error) {
                    console.error("Error al llamar a PHP" + this.datos.mensaje);
                    alert("Error al eliminar la imagen." + this.datos.mensaje);
                }
            });
        });
    }
    




    /**
     * Esta funcion muestra la galería cuando se cambia de asociacion y añade tambien toda la logica de los botones
     * @param {array} datosImagenes Este array contiene todas las imagenes a mostrar
     * @param {string}  nombreAsociacion Este string contiene el nombre de la asociacion
     */
    desplegarGaleriaDeAsociacion(datosImagenes, nombreAsociacion){
        this.mostrarImagenesDeAsociacion(datosImagenes, nombreAsociacion);



        // =================================================== LÓGICA DE BOTONES DE ELIMINAR ============================================================= //
        this.botonesEliminarImagen = document.querySelectorAll('.eliminar');
        
        this.botonesEliminarImagen.forEach(boton => {
            boton.addEventListener('click', async function() {
                const idImagen = this.dataset.idImagen;
                const nombreImagen = this.dataset.nombreImagen;
                try {
                    const respuesta = await fetch("index.php?c=Galeria&m=borrarImagen", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `idImagen=${encodeURIComponent(idImagen)}&nombreImagen=${encodeURIComponent(nombreImagen)}`
                    });
                    this.datos = await respuesta.json();

                    if (this.datos.imagenBorrada) {
                        const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó

                        div.remove();       
                    } else {
                        alert("Error: " + this.datos.mensaje);
                    }

                } catch (error) {
                    console.error("Error al llamar a PHP" + this.datos.mensaje);
                    alert("Error al eliminar la imagen." + this.datos.mensaje);
                }
            });
        });



        // =================================================== LÓGICA DE BOTONES DE VINCULAR ============================================================= //
        const idAsoc = this.select.value; 
        // TENEMOS QUE ASIGNAR DE NUEVO LOS BOTONES DENTRO DEL LISTENER "CHANGE" PORQUE CADA VEZ QUE SE CAMBIA EL SELECT, CAMBIAN LOS BOTONES
        this.botonesVincularImagen = document.querySelectorAll('.vincular'); // Despues de que se hayan desplegado todos los botones de las imagenes, nos los traemos a una variable
        this.botonesVincularImagen.forEach(boton => {
            boton.addEventListener('click', async function() {
                const idImagen = this.dataset.idImagen;
                const nombreImagen = this.dataset.nombreImagen;
                try {
                    const respuesta = await fetch("index.php?c=Galeria&m=vincularImagen", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `idImagen=${encodeURIComponent(idImagen)}&nombreImagen=${encodeURIComponent(nombreImagen)}&idAsoc=${encodeURIComponent(idAsoc)}`
                    });

                    this.datos = await respuesta.json();

                    if (this.datos.imagenVinculada) {
                        const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó

                        div.classList.remove('disponible');
                        div.classList.add('no-disponible');

                        const botonVincular = div.querySelector(".vincular");

                        botonVincular.classList.remove("vincular");
                        botonVincular.classList.add("desvincular");
                        botonVincular.disabled = true;
                        botonVincular.style.backgroundColor = '#d3d3d3';
                        botonVincular.style.color = '#5a5a5a';
                        botonVincular.style.cursor = 'default';
                        botonVincular.innerHTML = '<i class="fa-solid fa-link"></i> Vinculado';

                        this.botonesDesvincularincularImagen = document.querySelectorAll('.desvincular'); // Asignamos el nuevo boton desvincular
                                
                    } else {
                        alert("Error: " + this.datos.mensaje);
                    }
                } catch (error) {
                    console.error("Error al llamar a PHP" + this.datos.mensaje);
                    alert("Error al eliminar la imagen." + this.datos.mensaje);
                }
            });
        });



        // =================================================== LÓGICA DE BOTONES DE DESVINCULAR ========================================================== //
        // TENEMOS QUE ASIGNAR DE NUEVO LOS BOTONES DENTRO DEL LISTENER "CHANGE" PORQUE CADA VEZ QUE SE CAMBIA EL SELECT, CAMBIAN LOS BOTONES
        this.botonesDesvincularImagen = document.querySelectorAll('.desvincular'); // Despues de que se hayan desplegado todos los botones de las imagenes, nos los traemos a una variable
        this.botonesDesvincularImagen.forEach(boton => {
            boton.addEventListener('click', async function() {
                const idImagen = this.dataset.idImagen;
                const nombreImagen = this.dataset.nombreImagen;
                try {
                    const respuesta = await fetch("index.php?c=Galeria&m=desvincularImagen", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `idImagen=${encodeURIComponent(idImagen)}&nombreImagen=${encodeURIComponent(nombreImagen)}`
                    });
                    this.datos = await respuesta.json();

                    if (this.datos.imagenDesvinculada) {
                        const div = this.parentElement.parentElement; // obtiene el div padre del boton que se clickeó

                        div.classList.remove('no-disponible');
                        div.classList.add('disponible');

                        const botonVincular = div.querySelector(".desvincular");

                        botonVincular.classList.remove("desvincular");
                        botonVincular.classList.add("vincular");
                        botonVincular.disabled = true;
                        botonVincular.style.backgroundColor = 'var(--blanco-fondo-main)';
                        botonVincular.style.color = '#005fcc';
                        botonVincular.style.cursor = 'default';
                        botonVincular.innerHTML = '<i class="fa-solid fa-link-slash"></i> Desvinculado';

                        this.botonesVincularImagen = document.querySelectorAll('.vincular'); // Asignamos el nuevo boton vincular
                                
                    } else {
                        alert("Error: " + this.datos);
                    }
                } catch (error) {
                    console.error("Error al llamar a PHP" + error + "=============================" + this.datos);
                    alert("Error al eliminar la imagen."  + error + "=============================" + this.datos);
                }
            });
        });
    }
} 

export default VistaGaleria;