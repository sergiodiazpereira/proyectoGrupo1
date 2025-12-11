<?php
    //require_once __DIR__.'/../../controladores/conLogin.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Asociaciondle</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../src/css/styleUsuario.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
    </head>
    <body class="body_kiko">
        <main class="main_kiko">
            <div id="contenedorLogin">
                <img src="../../../src/img/logo_sin_fondo.png" alt="logo del Juego">
                <h1>Asociaciondle</h1>
                <p>Demuestra cuánto sabes de organizaciones benéficas</p>
                <div id="cajaBotonesIniYReg">
                    <a href="login.php" id="iniciar">Iniciar Sesión</a>
                    <a href="registro.php">Registrarse</a>
                </div>
                <form action="" method="post" id="formLoginRegis">
                    <h2>Bienvenido de nuevo</h2>
                    <p>Introduce tus credenciales para jugar</p>
                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" placeholder="tu@email.com">
                    <label for="pwd">Contraseña</label>
                    <input type="password" name="pwd">
                    <input type="submit"></input>
                </form>
                <p>---------------o continuar con--------------------</p>
            </div>
        </main>
        <script type="module" src="../../../src/js/app.js"></script>
    </body>
</html>