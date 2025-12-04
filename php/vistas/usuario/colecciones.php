<!DOCTYPE html>
<html>
    <head>
        <title>Asociaciondle</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../src/css/styleUsuario.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
    </head>
    <body class="body_kiko">
        <header>
            <a href="pagina_juego.php" id="flecha"><i class="fa-solid fa-arrow-left"></i></a>
            <span>Asociaciondle</span>
            <button id="usuario"><i class="fa-solid fa-user"></i></button>
        </header>
        <main class="main_kiko">
            <div id="coleccionPadre">
                <h1>Mi Colección</h1>
                <p>Explora las asociaciones que has adivinado y las que te faltan</p>
                <div id="gridColec">
                    <!--Esta son las cajas de referencia-->
                    <div class="cajaAsoc">
                        <div id="imgAsoc">
                            <img src="/src/img/logo_sin_fondo.png">
                            <h3>Nombre Asoc</h3>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="datosColec">
                            <p>Nombre:Unicef</p>
                            <p>Fundacion:1892</p>
                            <p>Alcance:Internacional</p>
                            <a href="https://www.msf.es/">https://www.msf.es/</a>
                        </div>
                    </div>
                    <div class="cajaAsoc">
                        <div id="imgAsoc">
                            <img src="/src/img/logo_sin_fondo.png">
                            <h3>Nombre Asoc2</h3>
                            <i class="fa-solid fa-lock-open"></i>
                        </div>
                        <div style="filter:none;" id="datosColec">
                            <p>Nombre:Unicef</p>
                            <p>Fundacion:1892</p>
                            <p>Alcance:Internacional</p>
                            <a href="https://www.msf.es/">https://www.msf.es/</a>
                        </div>
                    </div>
                    <!------------------------------------------->
                    <!---ESTAS DE DEBAJO SON DE PRUEBA----------->
                    <div class="cajaAsoc">
                        <div id="imgAsoc">
                            <img src="/src/img/logo_sin_fondo.png">
                            <h3>Nombre Asoc</h3>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="datosColec">
                            <p>Nombre:Unicef</p>
                            <p>Fundacion:1892</p>
                            <p>Alcance:Internacional</p>
                            <a href="https://www.msf.es/">https://www.msf.es/</a>
                        </div>
                    </div>
                    <div class="cajaAsoc">
                        <div id="imgAsoc">
                            <img src="/src/img/logo_sin_fondo.png">
                            <h3>Nombre Asoc</h3>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="datosColec">
                            <p>Nombre:Unicef</p>
                            <p>Fundacion:1892</p>
                            <p>Alcance:Internacional</p>
                            <a href="https://www.msf.es/">https://www.msf.es/</a>
                        </div>
                    </div>
                    <div class="cajaAsoc">
                        <div id="imgAsoc">
                            <img src="/src/img/logo_sin_fondo.png">
                            <h3>Nombre Asoc</h3>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="datosColec">
                            <p>Nombre:Unicef</p>
                            <p>Fundacion:1892</p>
                            <p>Alcance:Internacional</p>
                            <a href="https://www.msf.es/">https://www.msf.es/</a>
                        </div>
                    </div>
                    <!---------------------------------HASTA AQUI----------------->
                </div>
            </div>
        </main>
        <!--Esta parte debe activarse cuando utilicemos javscript para que al darle al boton se despligue-->
        <nav id="desplegable">
            <ul>
                <p id="nombreDes">Usuario</p>
                <p>usuario@hotmail.com</p>
                <hr>
                <li><i class="fa-solid fa-gamepad"></i> <a href="pagina_juego.html">Jugar</a></li>
                <li><i class="fa-solid fa-book"></i> <a href="colecciones.html">Colección</a></li>
                <li><i class="fa-solid fa-trophy"></i><a href="ranking.html">Ranking</a></li>
                <hr>
                <li><i class="fa-solid fa-key"></i> <a href="cambio.html">Cambiar Contraseña</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="login.html">Cerrar sesión</a></li>
            </ul>
        </nav>
        <script type="module" src="../../app.js"></script>
    </body>
</html>