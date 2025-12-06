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
                    <a href="./dashboard.html">
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
    <main>
        <!-- Gestión de Asociaciones -->
        <div id="bloqueGestionAsociaciones">
            <div id="tituloSubtitulo">
                <h1>Editar Asociación</h1>
                <p>Modifica los detalles de "<?=$datos['nombre']?>"</p>
            </div>
        </div>

        <!-- Formulario Asociaciones-->
        <form action="index.php?c=Asociacion&m=procesarModificar&idAsoc=<?= $datos['idAsoc'] ?>" method="POST" enctype="multipart/form-data" id="bloqueFormularioAsociaciones">
            <div id="formulario-head">
                <h2>Detalles de la Asociación</h2>
                <p>Asegurese de que la información sea correcta antes de guardar.</p>
            </div>
            <div id="formulario-main">
                <div id="formAsociacion">
                    <!-- Nombre + Año -->
                    <div class="fila">
                        <div class="campo">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" value="<?= $datos['nombre'] ?>">
                        </div>

                        <div class="campo">
                            <label>Año de fundación:</label>
                            <input type="text" name="fecha_fun" value="<?= $datos['fecha_fun'] ?>">
                        </div>
                    </div>

                    <!-- Dedicada a + Alcance -->
                    <div class="fila">
                        <div class="campo">
                            <label>Dirigida a:</label>
                            <select name="idTipoAsoc" id="categoriaDedicacion">
                                <?php
                                    foreach ($datos['tipo_asoc'] as $t) {
                                        echo "<option value='".$t['idTipoAsoc']."' ".(($t['idTipoAsoc'] == $datos['idTipoAsoc']) ? "selected" : "").">".$t['nombre']."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="campo">
                            <label>Alcance Geográfico:</label>
                            <select name="alcance" id="alcanceGeografico">
                                <option value="I" <?= $datos['alcance'] == 'I' ? 'selected' : '' ?>>Internacional</option>
                                <option value="N" <?= $datos['alcance'] == 'N' ? 'selected' : '' ?>>Nacional</option>
                                <option value="L" <?= $datos['alcance'] == 'L' ? 'selected' : '' ?>>Local</option>
                            </select>
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div class="fila">
                        <div class="campo-grande">
                            <label>Imagen:</label>
                            <input type="file" name="imagen">
                            <label>Imagen actual:</label>
                            <img src="<?= RUTAIMG.$datos['imagen'] ?>">
                            <input type="hidden" name="antiguaImagen" value="<?=$datos['imagen']?>">
                        </div>
                    </div>

                    <!-- Pista difícil -->
                    <div class="fila">
                        <div class="campo-grande">
                            <label>Pista Difícil:</label>
                            <textarea name="pista_dificil"><?= $datos['pista_dificil'] ?></textarea>
                        </div>
                    </div>

                    <!-- Pista media -->
                    <div class="fila">
                        <div class="campo-grande">
                            <label>Pista Media:</label>
                            <textarea name="pista_media"><?= $datos['pista_media'] ?></textarea>
                        </div>
                    </div>

                    <!-- Pista fácil -->
                    <div class="fila">
                        <div class="campo-grande">
                            <label>Pista Fácil:</label>
                            <textarea name="pista_facil"><?= $datos['pista_facil'] ?></textarea>
                        </div>
                    </div>

                    <!-- Contribuciones -->
                    <div>
                        <label>Contribuciones:</label>
                        <div id="cuadroContribuciones">
                            <?php
                            foreach ($datos['contribuciones'] as $c) {

                                $checked = in_array($c['idContribucion'], $datos['contribucionesAsoc']) ? 'checked' : '';

                                echo "<div class='tag'>";
                                echo "<input type='checkbox' name='contribuciones[]' value='".$c['idContribucion']."' $checked>";
                                echo $c['descripcion'];
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div id="formulario-footer">
                <a href="index.php?c=Asociacion&m=listar">
                    <button type="button">
                        <span>Cancelar</span>
                    </button>
                </a>
                <button type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </main>
</body>

</html>
