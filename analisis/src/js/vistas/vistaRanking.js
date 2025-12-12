export class VistaRanking {
    constructor(controlador) {
        this.controlador = controlador;
        this.caja = document.getElementById('cajaRanking');
        this.posicion = document.getElementsByClassName('posicion');
        this.jugador = document.getElementsByClassName('posicion');
        this.asociacion = document.getElementsByClassName('posicion');
        this.fecha = document.getElementsByClassName('posicion');
        this.tiempo = document.getElementsByClassName('posicion');
    }
    /**
     * 
     * @param {*} ranking esta variable contiene todo el ranking
     * Voy sacando los datos del ranking por pantalla y le pongo un trofeo de diferente color a los primeros
     */
    crearRanking(ranking) {
        ranking.forEach((puesto, indice) => {
            const div = document.createElement('div');
            div.style.display = 'contents';
            div.className = 'puesto';
            let posicion = indice + 1;
            switch (posicion) {
                case 1:
                    posicion = `<i class="fa-solid fa-trophy" style="color: #FFD43B;"></i>`;
                    break;
                case 2:
                    posicion = `<i class="fa-solid fa-trophy" style="color: #abb5beff;"></i>`;
                    break;
                case 3:
                    posicion = `<i class="fa-solid fa-trophy" style="color: #926105ff;"></i>`;
                    break;
            }
            div.innerHTML = `<h4 class="posicion">${posicion}</h4><h4 class="posicion">${puesto.jugador}</h4><h4 class="posicion">${puesto.asociacion}</h4><h4 class="posicion">${puesto.fecha}</h4><h4 class="tiempo">${puesto.tiempo}</h4>`;
            this.caja.appendChild(div);
        });
    }
    /**
     * 
     * @param {*} errores trae el error
     * Muestra los errores
     */
    mostrarErrores(errores) {
        let errorHTML = '';
        for (const campo in errores) {
            errorHTML += `<p style="color: red;">❌ ${errores[campo]}</p>`;
        }
        if (errorHTML) {
            this.mensajeResultado.innerHTML = errorHTML;
        }
    }
}