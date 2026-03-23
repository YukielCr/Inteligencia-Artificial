drop database enfermedades;

create database enfermedades;

use enfermedades;
-- 
CREATE TABLE registro_enfermedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    ruta_imagen VARCHAR(255)
);

SHOW TABLES;
select *from registro_enfermedades;


create table registro_Sintomas(
	id int auto_increment primary key,
    nombre varchar(100) not null,
    descripcion text not null,
    ruta_imagen varchar(255)
);

select *from registro_Sintomas;

CREATE TABLE cuadro_Patologico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_enfermedad INT NOT NULL,
    id_sintoma INT NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    -- Las llaves foráneas aseguran que no se guarden IDs que no existen
    FOREIGN KEY (id_enfermedad) REFERENCES registro_enfermedades(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sintoma) REFERENCES registro_Sintomas(id) ON DELETE CASCADE
);


select *from cuadro_Patologico;


INSERT INTO registro_Sintomas (nombre, descripcion, ruta_imagen) VALUES
('Fiebre', 'Elevación de la temperatura corporal por encima de los 38°C.', NULL),
('Tos seca', 'Tos persistente sin expectoración de mucosidad.', NULL),
('Cefalea', 'Dolor de cabeza intenso o punzante.', NULL),
('Fatiga', 'Sensación de cansancio extremo o falta de energía.', NULL),
('Náuseas', 'Sensación de malestar en el estómago con ganas de vomitar.', NULL),
('Mareos', 'Sensación de inestabilidad o pérdida del equilibrio.', NULL),
('Congestión nasal', 'Obstrucción de las fosas nasales por inflamación o moco.', NULL),
('Dolor de garganta', 'Irritación, carraspeo o dolor al tragar.', NULL),
('Mialgia', 'Dolor muscular generalizado.', NULL),
('Artralgia', 'Dolor o rigidez en las articulaciones.', NULL),
('Disnea', 'Dificultad para respirar o sensación de falta de aire.', NULL),
('Diarrea', 'Evacuaciones líquidas o blandas frecuentes.', NULL),
('Vómito', 'Expulsión violenta del contenido estomacal.', NULL),
('Escalofríos', 'Contracciones musculares involuntarias por frío o fiebre.', NULL),
('Ageusia', 'Pérdida total o parcial del sentido del gusto.', NULL),
('Anosmia', 'Pérdida total o parcial del sentido del olfato.', NULL),
('Dolor abdominal', 'Malestar o cólicos en la zona del vientre.', NULL),
('Erupción cutánea', 'Aparición de manchas, granos o enrojecimiento en la piel.', NULL),
('Insomnio', 'Dificultad persistente para conciliar el sueño.', NULL),
('Sudoración nocturna', 'Exceso de sudor durante las horas de sueño.', NULL),
('Taquicardia', 'Latidos del corazón más rápidos de lo normal en reposo.', NULL),
('Estornudos', 'Expulsión brusca y ruidosa de aire por la nariz.', NULL),
('Prurito', 'Picazón o irritación que induce a rascarse.', NULL),
('Edema', 'Hinchazón causada por la acumulación de líquidos.', NULL),
('Ojos rojos', 'Inflamación de los vasos sanguíneos en la esclerótica.', NULL),
('Tinnitus', 'Zumbido o silbido persistente en los oídos.', NULL),
('Anorexia', 'Pérdida notable del apetito.', NULL),
('Estreñimiento', 'Dificultad o baja frecuencia para evacuar heces.', NULL),
('Dolor lumbar', 'Dolor localizado en la parte baja de la espalda.', NULL),
('Palidez', 'Pérdida del color natural de la piel o mucosas.', NULL),
('Confusión', 'Desorientación o incapacidad para pensar con claridad.', NULL),
('Hipotensión', 'Presión arterial inusualmente baja.', NULL),
('Hipertensión', 'Presión arterial elevada por encima de los niveles normales.', NULL),
('Visión borrosa', 'Falta de agudeza visual o claridad en la vista.', NULL),
('Epistaxis', 'Sangrado proveniente de las fosas nasales.', NULL),
('Acidez', 'Ardor en el esófago causado por reflujo gástrico.', NULL),
('Rigidez de nuca', 'Dificultad dolorosa para mover o doblar el cuello.', NULL),
('Debilidad', 'Pérdida de fuerza física en las extremidades.', NULL),
('Taquipnea', 'Respiración excesivamente rápida y superficial.', NULL),
('Tos productiva', 'Tos acompañada de expectoración o flemas.', NULL),
('Opresión torácica', 'Sensación de peso o presión en el pecho.', NULL),
('Somnolencia', 'Ganas intensas de dormir durante el día.', NULL),
('Xerostomía', 'Sensación de sequedad en la boca por falta de saliva.', NULL),
('Escotomas', 'Presencia de puntos ciegos o luces en el campo visual.', NULL),
('Temblor', 'Movimientos involuntarios y rítmicos de una parte del cuerpo.', NULL),
('Irritabilidad', 'Estado emocional de agitación o enojo fácil.', NULL),
('Sibilancias', 'Sonido silbante al pasar el aire por los pulmones.', NULL),
('Adenopatía', 'Inflamación o aumento de tamaño de los ganglios.', NULL),
('Equimosis', 'Aparición de moretones sin causa aparente.', NULL),
('Desorientación', 'Confusión sobre el tiempo, lugar o identidad.', NULL);