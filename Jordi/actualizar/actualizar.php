<?php
$host = "localhost"; // o la IP del servidor de base de dades
$dbname = "stellar";
$user = "postgres";
$password = "password";
$port = "5432"; // Port per defecte PostgreSQL 5432

// Cadena de connexió
$conection = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port");
if (!$conection){
    echo "Error en la conecion";
}
?>
<!DOCTYPE HTML>
<html lang='es'>
<head>
    <title>Formulario de actualizacion de peliculas</title>
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        include '../funciones.php';
        $titulo=$_POST['titulo'] ;
        $nombre_artista=$_POST['artista'];
        $genero= $_POST['genero'];
        $album=$_POST['album'];
        $duracion=$_POST['duracion'];
        $fecha_lanzamiento=$_POST['fecha_lanzamiento'];
        $nombre_idioma=$_POST['idioma'];
        


        $identificador=$_GET['id'];
        $resultadoUpdate = actualizarCancion($identificador, $titulo, $nombre_artista, $album, $genero, $fecha_lanzamiento, $nombre_idioma, $duracion);
        if ($resultadoUpdate=="ok"){
            header ("Location: modificar.php");
        }else{echo $resultadoUpdate;}
        
        
        

    ?>