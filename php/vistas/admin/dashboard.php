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
                    <a href="./dashboard.html">
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
                    <a href="./listarUsuarios.html">
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
        <main class="main-admin">
            <h1 class="h1-admin">Dashboard</h1>
            <p class="subtitulos-admin">Vista general del estado de Asociaciondle.</p>
            <div class="grid-secciones">
                <section class="seccion-asociaciones">
                    <div>
                        <h3>Asociaciones totales</h3>
                        <i class="fa-regular fa-building"></i>
                    </div>
                    <p>67</p>
                </section>
                <section class="seccion-usuarios">
                    <div>
                        <h3>Usuarios registrados</h3>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p>777</p>
                </section>
                <section class="seccion-contribuciones">
                    <div>
                        <h3>Total contribuciones</h3>
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <p>38</p>
                </section>
                <section class="seccion-vistas">
                    <div>
                        <h3>Visitas totales</h3>
                        <i class="fa-regular fa-building"></i>
                    </div>
                    <p>2,432,127</p>
                </section>
            </div>
            <section class="seccion-regular">
                <h2>Nuevos usuarios</h2>
                <ul>
                    <li class="primer-usuario">
                        <i class="fa-solid fa-user"></i>
                        <span>Super admin</span>
                        <p>23/06/21</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <span>Admin</span>
                        <p>23/06/21</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <span>Kiko</span>
                        <p>23/06/21</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <span>Santi</span>
                        <p>23/06/21</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <span>Rafa</span>
                        <p>23/06/21</p>
                    </li>
                </ul>
            </section>
        </main>
    </body>
</html>