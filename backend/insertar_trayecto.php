<?php
session_start(); 
// Inicia la sesión. Necesario para verificar si el admin está logueado.

/* --------------------------------------------------------------
   VERIFICAR SI EL ADMIN ESTÁ LOGUEADO
   Si NO existe la variable de sesión "admin" o no es TRUE,
   entonces el usuario no debería estar acá → lo mandamos al login.
-------------------------------------------------------------- */
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("Location: admin_login.php"); // Redirección
    exit; // Detiene la ejecución del script
}

/* --------------------------------------------------------------
   CONECTAR A LA BASE DE DATOS
   Simplemente incluimos un archivo que ya contiene la conexión $mysqli.
-------------------------------------------------------------- */
require "conexion_mysqli.php";

/* --------------------------------------------------------------
   FUNCIÓN PARA LIMPIAR TEXTO
   trim()        → saca espacios de sobra
   htmlspecialchars() → evita inyección HTML
-------------------------------------------------------------- */
function limpiar($txt) {
    return htmlspecialchars(trim($txt));
}

/* --------------------------------------------------------------
   OBTENER LOS DATOS QUE VIENEN DEL FORMULARIO (POST)
   Cada campo pasa por la función limpiar()
-------------------------------------------------------------- */
$nombre      = limpiar($_POST["nombre"]);
$descripcion = limpiar($_POST["descripcion"]);
$horario     = limpiar($_POST["horario"]);
$imagen      = limpiar($_POST["imagen"]); 
// $imagen es solo el NOMBRE del archivo (ej: "foto1.jpg")

/* --------------------------------------------------------------
   VALIDAR QUE NINGÚN CAMPO ESTÉ VACÍO
   Si falta algo → mostrar error y frenar la ejecución.
-------------------------------------------------------------- */
if (!$nombre || !$descripcion || !$horario || !$imagen) {
    die("<p style='color:red;'>Faltan datos obligatorios.</p>
         <a href='alta_trayecto.php'>Volver</a>");
}

/* --------------------------------------------------------------
   PREPARAR CONSULTA SQL (INSERT)
   Creamos un INSERT con parámetros (?) para evitar inyecciones.
-------------------------------------------------------------- */
$sql = "INSERT INTO trayectos (nombre, descripcion, horario, imagen)
        VALUES (?, ?, ?, ?)";

/* Preparamos la consulta */
$stmt = $mysqli->prepare($sql);

/* Si algo salió mal al preparar la consulta */
if (!$stmt) {
    die("Error preparando consulta: " . $mysqli->error);
}

/* --------------------------------------------------------------
   UNIR PARÁMETROS A LOS ?
   bind_param("ssss", ...) indica 4 parámetros tipo string
-------------------------------------------------------------- */
$stmt->bind_param("ssss", $nombre, $descripcion, $horario, $imagen);

/* --------------------------------------------------------------
   EJECUTAR EL INSERT
   Si salió bien → mensaje verde
   Si falló → mensaje rojo con el error
-------------------------------------------------------------- */
if ($stmt->execute()) {
    echo "<h2 style='color:green;'>Trayecto agregado correctamente ✔</h2>";
    echo "<p><a href='admin_panel.php'>Volver al panel</a></p>";
} else {
    echo "<p style='color:red;'>Error al insertar: " . $stmt->error . "</p>";
    echo "<p><a href='alta_trayecto.php'>Volver</a></p>";
}

/* Cerrar statement y conexión */
$stmt->close();
$mysqli->close();
?>
