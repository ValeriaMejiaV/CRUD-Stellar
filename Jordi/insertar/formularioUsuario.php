<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../estilo.css">

  <title>Formulario de Canciones</title>
  
</head>
<body>
  <header>
    <nav class="menu">
        <a href="../inicio.php" class="button">Pagina Principal</a> 
        <a href="formularioComentario.html" class="button">Comentarios</a>
        <a href="formularioFavoritos.html" class="button">Favoritos</a>
        <a href="formulario.html" class="button">Canciones</a>

    </nav>
</header>
    <h1>Registro de Usuario</h1>
    <form action="formularioUsuario.php" method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="contrasenia">Contraseña:</label>
        <input type="password" id="contrasenia" name="contrasenia" required><br><br>

        <input type="submit" value="Registrar">
    </form>
  </form>
</body>
</html>
<?php

    
    
    ini_set('display_errors', 1);
        
    
    // Obtener los datos del formulario
    ini_set('display_errors', 1);
    include_once '../funcionesUsuarios.php';
    $nombre_usuario=$_POST['nombre_usuario'] ;
    $email=$_POST['email'];
    $contrasenia= $_POST['contrasenia'];
    
    
    $resultadoInsert = insertarUsuario( $nombre_usuario, $email, $contrasenia );
    if ($resultadoInsert=="ok"){
        echo 'Datos insertados correctamente.';
        $selectUsuarios = obtenerUsuarios();
        if ($selectUsuarios=='No se encontraron resultados.'){
            echo "No se encontraron resultados.";
        }else{
            $tablaSelect= tabla($selectUsuarios);
            echo $tablaSelect;
        }
    }elseif ($resultadoInsert == 'Error en la conexión.'){
        echo "Error en la conexión.";
    }
    else{
        echo "Error en al insertar.";
    }

?>