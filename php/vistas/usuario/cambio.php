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
                <p id="nombreDes">Usuario</p>
                <p>usuario@hotmail.com</p>
                <hr>
                <li><i class="fa-solid fa-gamepad"></i> <a href="./index.php?c=Juego&m=cargarPagina">Jugar</a></li>
                <li><i class="fa-solid fa-book"></i> <a href="./index.php?c=Colecciones&m=cargarPagina">Colección</a></li>
                <li><i class="fa-solid fa-trophy"></i><a href="./index.php?c=Ranking&m=cargarPagina">Ranking</a></li>
                <hr>
                <li><i class="fa-solid fa-key"></i> <a href="./index.php?c=Cambio&m=cargarPagina">Cambiar Contraseña</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="login.html">Cerrar sesión</a></li>
            </ul>
        </div>
        <div id="contenedorLogin">
            <form action="" method="post" id="formCambio">
                <h2>Cambiar Contraseña</h2>
                <p>Actualiza tu contraseña para mantener tu cuenta segura</p>
                <label for="contraActual">Contraseña</label>
                <input type="password" name="contraActual">
                <label for="contraNueva">Nueva Contraseña</label>
                <input type="password" name="contraNueva">
                <label for="contraConfir">Confirmar Contraseña</label>
                <input type="password" name="contraConfir">
                <button type="submit" id="botonGuardar">Guardar cambios</button>
                <a href="./index.php?c=Juego&m=cargarPagina">Cancelar</a>
            </form>
            <p>---------------o continuar con--------------------</p>
        </div>
        <script type="module" src="../src/js/app.js"></script>
    </body>
</html>