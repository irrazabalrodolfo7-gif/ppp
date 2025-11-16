<?php
/************************************************************
 * ARCHIVO: alta_trayecto.php
 * OBJETIVO:
 *   - Mostrar un formulario para que el ADMIN cargue
 *     un nuevo trayecto (nombre, descripción, horario e imagen).
 *   - Este archivo NO inserta nada en la base.
 *   - Los datos se envían a insertar_trayecto.php
 ************************************************************/

session_start();

/* SI NO HAY LOGIN, NO DEJAR PASAR */
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cargar nuevo trayecto</title>

    <style>
    body {
        background: #0a0a47;
        color: #fff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;

        /* CENTRAR TODO EN LA PANTALLA */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
    }

    form {
        background: rgba(255, 255, 255, 0.15);
        padding: 25px;
        border-radius: 12px;
        width: 100%;
        max-width: 450px;   /* NO PASA DE 450px EN PC */
        box-sizing: border-box; /* PARA QUE NO SE DESBORDE */
        text-align: left;   /* Para que las etiquetas no queden centradas */
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        margin-top: 6px;
        margin-bottom: 15px;
        border: none;
        border-radius: 6px;
        box-sizing: border-box; /* Que no se rompa en móvil */
    }

    button {
        background: #ffb300;
        color: black;
        border: none;
        padding: 14px;
        margin-top: 10px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 6px;
        width: 100%; /* Botón al 100% ancho */
    }

    button:hover {
        opacity: 0.85;
    }

    a {
        display: block;
        margin-top: 18px;
        text-align: center;
        color: #fff;
    }

    /* 🔥 HACERLO SUPER RESPONSIVE */
    @media (max-width: 480px) {

        body {
            padding: 20px;
        }

        form {
            padding: 18px;
        }

        input, textarea {
            padding: 10px;
        }
    }
</style>

</head>
<body>

<h2>Cargar nuevo trayecto</h2>

<form action="insertar_trayecto.php" method="POST">

    <!-- NOMBRE -->
    <label>Nombre del trayecto:</label>
    <input type="text" name="nombre" required>

    <!-- DESCRIPCION -->
    <label>Descripción:</label>
    <textarea name="descripcion" rows="4" required></textarea>

    <!-- HORARIO -->
    <label>Horario:</label>
    <input type="text" name="horario" required>

    <!-- IMAGEN -->
    <label>Nombre del archivo de imagen (ya debe estar en la carpeta /img):</label>
    <input type="text" name="imagen" placeholder="ejemplo.jpg" required>

    <!-- BOTÓN -->
    <button type="submit">Cargar trayecto</button>
    <a href="admin_panel.php">← Volver al panel</a>
</form>



</body>
</html>
