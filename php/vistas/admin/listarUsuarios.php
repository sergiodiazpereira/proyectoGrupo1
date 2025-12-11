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
                    <a href="index.php?c=Categorias&m=listar">
                        <button>
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
                    <a href="index.php?c=Usuario&m=cargarPagina">
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
                <div class="titulo-y-subtitulo">
                    <h1 class="h1-admin">Gestionar usuarios</h1>
                    <p class="subtitulos-admin">Visualiza y gestiona los usuarios de la aplicación.</p>
                </div>
                <?php
                    if($_SESSION["permiso"] == 'A'){
                        echo '';
                    }else{
                        echo '<a href="index.php?c=CrearAdmin&m=cargarPagina" class="boton-añadir"><i class="fa-solid fa-circle-plus"></i>Añadir administrador</a>';
                    }
                ?>
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
                        <?php foreach ($datos as $fila): ?>
                            <tr>
                                <td>
                                    <?php 
                                        if ($fila['permiso'] == 'S'){
                                            echo '<i class="fa-solid fa-user superadmin"></i>';
                                        }else if($fila['permiso'] == 'A'){
                                            echo '<i class="fa-solid fa-user admin"></i>';
                                        }else{
                                            echo '<i class="fa-solid fa-user"></i>';
                                        }
                                        echo $fila['nombre'];
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($fila['permiso'] == 'S'){
                                            echo '<span class="rol-superadmin">superadmin</span>';
                                        }else if($fila['permiso'] == 'A'){
                                            echo '<span class="rol-admin">admin</span>';
                                        }else{
                                            echo '<span>usuario</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= $fila['fecha_registro'] ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($_SESSION["permiso"] == 'A' && $fila['permiso'] == 'S'){
                                            echo '<a"><i class="fa-solid fa-trash-can desactivado"></i></a>';
                                        }else if($_SESSION["permiso"] == 'A' && $fila["permiso"] == 'A'){
                                            echo '<a"><i class="fa-solid fa-trash-can desactivado"></i></a>';
                                        }else if($fila["permiso"] == 'S'){
                                            echo '<a"><i class="fa-solid fa-trash-can desactivado"></i></a>';
                                        } else{
                                            echo '<a href="index.php?c=Usuarios&m=borrar&idUsuario='.$fila['idUsuario'].'"><i class="fa-solid fa-trash-can"></i></a>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
        <!-- Poner modal de confirmacion -->
        
        <script type="module" src="../src/js/app.js?v=4"></script>
    </body>
</html>