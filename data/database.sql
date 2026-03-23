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