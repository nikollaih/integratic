-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.9-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para integra
CREATE DATABASE IF NOT EXISTS `integra` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `integra`;

-- Volcando estructura para tabla integra.asg_materias
CREATE TABLE IF NOT EXISTS `asg_materias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `docente` varchar(25) DEFAULT '0',
  `materia` varchar(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla integra.asg_materias: ~196 rows (aproximadamente)
/*!40000 ALTER TABLE `asg_materias` DISABLE KEYS */;
/*!40000 ALTER TABLE `asg_materias` ENABLE KEYS */;

-- Volcando estructura para tabla integra.asg_proyectos
CREATE TABLE IF NOT EXISTS `asg_proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `docente` varchar(25) DEFAULT '0',
  `proyecto` varchar(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla integra.asg_proyectos: ~44 rows (aproximadamente)
/*!40000 ALTER TABLE `asg_proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `asg_proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla integra.cfg_materias
CREATE TABLE IF NOT EXISTS `cfg_materias` (
  `codmateria` int(11) NOT NULL AUTO_INCREMENT,
  `nommateria` varchar(50) NOT NULL DEFAULT '0',
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `area` varchar(50) NOT NULL DEFAULT '0',
  `grado` varchar(50) NOT NULL DEFAULT '0',
  `titulo` varchar(100) NOT NULL DEFAULT '0',
  `visible` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codmateria`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla integra.cfg_materias: ~171 rows (aproximadamente)
/*!40000 ALTER TABLE `cfg_materias` DISABLE KEYS */;
INSERT INTO `cfg_materias` (`codmateria`, `nommateria`, `tipo`, `area`, `grado`, `titulo`, `visible`) VALUES
	(1, 'artistica', 'areas', 'artistica', '1', 'Educación  Artística Grado 1 ', 'S'),
	(2, 'artistica', 'areas', 'artistica', '2', 'Educación  Artística Grado 2', 'S'),
	(3, 'artistica', 'areas', 'artistica', '3', 'Educación  Artística Grado 3', 'S'),
	(4, 'artistica', 'areas', 'artistica', '4', 'Educación  Artística Grado 4', 'S'),
	(5, 'artistica', 'areas', 'artistica', '5', 'Educación  Artística Grado 5', 'S'),
	(6, 'artistica', 'areas', 'artistica', '6', 'Educación  Artística Grado 6', 'S'),
	(7, 'artistica', 'areas', 'artistica', '7', 'Educación  Artística Grado 7', 'S'),
	(8, 'artistica', 'areas', 'artistica', '8', 'Educación  Artística Grado 8', 'S'),
	(9, 'artistica', 'areas', 'artistica', '9', 'Educación  Artística Grado 9', 'S'),
	(10, 'artistica', 'areas', 'artistica', '10', 'Educación  Artística Grado 10', 'S'),
	(11, 'artistica', 'areas', 'artistica', '11', 'Educación  Artística Grado 11', 'S'),
	(12, 'fisica', 'areas', 'naturales', '10', 'Física Grado 10', 'S'),
	(13, 'fisica', 'areas', 'naturales', '11', 'Física Grado 11', 'S'),
	(14, 'quimica', 'areas', 'naturales', '10', 'Química Grado 10', 'S'),
	(15, 'quimica', 'areas', 'naturales', '11', 'Química Grado 11', 'S'),
	(16, 'naturales', 'areas', 'naturales', '1', 'Ciencias Naturales Grado 1', 'S'),
	(17, 'naturales', 'areas', 'naturales', '2', 'Ciencias Naturales Grado 2', 'S'),
	(18, 'naturales', 'areas', 'naturales', '3', 'Ciencias Naturales Grado 3', 'S'),
	(19, 'naturales', 'areas', 'naturales', '4', 'Ciencias Naturales Grado 4', 'S'),
	(20, 'naturales', 'areas', 'naturales', '5', 'Ciencias Naturales Grado 5', 'S'),
	(21, 'naturales', 'areas', 'naturales', '6', 'Ciencias Naturales Grado 6', 'S'),
	(22, 'naturales', 'areas', 'naturales', '7', 'Ciencias Naturales Grado 7', 'S'),
	(23, 'naturales', 'areas', 'naturales', '8', 'Ciencias Naturales Grado 8', 'S'),
	(24, 'naturales', 'areas', 'naturales', '9', 'Ciencias Naturales Grado 9', 'S'),
	(25, 'naturales', 'areas', 'naturales', '10', 'Ciencias Naturales Grado 10', 'S'),
	(26, 'naturales', 'areas', 'naturales', '11', 'Ciencias Naturales Grado 11', 'S'),
	(27, 'historia', 'areas', 'sociales', '1', 'Historia y Geografía Grado 1', 'S'),
	(28, 'historia', 'areas', 'sociales', '2', 'Historia y Geografía Grado 2', 'S'),
	(29, 'historia', 'areas', 'sociales', '3', 'Historia y Geografía Grado 3', 'S'),
	(30, 'historia', 'areas', 'sociales', '4', 'Historia y Geografía Grado 4', 'S'),
	(31, 'historia', 'areas', 'sociales', '5', 'Historia y Geografía Grado 5', 'S'),
	(32, 'historia', 'areas', 'sociales', '6', 'Historia y Geografía Grado 6', 'S'),
	(33, 'historia', 'areas', 'sociales', '7', 'Historia y Geografía Grado 7', 'S'),
	(34, 'historia', 'areas', 'sociales', '8', 'Historia y Geografía Grado 8', 'S'),
	(35, 'historia', 'areas', 'sociales', '9', 'Historia y Geografía Grado 9', 'S'),
	(36, 'historia', 'areas', 'sociales', '10', 'Historia y Geografía Grado 10', 'S'),
	(37, 'historia', 'areas', 'sociales', '11', 'Historia y Geografía Grado 11', 'S'),
	(38, 'paz', 'areas', 'sociales', '4', 'Cátedra para la Paz Grado 4', 'S'),
	(39, 'paz', 'areas', 'sociales', '5', 'Cátedra para la Paz Grado 5', 'S'),
	(40, 'paz', 'areas', 'sociales', '6', 'Cátedra para la Paz Grado 6', 'S'),
	(41, 'paz', 'areas', 'sociales', '7', 'Cátedra para la Paz Grado 7', 'S'),
	(42, 'paz', 'areas', 'sociales', '8', 'Cátedra para la Paz Grado 8', 'S'),
	(43, 'paz', 'areas', 'sociales', '9', 'Cátedra para la Paz Grado 9', 'S'),
	(44, 'paz', 'areas', 'sociales', '10', 'Cátedra para la Paz Grado 10', 'S'),
	(45, 'paz', 'areas', 'sociales', '11', 'Cátedra para la Paz Grado 11', 'S'),
	(46, 'pcc', 'areas', 'sociales', '6', 'Paisaje Cultural Cafetero  Grado 6', 'S'),
	(47, 'pcc', 'areas', 'sociales', '7', 'Paisaje Cultural Cafetero  Grado 7', 'S'),
	(48, 'pcc', 'areas', 'sociales', '8', 'Paisaje Cultural Cafetero  Grado 8', 'S'),
	(49, 'pcc', 'areas', 'sociales', '9', 'Paisaje Cultural Cafetero  Grado 9', 'S'),
	(50, 'pcc', 'areas', 'sociales', '10', 'Paisaje Cultural Cafetero  Grado 10', 'S'),
	(51, 'pcc', 'areas', 'sociales', '11', 'Paisaje Cultural Cafetero  Grado 11', 'S'),
	(52, 'ciudadanas', 'areas', 'ciudadanas', '1', 'Competencias Ciudadanas Grado 1', 'S'),
	(53, 'ciudadanas', 'areas', 'ciudadanas', '2', 'Competencias Ciudadanas Grado 2', 'S'),
	(54, 'ciudadanas', 'areas', 'ciudadanas', '3', 'Competencias Ciudadanas Grado 3', 'S'),
	(55, 'ciudadanas', 'areas', 'ciudadanas', '4', 'Competencias Ciudadanas Grado 4', 'S'),
	(56, 'ciudadanas', 'areas', 'ciudadanas', '5', 'Competencias Ciudadanas Grado 5', 'S'),
	(57, 'ciudadanas', 'areas', 'ciudadanas', '6', 'Competencias Ciudadanas Grado 6', 'S'),
	(58, 'ciudadanas', 'areas', 'ciudadanas', '7', 'Competencias Ciudadanas Grado 7', 'S'),
	(59, 'ciudadanas', 'areas', 'ciudadanas', '8', 'Competencias Ciudadanas Grado 8', 'S'),
	(60, 'ciudadanas', 'areas', 'ciudadanas', '9', 'Competencias Ciudadanas Grado 9', 'S'),
	(61, 'ciudadanas', 'areas', 'ciudadanas', '10', 'Competencias Ciudadanas Grado 10', 'S'),
	(62, 'ciudadanas', 'areas', 'ciudadanas', '11', 'Competencias Ciudadanas Grado 11', 'S'),
	(63, 'economicas', 'areabase', 'economicas', '10', 'Ciencias Económicas Grado 10', 'S'),
	(64, 'politicas', 'areabase\r\n', 'politicas', '11', 'Ciencias Políticas Grado 11', 'S'),
	(65, 'edfisica', 'areas', 'edfisica', '1', 'Educación Física Grado 1', 'S'),
	(66, 'edfisica', 'areas', 'edfisica', '2', 'Educación Física Grado 2', 'S'),
	(67, 'edfisica', 'areas', 'edfisica', '3', 'Educación Física Grado 3', 'S'),
	(68, 'edfisica', 'areas', 'edfisica', '4', 'Educación Física Grado 4', 'S'),
	(69, 'edfisica', 'areas', 'edfisica', '5', 'Educación Física Grado 5', 'S'),
	(70, 'edfisica', 'areas', 'edfisica', '6', 'Educación Física Grado 6', 'S'),
	(71, 'edfisica', 'areas', 'edfisica', '7', 'Educación Física Grado 7', 'S'),
	(72, 'edfisica', 'areas', 'edfisica', '8', 'Educación Física Grado 8', 'S'),
	(73, 'edfisica', 'areas', 'edfisica', '9', 'Educación Física Grado 9', 'S'),
	(74, 'edfisica', 'areas', 'edfisica', '10', 'Educación Física Grado 10', 'S'),
	(75, 'edfisica', 'areas', 'edfisica', '11', 'Educación Física Grado 11', 'S'),
	(76, 'etica', 'areas', 'etica', '1', 'Educación Ética y Valores Grado 1', 'S'),
	(77, 'etica', 'areas', 'etica', '2', 'Educación Ética y Valores Grado 2', 'S'),
	(78, 'etica', 'areas', 'etica', '3', 'Educación Ética y Valores Grado 3', 'S'),
	(79, 'etica', 'areas', 'etica', '4', 'Educación Ética y Valores Grado 4', 'S'),
	(80, 'etica', 'areas', 'etica', '5', 'Educación Ética y Valores Grado 5', 'S'),
	(81, 'etica', 'areas', 'etica', '6', 'Educación Ética y Valores Grado 6', 'S'),
	(82, 'etica', 'areas', 'etica', '7', 'Educación Ética y Valores Grado 7', 'S'),
	(83, 'etica', 'areas', 'etica', '8', 'Educación Ética y Valores Grado 8', 'S'),
	(84, 'etica', 'areas', 'etica', '9', 'Educación Ética y Valores Grado 9', 'S'),
	(85, 'etica', 'areas', 'etica', '10', 'Educación Ética y Valores Grado 10', 'S'),
	(86, 'etica', 'areas', 'etica', '11', 'Educación Ética y Valores Grado 11', 'S'),
	(87, 'filosofia', 'areas', 'filosofia', '9', 'Filosofía Grado 9', 'S'),
	(88, 'filosofia', 'areas', 'filosofia', '10', 'Filosofía Grado 10', 'S'),
	(89, 'filosofia', 'areas', 'filosofia', '11', 'Filosofía Grado 11', 'S'),
	(90, 'castellana', 'areas', 'humanidades', '1', 'Lengua Castellana y Lectura Comprensiva Grado 1', 'S'),
	(91, 'castellana', 'areas', 'humanidades', '2', 'Lengua Castellana y Lectura Comprensiva Grado 2', 'S'),
	(92, 'castellana', 'areas', 'humanidades', '3', 'Lengua Castellana y Lectura Comprensiva Grado 3', 'S'),
	(93, 'castellana', 'areas', 'humanidades', '4', 'Lengua Castellana y Lectura Comprensiva Grado 4', 'S'),
	(94, 'castellana', 'areas', 'humanidades', '5', 'Lengua Castellana y Lectura Comprensiva Grado 5', 'S'),
	(95, 'castellana', 'areas', 'humanidades', '6', 'Lengua Castellana y Lectura Comprensiva Grado 6', 'S'),
	(96, 'castellana', 'areas', 'humanidades', '7', 'Lengua Castellana y Lectura Comprensiva Grado 7', 'S'),
	(97, 'castellana', 'areas', 'humanidades', '8', 'Lengua Castellana y Lectura Comprensiva Grado 8', 'S'),
	(98, 'castellana', 'areas', 'humanidades', '9', 'Lengua Castellana y Lectura Comprensiva Grado 9', 'S'),
	(99, 'castellana', 'areas', 'humanidades', '10', 'Lengua Castellana y Lectura Comprensiva Grado 10', 'S'),
	(100, 'castellana', 'areas', 'humanidades', '11', 'Lengua Castellana y Lectura Comprensiva Grado 11', 'S'),
	(101, 'critica', 'areas', 'humanidades', '4', 'Lectura Crítica Grado 4', 'S'),
	(102, 'critica', 'areas', 'humanidades', '5', 'Lectura Crítica Grado 5', 'S'),
	(103, 'critica', 'areas', 'humanidades', '6', 'Lectura Crítica Grado 6', 'S'),
	(104, 'critica', 'areas', 'humanidades', '7', 'Lectura Crítica Grado 7', 'S'),
	(105, 'critica', 'areas', 'humanidades', '8', 'Lectura Crítica Grado 8', 'S'),
	(106, 'ingles', 'areas', 'humanidades', '1', 'Inglés Grado 1', 'S'),
	(107, 'ingles', 'areas', 'humanidades', '2', 'Inglés Grado 2', 'S'),
	(108, 'ingles', 'areas', 'humanidades', '3', 'Inglés Grado 3', 'S'),
	(109, 'ingles', 'areas', 'humanidades', '4', 'Inglés Grado 4', 'S'),
	(110, 'ingles', 'areas', 'humanidades', '5', 'Inglés Grado 5', 'S'),
	(111, 'ingles', 'areas', 'humanidades', '6', 'Inglés Grado 6', 'S'),
	(112, 'ingles', 'areas', 'humanidades', '7', 'Inglés Grado 7', 'S'),
	(113, 'ingles', 'areas', 'humanidades', '8', 'Inglés Grado 8', 'S'),
	(114, 'ingles', 'areas', 'humanidades', '9', 'Inglés Grado 9', 'S'),
	(115, 'ingles', 'areas', 'humanidades', '10', 'Inglés Grado 10', 'S'),
	(116, 'ingles', 'areas', 'humanidades', '11', 'Inglés Grado 11', 'S'),
	(117, 'lecto', 'areas', 'humanidades', '1', 'Lectoescritura Grado 1', 'S'),
	(118, 'lecto', 'areas', 'humanidades', '2', 'Lectoescritura Grado 2', 'S'),
	(119, 'lecto', 'areas', 'humanidades', '3', 'Lectoescritura Grado 3', 'S'),
	(120, 'calculo', 'areas', 'matematicas', '11', 'Cálculo Grado 11', 'S'),
	(121, 'trigonometria', 'areas', 'matematicas', '10', 'Trigonometría Grado 10', 'S'),
	(122, 'estadistica', 'areas', 'matematicas', '10', 'Estadística Grado 10', 'S'),
	(123, 'estadistica', 'areas', 'matematicas', '11', 'Estadística Grado 11', 'S'),
	(124, 'geometria', 'areas', 'matematicas', '4', 'Geometría Grado 4', 'S'),
	(125, 'geometria', 'areas', 'matematicas', '5', 'Geometría Grado 5', 'S'),
	(126, 'geometria', 'areas', 'matematicas', '6', 'Geometría Grado 6', 'S'),
	(127, 'geometria', 'areas', 'matematicas', '7', 'Geometría Grado 7', 'S'),
	(128, 'geometria', 'areas', 'matematicas', '8', 'Geometría Grado 8', 'S'),
	(129, 'geometria', 'areas', 'matematicas', '9', 'Geometría Grado 9', 'S'),
	(130, 'matematicas', 'areas', 'matematicas', '1', 'Matemáticas Grado 1', 'S'),
	(131, 'matematicas', 'areas', 'matematicas', '2', 'Matemáticas Grado 2', 'S'),
	(132, 'matematicas', 'areas', 'matematicas', '3', 'Matemáticas Grado 3', 'S'),
	(133, 'matematicas', 'areas', 'matematicas', '4', 'Matemáticas Grado 4', 'S'),
	(134, 'matematicas', 'areas', 'matematicas', '5', 'Matemáticas Grado 5', 'S'),
	(135, 'matematicas', 'areas', 'matematicas', '6', 'Matemáticas Grado 6', 'S'),
	(136, 'matematicas', 'areas', 'matematicas', '7', 'Matemáticas Grado 7', 'S'),
	(137, 'matematicas', 'areas', 'matematicas', '8', 'Matemáticas Grado 8', 'S'),
	(138, 'matematicas', 'areas', 'matematicas', '9', 'Matemáticas Grado 9', 'S'),
	(139, 'religion', 'areas', 'religion', '1', 'Educación Religiosa Grado 1', 'S'),
	(140, 'religion', 'areas', 'religion', '2', 'Educación Religiosa Grado 2', 'S'),
	(141, 'religion', 'areas', 'religion', '3', 'Educación Religiosa Grado 3', 'S'),
	(142, 'religion', 'areas', 'religion', '4', 'Educación Religiosa Grado 4', 'S'),
	(143, 'religion', 'areas', 'religion', '5', 'Educación Religiosa Grado 5', 'S'),
	(144, 'religion', 'areas', 'religion', '6', 'Educación Religiosa Grado 6', 'S'),
	(145, 'religion', 'areas', 'religion', '7', 'Educación Religiosa Grado 7', 'S'),
	(146, 'religion', 'areas', 'religion', '8', 'Educación Religiosa Grado 8', 'S'),
	(147, 'religion', 'areas', 'religion', '9', 'Educación Religiosa Grado 9', 'S'),
	(148, 'religion', 'areas', 'religion', '10', 'Educación Religiosa Grado 10', 'S'),
	(149, 'religion', 'areas', 'religion', '11', 'Educación Religiosa Grado 11', 'S'),
	(150, 'informatica', 'areas', 'tecnologia', '6', 'Informática Grado 6', 'S'),
	(151, 'informatica', 'areas', 'tecnologia', '7', 'Informática Grado 7', 'S'),
	(152, 'informatica', 'areas', 'tecnologia', '8', 'Informática Grado 8', 'S'),
	(153, 'tecnologia', 'areas', 'tecnologia', '1', 'Tecnología e Informática Grado 1', 'S'),
	(154, 'tecnologia', 'areas', 'tecnologia', '2', 'Tecnología e Informática Grado 2', 'S'),
	(155, 'tecnologia', 'areas', 'tecnologia', '3', 'Tecnología e Informática Grado 3', 'S'),
	(156, 'tecnologia', 'areas', 'tecnologia', '4', 'Tecnología e Informática Grado 4', 'S'),
	(157, 'tecnologia', 'areas', 'tecnologia', '5', 'Tecnología e Informática Grado 5', 'S'),
	(158, 'tecnologia', 'areas', 'tecnologia', '6', 'Tecnología Grado 6', 'S'),
	(159, 'tecnologia', 'areas', 'tecnologia', '7', 'Tecnología Grado 7', 'S'),
	(160, 'tecnologia', 'areas', 'tecnologia', '8', 'Tecnología Grado 8', 'S'),
	(161, 'tecnologia', 'areas', 'tecnologia', '9', 'Tecnología e Informática Grado 9 ..', 'S'),
	(162, 'tecnologia', 'areas', 'tecnologia', '10', 'Tecnología e Informática Grado 10', 'S'),
	(163, 'tecnologia', 'areas', 'tecnologia', '11', 'Tecnología e Informática Grado 11', 'S'),
	(164, 'preescolar', 'areabase', 'preescolar', '0', 'Educación Preescolar', 'S'),
	(165, 'convivencia', 'areabase', 'convivencia', '0', 'Coord. de Convivencia', 'S'),
	(166, 'academica', 'areabase', 'academica', '0', 'Coord. Académica', 'S'),
	(167, 'rectoria', 'areabase', 'rectoria', '0', 'Rectoría', 'S'),
	(168, 'orientacion', 'areabase', 'orientacion', '0', 'Orientación', 'S'),
	(169, 'apoyo', 'areabase', 'apoyo', '0', 'Aula de Apoyo', 'S'),
	(170, 'pta', 'areabase', 'pta', '0', 'PTA', 'S'),
	(171, 'documentos', 'raiz', 'documentos', '0', 'Documentos Institucionales', 'S');
/*!40000 ALTER TABLE `cfg_materias` ENABLE KEYS */;

-- Volcando estructura para tabla integra.cfg_proyectos
CREATE TABLE IF NOT EXISTS `cfg_proyectos` (
  `codpro` int(11) NOT NULL AUTO_INCREMENT,
  `nomproyecto` varchar(70) NOT NULL DEFAULT '0',
  `icono` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codpro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla integra.cfg_proyectos: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `cfg_proyectos` DISABLE KEYS */;
INSERT INTO `cfg_proyectos` (`codpro`, `nomproyecto`, `icono`) VALUES
	(1, 'PRAE ', 'prae'),
	(2, 'Gestión del Riesgo', 'riesgo'),
	(3, 'Gestión de las TIC', 'tic'),
	(4, 'Auditoria Interna', 'auditoria'),
	(5, 'Mejoramiento de la Calidad Academica', 'mejoramiento'),
	(6, 'Bienestar Laboral', 'bienestar'),
	(7, 'Paisaje Cultural Cafetero', 'paisaje'),
	(8, 'Uso Creativo del Tiempo Libre', 'tiempo'),
	(9, 'Bilinguismo', 'bilinguismo'),
	(10, 'Democracia', 'democracia'),
	(11, 'Convivencia y Desarrollo Humano', 'convivencia'),
	(12, 'Lectura', 'lectura'),
	(13, 'Comité de Calidad', 'calidad'),
	(14, 'Servicio Social', 'social'),
	(15, 'Educación para la Sexualidad y Construcción de Ciudadania', 'sexualidad');
/*!40000 ALTER TABLE `cfg_proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla integra.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` varchar(25) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cargo` varchar(25) NOT NULL,
  `rol` varchar(25) NOT NULL,
  `nocel` varchar(25) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(25) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla integra.usuarios: ~34 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
