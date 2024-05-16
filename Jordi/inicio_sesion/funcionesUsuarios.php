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

function insertarUsuario($nombre_usuario, $email, $contrasenia) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $query = "INSERT INTO usuario (nombre_usuario, email, contrasenia) VALUES ('$nombre_usuario', '$email', '$contrasenia')";

    if (!pg_query($conection,$query)){
        
        return "ERROR EN LA Actualizacion";
        
    }else{
        
        return "ok";
        
    }
}
function eliminarUsuario($identificador) {
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
function obtenerUsuarios() {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta = "SELECT * FROM usuario ";
    $resultadoSelect = pg_query($conection, $consulta);
    
    if ($resultadoSelect) {
       return $resultadoSelect;
    } else {
        return "No se encontraron resultados.";
    }
}

function obtenerUsuarioExistente($usuario, $pwd) {
    $conection = conectarBD();
    
    if (!$conection) {
        return "Error en la conexión.";
    }
    
    $consulta = "SELECT * FROM usuario WHERE '$usuario'=nombre_usuario AND '$pwd'=contrasenia";
    echo $consulta;
    $resultadoSelect = pg_query($conection, $consulta);
    //echo pg_num_rows($resultadoSelect);
    if ( pg_num_rows($resultadoSelect) != 0) {
       return true;
    } else {
        return false;
    }
}

function actualizarUsuario($identificador, $titulo, $artista, $genero, $duracion, $fecha_lanzamiento, $idioma, $album){
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
    $tablaHTML .= '<tr><th>Nombre de usuario</th><th>E-mail</th>';

    while ($row = pg_fetch_assoc($resultadoSelect)) {
        $tablaHTML .= '<tr>';
        $tablaHTML .= '<td>' . $row['nombre_usuario'] . '</td>';
        $tablaHTML .= '<td>' . $row['email'] . '</td>';
        $tablaHTML .= '</tr>';
    }

    $tablaHTML .= '</table>';
    
    return $tablaHTML;
}
?>
