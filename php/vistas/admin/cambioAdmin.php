<!DOCTYPE html>
<html>
    <head>
        <title>Asociaciondle</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../src/css/styleAdmin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
    </head>
    <body class="body-kiko">
        <header>
            <span>Asociaciondle</span>
        </header>
        <nav id="navAdmin">
            <ul>
                <p>Menú Principal</p>
                <li><a href="index.php?c=Dashboard&m=cargarPagina"><button><i class="fa-solid fa-chart-line"></i>Dashboard</button></a></li>
                <li><a href="index.php?c=Asociacion&m=listar"><button><i class="fa-regular fa-building"></i>Asociaciones</button></a></li>
                <li><a href="index.php?c=Usuarios&m=cargarPagina"><button><i class="fa-solid fa-users"></i>Usuarios</button></a></li>
                <li><a href="index.php?c=Contribucion&m=listar"><button><i class="fa-solid fa-hand-holding-heart"></i></i>Contribuciones</button></a></li>
                <li><a href="index.php?c=Categorias&m=listar"><button><i class="fa-solid fa-icons"></i></i>Categorias</button></a></li>
                <li><a href="index.php?c=Galeria&m=cargarPagina"><button><i class="fa-regular fa-image"></i></i>Galería</button></a></li>
            </ul>
            <ul id="ulCerrar">
                <li ><a href="index.php?c=CambioAdmin&m=cargarPagina"><button id="pestaña"><i class="fa-solid fa-key"></i>Cambiar Contraseña</button></a></li>
                <li><a href="index.php?c=Dashboard&m=cargarPagina"><button><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar sesión</button></a></li>
            </ul>
        </nav>
        <div id="contenedorLogin">
            <form action="" method="post" id="formCambio">
                <h2>Cambiar Contraseña</h2>
                <p>Actualiza tu contraseña para mantener tu cuenta segura</p>
                <label for="contraActual">Contraseña</label>
                <input type="password" name="contraActual">
                <label for="contraNueva">Nueva Contraseña</label>
                <input type="password" name="contraNueva">
                <label for="contraConfir">Nueva Contraseña</label>
                <input type="password" name="contraConfir">
                <input type="submit" value="Guardar cambios" id="botonGuardar"></input>
                <a href="./dashboard.html">Cancelar</a>
            </form>
            <p>---------------o continuar con--------------------</p>
        </div>
    </body>
</html>