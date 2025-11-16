<?php

$conexion = mysqli_connect("localhost", "root", "", "");

if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS cfp_trayectos";
if (mysqli_query($conexion, $sql)) {
    echo "Base de datos creada correctamente<br>";
} else {
    echo "Error creando la base de datos: " . mysqli_error($conexion);
}

mysqli_select_db($conexion, "cfp_trayectos");

$sqlTabla = "CREATE TABLE IF NOT EXISTS trayectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    horario VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL
)";

if (mysqli_query($conexion, $sqlTabla)) {
    echo "Tabla 'trayectos' creada correctamente";
} else {
    echo "Error creando tabla: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
