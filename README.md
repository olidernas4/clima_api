#DESCRIPCION

Esta aplicación permite a los usuarios consultar el clima actual de una ciudad específica y visualizar el historial de consultas. La aplicación utiliza la API de OpenWeather para obtener datos meteorológicos y una base de datos para almacenar el historial de consultas de cada usuario.

Características
Consulta del Clima: Permite a los usuarios ingresar una ciudad y obtener la temperatura actual y una descripción del clima.
Historial de Consultas: Los usuarios pueden ver un historial de todas las consultas de clima realizadas, incluyendo la ciudad, la temperatura, la descripción y la fecha de consulta.
Interfaz Amigable: Diseñada con una interfaz limpia y responsive que se adapta a diferentes tamaños de pantalla.
Gestión de Sesiones: Solo los usuarios autenticados pueden acceder a las funcionalidades de la aplicación.
Tecnologías Utilizadas
Frontend: HTML, CSS, JavaScript
Backend: PHP
Base de Datos: MySQL
API: OpenWeather.


Configura la base de datos:

Crea una base de datos en MySQL.
Ejecuta los scripts SQL necesarios para crear las tablas (historial_clima, etc.).
Configura la conexión:

Edita el archivo conexion.php con tus credenciales de la base de datos.
Obtén una API Key de OpenWeather:

Regístrate en OpenWeather y obtén una API Key.
Reemplaza KEY en dashboard.php con tu API Key.
Ejecuta el servidor:

Si estás usando XAMPP, coloca la carpeta del proyecto en la carpeta htdocs.
Accede a la aplicación a través de http://localhost/proyecto-clima/dashboard.php.
Uso
Inicia sesión con tus credenciales (si es necesario).
Ingresa el nombre de una ciudad en el campo de texto y haz clic en "Consultar Clima".
Visualiza la temperatura y la descripción del clima.
Haz clic en "Ver Historial de Consultas" para ver todas tus consultas anteriores.
