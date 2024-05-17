<?php
/**
 * ConectarBD 
 *      Se conecta con la base de datos.
 * 
 * InsertarCancion
 *      @param string $titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma campos para insertar en la base de datos.
 *       En caso de que no funcione @return Error o @return confirmación.
 * 
 * EliminarCancion
 *      @param integer $identificador id de la tabla a borrar.
 * 
 * ObtenerCanciones
 *      Muestra los datos existentes en la base de datos.
 * 
 * Actualizar Cancion
 *       @param integer $identificador
 *       @param string $titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma
 *        Datos que actualizar en la base de datos.
 * 
 * Tablas
 *      @param string $resultadoSelect
 *      Realiza una tabla con el resultado del select.
 */
ini_set('display_errors', 1);
function conectarBD() {
    $host = "localhost";
    $dbname = "stellar";
    $user = "postgres";
    $password = "password";
    $port = "5432";
    
    // Cadena de conexión
    $conection = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port");
    
    return $conection;
}

function obtenerIdPorNombre($tabla, $nombre) {
    $conection = conectarBD();

    if (!$conection) {
        return "Error en la conexión.";
    }

    $query = "SELECT id FROM $tabla WHERE nombre = '$nombre'";
    $result = pg_query($conection, $query);

    if ($result === false) {
        // Manejo del error en la consulta
        return null;
    }

    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['id'];
    } else {
        return null;
    }
}


function crearRegistroSiNoExiste($tabla, $nombre) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $id = obtenerIdPorNombre($tabla, $nombre);
    if (is_null($id)) {
        $query = "INSERT INTO $tabla (nombre) VALUES ('$nombre') RETURNING id";
        $result = pg_query($conection, $query);
        if ($result) {
            $row = pg_fetch_assoc($result);
            return $row['id'];
        } else {
            return "Error al insertar en $tabla.";
        }
    } else {
        return $id;
    }
}

function insertarCancion($titulo, $nombre_artista, $album, $genero, $duracion, $fecha_lanzamiento, $nombre_idioma) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    // Obtener o crear los IDs correspondientes a los nombres
    $artista = crearRegistroSiNoExiste('artista', $nombre_artista);
    $idioma = crearRegistroSiNoExiste('idioma', $nombre_idioma);
    
    if (! $artista || ! $idioma) {
        return "Error " ;
    }

    $query = "INSERT INTO canciones (titulo, artista, album, genero, duracion, fecha_lanzamiento, idioma) 
              VALUES ('$titulo', $artista, '$album', '$genero', '$duracion', '$fecha_lanzamiento', $idioma)";

    if (!pg_query($conection, $query)){
        return "ERROR EN LA INSERCIÓN";
    } else {
        return "ok";
    }
}

function eliminarCancion($identificador) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta_eliminacion = "DELETE FROM canciones WHERE id = $identificador";
    if (!pg_query($conection, $consulta_eliminacion)){
        return "error";
    } else {
        return "ok";
    }
}

function obtenerCanciones() {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    // Join con las tablas artista e idioma para obtener los nombres en lugar de los IDs
    $consulta = "SELECT c.id, c.titulo, a.nombre AS nombre_artista, c.album, c.genero, c.duracion, c.fecha_lanzamiento, i.nombre AS nombre_idioma
                 FROM canciones c
                 JOIN artista a ON c.artista = a.id
                 JOIN idioma i ON c.idioma = i.id
                 ORDER BY c.artista DESC";
    $resultadoSelect = pg_query($conection, $consulta);
    
    if ($resultadoSelect) {
       return $resultadoSelect;
    } else {
        return "No se encontraron resultados.";
    }
}

function actualizarCancion($identificador, $titulo, $nombre_artista, $album, $genero, $duracion, $fecha_lanzamiento, $nombre_idioma) {
    
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    // Obtener o crear los IDs correspondientes a los nombres
    $artista = obtenerIdPorNombre('artista', $nombre_artista);
    $idioma = obtenerIdPorNombre('idioma', $nombre_idioma);
    
    if (is_string($artista) || is_string($idioma)) {
        return "Error: " . (is_string($artista) ? $artista : $idioma);
    }

    $consulta_actualizacion = "UPDATE canciones 
                               SET titulo='$titulo',
                                   artista=$artista,
                                   album='$album',
                                   genero='$genero',
                                   duracion='$duracion',
                                   fecha_lanzamiento='$fecha_lanzamiento',
                                   idioma=$idioma
                               WHERE id=$identificador";
    if (!pg_query($conection, $consulta_actualizacion)){
        return "ERROR EN LA ACTUALIZACIÓN";
    } else {
        return "ok";
    }
}

function tabla($resultadoSelect){
    $tablaHTML = '<table class="styled-table">';
    $tablaHTML .= '<tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Duración</th><th>Fecha de lanzamiento</th><th>Idioma</th></tr>';

    while ($row = pg_fetch_assoc($resultadoSelect)) {
        $tablaHTML .= '<tr>';
        $tablaHTML .= '<td>' . $row['titulo'] . '</td>';
        $tablaHTML .= '<td>' . $row['nombre_artista'] . '</td>';
        $tablaHTML .= '<td>' . $row['album'] . '</td>';
        $tablaHTML .= '<td>' . $row['genero'] . '</td>';
        $tablaHTML .= '<td>' . $row['duracion'] . '</td>';
        $tablaHTML .= '<td>' . $row['fecha_lanzamiento'] . '</td>';
        $tablaHTML .= '<td>' . $row['nombre_idioma'] . '</td>';
        $tablaHTML .= '</tr>';
    }

    $tablaHTML .= '</table>';
    
    return $tablaHTML;
}
?>
