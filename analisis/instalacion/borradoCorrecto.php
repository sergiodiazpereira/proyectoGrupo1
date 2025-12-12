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
                        <!-- Esto te tiene que llevar al dashboard -->
                        <a href="index.php?c=Contribucion&m=listar"><i class="fa-solid fa-xmark"></i></a>
                    </button>
                </div>
                <div id="yes">
                    <i  class="fa-regular fa-circle-check"></i>
                </div>
                <div class="modal-footer">
                    <!--Cambiar ruta del cancelar cuando se tenga el dashboard-->
                    <button class="aniadir"><a id="enlace-cancelar" href="../php/config/vistas/usuario/login.php">Ir al login</a></button>
                </div>
            </div>
        </div>
    </body>
</html>