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
                    <p class="subtitulos-admin">Añadir, asignar o eliminar imagenes de asociaciones.</p>
                </div>
                <a class="boton-añadir"><button id="abrirModal"><i class="fa-solid fa-circle-plus"></i>Añadir imagen</button></a>
            </div>
            <section class="seccion-regular query galeria">
                <div class="grid-titulo-lista-imagenes">
                    <h2 id="h2listagaleria" class="h2-regular">Lista de imagenes</h2>
                    <select id="selectAsociacion">
                        <option value="" selected>Todas las imágenes</option>
                        <?php
                            foreach ($datos as $asociacion) {
                                echo '<option value="'.$asociacion["idAsoc"].'">'.$asociacion["nombre"].'</option>';
                            } 
                        ?>
                    </select>
                </div>
                <div  id="contenedorImagenes" class="grid-imagenes">
                </div>
            </section>



            <!-- Modal para agregar Categorías -->
            <div class="fondo oculto" id="modal-galeria">
                <form action="index.php?c=Galeria&m=insertarImagen" method="post" class="modal">
                    <div class="modal-header">
                        <h2>Añadir Nueva Imagen</h2>
                        <button id="cerrarModal" class="ico-cerrar" type="button">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="modal-main">
                        <label for="subirArchivo">Solo se aceptan archivos .jpeg, .png, .webp y .jpg:</label>
                        <input type="file" name="archivo" id="subirArchivo" accept=".jpeg, .png, .webp y .jpg">
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrarModal2" class="cancelar">Cancelar</button>
                        <button type="button" class="aniadir">Añadir</button>
                    </div>
                </form>
            </div>
            <script type="module" src="../src/js/app.js"></script>
        </main>
    </body>
</html>