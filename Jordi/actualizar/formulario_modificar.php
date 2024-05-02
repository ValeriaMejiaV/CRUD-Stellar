<?php
ini_set('display_errors', 1);

$host = "localhost"; // o la IP del servidor de base de dades
$dbname = "stellar";
$user = "postgres";
$password = "password";
$port = "5432"; // Port per defecte PostgreSQL 5432

// Cadena de connexió
$conection = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port");
if (!$conection){
    echo "error en la conexion.";
}
?>


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
        <a href="inicio.php" class="button">Pagina Principal</a> 
        <a href="modificar.php" class="button">Modifica / Elimina</a>
        <a href="formulario.html" class="button">Añadir</a>
    </nav>
</header>
    <?php
        $identificador=$_GET['id'];
        $resultado=pg_query($conection, "SELECT * FROM Canciones where id=$identificador");
        $registro=pg_fetch_assoc($resultado);
    ?>
  <h1>Formulario de Canciones</h1>
  <form action="actualizar.php?id=<?php echo $identificador; ?>" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $registro['titulo']?>">

    <label for="artista">Artista:</label>
    <input type="text" id="artista" name="artista" value="<?php echo $registro['artista']?>">

    <label for="album">Álbum:</label>
    <input type="text" id="album" name="album" value="<?php echo $registro['album']?>">

    <label for="genero">Género:</label>
    <input type="text" id="genero" name="genero" value="<?php echo $registro['genero']?>">

    <label for="duracion">Duración:</label>
    <input type="time" id="duracion" name="duracion" value="<?php echo $registro['duracion']?>">

    <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
    <input type="date" id="fecha_lanzamiento" name="fecha_lanzamiento" value="<?php echo $registro['fecha_lanzamiento']?>">

    <label for="idioma">Idioma:</label>
        <select id="idioma" name="idioma" default="<?php echo $registro['idioma']?>">
            <option value="">Selecciona un idioma</option>
            <!-- Aquí puedes agregar opciones para diferentes países -->
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Francés">Francés</option>
            <!-- Puedes agregar más opciones según sea necesario -->
        </select>
    <input type="submit" value="Enviar">
  </form>
</body>
</html>
