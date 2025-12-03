<html>

<head>
    <title>Contribuciones</title>
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
                <a href="./dashboard.html">
                    <button>
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </button>
                </a>
            </li>
            <li>
                <a href="./listarAsociaciones.html">
                    <button>
                        <i class="fa-regular fa-building"></i>
                        <span>Asociaciones</span>
                    </button>
                </a>
            </li>
            <li>
                <a href="./listarUsuarios.html">
                    <button>
                        <i class="fa-solid fa-users"></i>
                        <span>Usuarios</span>
                    </button>
                </a>
            </li>
            <li>
                <a href="./vistaGestionContribuciones.html">
                    <button class="paginaSeleccionada">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        <span>Contribuciones</span>
                    </button>
                </a>
            </li>
        </ul>
        <ul class="ul-inferior">
            <li>
                <a href="./cambioAdmin.html">
                    <button>
                        <i class="fa-solid fa-key"></i>
                        <span>Cambiar contraseña</span>
                    </button>
                </a>
            </li>
            <li>
                <a href="../usuario/login.html">
                    <button>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </a>
            </li>
        </ul>
    </nav>
    <main>
        <!-- Gestión de Contribuciones (agregar y guardar cambios) -->
        <div id="bloqueGestionContribuciones">
            <h1>Gestionar Contribuciones</h1>
            <p>Añadir, editar o eliminar los tipos de contribucion.</p>
            <a href="./vistaAgregarContribucion.html">
                <button>
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Añadir contribución</span>
                </button>
            </a>
            <a href="./vistaGestionContribuciones.html">
                <button>
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Guardar cambios</span>
                </button>
            </a>
        </div>

        <!-- Lista de Contribuciones -->
        <form id="bloqueListaContribuciones">

            <h2>Lista de Contribuciones</h2>

            <div class="fila encabezado">
                <span>Nombre</span>
                <span>Acciones</span>
            </div>

            <div class="fila">
                <input type="text" value="Educación">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Salud">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Protección Infantil">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Asistencia Sanitaria">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Conservación">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Activismo">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Derechos Humanos">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Ayuda Humanitaria">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>

            <div class="fila">
                <input type="text" value="Inclusión">
                <a href="">
                    <button class="btn-eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </a>
            </div>
            
        </form>

        <!-- Modal para agregar Contribuciones -->
        <div class="fondo oculto" id="modal-contribuciones">
            <form class="modal">
                <div class="modal-header">
                    <h2>Añadir Nueva Contribución</h2>
                    <button class="ico-cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-main">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" placeholder="Ej: Apoyo escolar">
                </div>

                <div class="modal-footer">
                    <button class="cancelar">Cancelar</button>
                    <button class="aniadir">Añadir</button>
                </div>
            </form>
        </div>

    </main>
</body>

</html>
