<?php
/**
 * ConectarBD 
 *      Se conecta con la base de datos.
 * 
 * InsertarCanción
 *      @param string $titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma campos para insertar en la base de datos.
 *       En caso de que no funcione @return Error o @return confirmación.
 * 
 * EliminarCanción
 *      @param integer $identificador id de la tabla a borrar.
 * 
 * ObtenerCanciones
 *      Muestra los datos existentes en la base de datos.
 * 
 * Actualizar Canción
 *       @param integer $identificador
 *       @param string $titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma
 *        Datos que actuallizar en la base de datos.
 * 
 * Tablas
 *      @param string $resultadoSelect
 *      Realiza una tabla con el resultado del select.
 */
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

function insertarCancion($titulo, $artista, $album, $genero, $duracion, $fecha_lanzamiento, $idioma) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $query = "INSERT INTO Canciones (titulo, artista, album, genero, duracion, fecha_lanzamiento, idioma) VALUES ('$titulo', '$artista', '$album', '$genero', '$duracion', '$fecha_lanzamiento', '$idioma')";

    if (!pg_query($conection,$query)){
        
        return "ERROR EN LA Actualizacion";
        
    }else{
        
        return "ok";
        
    }
}
function eliminarCancion($identificador) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta_eliminacion="DELETE FROM Canciones WHERE id = $identificador";
    if (!pg_query($conection,$consulta_eliminacion)){
        
        return "error";
        
    }else{
        
        return "ok";
        
    }
}
function obtenerCanciones() {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta = "SELECT * FROM canciones ORDER BY artista DESC";
    $resultadoSelect = pg_query($conection, $consulta);
    
    if ($resultadoSelect) {
       return $resultadoSelect;
    } else {
        return "No se encontraron resultados.";
    }
}
function actualizarCancion($identificador, $titulo, $artista, $genero, $duracion, $fecha_lanzamiento, $idioma, $album){
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta_actualizacion="UPDATE Canciones SET titulo='$titulo',
                                                    artista='$artista',
                                                    genero='$genero',
                                                    duracion='$duracion',
                                                    fecha_lanzamiento='$fecha_lanzamiento',
                                                    idioma='$idioma',
                                                    album='$album'
                                                    where id=$identificador";
    if (!pg_query($conection,$consulta_actualizacion)){
        
        return "ERROR EN LA Actualizacion";
        
    }else{
        
        return "ok";
        
    }
} 
function tabla($resultadoSelect){
    $tablaHTML = '<table class="styled-table">';
    $tablaHTML .= '<tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Duración</th><th>Fecha de lanzamiento</th><th>Idioma</th></tr>';

    while ($row = pg_fetch_assoc($resultadoSelect)) {
        $tablaHTML .= '<tr>';
        $tablaHTML .= '<td>' . $row['titulo'] . '</td>';
        $tablaHTML .= '<td>' . $row['artista'] . '</td>';
        $tablaHTML .= '<td>' . $row['album'] . '</td>';
        $tablaHTML .= '<td>' . $row['genero'] . '</td>';
        $tablaHTML .= '<td>' . $row['duracion'] . '</td>';
        $tablaHTML .= '<td>' . $row['fecha_lanzamiento'] . '</td>';
        $tablaHTML .= '<td>' . $row['idioma'] . '</td>';
        $tablaHTML .= '</tr>';
    }

    $tablaHTML .= '</table>';
    
    return $tablaHTML;
}
?>
