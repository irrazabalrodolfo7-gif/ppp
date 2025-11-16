<?php
session_start();

/* SI NO HAY LOGIN -> FUERA */
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("Location: admin_login.php");
    exit;
}

/* CONECTAR A MYSQL */
require "conexion_mysqli.php";

/* LIMPIAR */
function limpiar($txt) {
    return htmlspecialchars(trim($txt));
}

/* POST */
$nombre      = limpiar($_POST["nombre"]);
$descripcion = limpiar($_POST["descripcion"]);
$horario     = limpiar($_POST["horario"]);
$imagen      = limpiar($_POST["imagen"]); // nombre del archivo, ej: foto1.jpg

/* VALIDAR */
if (!$nombre || !$descripcion || !$horario || !$imagen) {
    die("<p style='color:red;'>Faltan datos obligatorios.</p>
         <a href='alta_trayecto.php'>Volver</a>");
}

/* INSERT */
$sql = "INSERT INTO trayectos (nombre, descripcion, horario, imagen)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("Error preparando consulta: " . $mysqli->error);
}

$stmt->bind_param("ssss", $nombre, $descripcion, $horario, $imagen);

if ($stmt->execute()) {
    echo "<h2 style='color:green;'>Trayecto agregado correctamente ✔</h2>";
    echo "<p><a href='admin_panel.php'>Volver al panel</a></p>";
} else {
    echo "<p style='color:red;'>Error al insertar: " . $stmt->error . "</p>";
    echo "<p><a href='alta_trayecto.php'>Volver</a></p>";
}

$stmt->close();
$mysqli->close();
?>
