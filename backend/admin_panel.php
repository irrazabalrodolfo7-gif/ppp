<?php
/*******************************************************
 * ARCHIVO: admin_panel.php
 * OBJETIVO:
 *  - Mostrar opciones SOLO al administrador
 *  - Si no inició sesión, NO debe poder entrar
 *  - Desde acá podrá:
 *       1) Cargar un trayecto nuevo
 *       2) Eliminar un trayecto existente
 *       3) Salir (cerrar sesión)
 *******************************************************/

session_start();

// Si el admin NO inició sesión → NO LO DEJAMOS PASAR
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>

    <style>
        /* ESTILOS SIMPLES PARA QUE SE VEA LINDO */
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            text-align: center;
            padding: 40px;
        }
        h1 {
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #2980b9;
        }
        .salir {
            background: red;
        }
        .salir:hover {
            background: darkred;
        }
    </style>
</head>

<body>

    <h1>Panel del Administrador</h1>
    <p>Seleccioná una acción:</p>

    <!-- 1) Cargar un nuevo trayecto -->
    <a class="btn" href="alta_trayecto.php">Cargar Trayecto</a>

    <!-- 2) Eliminar trayectos -->
    <a class="btn" href="lista_trayectos.php">Eliminar Trayecto</a>


    <!-- 3) Salir y cerrar sesión -->
    <a class="btn salir" href="salir.php">Salir</a>

</body>
</html>
