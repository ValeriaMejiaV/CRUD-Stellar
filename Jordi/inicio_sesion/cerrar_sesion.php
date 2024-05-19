<?php


// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión u otra página deseada
header("Location: formulario_inicio.html");
exit();
?>
