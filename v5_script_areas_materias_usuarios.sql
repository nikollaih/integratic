
-- Crear áreas
INSERT INTO cfg_areas (caracterizacion_area, nomarea, tipo, icoarea, fecha) VALUES
(0, 'Matemáticas', 'area', 'matematicas.png', CURDATE()),
(0, 'Ciencias Sociales', 'area', 'sociales.png', CURDATE()),
(0, 'Ciencias Naturales', 'area', 'naturales.png', CURDATE()),
(0, 'Humanidades', 'area', 'humanidades.png', CURDATE());

-- Obtener códigos de área
SET @area_mate = (SELECT codarea FROM cfg_areas WHERE nomarea = 'Matemáticas');
SET @area_sociales = (SELECT codarea FROM cfg_areas WHERE nomarea = 'Ciencias Sociales');
SET @area_naturales = (SELECT codarea FROM cfg_areas WHERE nomarea = 'Ciencias Naturales');
SET @area_humanidades = (SELECT codarea FROM cfg_areas WHERE nomarea = 'Humanidades');

-- Crear materias
INSERT INTO cfg_materias (nommateria, area, grado, titulo, visible, icomateria, fecha) VALUES
('Matemáticas', @area_mate, '11', 'Matemáticas', 'SI', 'mat.png', CURDATE()),
('Geometría', @area_mate, '11', 'Geometría', 'SI', 'geo.png', CURDATE()),
('Estadística', @area_mate, '11', 'Estadística', 'SI', 'estad.png', CURDATE()),
('Historia', @area_sociales, '11', 'Historia', 'SI', 'hist.png', CURDATE()),
('Geografía', @area_sociales, '11', 'Geografía', 'SI', 'geo.png', CURDATE()),
('Ciencias Naturales', @area_naturales, '11', 'Ciencias Naturales', 'SI', 'ciennat.png', CURDATE()),
('Biología', @area_naturales, '11', 'Biología', 'SI', 'bio.png', CURDATE()),
('Química', @area_naturales, '11', 'Química', 'SI', 'quim.png', CURDATE()),
('Física', @area_naturales, '11', 'Física', 'SI', 'fis.png', CURDATE()),
('Español', @area_humanidades, '11', 'Español', 'SI', 'esp.png', CURDATE()),
('Lectura crítica', @area_humanidades, '11', 'Lectura crítica', 'SI', 'lect.png', CURDATE()),
('Inglés', @area_humanidades, '11', 'Inglés', 'SI', 'ing.png', CURDATE());

-- Insertar usuarios
INSERT INTO usuarios (id, nombres, apellidos, email, cargo, rol, nocel, usuario, clave, fecha, estado)
VALUES 
('10000001', 'Juan', 'Pérez', 'juan@example.com', 'Estudiante', 'estudiante', '3001234567', 'estudiante', '12345', '2025-07-16 22:26:46', 'ac'),
('10000002', 'Laura', 'Gómez', 'laura@example.com', 'Docente', 'docente', '3009876543', 'docente', '12345', '2025-07-16 22:26:46', 'ac'),
('10000003', 'Carlos', 'Ruiz', 'carlos@example.com', 'Coordinador', 'coordinador', '3005554433', 'coordinador', '12345', '2025-07-16 22:26:46', 'ac');

-- Insertar estudiante en tabla estudiante
INSERT INTO estudiante (documento, nombre, email, email_acudiente, grado, nee)
VALUES ('10000001', 'Juan Pérez', 'juan@example.com', 'acudiente@example.com', '11D', 0);


-- Asignaciones de materias al docente

-- Asignar cada materia al docente 10000002 (Laura Gómez) en el grupo 'D'
-- Se asume que los IDs de materias fueron insertados en este mismo script y son recuperables

INSERT INTO asg_materias (docente, materia, grupo)
SELECT '10000002', codmateria, 'D'
FROM cfg_materias;
