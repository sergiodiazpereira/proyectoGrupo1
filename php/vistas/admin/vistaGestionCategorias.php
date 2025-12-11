<html>
    <head>
        <title>Categorias</title>
        <link rel="stylesheet" href="../src/css/styleAdmin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;700&display=swap">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body class="asociacionContribucion">
        <header>
            <span>Asociaciondle - Admin</span>
        </header>
        <nav>
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
                        <button class="paginaSeleccionada">
                            <i class="fa-solid fa-icons"></i>
                            <span>Categorías</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=Galeria&m=cargarPagina">
                        <button>
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
        <main>
            <form action="index.php?c=Categorias&m=procesarModificar" method="POST" enctype="multipart/form-data">
                <!-- Gestión de Categorias (agregar y guardar cambios) -->
                <div id="bloqueGestionContribuciones">
                    <h1>Gestionar Categorías</h1>
                    <p>Añadir, editar o eliminar las categorías de las asociaciones.</p>

                    <button id="abrirModal" type="button">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Añadir categoria</span>
                    </button>

                    <button type="submit">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span>Guardar cambios</span>
                    </button>
                </div>

                <!-- Lista de Categorias -->
                <div id="bloqueListaCategorias">

                    <h2>Lista de Categorías</h2>

                    <div class="fila encabezado">
                        <span>Nombre</span>
                        <span>Acciones</span>
                    </div>

                    <?php if(!empty($datos['categoria'])): ?>
                        <?php foreach ($datos['categoria'] as $c): ?>
                            <div class="fila">
                                <input type="text" name="nombre[<?= $c['idTipoAsoc'] ?>]" value="<?= $c['nombre'] ?>">
                                <a class="btn-eliminar" href="index.php?c=Categorias&m=borrar&idTipoAsoc=<?= $c['idTipoAsoc'] ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay categorías registradas.</p>
                    <?php endif; ?>
                </div>
            </form>
                
            <!-- Modal para agregar Categorías -->
            <div class="fondo oculto" id="modal-categorias">
                <form action="index.php?c=Categorias&m=insertar" method="post" class="modal">
                    <div class="modal-header">
                        <h2>Añadir Nueva Categoría</h2>
                        <button id="cerrarModal" class="ico-cerrar" type="button">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="modal-main">
                        <label for="categoria">Nombre</label>
                        <input type="text" name="categoria" id="nombre" placeholder="Ej: Jóvenes">
                    </div>

                    <div class="modal-footer">
                        <!--Cambiar controlador y modelo por defecto cuanto se tenga el dashboard-->
                        <button class="cancelar"><a href="./index.php?c=Categorias&m=listar">Cancelar</a></button>
                        <button class="aniadir">Añadir</button>
                    </div>
                </form>
            </div>
            <script> 
                /*Recojo el modal el boton abrir y el boton de cerrar */
                const modal = document.getElementById("modal-categorias");
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
