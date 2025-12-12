class VistaGaleria{
    /**
     * 
     * @param {ServicioGaleria} servicio - Servicio de la galeria
     */
    constructor(servicio){
        //this.servicio = servicio;
        /*Recojo el modal el boton abrir y el boton de cerrar */
        this.servicio = servicio;
        this.modal = document.getElementById("modal-galeria");
        this.btnAbrir = document.getElementById("abrirModal");
        this.btnCerrar = document.getElementById("cerrarModal");
        this.select = document.getElementById("selectAsociacion");
        this.h2 = document.getElementById("h2listagaleria");
        /*Si pulso abrir quito la clase oculto y si lo cierro la añado */
        this.btnAbrir.onclick = () => this.modal.classList.remove("oculto");
        this.btnCerrar.onclick = () => this.modal.classList.add("oculto");
        this.select.addEventListener("change", async () => { // Detecta que se ha cambiado de asociación
            try {
                await this.servicio.inicializar();  // Llamamos a inicializar y esperamos a que cargue los datos
            } catch (error) {
                console.error("Error al cargar imágenes:", error);
            }
            if (this.select.value == "") {
                this.h2.innerText = "Lista de imagenes";
                this.mostrarTodasLasImagenes(this.servicio.datosImagenes);
            } else {
                let textoDeSelect = this.select.options[this.select.value].text; // Coge el texto del option que tiene el value enviado
                this.h2.innerText = "Lista de imagenes de " + textoDeSelect;
                console.log(this.servicio.imagenesDeAsociacion(this.select.value));
            }
        });
        /*Esto es por si clico fuera del modal se cierra */
        window.onclick = (event) => {
            if (event.target === this.modal) {
                this.modal.classList.add("oculto");
            }
        }
    }

    mostrarTodasLasImagenes(imagenesAMostrar){ // VOY POR AQUI (MOSTRAR IMAGENES)
        imagenesAMostrar.forEach(imagen => {
            
        });
    }
} 

export default VistaGaleria;