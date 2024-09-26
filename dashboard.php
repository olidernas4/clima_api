<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// API Key de OpenWeather
$apiKey = "35318f57b7ca75423c798f4adfbadb28"; 
$ciudad = 'Bogotá';

// Si el usuario ingresó una ciudad, usamos esa ciudad
if (isset($_POST['ciudad'])) {
    $ciudad = $_POST['ciudad'];
}

// URL de la API de OpenWeather
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=$apiKey&units=metric&lang=es";

// Obtener la información del clima
$climaData = file_get_contents($apiUrl);
$clima = json_decode($climaData, true);

// Información del clima
$temperatura = $clima['main']['temp'];
$descripcion = $clima['weather'][0]['description'];

// Conectar a la base de datos
include 'conexion.php';
$usuario_id = $_SESSION['user_id'];

// Insertar la consulta del clima en la base de datos
$sql = "INSERT INTO historial_clima (usuario_id, ciudad, temperatura, descripcion, fecha_consulta)
        VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isss', $usuario_id, $ciudad, $temperatura, $descripcion);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la aplicación del clima, <?php echo $_SESSION['username']; ?>!</h1>
        <form method="POST">
            <input type="text" name="ciudad" placeholder="Ingresa tu ciudad" required>
            <button type="submit" class="button">Consultar Clima</button>
        </form>

        <h2>Clima en <?php echo htmlspecialchars($ciudad); ?></h2>
        <p>Temperatura: <?php echo htmlspecialchars($temperatura); ?> °C</p>
        <p>Descripción: <?php echo ucfirst(htmlspecialchars($descripcion)); ?></p>

        <button id="historialBtn" class="button">Ver Historial de Consultas</button>

        <!-- Modal para el Historial -->
        <div id="historialModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Historial de Consultas de Clima</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Ciudad</th>
                            <th>Temperatura</th>
                            <th>Descripción</th>
                            <th>Fecha de Consulta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Consulta para obtener el historial de clima
                        $query = "
                            SELECT ciudad, temperatura, descripcion, fecha_consulta
                            FROM historial_clima
                            WHERE usuario_id = ?
                            ORDER BY fecha_consulta DESC
                        ";
                        $stmtHistorial = $conn->prepare($query);
                        $stmtHistorial->bind_param('i', $usuario_id);
                        $stmtHistorial->execute();
                        $resultHistorial = $stmtHistorial->get_result();

                        if ($resultHistorial->num_rows > 0): 
                            while ($registro = $resultHistorial->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($registro['ciudad']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['temperatura']); ?> °C</td>
                                    <td><?php echo htmlspecialchars($registro['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['fecha_consulta']); ?></td>
                                </tr>
                            <?php endwhile; 
                        else: ?>
                            <tr>
                                <td colspan="4">No hay registros disponibles</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button class="button" id="cerrarModal">Devolver a Consultar Más Ciudades</button>
            </div>
        </div>

        <a href="logout.php" class="button">Cerrar Sesión</a>
    </div>

    <script>
        // Modal de Historial
        var modal = document.getElementById("historialModal");
        var btn = document.getElementById("historialBtn");
        var span = document.getElementsByClassName("close")[0];
        var btnCerrar = document.getElementById("cerrarModal");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        btnCerrar.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
