<html>
    <head>
        <title>Gestionar usuarios</title>
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
                        <button class="paginaSeleccionada">
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
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Cerrar sesión</span>
                        </button>
                    </a>
                </li>
            </ul>
        </nav>
        <main class="main-admin">
            <div class="grid-titulo-botón">
                <div class="titulo-y-subtitulo">
                    <h1 class="h1-admin">Gestionar usuarios</h1>
                    <p class="subtitulos-admin">Visualiza y gestiona los usuarios de la aplicación.</p>
                </div>
            </div>
            <section class="seccion-regular query">
                <h2 class="h2-regular">Lista de usuarios</h2>
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user superadmin"></i>
                                Superadmin
                            </td>
                            <td>
                                <span class="rol-superadmin">superadmin</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can desactivado"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user admin"></i>
                                Santi
                            </td>
                            <td>
                                <span class="rol-admin">admin</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can desactivado"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user admin"></i>
                                Rafa
                            </td>
                            <td>
                                <span class="rol-admin">admin</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can desactivado"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user admin"></i>
                                Kiko
                            </td>
                            <td>
                                <span class="rol-admin">admin</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can desactivado"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user admin"></i>
                                Sergio
                            </td>
                            <td>
                                <span class="rol-admin">admin</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can desactivado"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-user"></i>
                                gamer300
                            </td>
                            <td>
                                <span>usuario</span>
                            </td>
                            <td>
                                27/06/2024
                            </td>
                            <td>
                                <a class="papelera"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </body>
</html>