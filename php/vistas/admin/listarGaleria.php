<html>
    <head>
        <title>Galería</title>
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
                <li>
                    <a href="index.php?c=Categorias&m=listar">
                        <button>
                            <i class="fa-solid fa-icons"></i>
                            <span>Categorías</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Galeria&m=cargarPagina">
                        <button class="paginaSeleccionada">
                            <i class="fa-regular fa-image"></i>
                            <span>Galeria</span>
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
                    <a href="index.php?c=Login&m=cerrarSesion">
                        <button>
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Cerrar sesión</span>
                        </button>
                    </a>
                </li>
            </ul>
        </nav>
        <main class="main-admin">
            <div class="grid-titulo-botón">
                <div>
                    <h1 class="h1-admin">Galería de Imagenes</h1>
                    <p class="subtitulos-admin">Añadir, asignar o eliminar imagenes del juego.</p>
                </div>
                <a class="boton-añadir"><button id="abrirModal"><i class="fa-solid fa-circle-plus"></i>Añadir imagen</button></a>
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



            <!-- Modal para agregar Categorías -->
            <div class="fondo oculto" id="modal-galeria">
                <form action="index.php?c=Galeria&m=insertarImagenPorURL" method="post" class="modal">
                    <div class="modal-header">
                        <h2>Añadir Nueva Imagen</h2>
                        <button id="cerrarModal" class="ico-cerrar" type="button">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="modal-main">
                        <label for="url">URL:</label>
                        <input type="text" name="url" id="nombre" placeholder="Inserta la URL de la imagen que quieras cargar">
                    </div>

                    <div class="modal-footer">
                        <button class="cancelar"><a href="./index.php?c=Galeria&m=cargarPagina">Cancelar</a></button>
                        <button class="aniadir">Añadir</button>
                    </div>
                </form>
            </div>
            <script> 
                /*Recojo el modal el boton abrir y el boton de cerrar */
                const modal = document.getElementById("modal-galeria");
                const btnAbrir = document.getElementById("abrirModal");
                const btnCerrar = document.getElementById("cerrarModal");
                /*Si pulso abrir quito la clase oculto y si lo cierro la añado */
                btnAbrir.onclick = () => modal.classList.remove("oculto");
                btnCerrar.onclick = () => modal.classList.add("oculto");
                /*Esto es por si clico fuera del modal se cierra */
                window.onclick = (event) => {
                    if (event.target === modal) {
                        modal.classList.add("oculto");
                    }
                }
            </script>



        </main>
    </body>
</html>