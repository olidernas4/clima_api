<?php
session_start(); // Iniciar sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
</head>
<body>
    <h2>Bienvenido al Panel de Control</h2>
    <p>Solo los usuarios autenticados pueden ver esta página.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>