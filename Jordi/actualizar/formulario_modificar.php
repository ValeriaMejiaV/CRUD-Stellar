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
    exit;
}

// Obtener el identificador de la canción
$identificador = $_GET['id'];

// Consultar la información de la canción específica
$consulta = "SELECT c.id, c.titulo, a.nombre AS nombre_artista, c.album, c.genero, c.duracion, c.fecha_lanzamiento, i.nombre AS nombre_idioma
FROM canciones c
JOIN artista a ON c.artista = a.id
JOIN idioma i ON c.idioma = i.id
WHERE c.id = $identificador";
$resultado = pg_query($conection, $consulta);
$registro = pg_fetch_assoc($resultado);

// Consultar todos los artistas
$consulta_artistas = "SELECT id, nombre FROM artista";
$resultado_artistas = pg_query($conection, $consulta_artistas);

// Consultar todos los idiomas
$consulta_idiomas = "SELECT id, nombre FROM idioma";
$resultado_idiomas = pg_query($conection, $consulta_idiomas);
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

  <h1>Formulario de Canciones</h1>
  <form action="actualizar.php?id=<?php echo $identificador; ?>" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $registro['titulo']?>">

    <label for="artista">Artista:</label>
    <select id="artista" name="artista">
        <option value="">Selecciona un artista</option>
        <?php
        while ($row_artista = pg_fetch_assoc($resultado_artistas)) {
            $selected = $row_artista['nombre'] == $registro['nombre_artista'] ? 'selected' : '';
            echo "<option value='{$row_artista['nombre']}' $selected>{$row_artista['nombre']}</option>";
        }
        ?>
    </select>

    <label for="album">Álbum:</label>
    <input type="text" id="album" name="album" value="<?php echo $registro['album']?>">

    <label for="genero">Género:</label>
    <input type="text" id="genero" name="genero" value="<?php echo $registro['genero']?>">

    <label for="duracion">Duración:</label>
    <input type="time" id="duracion" name="duracion" value="<?php echo $registro['duracion']?>">

    <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
    <input type="date" id="fecha_lanzamiento" name="fecha_lanzamiento" value="<?php echo $registro['fecha_lanzamiento']?>">

    <label for="idioma">Idioma:</label>
    <select id="idioma" name="idioma">
        <option value="">Selecciona un idioma</option>
        <?php
        while ($row_idioma = pg_fetch_assoc($resultado_idiomas)) {
            $selected = $row_idioma['nombre'] == $registro['nombre_idioma'] ? 'selected' : '';
            echo "<option value='{$row_idioma['nombre']}' $selected>{$row_idioma['nombre']}</option>";
        }
        ?>
    </select>

    <input type="submit" value="Enviar">
  </form>
</body>
</html>
