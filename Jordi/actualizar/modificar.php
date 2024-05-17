<?php
$host = "localhost"; // o la IP del servidor de base de dades
$dbname = "stellar";
$user = "postgres";
$password = "password";
$port = "5432"; // Port per defecte PostgreSQL 5432

// Cadena de connexió
$conection = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port");
if (!$conection){
    echo "Error en la conexion:";
}
?>
<!DOCTYPE HTML>
<html lang='es'>
<head>
    <title> Actualizacion / Eliminación </title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <header>
        <nav class="menu">
            <a href="../inicio.html" class="button">Pagina Principal</a> 
            <a href="../selects.php" class="button">Disponibles</a>
            <a href="../insertar/formulario.html" class="button">Añadir</a>
        </nav>
    </header>
    <table class="styled-table">
        <tr><td>Titulo</td><td>Artista</td><td>Album</td><td>Genero</td><td>Duracion</td><td>Fecha de lanzamiento</td><td>Idioma</td></tr>
        <?php
        $consulta = "SELECT c.id, c.titulo, a.nombre AS nombre_artista, c.album, c.genero, c.duracion, c.fecha_lanzamiento, i.nombre AS nombre_idioma
        FROM canciones c
        JOIN artista a ON c.artista = a.id
        JOIN idioma i ON c.idioma = i.id
        ORDER BY c.artista DESC";
        $resultadoSelect = pg_query($conection, $consulta);
        while ($row=pg_fetch_assoc($resultadoSelect)){
            echo '<tr>';
            echo '<td>' . $row['titulo'] . '</td>';
            echo '<td>' . $row['nombre_artista'] . '</td>';
            echo '<td>' . $row['album'] . '</td>';
            echo '<td>' . $row['genero'] . '</td>';
            echo '<td>' . $row['duracion'] . '</td>';
            echo '<td>' . $row['fecha_lanzamiento'] . '</td>';
            echo '<td>' . $row['nombre_idioma'] . '</td>';
            $linkactualizacion="formulario_modificar.php?id=".$row['id'];
            $linkeliminacion="../eliminar/eliminar.php?id=".$row['id'];
            echo "<td><a href=\"$linkactualizacion\" class='button'>Actualizar</a>   <a href=\"$linkeliminacion\" class='button'>Eliminar</a></td>";
            echo '</tr>';
        }
        ?>
    </table>

</body>
</html>
