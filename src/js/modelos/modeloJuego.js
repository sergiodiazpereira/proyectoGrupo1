export class ModeloJuego {
    
    constructor(asociacionCorrecta, listaTodas) {
        // Blindaje contra listas vacías
        const listaSegura = listaTodas || [];

        // Mapeamos los datos (Aquí traduciremos la 'L' a 'Local')
        this.asociacionCorrecta = this._mapearDatosBD(asociacionCorrecta);
        this.listaOpciones = listaSegura.map(item => this._mapearDatosBD(item));
        
        this.intentos = [];
        this.maxIntentos = 10;
        this.juegoTerminado = false;
        
        // Cronómetro
        this.tiempoInicio = new Date(); 

        console.log("ModeloJuego INICIADO. Opciones cargadas:", this.listaOpciones.length);
    }

    /* PARA EL CONTROLADOR */
    enlazarCambios(callback) {
        this.onCambio = callback;
    }

    _mapearDatosBD(datoBD) {
        if (!datoBD) return null;

        const diccionarioAlcance = {
            'L': 'Local',
            'N': 'Nacional',
            'I': 'Internacional'
        };
        // Si viene 'L', devuelve 'Local'. Si no está en la lista, deja el original.
        const alcanceTraducido = diccionarioAlcance[datoBD.alcance] || datoBD.alcance;

        return {
            nombre: datoBD.nombre,
            
            dirigidoA: datoBD.pista_facil || datoBD.nombre_tipo || "General",

            anioFundacion: datoBD.fecha_fun,

            // ALCANCE: Usamos el traducido (Local, Nacional...)
            alcanceGeografico: alcanceTraducido,

            // CONTRIBUCIONES: Convertimos texto "A,B" a lista ["A","B"]
            contribuciones: (datoBD.contribuciones && typeof datoBD.contribuciones === 'string') ? datoBD.contribuciones.split(',') : [],
        };
    }

    /* LÓGICA DEL JUEGO */
    registrarIntento(nombreIntento) {
        if (this.juegoTerminado) return null;

        const nombreLimpio = nombreIntento.trim();
        const intento = this.listaOpciones.find(op => op.nombre === nombreLimpio);

        if (!intento) {
            console.error(`ERROR: No encuentro '${nombreLimpio}' en la lista.`);
            return null;
        }

        const resultado = this._compararAsociacion(intento);
        this.intentos.push(resultado);

        if (this.onCambio) this.onCambio(this.intentos);

        if (this.verificarVictoria(intento)) this.juegoTerminado = true;
        else if (this.intentos.length >= this.maxIntentos) this.juegoTerminado = true;

        return resultado;
    }

    obtenerTiempoFormateado() {
        const ahora = new Date();
        const diferencia = Math.floor((ahora - this.tiempoInicio) / 1000); 
        const minutos = Math.floor(diferencia / 60).toString().padStart(2, '0');
        const segundos = (diferencia % 60).toString().padStart(2, '0');
        return `${minutos}:${segundos}`;
    }

    _compararAsociacion(intento) {
        const correcta = this.asociacionCorrecta;
        
        let estados = {};

        // 1. LÓGICA DE COLORES
        estados.nombre = (intento.nombre === correcta.nombre) ? 'verde' : 'rojo';
        
        // Dirigido A (Rojo si falla)
        estados.dirigidoA = (intento.dirigidoA === correcta.dirigidoA) ? 'verde' : 'rojo';

        // Alcance (Como ya están traducidos a "Local", comparamos las palabras completas)
        estados.alcance = (intento.alcanceGeografico === correcta.alcanceGeografico) ? 'verde' : 'rojo';

        // Año
        let flecha = '';
        if (intento.anioFundacion == correcta.anioFundacion) {
            estados.anio = 'verde';
        } else {
            estados.anio = 'rojo';
            flecha = (correcta.anioFundacion > intento.anioFundacion) ? '▲' : '▼';
        }

        // Contribuciones
        const intentoStr = JSON.stringify(intento.contribuciones.sort());
        const correctaStr = JSON.stringify(correcta.contribuciones.sort());
        const coincidencias = intento.contribuciones.filter(c => correcta.contribuciones.includes(c));

        if (intentoStr === correctaStr) {
            estados.contribuciones = 'verde';
        } else if (coincidencias.length > 0) {
            estados.contribuciones = 'amarillo';
        } else {
            estados.contribuciones = 'rojo';
        }

        const celdasGeneradas = [
            { valor: intento.nombre, color: estados.nombre },
            { valor: intento.dirigidoA, color: estados.dirigidoA },
            { valor: intento.anioFundacion + ' ' + flecha, color: estados.anio },
            // Aquí se mostrará "Local" o "Nacional" gracias a la traducción de arriba
            { valor: intento.alcanceGeografico, color: estados.alcance }, 
            // Aquí unimos la lista con comas para que se lea bien: "Salud, Educación"
            { valor: intento.contribuciones.join(', ') || "Ninguna", color: estados.contribuciones }
        ];

        return {
            datos: intento,
            esCorrecto: intento.nombre === correcta.nombre,
            celdas: celdasGeneradas 
        };
    }

    verificarVictoria(intento) {
        return intento.nombre === this.asociacionCorrecta.nombre;
    }
    
    get intentosRealizados() {
        return this.intentos;
    }
    
    get juegoGanado() {
        return this.juegoTerminado && this.intentos.length > 0 && this.intentos[this.intentos.length - 1].esCorrecto;
    }

    /* //mio
    mostrarPista(num) {
        document.getElementById(`pista${num}`).classList.add("visible");
    } */
}