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

<body>
    <!-- Modal para mensajes informativos sobre operaciones -->
    <div id="modal-contribuciones" class="fondo">
        <div class="modal">
            <div class="modal-header">
                <h2>Información</h2>
                <button class="ico-cerrar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-main">
                <p><?=$datos?></p>
            </div>
            <div class="modal-footer">
                <a href="index.php?c=Asociacion&m=listar">
                    <button class="cancelar" type="button">Volver</button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>