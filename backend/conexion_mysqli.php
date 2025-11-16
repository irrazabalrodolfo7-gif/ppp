<?php
// ===============================
//  ARCHIVO DE CONEXIÓN (MySQLi)
// ===============================

// Datos de conexión
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); 
define('DB_NAME', 'cfp6'); // <-- CORREGIDO

// Crear conexión
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar si falló
if ($mysqli->connect_errno) {
    echo "Error al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

// Asegurar acentos y ñ
$mysqli->set_charset("utf8mb4");
?>
