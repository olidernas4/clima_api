<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="post" action="">
            Usuario: <input type="text" name="username" required><br>
            Email: <input type="email" name="email" required><br>
            Contraseña: <input type="password" name="password" required><br>
            <input type="submit" value="Registrar">
        </form>
        <a href="login.php">Volver al Login</a>
    </div>
</body>
</html>
