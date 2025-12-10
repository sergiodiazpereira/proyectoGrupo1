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
                <li><i class="fa-solid fa-book"></i><a href="./index.php?c=Colecciones&m=cargarPagina">Colección</a></li>
                <li><i class="fa-solid fa-trophy"></i><a href="./index.php?c=Ranking&m=cargarPagina">Ranking</a></li>
                <hr>
                <li><i class="fa-solid fa-key"></i> <a href="./index.php?c=Cambio&m=cargarPagina">Cambiar Contraseña</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="index.php?c=Login&m=cerrarSesion">Cerrar sesión</a></li>
            </ul>
        </div>
        <main class="main_kiko">
            <div id="coleccionPadre">
                <h1>Mi Colección</h1>
                <p>Explora las asociaciones que has adivinado y las que te faltan</p>
                <div id="gridColec">
                    <?php 
                    // Usamos $controlador (o $objeto si no cambiaste el index)
                    $lista = $objContro->datos; 

                    if (!empty($lista)) {
                        foreach ($lista as $asoc) { 
                            // Verificamos si está adivinada
                            $desbloqueada = (isset($asoc['adivinada']) && $asoc['adivinada'] == 1);
                    ?>
                            <div class="cajaAsoc">
                                
                                <div id="imgAsoc">
                                    <img src="../src/img/<?= $asoc['imagen'] ?>" 
                                        alt="Logo"
                                        style="<?= $desbloqueada ? '' : 'filter: blur(8px); opacity: 0.5;' ?>">
                                    
                                    <h3><?= $desbloqueada ? $asoc['nombre'] : '???' ?></h3>
                                    
                                    <i class="fa-solid <?= $desbloqueada ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                                </div>

                                <div id="datosColec">
                                    <?php if ($desbloqueada): ?>
                                        <p><strong>Fundación:</strong> <?= $asoc['fundacion'] ?></p>
                                        <p><strong>Alcance:</strong> <?= $asoc['alcance'] ?></p>
                                        
                                        <a href="<?= $asoc['web'] ?>" target="_blank" style="display:block; margin-top:5px; color:#007bff; text-decoration:none;">
                                            <i class="fa-solid fa-link"></i> Visitar Web Oficial
                                        </a>
                                    <?php else: ?>
                                        <p style="color: #666; font-style: italic; margin-top: 10px;">
                                            Bloqueado
                                        </p>
                                    <?php endif; ?>
                                </div>

                            </div>
                    <?php 
                        } 
                    } else {
                        echo "<p>No hay datos disponibles.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
        <script type="module" src="../src/js/app.js"></script>
    </body>
</html>