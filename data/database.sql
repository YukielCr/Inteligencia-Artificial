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
ALTER TABLE registro_enfermedades ADD COLUMN suma_total DECIMAL(6,2) DEFAULT 0;

-- Creacion de la primera tabla
create table registro_Sintomas(
	id int auto_increment primary key,
    nombre varchar(100) not null,
    descripcion text not null,
    ruta_imagen varchar(255)
);

-- Registro de enfermedades
CREATE TABLE cuadro_Patologico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_enfermedad INT NOT NULL,
    id_sintoma INT NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    -- Las llaves foráneas aseguran que no se guarden IDs que no existen
    FOREIGN KEY (id_enfermedad) REFERENCES registro_enfermedades(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sintoma) REFERENCES registro_Sintomas(id) ON DELETE CASCADE
);

select *from registro_enfermedades;
select *from registro_Sintomas;
select *from cuadro_Patologico;





INSERT INTO registro_enfermedades (nombre, descripcion, ruta_imagen) VALUES 
('Dengue', 'Enfermedad viral transmitida por mosquitos.', ''),
('Chikungunya', 'Fiebre viral transmitida por mosquitos que causa dolor articular.', ''),
('Zika', 'Infección viral transmitida por el mosquito Aedes.', ''),
('COVID-19', 'Enfermedad respiratoria aguda causada por el coronavirus SARS-CoV-2.', ''),
('Influenza (Gripe)', 'Infección viral respiratoria contagiosa.', ''),
('Resfriado común', 'Infección viral leve del tracto respiratorio superior.', ''),
('Asma', 'Enfermedad crónica que inflama y estrecha las vías respiratorias.', ''),
('Bronquitis', 'Inflamación del revestimiento de los conductos bronquiales.', ''),
('Gastritis', 'Inflamación del revestimiento del estómago.', ''),
('Migraña', 'Dolor de cabeza intenso y pulsátil, a menudo en un lado de la cabeza.', ''),
('Diabetes Tipo 2', 'Trastorno crónico que afecta la forma en que el cuerpo metaboliza el azúcar.', ''),
('Hipertensión', 'Presión arterial alta de forma crónica.', ''),
('Anemia', 'Afección en la que la sangre no cuenta con suficientes glóbulos rojos sanos.', ''),
('Tuberculosis', 'Infección bacteriana contagiosa que afecta principalmente a los pulmones.', ''),
('Cólera', 'Enfermedad bacteriana que provoca diarrea severa y deshidratación.', '');


INSERT INTO registro_Sintomas (nombre, descripcion, ruta_imagen) VALUES 
('Fiebre', 'Aumento temporal de la temperatura corporal promedio.', ''),
('Dolor de cabeza', 'Dolor o molestia en la cabeza, el cuero cabelludo o el cuello.', ''),
('Escalofríos', 'Sensación de frío acompañada de temblores musculares.', ''),
('Debilidad', 'Falta de fuerza física o energía muscular.', ''),
('Ronchas', 'Erupción cutánea con bultos rojizos que causan picazón.', ''),
('Dolor muscular', 'Molestia o dolor en los músculos (mialgia).', ''),
('Dolor articular', 'Molestia, dolor o inflamación en cualquier parte de una articulación.', ''),
('Náuseas', 'Sensación de malestar en el estómago con ganas de vomitar.', ''),
('Vómitos', 'Expulsión forzada del contenido del estómago por la boca.', ''),
('Diarrea', 'Heces blandas, acuosas y frecuentes.', ''),
('Cansancio extremo', 'Fatiga persistente que no se alivia con el descanso.', ''),
('Tos seca', 'Tos que no produce flema ni moco.', ''),
('Tos con flema', 'Tos que expulsa mucosidad de los pulmones.', ''),
('Dificultad para respirar', 'Sensación de falta de aire o asfixia.', ''),
('Congestión nasal', 'Acumulación de moco que bloquea los conductos nasales.', ''),
('Estornudos', 'Expulsión repentina y forzada de aire por la nariz y la boca.', ''),
('Dolor de garganta', 'Dolor, irritación o picazón en la garganta.', ''),
('Pérdida de olfato', 'Incapacidad total o parcial para percibir olores.', ''),
('Pérdida de gusto', 'Incapacidad para detectar sabores (dulce, salado, amargo, etc.).', ''),
('Sudoración nocturna', 'Episodios repetidos de sudoración extrema al dormir.', ''),
('Mareos', 'Sensación de inestabilidad o de que todo da vueltas.', ''),
('Visión borrosa', 'Falta de agudeza visual, incapacidad para ver detalles finos.', ''),
('Zumbido de oídos', 'Percepción de ruidos o pitidos en los oídos (tinnitus).', ''),
('Palidez', 'Pérdida inusual del color de la piel.', ''),
('Opresión en el pecho', 'Sensación de peso o aplastamiento en el área del tórax.', ''),
('Taquicardia', 'Ritmo cardíaco más rápido de lo normal en reposo.', ''),
('Sensibilidad a la luz', 'Molestia o dolor en los ojos por exposición a la luz (fotofobia).', ''),
('Sensibilidad al ruido', 'Intolerancia a niveles de sonido normales (hiperacusia).', ''),
('Acidez estomacal', 'Sensación de ardor en el pecho o la garganta.', ''),
('Gases', 'Acumulación de aire en el tracto digestivo.', ''),
('Estreñimiento', 'Dificultad para evacuar las heces.', ''),
('Sed excesiva', 'Necesidad anormal e incontrolable de beber líquidos (polidipsia).', ''),
('Orina frecuente', 'Necesidad de orinar más a menudo de lo habitual (poliuria).', ''),
('Hambre extrema', 'Apetito anormalmente grande (polifagia).', ''),
('Pérdida de peso', 'Disminución del peso corporal sin intentarlo.', ''),
('Aumento de peso', 'Acumulación inusual de masa corporal.', ''),
('Dificultad para dormir', 'Problemas para conciliar o mantener el sueño (insomnio).', ''),
('Calambres', 'Contracciones musculares involuntarias y dolorosas.', ''),
('Manos y pies fríos', 'Sensación de baja temperatura en las extremidades.', ''),
('Piel seca', 'Piel áspera, escamosa o que pica.', ''),
('Picazón', 'Sensación irritante que provoca el deseo de rascarse.', ''),
('Enrojecimiento ocular', 'Vasos sanguíneos dilatados en la parte blanca del ojo.', ''),
('Sangrado de encías', 'Hemorragia en los tejidos que rodean los dientes.', ''),
('Hemorragia nasal', 'Pérdida de sangre del tejido que recubre la nariz (epistaxis).', ''),
('Inflamación de ganglios', 'Aumento de tamaño de los ganglios linfáticos.', ''),
('Confusión mental', 'Incapacidad para pensar con la claridad o rapidez habitual.', ''),
('Alteración del equilibrio', 'Dificultad para mantenerse firme o caminar derecho.', ''),
('Desmayos', 'Pérdida temporal del conocimiento.', ''),
('Sibilancias', 'Sonido silbante durante la respiración.', ''),
('Irritabilidad', 'Tendencia a enojarse o frustrarse con facilidad.', '');


INSERT INTO cuadro_Patologico (id_enfermedad, id_sintoma, peso) VALUES
-- 1. Dengue (Fiebre, Dolor de cabeza, Dolor muscular, Dolor articular, Ronchas)
(1, 1, 30.00), (1, 2, 20.00), (1, 6, 20.00), (1, 7, 20.00), (1, 5, 10.00),

-- 2. Chikungunya (Fiebre, Dolor articular, Dolor muscular, Náuseas, Ronchas)
(2, 1, 25.00), (2, 7, 40.00), (2, 6, 15.00), (2, 8, 10.00), (2, 5, 10.00),

-- 3. Zika (Fiebre, Ronchas, Dolor articular, Enrojecimiento ocular, Dolor de cabeza)
(3, 1, 15.00), (3, 5, 35.00), (3, 7, 20.00), (3, 42, 20.00), (3, 2, 10.00),

-- 4. COVID-19 (Fiebre, Tos seca, Cansancio extremo, Pérdida de olfato, Dificultad para respirar)
(4, 1, 20.00), (4, 12, 20.00), (4, 11, 15.00), (4, 18, 25.00), (4, 14, 20.00),

-- 5. Influenza (Fiebre, Dolor muscular, Escalofríos, Tos seca, Dolor de garganta)
(5, 1, 30.00), (5, 6, 20.00), (5, 3, 20.00), (5, 12, 15.00), (5, 17, 15.00),

-- 6. Resfriado común (Congestión nasal, Estornudos, Dolor de garganta, Tos con flema, Lagrimeo/Picazón)
(6, 15, 30.00), (6, 16, 25.00), (6, 17, 20.00), (6, 13, 15.00), (6, 41, 10.00),

-- 7. Asma (Dificultad para respirar, Sibilancias, Opresión en el pecho, Tos seca, Cansancio extremo)
(7, 14, 30.00), (7, 49, 30.00), (7, 25, 20.00), (7, 12, 10.00), (7, 11, 10.00),

-- 8. Bronquitis (Tos con flema, Dificultad para respirar, Opresión en el pecho, Cansancio extremo, Fiebre)
(8, 13, 35.00), (8, 14, 20.00), (8, 25, 20.00), (8, 11, 15.00), (8, 1, 10.00),

-- 9. Gastritis (Náuseas, Acidez estomacal, Gases, Vómitos, Debilidad)
(9, 8, 25.00), (9, 29, 35.00), (9, 30, 15.00), (9, 9, 15.00), (9, 4, 10.00),

-- 10. Migraña (Dolor de cabeza, Náuseas, Sensibilidad a la luz, Sensibilidad al ruido, Visión borrosa)
(10, 2, 40.00), (10, 8, 15.00), (10, 27, 20.00), (10, 28, 15.00), (10, 22, 10.00),

-- 11. Diabetes Tipo 2 (Sed excesiva, Orina frecuente, Hambre extrema, Visión borrosa, Pérdida de peso)
(11, 32, 25.00), (11, 33, 25.00), (11, 34, 20.00), (11, 22, 15.00), (11, 35, 15.00),

-- 12. Hipertensión (Dolor de cabeza, Mareos, Visión borrosa, Zumbido de oídos, Palpitaciones/Taquicardia)
(12, 2, 25.00), (12, 21, 25.00), (12, 22, 20.00), (12, 23, 15.00), (12, 26, 15.00),

-- 13. Anemia (Cansancio extremo, Palidez, Mareos, Debilidad, Manos y pies fríos)
(13, 11, 30.00), (13, 24, 25.00), (13, 21, 15.00), (13, 4, 20.00), (13, 39, 10.00),

-- 14. Tuberculosis (Tos con flema, Sudoración nocturna, Pérdida de peso, Fiebre, Cansancio extremo)
(14, 13, 35.00), (14, 20, 20.00), (14, 35, 20.00), (14, 1, 15.00), (14, 11, 10.00),

-- 15. Cólera (Diarrea, Vómitos, Náuseas, Sed excesiva, Calambres)
(15, 10, 40.00), (15, 9, 20.00), (15, 8, 10.00), (15, 32, 20.00), (15, 38, 10.00);