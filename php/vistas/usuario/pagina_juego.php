<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
        <link rel="stylesheet" href="../src/css/styleUsuario.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <title>Mockup Jugando Partida</title>
    </head>
    <body class="body_rafa">


        <!-- POP-UP DE INFORMACIÓN -->
        <div id="pantalla-informacion" class="pantalla-popup">
            <div class="guia-modal" id="modal-info">
                <button id="boton-cerrar" class="x-cerrar">X</button>
                <h2>GUÍA DE INDICADORES</h2>
                <div class="fila-top">
                    <div class="indicador-box celda">
                        <div class="circulo verde"></div>
                        <p class="textoCentrado"><strong>CORRECTO</strong></p>
                        <p class="textoCentrado">Has acertado el atributo.</p>
                    </div>
                    <div class="indicador-box celda">
                        <div class="circulo celda amarillo"></div>
                        <p class="textoCentrado"><strong>PARCIAL</strong></p>
                        <p class="textoCentrado">El atributo contiene una parte.</p>
                    </div>
                    <div class="indicador-box celda">
                        <div class="circulo rojo"></div>
                        <p class="textoCentrado"><strong>INCORRECTO</strong></p>
                        <p class="textoCentrado">El atributo no es el correcto.</p>
                    </div>
                </div>
                <div class="box-inferior celda">
                    <div class="flechas">
                        <span class="flecha-up">▲</span>
                        <span class="flecha-down">▼</span>
                    </div>
                    <p class="textoCentrado"><strong>AÑO DE FUNDACIÓN</strong></p>
                    <p class="desc-menor textoCentrado">Las flechas indican si el año de fundacion de la asociacion correcta es mayor & o menor ¥ que el de tu intento.</p>
                </div>
            </div>
        </div>
        <!-- FIN DE POP-UP DE INFORMACIÓN -->


        <!-- POP-UP DE PISTAS -->
         <div id="pantalla-pistas" class="pantalla-popup">
            <div class="guia-modal" id="modal-pistas">
                <button id="boton-cerrar-pistas" class="x-cerrar">X</button>
                <h2>PISTAS</h2>
                <div class="fila-top">
                    <div class="indicador-box celda">
                        <p class="textoCentrado"><strong>Pista 1 (Difícil)</strong></p>
                        <p id="interrogacionesDificil" class="textoCentrado">????</p>
                        <p id="textoDificil" class="textoCentrado">Se desbloquea en el intento 3</p>
                    </div>
                    <div class="indicador-box celda">
                        <p class="textoCentrado"><strong>Pista 2 (Media)</strong></p>
                        <p id="interrogacionesMedia" class="textoCentrado">????</p>
                        <p id="textoMedia" class="textoCentrado">Se desbloquea en el intento 5</p>
                    </div>
                    <div class="indicador-box celda">
                        <p class="textoCentrado"><strong>Pista 3 (Fácil)</strong></p>
                        <p id="interrogacionesFacil" class="textoCentrado">????</p>
                        <p id="textoFacil" class="textoCentrado">Se desbloquea en el intento 8</p>
                    </div>
                </div>
            </div>
         </div>
        <!-- FIN DE POP-UP DE PISTAS -->


        <!-- POP-UP DE VICTORIA -->
        <div id="pantalla-victoria" class="pantalla-popup">
            <div class="guia-modal" id="modal-ganar">
                <h2>¡HAS GANADO!</h2>
                <div class="fila-top">
                    <div class="indicador-box quitarBorde">
                        <p id="texto-tiempo-victoria" class="textoCentrado celda">Has adivinado la asociación en 00:06.</p>
                        <p class="textoCentrado celda">La asociacion era:</p>
                        <img src="../src/img/cruzRoja.webp" alt="" class="estiloFundacion">
                        <p id="victoriaAsociacionEra" class="textoCentrado celda"><strong>Médicos Sin Fronteras</strong></p>
                        <a href="./pagina_juego.php"><button id="jugar">Jugar de nuevo</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE POP-UP DE VICTORIA -->


        <!-- POP-UP DE DERROTA -->
        <div id="pantalla-derrota" class="pantalla-popup">
            <div class="guia-modal" id="modal-perder">
                <h2>¡HAS PERDIDO!</h2>
                <div class="fila-top">
                    <div class="indicador-box quitarBorde celda">
                        <p class="textoCentrado">Has agotado tus 10 intentos.</p>
                        <p class="textoCentrado">La asociacion era:</p>
                        <img src="../src/img/cruzRoja.webp" alt="" class="estiloFundacion">
                        <p class="textoCentrado"><strong id="derrotaAsociacionEra">Médicos Sin Fronteras</strong></p>
                        <a href="./pagina_juego.php"><button id="jugar-derrota">Jugar de nuevo</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE POP-UP DE DERROTA -->


        <header class="header_rafa">
            <span>Asociaciondle</span>
            <button id="usuario"><i id="icono-boton-usuario" class="fa-solid fa-user"></i></button>
        </header>
        <div id="desplegable">
            <ul>
                <p id="nombreDes">Usuario</p>
                <p>usuario@hotmail.com</p>
                <hr>
                <li><i class="fa-solid fa-gamepad"></i> <a href="./index.php?c=Juego&m=cargarPagina">Jugar</a></li>
                <li><i class="fa-solid fa-book"></i><a href="./index.php?c=Colecciones&m=cargarPagina">Colección</a></li>
                <li><i class="fa-solid fa-trophy"></i><a href="./index.php?c=Ranking&m=cargarPagina">Ranking</a></li>
                <hr>
                <li><i class="fa-solid fa-key"></i> <a href="./index.php?c=Cambio&m=cargarPagina">Cambiar Contraseña</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="login.html">Cerrar sesión</a></li>
            </ul>
        </div>
        <nav id="nav_crono">
            <button id="boton-info" class="azul"><i id="icono-boton-info" class="fa-solid fa-info tam-img colorBlanco"></i></button>
            <button id="boton-pistas" class="amarillo"><i class="fa-regular fa-lightbulb tam-img colorBlanco"></i></button>
            <div id="crono" class="textoCentrado">
                <i class="fa-solid fa-stopwatch gris estiloCrono"></i>
                <br><br><span class="negro">00:00</span>
            </div>
        </nav>
        <main class="main_rafa">
            <h1>Adivina la asociación</h1>
            <h4 class="gris"><span id="contador-intentos">Intento 0 de 10</span></h4>
            <select id="select-asociacion" name="opcion-usuario">
                <option value="" disabled selected>Introduce una Asociación</option>
                <?php
                    foreach ($datos as $nombreAsociacion) {
                        echo '<option value="'.$nombreAsociacion.'">'.$nombreAsociacion.'</option>';
                    }
                ?>
            </select>
            <div id="contenedor-encabezados">
                <div class="encabezado textoCentrado">Asociación</div>
                <div class="encabezado textoCentrado">Dirigido a</div>
                <div class="encabezado textoCentrado">Año Fund.</div>
                <div class="encabezado textoCentrado">Alcance GEO.</div>
                <div class="encabezado textoCentrado">Contribuciones</div>
            </div>
            <div id="contenedor-resultados" style="display: none;">
                <div class="celda rojo textoCentrado">Cruz Roja</div>
                <div class="celda rojo textoCentrado">Personas</div>
                <div class="celda verde textoCentrado">1998</div>
                <div class="celda rojo textoCentrado">Local</div>
                <div class="celda rojo textoCentrado">Educación, Inclusión</div>

                <div class="celda rojo textoCentrado">Cáritas</div>
                <div class="celda rojo textoCentrado">Jóvenes</div>
                <div class="celda rojo textoCentrado">1863</div>
                <div class="celda rojo textoCentrado">Internacional</div>
                <div class="celda amarillo textoCentrado">Salud, Educación</div>
            </div>
        </main>
        <script type="module" src="../src/js/app.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
  const asociacionesSelect = new Choices('#select-asociacion', {
    searchEnabled: true,      // permite escribir para buscar
    itemSelectText: '',       // quita el texto "Press to select"
    shouldSort: false,        // mantiene el orden original
    searchPlaceholderValue: 'Buscar...', 
  });
</script>
    </body>
</html>