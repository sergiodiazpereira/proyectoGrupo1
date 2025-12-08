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
    <!-- Modal para confirmar borrado de Contribuciones -->
    <div id="modal-contribuciones" class="fondo">
        <form action="index.php?c=Contribucion&m=procesarBorrar&idContribucion=<?=$datos['idContribucion']?>" method="POST" class="modal">
            <div class="modal-header">
                <h2>¿Estas seguro de que quieres borrar <?=$datos['descripcion']?>?</h2>
                <button class="ico-cerrar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-footer">
                <a href="index.php?c=Contribucion&m=listar">
                    <button class="cancelar" type="button">Cancelar</button>
                </a>
                <button class="borrar" type="submit">Borrar</button>
            </div>
        </form>
    </div>

</body>

</html>