<?php
/*******************************************************
 * ARCHIVO: admin_login.php
 * OBJETIVO:
 *  - Mostrar un formulario donde el admin ingresa la contraseña
 *  - Enviar la contraseña a verificar_admin.php
 *  - Manejar errores si la contraseña es incorrecta
 *******************************************************/
session_start(); // Inicia o continúa la sesión

// -------------------------------------------------------------
// Si el admin YA está logueado → lo mandamos directo al panel
// Evita que vuelva a ver el login si ya inició sesión
// -------------------------------------------------------------
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Location: admin_panel.php"); // Redirige al panel
    exit; // Detiene la ejecución del archivo
}

// -------------------------------------------------------------
// Manejo de error: si llega ?error en la URL → significa que
// en verificar_admin.php falló la contraseña.
// -------------------------------------------------------------
$error = isset($_GET["error"]) ? "Contraseña incorrecta" : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login administrador</title>

    <!--
        CSS SIMPLE PARA EL LOGIN:
        Fondo oscuro, texto blanco y un formulario centrado
    -->
    <style>
        body {
            background: #003049; /* Fondo azul oscuro */
            color: white;
            font-family: Arial;
            text-align: center;
            padding-top: 60px;
        }

        form {
            background: rgba(255,255,255,0.1); /* Blanco translúcido */
            padding: 25px;
            border-radius: 10px;
            width: 350px;
            margin: auto; /* Centrado */
        }

        input {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
        }

        button {
            padding: 10px;
            width: 100%;
            margin-top: 15px;
            background: #ffb300; /* Amarillo */
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        .error {
            color: #ff5555; /* Rojo */
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Acceso Administrador</h2>

<!--
    FORMULARIO DE LOGIN
    - method="POST" para enviar la contraseña sin mostrarla en la URL
    - action="verificar_admin.php" donde se valida la contraseña real
-->
<form action="verificar_admin.php" method="POST">

    <label>Contraseña:</label>

    <!-- Input tipo cntraseña para ocultar caracteres -->
    <input type="password" name="password" required>

    <!-- Botón para enbiar la contraseña -->
    <button type="submit">Ingresar</button>

    <!-- Botón para salir de la sesión -->
    <!-- IMPORTANTE: el <a> adentro de <button> funciona-->
    <button>
        <a class="btn salir" href="salir.php" style="text-decoration:none; color:black;">
            Salir
        </a>
    </button>
</form>

<!--
    SI hubo error → mostrar mensaje en rogo
-->
<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

</body>
</html>
