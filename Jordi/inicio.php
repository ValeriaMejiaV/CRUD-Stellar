<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="enunciado1.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_package_v0.16/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Pagina inicio</title>

</head>
<body>
    
    <header>
        <nav class="menu">
            <a href="inicio.html" class="button">Pagina Principal</a> 
            <a href="insertar/formulario.html" class="button">Añadir</a>
            <a href="actualizar/modificar.php" class="button">Modificar / Eliminar</a>
            <a href="selects.php" class="button">Disponibles</a>
        </nav>
    </header>
    <main>
        <?php
            include 'funciones.php';
            $selectCanciones = obtenerCanciones();
            if ($selectCanciones=='No se encontraron resultados.'){
                echo "No se encontraron resultados.";
            }else{
                $tablaSelect= tabla($selectCanciones);
                echo $tablaSelect;
            }
        ?>

    </main>

    
</body>
</html>