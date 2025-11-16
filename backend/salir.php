<?php
/*****************************************************
 * ARCHIVO: salir.php
 * OBJETIVO:
 *  - Cerrar la sesión del administrador
 *  - Volver a la página pública de trayectos
 *****************************************************/

session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión por completo
session_destroy();

// Redirigir a la página pública donde se ven los trayectos
header("Location: ../index.php");
exit;
?>
