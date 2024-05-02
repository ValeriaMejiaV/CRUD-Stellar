<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
<header>
        <nav class="menu">
            <a href="../inicio.php" class="button">Pagina Principal</a> 
            <a href="../actualizar/modificar.php" class="button">Modifica / Elimina</a>
            <a href="../añadir.php" class="button">Añadir</a>
            
        </nav>
    </header>
<?php

    
    
    ini_set('display_errors', 1);
        
    // Incluir el archivo que contiene nuestras funciones
    include '../funciones.php';

    // Procesar el formulario si se ha enviado

    // Obtener los datos del formulario
    ini_set('display_errors', 1);
    include_once '../funciones.php';
    $titulo=$_POST['titulo'] ;
    $artista=$_POST['artista'];
    $genero= $_POST['genero'];
    $album=$_POST['album'];
    $duracion=$_POST['duracion'];
    $fecha_lanzamiento=$_POST['fecha_lanzamiento'];
    $idioma=$_POST['idioma'];
    
    $resultadoInsert = insertarCancion( $titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma);
    if ($resultadoInsert=="ok"){
        echo 'Datos insertados correctamente.';
        $selectCanciones = obtenerCanciones();
        if ($selectCanciones=='No se encontraron resultados.'){
            echo "No se encontraron resultados.";
        }else{
            $tablaSelect= tabla($selectCanciones);
            echo $tablaSelect;
        }
    }elseif ($resultadoInsert == 'Error en la conexión.'){
        echo "Error en la conexión.";
    }
    else{
        echo "Error en al insertar.";
    }

?>
</body>
</html>
