<?php
include 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Imprimir los valores ingresados 
    //echo "Usuario ingresado: " . htmlspecialchars($username) . "<br>";
    //echo "Contraseña ingresada: " . htmlspecialchars($password) . "<br>";

    // Preparar la consulta para evitar inyección SQL
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Imprimir la consulta SQL
    echo "Consulta SQL: " . $sql . "<br>";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Usuario encontrado: " . htmlspecialchars($row['nombre_usuario']) . "<br>";

        
        if ($password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; 
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="">
            Usuario: <input type="text" name="username" required><br>
            Contraseña: <input type="password" name="password" required><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <a href="user_register.php" class="button">Registrar</a>
    </div>
</body>
</html>
