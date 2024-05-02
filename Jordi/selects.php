<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<header>
        <nav class="menu">
            <a href="inicio.php" class="button">Pagina Principal</a> 
            <a href="actualizar/modificar.php" class="button">Modifica / Elimina</a>
            <a href="insertar/formulario.html" class="button">Añadir</a> 
        </nav>
    </header>
<?php


    
    ini_set('display_errors', 1);
    include 'funciones.php';
    $selectCanciones = obtenerCanciones();
    if ($selectCanciones=='No se encontraron resultados.'){
        echo "No se encontraron resultados.";
    }else{
        $tablaSelect= tabla($selectCanciones);
        echo $tablaSelect;
    }
    


?>
</body>
</html>
