-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS maestros;

-- Seleccionar la base de datos
USE maestros;

-- Crear la tabla 'maestros' si no existe
CREATE TABLE IF NOT EXISTS maestros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Insertar los datos en la tabla 'maestros'
INSERT INTO maestros (nombre) VALUES 
('Profesor Juan Ruiz'), 
('Maestra Marta Ortega'), 
('Profesor David Silva'), 
('Maestra Elena Morales'), 
('Profesor Alejandro Herrera');
