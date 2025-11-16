<?php
session_start();

/* ============================================================
   VERIFICAR SI EL ADMIN ESTÁ LOGUEADO
   Si no existe la variable de sesión "admin" o no es TRUE,
   significa que NO inició sesión → lo mandamos al login.
   ============================================================ */
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: admin_login.php");
    exit;
}

/* ============================================================
   CONECTAR A LA BASE DE DATOS
   ============================================================ */
require "conexion_mysqli.php";

/* ============================================================
   CONSULTA: traer todos los trayectos (últimos primero)
   ============================================================ */
$sql = "SELECT id, nombre, descripcion, horario, imagen 
        FROM trayectos 
        ORDER BY id DESC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar Trayectos</title>

    <!-- =======================================================
         ESTILOS COMPLETOS — TOTALMENTE RESPONSIVO
         ======================================================= -->
    <style>

        /* -------------------------------------------------------
           GENERAL DEL BODY
           Fondo oscuro + centrado del contenido
           ------------------------------------------------------- */
        body {
            background: #0a0a47;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        /* -------------------------------------------------------
           CONTENEDOR PRINCIPAL
           Centra la tabla y le da un recuadro
           ------------------------------------------------------- */
        .contenedor {
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 15px;
            width: 90%;
            max-width: 900px; /* no se va a estirar más que esto */
        }

        /* -------------------------------------------------------
           TÍTULO
           ------------------------------------------------------- */
        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* -------------------------------------------------------
           TABLA
           responsive gracias al overflow-x
           ------------------------------------------------------- */
        .tabla_contenedor {
            overflow-x: auto; /* hace scroll horizontal en pantallas chicas */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            text-align: left;
        }

        th {
            background: rgba(0, 0, 0, 0.3);
        }

        /* -------------------------------------------------------
           COLOR DEL BOTÓN “ELIMINAR”
           ------------------------------------------------------- */
        .del {
            color: #ff6b6b;
            font-weight: bold;
            text-decoration: none;
        }

        .del:hover {
            text-decoration: underline;
        }

        /* -------------------------------------------------------
           BOTÓN VOLVER
           ------------------------------------------------------- */
        .volver {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ffd86b;
        }

        /* -------------------------------------------------------
           MEDIA QUERY EXTRA (para pantallas MUY chicas)
           ------------------------------------------------------- */
        @media (max-width: 480px) {
            th, td {
                padding: 8px;
                font-size: 14px;
            }
        }

    </style>
</head>
<body>

<div class="contenedor">

    <h2>Listado de trayectos</h2>

    <!-- CONTENEDOR SCROLL PARA MÓVILES -->
    <div class="tabla_contenedor">
    
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Horario</th>
                <th>Imagen</th>
                <th>Acción</th>
            </tr>

            <!-- BUCLE QUE IMPRIME TODAS LAS FILAS -->
            <?php while ($fila = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['horario'] ?></td>
                <td><?= $fila['imagen'] ?></td>

                <td>
                    <a class="del"
                        href="baja_trayecto.php?id=<?= $fila['id'] ?>"
                        onclick="return confirm('¿Seguro que querés borrar este trayecto?');">
                        ❌ Eliminar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>

    </div>

    <!-- BOTÓN VOLVER -->
    <a class="volver" href="admin_panel.php">← Volver al panel</a>

</div>

</body>
</html>

