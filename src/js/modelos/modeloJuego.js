export class ModeloJuego {
    constructor(asociacionObjetivo, listaMaestra) {
        
        // 1. Convertimos los datos de la BD al formato que usa tu lógica de JS
        // Si no vienen datos (null), usamos un objeto vacío para que no rompa
        this.asociacionObjetivo = asociacionObjetivo ? this._mapearDatosBD(asociacionObjetivo) : {};
        
        // Mapeamos toda la lista para que las búsquedas funcionen
        this.listaMaestraAsociaciones = (listaMaestra || []).map(assoc => this._mapearDatosBD(assoc));

        this.juegoGanado = false;
        this.cronometro = { 
            estaCorriendo: false,
            tiempoInicio: 0,
            tiempoTranscurrido: 0,
            idIntervalo: null
        };
        this.intentosRealizados = []; 
        this.intentoActual = 1;
        this.alCambiarModelo = () => {}; 
    }

    _mapearDatosBD(datoBD) {
        return {
            // Ajusta 'datoBD.nombre_columna' según venga exactamente en el JSON de PHP
            nombre: datoBD.nombre, 
            
            // Asumiendo que 'dirigidoA' viene en 'pista_facil' o 'nombre_tipo'
            dirigidoA: datoBD.pista_facil || datoBD.nombre_tipo || "General", 
            
            // Convertimos la fecha 'YYYY-MM-DD' a solo el año (número)
            anioFundacion: datoBD.fecha_fun,
            
            // Mapeo directo de 'alcance' (SQL) a 'alcanceGeografico' (JS)
            alcanceGeografico: datoBD.alcance, 
            
            // Si PHP no manda array de contribuciones, ponemos vacío para evitar error
            contribuciones: datoBD.descripcion,
        };
    }

    iniciarCrono() {
        if (this.cronometro.estaCorriendo) return;
        this.cronometro.estaCorriendo = true;
        this.cronometro.tiempoInicio = Date.now() - this.cronometro.tiempoTranscurrido;
        
        this.cronometro.idIntervalo = setInterval(() => {
            this.cronometro.tiempoTranscurrido = Date.now() - this.cronometro.tiempoInicio;
            this.alCambiarModelo();
        }, 1000);
    }
    
    obtenerTiempoFormateado() {
        const totalMilisegundos = this.cronometro.tiempoTranscurrido || 0; 
        const totalSegundos = Math.floor(totalMilisegundos / 1000);
        const minutos = Math.floor(totalSegundos / 60).toString().padStart(2, '0'); 
        const segundos = (totalSegundos % 60).toString().padStart(2, '0');
        return `${minutos}:${segundos}`;
    }

    detenerCrono() {
        if (this.cronometro.idIntervalo) {
            clearInterval(this.cronometro.idIntervalo);
            this.cronometro.estaCorriendo = false;
            console.log("Se terminó el juego.");
        }
    }

    registrarIntento(intentoAsociacion) {
        this.iniciarCrono();
        const resultados = this._compararAsociacion(intentoAsociacion);
        
        // Si no se encontró la asociación, salimos para evitar errores
        if (!resultados || resultados.length === 0) return;

        const victoria = resultados.every(celda => celda.color === 'verde');

        if (victoria) {
            this.juegoGanado = true;
            this.detenerCrono();
        }

        this.intentosRealizados.push({
            id: this.intentoActual++,
            asociacion: intentoAsociacion,
            celdas: resultados 
        });

        this.alCambiarModelo();
    }
    
    _compararAsociacion(nombreIntento) {
        // Buscamos en la lista maestra (que ya está traducida/mapeada)
        const datosIntento = this.listaMaestraAsociaciones.find(a => a.nombre === nombreIntento);
        
        if (!datosIntento) {
            console.warn(`ModeloJuego: No se encontró la asociación con nombre: ${nombreIntento}`);
            return [];
        }
        
        const objetivo = this.asociacionObjetivo;
        const resultados = [];

        // 1. NOMBRE
        let colorAsociacion = nombreIntento === objetivo.nombre ? 'verde' : 'rojo';
        resultados.push({ valor: nombreIntento, color: colorAsociacion });

        // 2. DIRIGIDO A
        const valorDirigido = `${datosIntento.dirigidoA}`;
        if (datosIntento.dirigidoA === objetivo.dirigidoA) {
            resultados.push({ valor: valorDirigido, color: 'verde' });
        } else {
            // Comparación laxa (si contiene la palabra)
            const objetivoPalabra = String(objetivo.dirigidoA).split(' ')[0].toLowerCase();
            const intentoPalabra = String(datosIntento.dirigidoA).toLowerCase();
            if (intentoPalabra.includes(objetivoPalabra) || objetivoPalabra.includes(intentoPalabra)) {
                resultados.push({ valor: valorDirigido, color: 'amarillo' });
            } else {
                resultados.push({ valor: valorDirigido, color: 'rojo' });
            }
        }
        
        // 3. AÑO FUNDACION
        const valorAnio = `${datosIntento.anioFundacion}`;
        const diferenciaAnios = Math.abs(datosIntento.anioFundacion - objetivo.anioFundacion);
        if (diferenciaAnios === 0) {
            resultados.push({ valor: valorAnio, color: 'verde' });
        } else if (diferenciaAnios <= 10) { 
            resultados.push({ valor: valorAnio, color: 'amarillo' });
        } else {
            resultados.push({ valor: valorAnio, color: 'rojo' });
        }

        // 4. ALCANCE GEOGRAFICO
        const mapaAlcance = { 'I': 'Internacional', 'N': 'Nacional', 'L': 'Local' };
        // Si el valor ya viene completo, úsalo, si no, usa el mapa
        const textoAlcance = mapaAlcance[datosIntento.alcanceGeografico] || datosIntento.alcanceGeografico;
        const valorAlcance = `Alcance: ${textoAlcance}`;

        if (datosIntento.alcanceGeografico === objetivo.alcanceGeografico) {
            resultados.push({ valor: valorAlcance, color: 'verde' });
        } else {
            resultados.push({ valor: valorAlcance, color: 'rojo' });
        }
        
        // 5. CONTRIBUCIONES
        // Nota: Esto requiere que el backend envíe un array en 'contribuciones'
        let colorContribuciones = 'rojo';
        const contribArray = Array.isArray(datosIntento.contribuciones) ? datosIntento.contribuciones : [];
        const objContribArray = Array.isArray(objetivo.contribuciones) ? objetivo.contribuciones : [];

        const coincidencias = contribArray.filter(c => objContribArray.includes(c));
        
        if (coincidencias.length === objContribArray.length && coincidencias.length > 0 && objContribArray.length > 0) {
            colorContribuciones = 'verde';
        } else if (coincidencias.length > 0) {
            colorContribuciones = 'amarillo';
        }
        
        const valorContribuciones = `${contribArray.join(', ')}`;
        resultados.push({ valor: valorContribuciones, color: colorContribuciones });

        return resultados;
    }

    enlazarCambios(callback) {
        this.alCambiarModelo = callback;
    }
}