<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: admin_login.php");
    exit;
}

require "conexion_mysqli.php";

$sql = "SELECT id, nombre, descripcion, horario, imagen FROM trayectos ORDER BY id DESC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar Trayectos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ccc; padding: 10px; }
        .del { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Listado de trayectos</h2>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Horario</th>
    <th>Imagen</th>
    <th>Acción</th>
</tr>

<?php while ($fila = $result->fetch_assoc()): ?>
<tr>
    <td><?= $fila['id'] ?></td>
    <td><?= $fila['nombre'] ?></td>
    <td><?= $fila['horario'] ?></td>
    <td><?= $fila['imagen'] ?></td>
    <td>
        <a class="del" href="baja_trayecto.php?id=<?= $fila['id'] ?>"
           onclick="return confirm('¿Seguro que querés borrar este trayecto?');">
           ❌ Eliminar
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="admin_panel.php">← Volver al panel</a>

</body>
</html>
