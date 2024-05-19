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
            <a href="inicio_sesion/formulario_inicio.html" class="button">Inicio sesion</a> 
            <a href="insertar/formularioUsuario.html"class="button">Registro</a>
            <a href="insertar/formulario.html" class="button">Canciones</a>
            <a href="inicio_sesion/cerrar_sesion.php"class="button">Cerrar sesion</a>
           
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