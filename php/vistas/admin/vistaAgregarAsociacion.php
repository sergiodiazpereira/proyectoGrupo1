<html>
    <head>
        <title>Asociaciones</title>
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
                        <a href="./dashboard.php">
                            <button>
                                <i class="fa-solid fa-chart-line"></i>
                                <span>Dashboard</span>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="./index.php?c=Asociacion&m=cargarPaginaAsoc">
                            <button class="paginaSeleccionada">
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
                        <a href="./index.php?c=Contribucion&m=obtenerContribucion">
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
        <main>
            <!-- Gestión de Asociaciones -->
            <div id="bloqueGestionAsociaciones">
                <div id="tituloSubtitulo">
                    <h1>Añadir Asociación</h1>
                    <p>Añade los detalles de la asociación.</p>
                </div>
            </div>

            <!-- Formulario Asociaciones-->
            <form action="./index.php?c=Asociacion&m=insertar" method="post" id="bloqueFormularioAsociaciones" enctype="multipart/form-data">
                <div id="formulario-head">
                    <h2>Detalles de la Asociación</h2>
                    <p>Asegurese de que la información sea correcta antes de añadir.</p>
                </div>
                <div id="formulario-main">
                    <div id="formAsociacion">

                        <!-- Nombre + Año -->
                        <div class="fila">
                            <div class="campo">
                                <label>Nombre:</label>
                                <input type="text" name="nombre">
                            </div>

                            <div class="campo">
                                <label>Año de fundación:</label>
                                <input type="text" name="anio">
                            </div>
                        </div>

                        <!-- Dedicada a + Alcance -->
                        <div class="fila">
                            <div class="campo">
                                <label>Dirigida a:</label>
                                <select name="categoria" id="categoriaDedicacion">
                                    <?php
                                        foreach($datos['tiposAsoc'] as $value){
                                            echo '<option value="'.$value['idTipoAsoc'].'">'.$value['nombre'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="campo">
                                <label>Alcance Geográfico:</label>
                                <select name="alcanceGeografico" id="alcanceGeografico">
                                    <option value="I">Internacional</option>
                                    <option value="L">Local</option>
                                    <option value="N">Nacional</option>
                                </select>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="fila">
                            <div class="campo-grande">
                                <label>Imagen:</label>
                                <input type="file" name="logo">
                            </div>
                        </div>

                        <!-- Pista difícil -->
                        <div class="fila">
                            <div class="campo-grande">
                                <label>Pista Difícil:</label>
                                <textarea name="pistaD"></textarea>
                            </div>
                        </div>

                        <!-- Pista media -->
                        <div class="fila">
                            <div class="campo-grande">
                                <label>Pista Media:</label>
                                <textarea name="pistaM"></textarea>
                            </div>
                        </div>

                        <!-- Pista fácil -->
                        <div class="fila">
                            <div class="campo-grande">
                                <label>Pista Fácil:</label>
                                <textarea name="pistaF"></textarea>
                            </div>
                        </div>

                        <!-- Contribuciones -->
                        <div>
                            <label>Contribuciones:</label>
                            <div id="cuadroContribuciones">
                                <?php
                                    foreach($datos['contribuciones'] as $value){
                                        echo'<div class="tag"><input type="checkbox" name=contribucion[] value="'.$value['idContribucion'].'">'.$value['descripcion'].'</div>';
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="formulario-footer">
                    <button>
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Añadir</span>
                    </button>
                </div>
            </form>
        </main>
    </body>
</html>
