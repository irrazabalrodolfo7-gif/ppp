<?php
// ---------------------------------------------------------
// verificar_admin.php
// Se ejecuta cuando el admin envía la contraseña.
// Si es correcta, crea la sesión y lo manda al panel.
// ---------------------------------------------------------

session_start();

// === CONTRASEÑA GUARDADA (la que vos quieras) ===
$admin_password_real = "1234";

// === CONTRASEÑA QUE ESCRIBIÓ EL ADMIN ===
$pass_ingresada = $_POST['password'] ?? "";

// === VERIFICAR ===
if ($pass_ingresada === $admin_password_real) {

    // Guardamos que el admin inició sesión
    $_SESSION['admin'] = true;

    // Mandarlo al panel
    header("Location: admin_panel.php");
    exit;

} else {

    // Si está mal, volver al login con error
    header("Location: admin_login.php?error=1");
    exit;

}
?>
