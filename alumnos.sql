-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS alumnos;
USE alumnos;

-- Crear tabla alumnos
CREATE TABLE IF NOT EXISTS alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Insertar datos de ejemplo en la tabla alumnos
INSERT INTO alumnos (nombre) VALUES 
('Carlos López'), ('María González'), ('Jorge Rodríguez'), ('Ana Martínez'), ('Luis Fernández'),
('Sofía Jiménez'), ('José García'), ('Carolina Torres'), ('Miguel Pérez'), ('Laura Sánchez');

