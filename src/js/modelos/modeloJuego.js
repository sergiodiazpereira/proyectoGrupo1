// js/modelos/ModeloJuego.js

export class ModeloJuego {
    constructor() {
        // Estado del cronómetro
        this.cronometro = { 
            estaCorriendo: false,
            tiempoInicio: 0,
            tiempoTranscurrido: 0,
            idIntervalo: null // ID para poder detener el setInterval
        };
        this.intentosRealizados = []; // Almacena las filas de la tabla
        this.intentoActual = 1;
        
        // Método para notificar a la Vista (Patrón Observador)
        this.alCambiarModelo = () => {}; 
    }

    // --- LÓGICA DEL CRONÓMETRO ---
    iniciarCrono() {
        if (this.cronometro.estaCorriendo) return;

        this.cronometro.estaCorriendo = true;
        this.cronometro.tiempoInicio = Date.now();
        
        this.cronometro.idIntervalo = setInterval(() => {
            this.cronometro.tiempoTranscurrido = Date.now() - this.cronometro.tiempoInicio;
            this.alCambiarModelo(); // Notifica a la Vista para actualizar el tiempo
        }, 1000);
    }
    
    obtenerTiempoFormateado() {
        const totalSegundos = Math.floor(this.cronometro.tiempoTranscurrido / 1000);
        const minutos = Math.floor(totalSegundos / 60).toString().padStart(2, '0');
        const segundos = (totalSegundos % 60).toString().padStart(2, '0');
        return `${minutos}:${segundos}`;
    }

    // --- LÓGICA DE JUEGO (Botón Introducir) ---
    registrarIntento(intentoAsociacion) {
        // 1. Activar Cronómetro (si es el primer intento)
        this.iniciarCrono();

        // 2. Simular lógica de comparación de la asociación adivinada
        const resultados = this._compararAsociacion(intentoAsociacion);
        
        // 3. Insertar Fila con colores de celda
        this.intentosRealizados.push({
            id: this.intentoActual++,
            asociacion: intentoAsociacion,
            celdas: resultados // Contiene los colores (verde, rojo, amarillo)
        });

        // 4. Notificar a la Vista para que dibuje la nueva fila y el cronómetro
        this.alCambiarModelo();
    }

    _compararAsociacion(nombreIntento) {
        // 1. **RECOGIDA DINÁMICA DE DATOS**
        const datosIntento = this.listaMaestraAsociaciones.find(a => a.nombre === nombreIntento);

        if (!datosIntento) {
            // Manejar el caso de que la asociación no exista (aunque no debería si viene del select)
            return []; 
        }
        
        const objetivo = this.asociacionObjetivo;
        const resultados = [];

        // --- Criterios de Comparación por Columna ---
        
        // COLUMNA 1: Asociación
        let colorAsociacion = 'rojo';
        if (nombreIntento === objetivo.nombre) {
            colorAsociacion = 'verde';
            // Si es verde, el juego ha terminado.
        } else if (this._esSimilar(nombreIntento, objetivo.nombre)) { 
            colorAsociacion = 'amarillo';
        }
        resultados.push({ valor: nombreIntento, color: colorAsociacion });


        // COLUMNA 2: Dirigido a
        const valorDirigido = `Dirigido a: ${datosIntento.dirigidoA}`;
        if (datosIntento.dirigidoA === objetivo.dirigidoA) {
            resultados.push({ valor: valorDirigido, color: 'verde' });
        } else if (datosIntento.dirigidoA.includes(objetivo.dirigidoA.split(' ')[0])) {
            // Ejemplo de Amarillo: Si el público objetivo es de la misma "familia"
            resultados.push({ valor: valorDirigido, color: 'amarillo' });
        } else {
            resultados.push({ valor: valorDirigido, color: 'rojo' });
        }
        
        
        // COLUMNA 3: Año de Fundación
        const valorAnio = `Año Fund.: ${datosIntento.anioFundacion}`;
        const diferenciaAnios = Math.abs(datosIntento.anioFundacion - objetivo.anioFundacion);
        if (diferenciaAnios === 0) {
            resultados.push({ valor: valorAnio, color: 'verde' });
        } else if (diferenciaAnios <= 10) { 
            // Ejemplo de Amarillo: Si el año está a menos de 10 años del objetivo
            resultados.push({ valor: valorAnio, color: 'amarillo' });
        } else {
            resultados.push({ valor: valorAnio, color: 'rojo' });
        }

        // COLUMNA 4: Alcance Geográfico
        const valorAlcance = `Alcance GEO.: ${datosIntento.alcanceGeografico}`;
        if (datosIntento.alcanceGeografico === objetivo.alcanceGeografico) {
            resultados.push({ valor: valorAlcance, color: 'verde' });
        } else {
            resultados.push({ valor: valorAlcance, color: 'rojo' });
        }
        
        
        // COLUMNA 5: Contribuciones
        let colorContribuciones = 'rojo';
        const coincidencias = datosIntento.contribuciones.filter(c => objetivo.contribuciones.includes(c));
        
        if (coincidencias.length > 0 && coincidencias.length === objetivo.contribuciones.length) {
            colorContribuciones = 'verde';
        } else if (coincidencias.length > 0) {
            colorContribuciones = 'amarillo';
        }
        
        const valorContribuciones = `Contribuciones: ${datosIntento.contribuciones.join(', ')}`;
        resultados.push({ valor: valorContribuciones, color: colorContribuciones });

        return resultados;
    }

    // (Función auxiliar para comparar similitud, si se desea un Amarillo más complejo)
    _esSimilar(str1, str2) {
        // Podría usar alguna métrica de distancia de cadena o simplemente un chequeo de palabras clave.
        return str1.toLowerCase().includes(str2.toLowerCase().split(' ')[0]);
    }

    // Método para que el Controlador se 'suscriba' a los cambios
    enlazarCambios(callback) {
            this.alCambiarModelo = callback;
        }
    }