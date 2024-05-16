<?php
session_start();

include 'funcionesUsuarios.php';
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $confirmacion= obtenerUsuarioExistente($username, $password);
    if($confirmacion){
        $_SESSION['username']=$username;
        header("Location: ../inicio.php");
    }else{
        header("Location: formulario_inicio.html");
    }

}
  ?>