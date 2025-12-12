<!DOCTYPE html>
<html>
    <head>
        <title>Asociaciondle</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../src/css/styleUsuario.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
    </head>
    <body class="body_kiko">
        <header>
            <a href="./index.php?c=Juego&m=cargarPagina" id="flecha"><i class="fa-solid fa-arrow-left"></i></a>
            <span>Asociaciondle</span>
            <button id="usuario"><i id="icono-boton-usuario" class="fa-solid fa-user"></i></button>
        </header>
        <div id="desplegable">
            <ul>
                <p id="nombreDes"><?= $_SESSION['nombre'] ?></p>
                <p><?= $_SESSION['correo'] ?></p>
                <hr>
                <li><i class="fa-solid fa-gamepad"></i> <a href="./index.php?c=Juego&m=cargarPagina">Jugar</a></li>
                <li><i class="fa-solid fa-book"></i><a href="./index.php?c=Colecciones&m=cargarPagina">Colección</a></li>
                <li><i class="fa-solid fa-trophy"></i><a href="./index.php?c=Ranking&m=cargarPagina">Ranking</a></li>
                <hr>
                <li><i class="fa-solid fa-key"></i> <a href="./index.php?c=Cambio&m=cargarPagina">Cambiar Contraseña</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="index.php?c=Login&m=cerrarSesion">Cerrar sesión</a></li>
            </ul>
        </div>
        <main class="main_kiko">
            <div id="rankingPadre">
                <h1>Ranking de Jugadores</h1>
                <p>¿Quienes son los más rápidos en adivinar?</p>
                <div id="top">
                    <div id="h2top">
                        <h2>Top 10 jugadores</h2>
                    </div>
                    <div id="cajaRanking">
                        <p id="puesto">Puesto</p><p id="jugador">Jugador</p><p id="asociación">Asociación</p><p id="fecha">Fecha</p><p id="tiempo">Tiempo</p>
                    </div>
                </div>
            </div>
        </main>
        <script type="module" src="../src/js/app.js"></script>
    </body>
</html>