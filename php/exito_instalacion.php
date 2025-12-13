<?php
    /**
     * Summary of borrarInstalacion
     * @param mixed $dir recibe el directorio que debe borrar
     * @return bool devuelve verdadero o falso en funcion de si se ejecuta o no
     */
    function borrarInstalacion($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            borrarInstalacion($dir . DIRECTORY_SEPARATOR . $item);
        }
        return rmdir($dir);
    }

    $instalacionDir = __DIR__ . '/../instalacion';
    if(borrarInstalacion($instalacionDir)){
        $mensaje = "Felicidades Juego Instalado";
    };
?>
<html>
    <head>
        <title>Mensaje Correcto</title>
        <link rel="stylesheet" href="../src/css/styleAdmin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;700&display=swap">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body class="asociacionContribucion">
        <!-- Modal para decir que todo esta bien -->
        <div id="modal-aceptarOno" class="fondo">
            <div class="modal">
                <div class="modal-header">
                    <h2><?php echo $mensaje ?></h2>
                    <button id="cerrarModal" class="ico-cerrar" type="button">
                        <a href="vistas/usuario/login.php"><i class="fa-solid fa-xmark"></i></a>
                    </button>
                </div>
                <div id="yes">
                    <i  class="fa-regular fa-circle-check"></i>
                </div>
                <div class="modal-footer">
                    <button class="aniadir"><a id="enlace-cancelar" href="vistas/usuario/login.php">Ir al login</a></button>
                </div>
            </div>
        </div>
    </body>
</html>
