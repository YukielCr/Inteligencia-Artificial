-- Base de datos para el registro de enfermedades

-- Base de datos para el registro de enfermedades

create database enfermedades;

use enfermedades;

CREATE TABLE registro_enfermedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    ruta_imagen VARCHAR(255)
);


select *from registro_enfermedades;

create table registro_Sintomas(
	id int auto_increment primary key,
    nombre varchar(100) not null,
    descripcion text not null,
    ruta_imagen varchar(255)
);

select *from registro_Sintomas;


