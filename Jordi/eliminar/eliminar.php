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
    echo "Error en la conecion";
}
?>
<!DOCTYPE HTML>
<html lang='es'>
<head>
    <title>Formulario de actualizacion de registro</title>
</head>
<body>
    <?php
    include "../funciones.php";
    $identificador=$_GET['id'];
    $resultadoEliminacion = eliminarCancion( $identificador );
    if ($resultadoEliminacion=="ok"){
        echo 'Actualizacion realizada <a href="../actualizar/modificar.php">Tornar al lista</a>';

    }elseif ($resultadoEliminacion== 'Error en la conexión.'){
        echo "Error en la conexión.";
    }
    else{
        echo "Error en al eliminar.";
    }

    ?>