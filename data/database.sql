-- Base de datos para el registro de enfermedades

create database enfermedades;

use enfermedades;

CREATE TABLE registro_enfermedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    ruta_imagen VARCHAR(255)
);