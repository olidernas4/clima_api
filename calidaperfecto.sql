-- Crear la base de datos
CREATE DATABASE sistema_clima;

-- Usar la base de datos creada
USE sistema_clima;

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de Registros de Inicio de Sesión
CREATE TABLE registros_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tiempo_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_direccion VARCHAR(45),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar Usuario de Prueba
INSERT INTO usuarios (nombre_usuario, email, password) 
VALUES ('admin', 'admin2@example.com', '2'); 

select * from usuarios


CREATE TABLE historial_clima (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    ciudad VARCHAR(100),
    temperatura FLOAT,
    descripcion VARCHAR(100),
    fecha_consulta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
