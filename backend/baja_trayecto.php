<?php
/************************************************************
 * ARCHIVO: baja_trayecto.php
 * OBJETIVO:
 *   - El administrador puede eliminar trayectos por ID
 *   - La acción se realiza solo si hay sesión iniciada
 ************************************************************/

session_start();

/* SI EL ADMIN NO ESTÁ LOGUEADO -> AFUERA */
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: admin_login.php");
    exit;
}

/* CONEXIÓN */
require "conexion_mysqli.php";

/* VALIDAR QUE VIENE EL ID */
if (!isset($_GET["id"])) {
    die("<p style='color: red;'>Error: No se recibió ID de trayecto.</p>
         <a href='admin_panel.php'>Volver</a>");
}

$id = intval($_GET["id"]); // convertir a número

if ($id <= 0) {
    die("<p style='color:red;'>ID inválido.</p>
         <a href='admin_panel.php'>Volver</a>");
}

/************************************************************
 * ELIMINAR TRAYECTO
 ************************************************************/

$sql = "DELETE FROM trayectos WHERE id = ?";

/* PREPARAR */
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("<p style='color:red;'>Error preparando consulta: " . $mysqli->error . "</p>");
}

/* BIND */
$stmt->bind_param("i", $id);

/* EJECUTAR */
if ($stmt->execute()) {

    if ($stmt->affected_rows > 0) {
        echo "<h2 style='color:green;'>Trayecto eliminado correctamente ✔</h2>";
    } else {
        echo "<h2 style='color:orange;'>No existe un trayecto con ese ID.</h2>";
    }

    echo "<p><a href='admin_panel.php'>Volver al panel</a></p>";

} else {

    echo "<p style='color:red;'>Error al eliminar: " . $stmt->error . "</p>";
    echo "<p><a href='admin_panel.php'>Volver</a></p>";
}

/* CERRAR */
$stmt->close();
$mysqli->close();
?>
