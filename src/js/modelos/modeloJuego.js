export class ModeloJuego {
    constructor() {
        this.asociacionObjetivo = {
            nombre: 'Médicos Sin Fronteras',
            dirigidoA: 'Personas en conflicto',
            anioFundacion: 1971,
            alcanceGeografico: 'I',
            contribuciones: ['Salud', 'Emergencias']
        };

        this.listaMaestraAsociaciones = [
            { 
                nombre: 'Cruz Roja', 
                dirigidoA: 'Jóvenes',
                anioFundacion: 1863, 
                alcanceGeografico: 'I', 
                contribuciones: ['Eduación', 'Salud'] 
            },
            { 
                nombre: 'Unicef', 
                dirigidoA: 'Personas',
                anioFundacion: 2002, 
                alcanceGeografico: 'N', 
                contribuciones: ['Eduación', 'Protección Infantil', 'Salud'] 
            },
            { 
                nombre: 'Fundación Loyola', 
                dirigidoA: 'Personas',
                anioFundacion: 2000, 
                alcanceGeografico: 'I', 
                contribuciones: ['Eduación', 'Protección Infantil'] 
            },
            { 
                nombre: 'Cáritas', 
                dirigidoA: 'Discapacitados',
                anioFundacion: 1988, 
                alcanceGeografico: 'L', 
                contribuciones: ['Protección Infantil', 'Salud'] 
            },
            this.asociacionObjetivo 
        ];
        
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
        //El padstart se utiliza para dar formato al crono, el 2 se utiliza para indicar la longitud total de la cadena en el crono,
        //y el 0 es para darle un valor inicial
        const minutos = Math.floor(totalSegundos / 60).toString().padStart(2, '0'); 
        const segundos = (totalSegundos % 60).toString().padStart(2, '0');
        return `${minutos}:${segundos}`;
    }

    detenerCrono()
    {
        if (this.cronometro.idIntervalo)
        {
            clearInterval(this.cronometro.idIntervalo);
            this.cronometro.estaCorriendo = false;
            console.log("Se terminó el juego.");
        }
    }

    registrarIntento(intentoAsociacion) {
        this.iniciarCrono();
        const resultados = this._compararAsociacion(intentoAsociacion);
        const victoria = resultados.every(celda => celda.color === 'verde');

        if (victoria)
        {
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
        const datosIntento = this.listaMaestraAsociaciones.find(a => a.nombre === nombreIntento);
        if (!datosIntento) {
            console.warn(`ModeloJuego: No se encontró la asociación con nombre: ${nombreIntento}`);
            return [];
        }
        
        const objetivo = this.asociacionObjetivo;
        const resultados = [];

        let colorAsociacion = nombreIntento === objetivo.nombre ? 'verde' : 'rojo';
        resultados.push({ valor: nombreIntento, color: colorAsociacion });

        const valorDirigido = `${datosIntento.dirigidoA}`;
        if (datosIntento.dirigidoA === objetivo.dirigidoA) {
            resultados.push({ valor: valorDirigido, color: 'verde' });
        } else {
            const objetivoPalabra = objetivo.dirigidoA.split(' ')[0].toLowerCase();
            const intentoPalabra = datosIntento.dirigidoA.toLowerCase();
            if (intentoPalabra.includes(objetivoPalabra) || objetivoPalabra.includes(intentoPalabra)) {
                resultados.push({ valor: valorDirigido, color: 'amarillo' });
            } else {
                resultados.push({ valor: valorDirigido, color: 'rojo' });
            }
        }
        
        const valorAnio = `${datosIntento.anioFundacion}`;
        const diferenciaAnios = Math.abs(datosIntento.anioFundacion - objetivo.anioFundacion);
        if (diferenciaAnios === 0) {
            resultados.push({ valor: valorAnio, color: 'verde' });
        } else if (diferenciaAnios <= 10) { 
            resultados.push({ valor: valorAnio, color: 'amarillo' });
        } else {
            resultados.push({ valor: valorAnio, color: 'rojo' });
        }

        const mapaAlcance = { 'I': 'Internacional', 'N': 'Nacional', 'L': 'Local' };
        const valorAlcance = `${mapaAlcance[datosIntento.alcanceGeografico]}`;

        console.log('Intento Alcance:', datosIntento.alcanceGeografico);
        console.log('Objetivo Alcance:', objetivo.alcanceGeografico);
        if (datosIntento.alcanceGeografico === objetivo.alcanceGeografico) {
            resultados.push({ valor: valorAlcance, color: 'verde' });
        } else {
            resultados.push({ valor: valorAlcance, color: 'rojo' });
        }
        
        let colorContribuciones = 'rojo';
        const coincidencias = datosIntento.contribuciones.filter(c => objetivo.contribuciones.includes(c));
        
        if (coincidencias.length === objetivo.contribuciones.length && coincidencias.length > 0) {
            colorContribuciones = 'verde';
        } else if (coincidencias.length > 0) {
            colorContribuciones = 'amarillo';
        }
        
        const valorContribuciones = `${datosIntento.contribuciones.join(', ')}`;
        resultados.push({ valor: valorContribuciones, color: colorContribuciones });

        return resultados;
    }

    enlazarCambios(callback) {
        this.alCambiarModelo = callback;
    }
}