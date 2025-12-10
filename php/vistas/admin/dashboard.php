<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../src/css/styleAdmin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;700&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body class="body-sergio">
        <header class="header-admin">
            <span>Asociaciondle - Admin</span>
        </header>
        <nav class="nav-admin">
            <h3>Menú Principal</h3>
            <ul>
                <li>
                    <a href="index.php?c=Dashboard&m=cargarPagina">
                        <button class="paginaSeleccionada">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Dashboard</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Asociacion&m=listar">
                        <button>
                            <i class="fa-regular fa-building"></i>
                            <span>Asociaciones</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Usuarios&m=cargarPagina">
                        <button>
                            <i class="fa-solid fa-users"></i>
                            <span>Usuarios</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Contribucion&m=listar">
                        <button>
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            <span>Contribuciones</span>
                        </button>
                    </a>
                </li>
            </ul>
            <ul class="ul-inferior">
                <li>
                    <a href="index.php?c=CambioAdmin&m=cargarPagina">
                        <button>
                            <i class="fa-solid fa-key"></i>
                            <span>Cambiar contraseña</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Dashboard&m=cargarPagina">
                        <button>
                            <i class="fa-solid fa-arrow-right-from-bracket color-a"></i>
                            <a href="index.php?c=Login&m=cerrarSesion"><span class="color-a">Cerrar sesión</span></a>
                        </button>
                    </a>
                </li>
            </ul>
        </nav>
        <main class="main-admin">
            <h1 class="h1-admin">Dashboard</h1>
            <p class="subtitulos-admin">Vista general del estado de Asociaciondle.</p>
            <div class="grid-secciones">
                <section class="seccion-asociaciones">
                    <div>
                        <h3>Asociaciones totales</h3>
                        <i class="fa-regular fa-building"></i>
                    </div>
                    <p><?php echo $datos["asociacionesTotales"] ?></p>
                </section>
                <section class="seccion-usuarios">
                    <div>
                        <h3>Usuarios registrados</h3>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p><?php echo $datos["usuariosTotales"] ?></p>
                </section>
                <section class="seccion-contribuciones">
                    <div>
                        <h3>Total contribuciones</h3>
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <p><?php echo $datos["contribucionesTotales"] ?></p>
                </section>
                <section class="seccion-vistas">
                    <div>
                        <h3>Visitas totales</h3>
                        <i class="fa-regular fa-building"></i>
                    </div>
                    <p><?php echo $datos["visitas"] ?></p>
                </section>
            </div>
            <section class="seccion-regular">
                <h2>Nuevos usuarios</h2>
                <ul>
                    <?php
                        foreach($datos["usuariosNuevos"] as $usuario) {
                            echo '<li>
                                  <i class="fa-solid fa-user"></i>
                                  <span>'.$usuario["nombre"].'</span>
                                  <p>'.$usuario["fecha_registro"].'</p>
                                  </li>';
                        }
                    ?>
                </ul>
            </section>
        </main>
    </body>
</html>