<?php
/*******************************************************
 * ARCHIVO: admin_login.php
 * OBJETIVO:
 *  - Mostrar un formulario donde el admin ingresa la contraseña
 *  - Enviar la contraseña a verificar_admin.php
 *******************************************************/
session_start();

// Si ya está logueado → mandarlo al panel
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Location: admin_panel.php");
    exit;
}

$error = isset($_GET["error"]) ? "Contraseña incorrecta" : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login administrador</title>
    <style>
        body {
            background: #003049;
            color: white;
            font-family: Arial;
            text-align: center;
            padding-top: 60px;
        }

        form {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 10px;
            width: 350px;
            margin: auto;
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
            background: #ffb300;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        .error {
            color: #ff5555;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Acceso Administrador</h2>

<form action="verificar_admin.php" method="POST">
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Ingresar</button>
   <button><a class="btn salir" href="salir.php">Salir</a></button>
</form>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

</body>
</html>
