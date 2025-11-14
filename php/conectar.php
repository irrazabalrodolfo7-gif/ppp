<?php

// 1. **Definir la información de conexión**
$servidor = "localhost";
$usuario = "root";
$contrasena = ""; 
$nombre_bd = "consulta10"; // La base de datos que ya tienes creada

// 2. **Establecer la conexión y seleccionar la base de datos**
// El cuarto parámetro ($nombre_bd) selecciona la BD al conectar.
$conexion = new mysqli($servidor, $usuario, $contrasena, $nombre_bd);

// 3. **Verificar si la conexión falló**
if ($conexion->connect_error) {
    // Si hay un error, el script se detiene y muestra el mensaje.
    die("❌ Error de conexión: " . $conexion->connect_error);
}
// ... Suponiendo que la conexión a 'consulta10' ya está establecida en $conexion ...


// Datos que quieres insertar (simulando datos de un formulario)
$nombre = "Raton inalambrico";
$precio = 45.70;
$stock = 100;

// 1. Sentencia SQL con marcadores de posición (?)
$sql = "INSERT INTO productos (nombre_producto, precio, stock) VALUES (?, ?, ?)";

// 2. Preparar la sentencia
$stmt = $conexion->prepare($sql);

// 3. Vincular (Bind) los parámetros
// El primer argumento ('sdi') indica los tipos de datos:
// 's' = string (nombre)
// 'd' = double/decimal (precio)
// 'i' = integer (stock)
$stmt->bind_param("sdi", $nombre, $precio, $stock);

// 4. Ejecutar la sentencia
if ($stmt->execute()) {
    echo "✅ Nuevo registro insertado exitosamente.";
} else {
    echo "❌ Error al insertar datos: " . $stmt->error;
}

// 5. Cerrar la sentencia
$stmt->close();
// $conexion->close(); // Cerrar la conexión cuando ya no la necesites

// 6. **Cerrar la conexión**
// Es una buena práctica liberar el recurso del servidor.
$conexion->close();

?>
