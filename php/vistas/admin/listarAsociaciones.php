<html>
    <head>
        <title>Gestionar asociaciones</title>
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
                        <button>
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Dashboard</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Asociacion&m=listar">
                        <button class="paginaSeleccionada">
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
                <li>
                    <a href="index.php?c=Categorias&m=cargarPagina">
                        <button>
                            <i class="fa-solid fa-icons"></i>
                            <span>Categorías</span>
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
            <div class="grid-titulo-botón">
                <div>
                    <h1 class="h1-admin">Gestionar asociaciones</h1>
                    <p class="subtitulos-admin">Añadir, editar o eliminar asociaciones del juego.</p>
                </div>
                <a href="index.php?c=Asociacion&m=cargarPaginaAsoc" class="boton-añadir"><i class="fa-solid fa-circle-plus"></i>Añadir asociación</a>
            </div>
            <section class="seccion-regular query">
                <h2 class="h2-regular">Lista de asociaciones</h2>
                <table class="tabla-asociaciones">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Año fundación</th>
                            <th>Acciones</th>        
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($datos)): ?>
                        <?php foreach ($datos as $fila): ?>
                            <tr>
                                <td><img src="../src/img/<?= $fila['imagen'] ?>"><?= $fila['nombre'] ?></td>
                                <td><span><?= $fila['tipo_asociacion'] ?></span></td>
                                <td><?= $fila['fecha_fun'] ?></td>
                                <td>
                                    <a href="index.php?c=Asociacion&m=modificar&idAsoc=<?= $fila['idAsoc'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="index.php?c=Asociacion&m=borrar&idAsoc=<?= $fila['idAsoc'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">No hay asociaciones registradas.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </body>
</html>