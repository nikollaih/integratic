-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-01-2024 a las 15:30:19
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
                               `id_actividad` int(11) NOT NULL,
                               `titulo_actividad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                               `descripcion_actividad` text COLLATE utf8_spanish2_ci NOT NULL,
                               `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               `disponible_hasta` datetime NOT NULL,
                               `url_archivo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                               `nombre_archivo` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
                               `created_by` int(11) NOT NULL,
                               `materia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
                               `grupo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
                               `estudiantes_habilitados` longtext COLLATE utf8_spanish2_ci NOT NULL,
                               `id_periodo` int(11) NOT NULL,
                               `porcentaje` double NOT NULL,
                               `disponible_desde` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alcance_prueba`
--

CREATE TABLE `alcance_prueba` (
                                  `id_alcance_prueba` int(11) NOT NULL,
                                  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alcance_prueba`
--

INSERT INTO `alcance_prueba` (`id_alcance_prueba`, `descripcion`) VALUES
                                                                      (1, 'Municipal'),
                                                                      (2, 'Departamental'),
                                                                      (3, 'Institucional'),
                                                                      (4, 'Nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
                            `id_anuncio` int(11) NOT NULL,
                            `titulo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                            `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
                            `created_by` int(11) NOT NULL,
                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `materia` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
                            `grupo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_curso`
--

CREATE TABLE `archivos_curso` (
                                  `id_archivo_curso` int(11) NOT NULL,
                                  `id_curso` int(11) NOT NULL,
                                  `nombre_archivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                  `slug_archivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asg_materias`
--

CREATE TABLE `asg_materias` (
                                `id` int(11) NOT NULL,
                                `docente` char(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT '0',
                                `materia` char(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT '0',
                                `grupo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asg_procesos`
--

CREATE TABLE `asg_procesos` (
                                `id` int(11) NOT NULL,
                                `docente` char(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT '0',
                                `proceso` char(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asg_proyectos`
--

CREATE TABLE `asg_proyectos` (
                                 `id` int(11) NOT NULL,
                                 `docente` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT '0',
                                 `proyecto` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_participantes_prueba`
--

CREATE TABLE `asignacion_participantes_prueba` (
                                                   `id_asignacion_participante_prueba` int(11) NOT NULL,
                                                   `id_prueba` int(11) NOT NULL,
                                                   `id_participante` varchar(25) NOT NULL,
                                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_preguntas_prueba`
--

CREATE TABLE `asignacion_preguntas_prueba` (
                                               `id_asignacion_pregunta_prueba` int(11) NOT NULL,
                                               `id_prueba` int(11) NOT NULL,
                                               `id_pregunta` int(11) NOT NULL,
                                               `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion`
--

CREATE TABLE `caracterizacion` (
                                   `id_caracterizacion` int(11) NOT NULL,
                                   `id_dba` int(11) DEFAULT NULL,
                                   `id_lineamiento_curricular` int(11) DEFAULT NULL,
                                   `id_estandar` int(11) DEFAULT NULL,
                                   `id_area` int(11) NOT NULL,
                                   `grado` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
                                   `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                   `ruta_contenido` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                   `estado` tinyint(1) NOT NULL DEFAULT '1',
                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion_area`
--

CREATE TABLE `caracterizacion_area` (
                                        `id_caracterizacion_area` int(11) NOT NULL,
                                        `descripcion_area` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                        `estado` tinyint(1) NOT NULL DEFAULT '1',
                                        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                        `is_dba` tinyint(4) NOT NULL DEFAULT '0',
                                        `is_lc` tinyint(4) NOT NULL DEFAULT '0',
                                        `is_ec` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_area`
--

INSERT INTO `caracterizacion_area` (`id_caracterizacion_area`, `descripcion_area`, `estado`, `created_at`, `is_dba`, `is_lc`, `is_ec`) VALUES
                                                                                                                                           (1, 'Matemáticas', 1, '2022-05-24 11:12:04', 1, 1, 1),
                                                                                                                                           (2, 'Ciencias Naturales', 1, '2022-06-04 11:40:49', 1, 1, 1),
                                                                                                                                           (3, 'Ciencias Sociales', 1, '2022-06-04 11:43:51', 1, 1, 1),
                                                                                                                                           (4, 'Lenguaje', 1, '2022-06-04 11:43:51', 1, 1, 1),
                                                                                                                                           (5, 'Transición', 1, '2022-06-04 11:43:51', 1, 0, 0),
                                                                                                                                           (6, 'Competencias Ciudadanas', 1, '2022-06-04 11:43:51', 0, 0, 1),
                                                                                                                                           (7, 'Tecnología e Informática', 1, '2022-06-04 11:43:51', 0, 0, 1),
                                                                                                                                           (8, 'Inglés', 1, '2022-06-04 11:43:51', 0, 1, 1),
                                                                                                                                           (9, 'Constitución Política y Democracia', 1, '2022-06-04 11:46:39', 0, 1, 0),
                                                                                                                                           (10, 'Cátedra de Estudios Afrocolombianos', 1, '2022-06-04 11:46:39', 0, 1, 0),
                                                                                                                                           (11, 'Educación Artística', 1, '2022-06-04 11:46:39', 0, 1, 0),
                                                                                                                                           (12, 'Educación Física Recreación y Deporte', 1, '2022-06-04 11:46:39', 0, 1, 0),
                                                                                                                                           (13, 'Educación Ética y Valores Humanos', 1, '2022-06-04 11:46:39', 0, 1, 0),
                                                                                                                                           (14, 'Preescolar', 1, '2022-06-04 11:46:39', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion_dba`
--

CREATE TABLE `caracterizacion_dba` (
                                       `id_dba` int(11) NOT NULL,
                                       `id_area` int(11) NOT NULL,
                                       `grado` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                       `descripcion_dba` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                       `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                       `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_dba`
--

INSERT INTO `caracterizacion_dba` (`id_dba`, `id_area`, `grado`, `descripcion_dba`, `created_at`, `estado`) VALUES
                                                                                                                (5, 1, '1', 'Identifica los usos de los números (como código, cardinal, medida, ordinal) y las operaciones (suma y resta) en contextos de juego, familiares, económicos, entre otros.', '2022-05-24 11:21:00', 0),
                                                                                                                (6, 1, '10', 'gfrgr ghth fhf hfh fh', '2022-05-26 17:54:27', 0),
                                                                                                                (7, 2, 'a:1:{i:0;s:1:\"1\";}', 'Comprende que los sentidos le permiten percibir algunas características de los objetos que nos rodean (temperatura, sabor, sonidos, olor, color, texturas y formas).', '2022-06-06 16:49:17', 1),
                                                                                                                (8, 2, 'a:1:{i:0;s:1:\"1\";}', 'Comprende que existe una gran variedad de materiales y que éstos se utilizan para distintos fines, según sus características (longitud, dureza, flexibilidad, permeabilidad al agua, solubilidad, ductilidad, maleabilidad, color, sabor, textura).', '2022-06-06 16:49:52', 1),
                                                                                                                (9, 2, 'a:1:{i:0;s:1:\"1\";}', 'Comprende que los seres vivos (plantas y animales) tienen características comunes (se alimentan, respiran, tienen un ciclo de vida, responden al entorno) y los diferencia de los objetos inertes.', '2022-06-06 16:50:27', 1),
                                                                                                                (10, 2, 'a:1:{i:0;s:1:\"1\";}', 'Comprende que su cuerpo experimenta constantes cambios a lo largo del tiempo y reconoce a partir de su comparación que tiene características similares y diferentes a\r\nlas de sus padres y compañeros.', '2022-06-06 16:51:04', 1),
                                                                                                                (11, 2, 'a:1:{i:0;s:1:\"2\";}', 'Comprende que una acción mecánica (fuerza) puede producir distintas deformaciones en un objeto, y que este resiste a las fuerzas de diferente modo, de acuerdo con el material del que está hecho.', '2022-06-06 16:51:39', 1),
                                                                                                                (12, 2, 'a:1:{i:0;s:1:\"2\";}', 'Comprende que las sustancias pueden encontrarse en distintos estados (sólido, líquido y gaseoso).', '2022-06-06 16:51:58', 1),
                                                                                                                (13, 2, 'a:1:{i:0;s:1:\"2\";}', 'Comprende la relación entre las características físicas de plantas y animales con los ambientes en donde viven, teniendo en cuenta sus necesidades básicas (luz, agua, aire, suelo, nutrientes, desplazamiento y protección).', '2022-06-06 16:52:25', 1),
                                                                                                                (14, 2, 'a:1:{i:0;s:1:\"2\";}', 'Explica los procesos de cambios físicos que ocurren en el ciclo de vida de plantas y animales de su entorno, en un período de tiempo determinado.', '2022-06-06 16:52:48', 1),
                                                                                                                (15, 2, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la forma en que se propaga la luz a través de diferentes materiales (opacos, transparentes como el aire, translúcidos como el papel y reflectivos como el espejo).', '2022-06-06 16:53:22', 1),
                                                                                                                (16, 2, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la forma en que se produce la sombra y la relación de su tamaño con las distancias entre la fuente de luz, el objeto interpuesto y el lugar donde se produce la\r\nsombra.', '2022-06-06 16:54:01', 1),
                                                                                                                (17, 2, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la naturaleza (fenómeno de la vibración) y las características del sonido (altura, timbre, intensidad) y que este se propaga en distintos medios (sólidos, líquidos, gaseosos).', '2022-06-06 16:54:37', 1),
                                                                                                                (18, 2, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la influencia de la variación de la temperatura en los cambios de estado de la materia, considerando como ejemplo el caso del agua.', '2022-06-06 16:55:11', 1),
                                                                                                                (19, 2, 'a:1:{i:0;s:1:\"3\";}', 'Explica la influencia de los factores abióticos (luz, temperatura, suelo y aire) en el desarrollo de los factores bióticos (fauna y flora) de un ecosistema.', '2022-06-06 16:58:22', 1),
                                                                                                                (20, 2, 'a:1:{i:0;s:1:\"3\";}', 'Comprende las relaciones de los seres vivos con otros organismos de su entorno (intra e interespecíficas) y las explica como esenciales para su supervivencia en un ambiente determinado.', '2022-06-06 16:58:54', 1),
                                                                                                                (21, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que la magnitud y la dirección en que se aplica una fuerza puede producir cambios en la forma como se mueve un objeto (dirección y rapidez).', '2022-06-06 16:59:32', 1),
                                                                                                                (22, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende los efectos y las ventajas de utilizar máquinas simples en diferentes tareas que requieren la aplicación de una fuerza.', '2022-06-06 16:59:54', 1),
                                                                                                                (23, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que el fenómeno del día y la noche se debe a que la Tierra rota sobre su eje y en consecuencia el sol sólo ilumina la mitad de su superficie.', '2022-06-06 17:00:22', 1),
                                                                                                                (24, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que las fases de la Luna se deben a la posición relativa del Sol, la Luna y la Tierra a lo largo del mes.', '2022-06-06 17:00:44', 1),
                                                                                                                (25, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que existen distintos tipos de mezclas (homogéneas y heterogéneas) que de acuerdo con los materiales que las componen pueden separarse mediante\r\ndiferentes técnicas (filtración, tamizado, decantación, evaporación).', '2022-06-06 17:01:16', 1),
                                                                                                                (26, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que los organismos cumplen distintas funciones en cada uno de los niveles tróficos y que las relaciones entre ellos pueden representarse en cadenas y redes alimenticias.', '2022-06-06 17:01:44', 1),
                                                                                                                (27, 2, 'a:1:{i:0;s:1:\"4\";}', 'Comprende que existen distintos tipos de ecosistemas (terrestres y acuáticos) y que sus características físicas (temperatura, humedad, tipos de suelo, altitud) permiten que habiten en ellos diferentes seres vivos.', '2022-06-06 17:02:15', 1),
                                                                                                                (28, 2, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que un circuito eléctrico básico está formado por un generador o fuente (pila), conductores (cables) y uno o más dispositivos (bombillos, motores, timbres), que deben estar conectados apropiadamente (por sus dos polos) para que funcionen y ', '2022-06-06 17:02:49', 1),
                                                                                                                (29, 2, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que algunos materiales son buenos conductores de la corriente eléctrica y otros no (denominados aislantes) y que el paso de la corriente siempre genera calor.', '2022-06-06 17:03:10', 1),
                                                                                                                (30, 2, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que los sistemas del cuerpo humano están formados por órganos, tejidos y células y que la estructura de cada tipo de célula está relacionada con la función del tejido que forman.', '2022-06-06 17:03:54', 1),
                                                                                                                (31, 2, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que en los seres humanos (y en muchos otros animales) la nutrición involucra el funcionamiento integrado de un conjunto de sistemas de órganos: digestivo, respiratorio y circulatorio.', '2022-06-06 17:04:17', 1),
                                                                                                                (32, 2, 'a:1:{i:0;s:1:\"6\";}', 'Comprende cómo los cuerpos pueden ser cargados eléctricamente asociando esta carga a efectos de atracción y repulsión.', '2022-06-07 14:00:56', 1),
                                                                                                                (33, 2, 'a:1:{i:0;s:1:\"6\";}', 'Comprende que la temperatura (T) y la presión (P) influyen en algunas propiedades fisicoquímicas (solubilidad, viscosidad, densidad, puntos de ebullición y fusión)\r\nde las sustancias, y que estas pueden ser aprovechadas en las técnicas de separación ', '2022-06-07 14:01:23', 1),
                                                                                                                (34, 2, 'a:1:{i:0;s:1:\"6\";}', 'Comprende que la temperatura (T) y la presión (P) influyen en algunas propiedades fisicoquímicas (solubilidad, viscosidad, densidad, puntos de ebullición y fusión) de las sustancias, y que estas pueden ser aprovechadas en las técnicas de separación d', '2022-06-07 14:02:00', 1),
                                                                                                                (35, 2, 'a:1:{i:0;s:1:\"6\";}', 'Comprende algunas de las funciones básicas de la célula (transporte de membrana, obtención de energía y división celular) a partir del análisis de su estructura.', '2022-06-07 14:02:22', 1),
                                                                                                                (36, 2, 'a:1:{i:0;s:1:\"6\";}', 'Comprende la clasificación de los organismos en grupos taxonómicos, de acuerdo con el tipo de células que poseen y reconoce la diversidad de especies que constituyen nuestro planeta y las relaciones de parentesco entre ellas.', '2022-06-07 14:03:01', 1),
                                                                                                                (37, 2, 'a:1:{i:0;s:1:\"7\";}', 'Comprende las formas y las transformaciones de energía en un sistema mecánico y la manera como, en los casos reales, la energía se disipa en el medio (calor, sonido).', '2022-06-07 14:03:24', 1),
                                                                                                                (38, 2, 'a:1:{i:0;s:1:\"7\";}', 'Explica cómo las sustancias se forman a partir de la interacción de los elementos y que estos se encuentran agrupados en un sistema periódico.', '2022-06-07 14:03:46', 1),
                                                                                                                (39, 2, 'a:1:{i:0;s:1:\"7\";}', 'Comprende que en las cadenas y redes tróficas existen flujos de materia y energía, y los relaciona con procesos de nutrición, fotosíntesis y respiración celular.', '2022-06-07 14:04:14', 1),
                                                                                                                (40, 2, 'a:1:{i:0;s:1:\"7\";}', 'Comprende la relación entre los ciclos del carbono, el nitrógeno y del agua, explicando su importancia en el mantenimiento de los ecosistemas.', '2022-06-07 14:04:36', 1),
                                                                                                                (41, 2, 'a:1:{i:0;s:1:\"8\";}', 'Comprende el funcionamiento de máquinas térmicas (motores de combustión, refrigeración) por medio de las leyes de la termodinámica (primera y segunda ley).', '2022-06-07 14:05:08', 1),
                                                                                                                (42, 2, 'a:1:{i:0;s:1:\"8\";}', 'Comprende que en una reacción química se recombinan los átomos de las moléculas de los reactivos para generar productos nuevos, y que dichos productos se forman a partir de fuerzas intramoleculares (enlaces iónicos y covalentes).', '2022-06-07 14:05:37', 1),
                                                                                                                (43, 2, 'a:1:{i:0;s:1:\"8\";}', 'Comprende que el comportamiento de un gas ideal está determinado por las relaciones entre Temperatura (T), Presión (P), Volumen (V) y Cantidad de sustancia (n).', '2022-06-07 14:06:04', 1),
                                                                                                                (44, 2, 'a:1:{i:0;s:1:\"8\";}', 'Analiza relaciones entre sistemas de órganos (excretor, inmune, nervioso, endocrino, óseo y muscular) con los procesos de regulación de las funciones en los seres vivos.', '2022-06-07 14:06:32', 1),
                                                                                                                (45, 2, 'a:1:{i:0;s:1:\"8\";}', 'Analiza la reproducción (asexual, sexual) de distintos grupos de seres vivos y su importancia para la preservación de la vida en el planeta.', '2022-06-07 14:06:54', 1),
                                                                                                                (46, 2, 'a:1:{i:0;s:1:\"9\";}', 'Comprende que el movimiento de un cuerpo, en un marco de referencia inercial dado, se puede describir con gráficos y predecir por medio de expresiones matemáticas.', '2022-06-07 14:07:16', 1),
                                                                                                                (47, 2, 'a:1:{i:0;s:1:\"9\";}', 'Comprende que la acidez y la basicidad son propiedades químicas de algunas sustancias y las relaciona con su importancia biológica y su uso cotidiano e industrial.', '2022-06-07 14:07:42', 1),
                                                                                                                (48, 2, 'a:1:{i:0;s:1:\"9\";}', 'Analiza las relaciones cuantitativas entre solutos y solventes, así como los factores que afectan la formación de soluciones.', '2022-06-07 14:08:06', 1),
                                                                                                                (49, 2, 'a:1:{i:0;s:1:\"9\";}', 'Comprende la forma en que los principios genéticos mendelianos y post-mendelianos explican la herencia y el mejoramiento de las especies existentes.', '2022-06-07 14:08:25', 1),
                                                                                                                (50, 2, 'a:1:{i:0;s:1:\"9\";}', 'Explica la forma como se expresa la información genética contenida en el –ADN–, relacionando su expresión con los fenotipos de los organismos y reconoce su capacidad de modificación a lo largo del tiempo (por mutaciones y otros cambios), como un fact', '2022-06-07 14:09:00', 1),
                                                                                                                (51, 2, 'a:1:{i:0;s:1:\"9\";}', 'Analiza teorías científicas sobre el origen de las especies (selección natural y ancestro común) como modelos científicos que sustentan sus explicaciones desde diferentes evidencias y argumentaciones.', '2022-06-07 14:09:25', 1),
                                                                                                                (52, 2, 'a:1:{i:0;s:2:\"10\";}', 'Comprende, que el reposo o el movimiento rectilíneo uniforme, se presentan cuando las fuerzas aplicadas sobre el sistema se anulan entre ellas, y que en presencia de fuerzas resultantes no nulas se producen cambios de velocidad.', '2022-06-07 14:10:07', 1),
                                                                                                                (53, 2, 'a:1:{i:0;s:2:\"10\";}', 'Comprende la conservación de la energía mecánica como un principio que permite cuantificar y explicar diferentes fenómenos mecánicos: choques entre cuerpos,  movimiento pendular, caída libre, deformación de un sistema masa-resorte.', '2022-06-07 14:10:43', 1),
                                                                                                                (54, 2, 'a:1:{i:0;s:2:\"10\";}', 'Comprende que los diferentes mecanismos de reacción química (oxido-reducción, descomposición, neutralización y precipitación) posibilitan la formación de compuestos inorgánicos.', '2022-06-07 14:11:24', 1),
                                                                                                                (55, 2, 'a:1:{i:0;s:2:\"10\";}', 'Comprende que la biotecnología conlleva el uso y manipulación de la información genética a través de distintas técnicas (fertilización asistida, clonación reproductiva y terapéutica, modificación genética, terapias génicas), y que tiene implicaciones', '2022-06-07 14:11:52', 1),
                                                                                                                (56, 2, 'a:1:{i:0;s:2:\"11\";}', 'Comprende la naturaleza de la propagación del sonido y de la luz como fenómenos ondulatorios (ondas mecánicas y electromagnéticas, respectivamente).', '2022-06-07 14:12:18', 1),
                                                                                                                (57, 2, 'a:1:{i:0;s:2:\"11\";}', 'Comprende que la interacción de las cargas en reposo genera fuerzas eléctricas y que cuando las cargas están en movimiento genera fuerzas magnéticas.', '2022-06-07 14:12:40', 1),
                                                                                                                (58, 2, 'a:1:{i:0;s:2:\"11\";}', 'Comprende las relaciones entre corriente y voltaje en circuitos resistivos sencillos en serie, en paralelo y mixtos.', '2022-06-07 14:13:00', 1),
                                                                                                                (59, 2, 'a:1:{i:0;s:2:\"11\";}', 'Comprende que los diferentes mecanismos de reacción química (oxido-reducción, homólisis, heterólisis y pericíclicas) posibilitan la formación de distintos tipos de compuestos orgánicos.', '2022-06-07 14:13:29', 1),
                                                                                                                (60, 2, 'a:1:{i:0;s:2:\"11\";}', 'Analiza cuestiones ambientales actuales, como el calentamiento global, contaminación, tala de bosques y minería, desde una visión sistémica (económico, social, ambiental y cultural).', '2022-06-07 14:13:56', 1),
                                                                                                                (61, 3, 'a:1:{i:0;s:1:\"1\";}', 'Se ubica en el espacio que habita teniendo como referencia su propio cuerpo y los puntos cardinales.', '2022-06-07 14:17:56', 1),
                                                                                                                (62, 3, 'a:1:{i:0;s:1:\"1\";}', 'Describe las características del paisaje geográfico del barrio, vereda o lugar donde vive, sus componentes y formas.', '2022-06-07 14:18:48', 1),
                                                                                                                (63, 3, 'a:1:{i:0;s:1:\"1\";}', 'Describe el tiempo personal y se sitúa en secuencias de eventos propios y sociales.', '2022-06-07 14:19:10', 1),
                                                                                                                (64, 3, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce la noción de cambio a partir de las transformaciones que ha vivido en los últimos años a nivel personal, de su familia y del entorno barrial, veredal o del lugar donde vive.', '2022-06-07 14:19:37', 1),
                                                                                                                (65, 3, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce su individualidad y su pertenencia a los diferentes grupos sociales.', '2022-06-07 14:20:17', 1),
                                                                                                                (66, 3, 'a:1:{i:0;s:1:\"1\";}', ' Comprende cambios en las formas de habitar de los grupos humanos, desde el reconocimiento de los tipos de vivienda que se encuentran en el contexto de su barrio,\r\nvereda o lugar donde vive.', '2022-06-07 14:20:49', 1),
                                                                                                                (67, 3, 'a:1:{i:0;s:1:\"1\";}', 'Participa en la construcción de acuerdos básicos sobre normas para el logro de metas comunes en su contexto cercano (compañeros y familia) y se compromete con\r\nsu cumplimiento.', '2022-06-07 14:21:16', 1),
                                                                                                                (68, 3, 'a:1:{i:0;s:1:\"1\";}', 'Establece relaciones de convivencia desde el reconocimiento y el respeto de sí mismo y de los demás.', '2022-06-07 14:21:43', 1),
                                                                                                                (69, 3, 'a:1:{i:0;s:1:\"2\";}', 'Comprende que el paisaje que vemos es resultado de las acciones humanas que se realizan en un espacio geográfico y que por esta razón, dicho paisaje cambia.', '2022-06-07 14:22:12', 1),
                                                                                                                (70, 3, 'a:1:{i:0;s:1:\"2\";}', 'Reconoce los puntos cardinales y los usa para orientarse en el desplazamiento de un lugar a otro.', '2022-06-07 14:22:58', 1),
                                                                                                                (71, 3, 'a:1:{i:0;s:1:\"2\";}', 'Comprende la importancia de las fuentes históricas para la construcción de la memoria individual, familiar y colectiva.', '2022-06-07 14:23:22', 1),
                                                                                                                (72, 3, 'a:1:{i:0;s:1:\"2\";}', 'Explica cambios y continuidades en los medios empleados por las personas para transportarse en su municipio, vereda o lugar donde vive.', '2022-06-07 14:23:53', 1),
                                                                                                                (73, 3, 'a:1:{i:0;s:1:\"2\";}', 'Analiza las actividades económicas de su entorno y el impacto de estas en la comunidad.', '2022-06-07 14:24:15', 1),
                                                                                                                (74, 3, 'a:1:{i:0;s:1:\"2\";}', 'Compara las características de las viviendas de su municipio, vereda o lugar donde vive con las de otros lugares.', '2022-06-07 14:24:37', 1),
                                                                                                                (75, 3, 'a:1:{i:0;s:1:\"2\";}', 'Reconoce la organización territorial en su municipio, desde: comunas, corregimientos, veredas, localidades y territorios indígenas.', '2022-06-07 14:25:05', 1),
                                                                                                                (76, 3, 'a:1:{i:0;s:1:\"2\";}', 'Reconoce y rechaza situaciones de exclusión o discriminación en su familia, entre sus amigos y en los compañeros del salón de clase.', '2022-06-07 14:25:29', 1),
                                                                                                                (77, 3, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la importancia de los océanos y mares en la organización económica y social de los pueblos costeros en la actualidad.', '2022-06-07 14:26:32', 1),
                                                                                                                (78, 3, 'a:1:{i:0;s:1:\"3\";}', ' Relaciona las características biogeográficas de su departamento, municipio, resguardo o lugar donde vive, con las actividades económicas que en ellos se realizan.', '2022-06-07 14:27:12', 1),
                                                                                                                (79, 3, 'a:1:{i:0;s:1:\"3\";}', 'Explica las acciones humanas que han incidido en las transformaciones del territorio asociadas al número de habitantes e infraestructura, en su departamento, municipio, resguardo o lugar donde vive.', '2022-06-07 14:28:18', 1),
                                                                                                                (80, 3, 'a:1:{i:0;s:1:\"3\";}', 'Comprende el legado de los grupos humanos en la gastronomía, la música y el paisaje de la región, municipio, resguardo o lugar donde vive.', '2022-06-07 14:28:48', 1),
                                                                                                                (81, 3, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la importancia del tiempo en la organización de las actividades sociales, económicas y culturales en su comunidad.', '2022-06-07 14:29:09', 1),
                                                                                                                (82, 3, 'a:1:{i:0;s:1:\"3\";}', 'Analiza las contribuciones de los grupos humanos que habitan en su departamento, municipio o lugar donde vive, a partir de sus características culturales: lengua, organización social, tipo de vivienda, cosmovisión y uso del suelo.', '2022-06-07 14:29:42', 1),
                                                                                                                (83, 3, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la importancia de participar en las decisiones de su comunidad cercana (institución educativa) mediante la elección del gobierno escolar.', '2022-06-07 14:30:08', 1),
                                                                                                                (84, 3, 'a:1:{i:0;s:1:\"3\";}', 'Comprende la estructura y el funcionamiento democrático a nivel del departamento como entidad política, administrativa y jurídica.', '2022-06-07 14:30:47', 1),
                                                                                                                (85, 3, 'a:1:{i:0;s:1:\"4\";}', 'Comprende la importancia de los límites geográficos y el establecimiento de las fronteras en la organización de los territorios.', '2022-06-07 14:31:56', 1),
                                                                                                                (86, 3, 'a:1:{i:0;s:1:\"4\";}', 'Diferencia las características geográficas del medio urbano y el medio rural, mediante el reconocimiento de la concentración de la población y el uso del suelo, que se da en ellos.', '2022-06-07 14:32:27', 1),
                                                                                                                (87, 3, 'a:1:{i:0;s:1:\"4\";}', 'Comprende las razones de algunos cambios socioculturales en Colombia, motivados en los últimos años por el uso de la tecnología.', '2022-06-07 14:32:44', 1),
                                                                                                                (88, 3, 'a:1:{i:0;s:1:\"4\";}', 'Analiza las características de las culturas ancestrales que a la llegada de los españoles, habitaban el territorio nacional.', '2022-06-07 14:33:15', 1),
                                                                                                                (89, 3, 'a:1:{i:0;s:1:\"4\";}', 'Evalúa la diversidad étnica y cultural del pueblo colombiano desde el reconocimiento de los grupos humanos existentes en el país: afrodescendientes, raizales, mestizos, indígenas y blancos.', '2022-06-07 14:33:52', 1),
                                                                                                                (90, 3, 'a:1:{i:0;s:1:\"4\";}', 'Comprende la importancia de la división de poderes en una democracia y la forma como funciona en Colombia.', '2022-06-07 14:34:11', 1),
                                                                                                                (91, 3, 'a:1:{i:0;s:1:\"4\";}', 'Analiza los derechos que protegen la niñez y los deberes que deben cumplirse en una sociedad democrática para el desarrollo de una sana convivencia.', '2022-06-07 14:34:44', 1),
                                                                                                                (92, 3, 'a:1:{i:0;s:1:\"4\";}', 'Evalúa la importancia de satisfacer las necesidades básicas para el bienestar individual, familiar y colectivo.', '2022-06-07 14:35:11', 1),
                                                                                                                (93, 3, 'a:1:{i:0;s:1:\"5\";}', 'Comprende la organización territorial existente en Colombia y las particularidades geográficas de las regiones.', '2022-06-07 14:35:31', 1),
                                                                                                                (94, 3, 'a:1:{i:0;s:1:\"5\";}', 'Comprende las ventajas que tiene para Colombia su posición geográfica y astronómica en relación con la economía nacional.', '2022-06-07 14:36:03', 1),
                                                                                                                (95, 3, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que los cambios en la comunicación originados por los avances tecnológicos han generado transformaciones en la forma como se relacionan las personas\r\nen la sociedad actual.', '2022-06-07 14:36:30', 1),
                                                                                                                (96, 3, 'a:1:{i:0;s:1:\"5\";}', 'Analiza el periodo colonial en la Nueva Granada a partir de sus organizaciones políticas, económicas y sociales.', '2022-06-07 14:36:57', 1),
                                                                                                                (97, 3, 'a:1:{i:0;s:1:\"5\";}', 'Analiza el origen y consolidación de Colombia como república y sus cambios políticos, económicos y sociales.', '2022-06-07 14:37:19', 1),
                                                                                                                (98, 3, 'a:1:{i:0;s:1:\"5\";}', 'Analiza los cambios ocurridos en la sociedad colombiana en la primera mitad del siglo XX, asociados a la expansión de la industria y el establecimiento de nuevas redes de comunicación.', '2022-06-07 14:37:47', 1),
                                                                                                                (99, 3, 'a:1:{i:0;s:1:\"5\";}', 'Comprende que en la sociedad colombiana existen derechos, deberes, principios y acciones para orientar y regular la convivencia de las personas.', '2022-06-07 14:38:10', 1),
                                                                                                                (100, 3, 'a:1:{i:0;s:1:\"5\";}', 'Analiza el papel de las organizaciones sociales en la preservación y el reconocimiento de los Derechos Humanos.', '2022-06-07 14:38:32', 1),
                                                                                                                (101, 3, 'a:1:{i:0;s:1:\"6\";}', 'Comprende que existen diversas explicaciones y teorías sobre el origen del universo en nuestra búsqueda por entender que hacemos parte de un mundo más amplio.', '2022-06-07 14:40:24', 1),
                                                                                                                (102, 3, 'a:1:{i:0;s:1:\"6\";}', 'Comprende que la Tierra es un planeta en constante transformación cuyos cambios influyen en las formas del relieve terrestre y en la vida de las comunidades que la habitan.', '2022-06-07 14:41:21', 1),
                                                                                                                (103, 3, 'a:1:{i:0;s:1:\"6\";}', 'Analiza los aspectos centrales del proceso de hominización y del desarrollo tecnológico dados durante la prehistoria, para explicar las transformaciones del entorno.', '2022-06-07 14:42:20', 1),
                                                                                                                (104, 3, 'a:1:{i:0;s:1:\"6\";}', 'Analiza cómo en las sociedades antiguas surgieron las primeras ciudades y el papel de la agricultura y el comercio para la expansión de estas.', '2022-06-07 14:42:44', 1),
                                                                                                                (105, 3, 'a:1:{i:0;s:1:\"6\";}', 'Analiza los legados que las sociedades americanas prehispánicas dejaron en diversos campos.', '2022-06-07 14:43:12', 1),
                                                                                                                (106, 3, 'a:1:{i:0;s:1:\"6\";}', 'Analiza las distintas formas de gobierno ejercidas en la antigüedad y las compara con el ejercicio del poder político en el mundo contemporáneo.', '2022-06-07 14:43:39', 1),
                                                                                                                (107, 3, 'a:1:{i:0;s:1:\"6\";}', 'Analiza cómo en el escenario político democrático entran en juego intereses desde diferentes sectores sociales, políticos y económicos, los cuales deben ser dirimidos\r\npor los ciudadanos.', '2022-06-07 14:44:11', 1),
                                                                                                                (108, 3, 'a:1:{i:0;s:1:\"6\";}', 'Comprende que en una sociedad democrática no es aceptable ninguna forma de discriminación por origen étnico, creencias religiosas, género, discapacidad y/o apariencia física.', '2022-06-07 14:44:38', 1),
                                                                                                                (109, 3, 'a:1:{i:0;s:1:\"7\";}', 'Comprende que las representaciones del mundo han cambiado a partir de las visiones de quienes las elaboran y de los avances de la tecnología.', '2022-06-07 14:45:53', 1),
                                                                                                                (110, 3, 'a:1:{i:0;s:1:\"7\";}', 'Interpreta las relaciones entre el crecimiento de la población, el desarrollo de los centros urbanos y las problemáticas sociales.', '2022-06-07 14:46:30', 1),
                                                                                                                (111, 3, 'a:1:{i:0;s:1:\"7\";}', 'Analiza la influencia del imperio romano en la cultura de occidente y los aportes en diversos campos como la literatura, las leyes, la ingeniería y la vida cotidiana.', '2022-06-07 14:46:58', 1),
                                                                                                                (112, 3, 'a:1:{i:0;s:1:\"7\";}', 'Analiza la Edad Media como un periodo histórico que dio origen a instituciones sociales, económicas y políticas en relación con el mismo período de las sociedades\r\nprecolombinas.', '2022-06-07 14:47:22', 1),
                                                                                                                (113, 3, 'a:1:{i:0;s:1:\"7\";}', 'Analiza el Renacimiento como una época que dio paso en Europa a una nueva configuración cultural en campos como las ciencias, la política, las artes y la literatura.', '2022-06-07 14:47:58', 1),
                                                                                                                (114, 3, 'a:1:{i:0;s:1:\"7\";}', 'Evalúa las causas y consecuencias de los procesos de Conquista y colonización europea dados en en América.', '2022-06-07 14:48:21', 1),
                                                                                                                (115, 3, 'a:1:{i:0;s:1:\"7\";}', 'Comprende la responsabilidad que tiene una sociedad democrática para evitar la violación de los derechos fundamentales de sus ciudadanos.', '2022-06-07 14:48:45', 1),
                                                                                                                (116, 3, 'a:1:{i:0;s:1:\"7\";}', 'Aplica procesos y técnicas de mediación de conflictos en pro del establecimiento de una cultura de la paz.', '2022-06-07 14:49:08', 1),
                                                                                                                (117, 3, 'a:1:{i:0;s:1:\"8\";}', 'Evalúa la influencia de los procesos de cooperación económica y política entre los Estados Nacionales en la actualidad.', '2022-06-07 14:49:26', 1),
                                                                                                                (118, 3, 'a:1:{i:0;s:1:\"8\";}', 'Comprende el fenómeno de las migraciones en distintas partes del mundo y cómo afectan a las dinámicas de los países receptores y a países de origen.', '2022-06-07 14:49:48', 1),
                                                                                                                (119, 3, 'a:1:{i:0;s:1:\"8\";}', 'Analiza los cambios sociales, económicos, políticos y culturales generados por el surgimiento y consolidación del capitalismo en Europa y las razones por las cuales este\r\nsigue siendo un sistema económico vigente.', '2022-06-07 14:50:12', 1),
                                                                                                                (120, 3, 'a:1:{i:0;s:1:\"8\";}', 'Analiza los procesos de expansión territorial desarrollados por Europa durante el siglo XIX y las nuevas manifestaciones imperialistas observadas en las sociedades\r\ncontemporáneas.', '2022-06-07 14:50:37', 1),
                                                                                                                (121, 3, 'a:1:{i:0;s:1:\"8\";}', 'Comprende cómo se produjeron los procesos de independencia de las colonias americanas durante los siglos XVIII y XIX y sus implicaciones para las sociedades contemporáneas.', '2022-06-07 14:50:59', 1),
                                                                                                                (122, 3, 'a:1:{i:0;s:1:\"8\";}', 'Evalúa el impacto producido por los avances tecnológicos en el desarrollo social y económico de Colombia en el siglo XIX.', '2022-06-07 14:51:47', 1),
                                                                                                                (123, 3, 'a:1:{i:0;s:1:\"8\";}', 'Evalúa hechos trascendentales para la dignidad humana (abolición de la esclavitud, reconocimiento de los derechos de las mujeres,derechos de las minorías) y describe\r\nlas discriminaciones que aún se presentan.', '2022-06-07 14:52:15', 1),
                                                                                                                (124, 3, 'a:1:{i:0;s:1:\"8\";}', 'Comprende la importancia de las asociaciones, los gremios, los movimientos y organizaciones sindicales en la defensa de los derechos colectivos.', '2022-06-07 14:52:49', 1),
                                                                                                                (125, 3, 'a:1:{i:0;s:1:\"9\";}', 'Analiza la situación ambiental de los geosistemas más biodiversos de Colombia (selvas, páramos, arrecifes coralinos) y las problemáticas que enfrentan actualmente\r\ndebido a la explotación a que han sido sometidos.', '2022-06-07 14:53:18', 1),
                                                                                                                (126, 3, 'a:1:{i:0;s:1:\"9\";}', 'Comprende las consecuencias que han traído los procesos migratorios en la organización social y económica de Colombia en el siglo XX y en la actualidad.', '2022-06-07 14:53:37', 1),
                                                                                                                (127, 3, 'a:1:{i:0;s:1:\"9\";}', 'Analiza las crisis económicas dadas en la Colombia contemporánea y sus repercusiones en la vida cotidiana de las personas.', '2022-06-07 14:53:58', 1),
                                                                                                                (128, 3, 'a:1:{i:0;s:1:\"9\";}', 'Analiza los cambios sociales, políticos, económicos y culturales en Colombia en el siglo XX y su impacto en la vida de los habitantes del país.', '2022-06-07 14:54:22', 1),
                                                                                                                (129, 3, 'a:1:{i:0;s:1:\"9\";}', 'Evalúa cómo las sociedades democráticas en un Estado social de Derecho tienen el deber de proteger y promover los derechos fundamentales de los ciudadanos.', '2022-06-07 14:54:52', 1),
                                                                                                                (130, 3, 'a:1:{i:0;s:1:\"9\";}', 'Comprende el papel de las mujeres en los cambios sociales, políticos, económicos y culturales en el mundo y la igualdad de derechos que han adquirido en los últimos\r\naños.', '2022-06-07 14:55:12', 1),
                                                                                                                (131, 3, 'a:1:{i:0;s:1:\"9\";}', 'Evalúa cómo todo conflicto puede solucionarse mediante acuerdos en que las personas ponen de su parte para superar las diferencias.', '2022-06-07 14:55:35', 1),
                                                                                                                (132, 3, 'a:1:{i:0;s:1:\"9\";}', 'Comprende el impacto social del crecimiento económico desigual que se da en las diferentes regiones del país.', '2022-06-07 14:55:54', 1),
                                                                                                                (133, 3, 'a:1:{i:0;s:2:\"10\";}', 'Analiza conflictos que se presentan en el territorio colombiano originados por la degradación ambiental, el escaso desarrollo económico y la inestabilidad política.', '2022-06-07 14:57:46', 1),
                                                                                                                (134, 3, 'a:1:{i:0;s:2:\"10\";}', 'Evalúa las causas y consecuencias de la violencia en la segunda mitad del siglo XX en Colombia y su incidencia en los ámbitos social, político, económico y cultural.', '2022-06-07 14:58:22', 1),
                                                                                                                (135, 3, 'a:1:{i:0;s:2:\"10\";}', 'Comprende que existen multitud de culturas y una sola humanidad en el mundo y que entre ellas se presenta la discriminación y exclusión de algunos grupos, lo cual dificulta el bienestar de todos.', '2022-06-07 14:58:48', 1),
                                                                                                                (136, 3, 'a:1:{i:0;s:2:\"10\";}', 'Interpreta el papel que cumplen los organismos internacionales como formas de alianza y organización entre los Estados y que responden a los intereses entre los países.', '2022-06-07 14:59:22', 1),
                                                                                                                (137, 3, 'a:1:{i:0;s:2:\"10\";}', 'Analiza los conflictos bélicos presentes en las sociedades contemporáneas, sus causas y consecuencias así como su incidencia en la vida cotidiana de los pueblos.', '2022-06-07 14:59:50', 1),
                                                                                                                (138, 3, 'a:1:{i:0;s:2:\"11\";}', 'Analiza cómo el bienestar y la supervivencia de la humanidad dependen de la protección que hagan del ambiente los diferentes actores (políticos, económicos y sociales).', '2022-06-07 15:00:19', 1),
                                                                                                                (139, 3, 'a:1:{i:0;s:2:\"11\";}', 'Evalúa la importancia de la solución negociada de los conflictos armados para la búsqueda de la paz.', '2022-06-07 15:00:43', 1),
                                                                                                                (140, 3, 'a:1:{i:0;s:2:\"11\";}', 'Analiza las consecuencias políticas, económicas y sociales de algunos conflictos geopolíticos desde finales del siglo XX hasta la actualidad a nivel mundial.', '2022-06-07 15:01:04', 1),
                                                                                                                (141, 3, 'a:1:{i:0;s:2:\"11\";}', 'Comprende las implicaciones sociales, económicas y políticas que tuvo la Guerra Fría en el mundo y las relaciona con las vividas en América Latina.', '2022-06-07 15:01:28', 1),
                                                                                                                (142, 3, 'a:1:{i:0;s:2:\"11\";}', 'Analiza la globalización como un proceso que redefine el concepto de territorio, las dinámicas de los mercados, las gobernanzas nacionales y las identidades locales.', '2022-06-07 15:01:54', 1),
                                                                                                                (143, 4, 'a:1:{i:0;s:1:\"1\";}', 'Identifica los diferentes medios de comunicación como una posibilidad para informarse, participar y acceder al universo cultural que lo rodea.', '2022-06-08 06:02:24', 1),
                                                                                                                (144, 4, 'a:1:{i:0;s:1:\"1\";}', 'Relaciona códigos no verbales, como los movimientos corporales y los gestos de las manos o del rostro, con el significado que pueden tomar de acuerdo con el contexto.', '2022-06-08 06:02:50', 1),
                                                                                                                (145, 4, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce en los textos literarios la posibilidad de desarrollar su capacidad creativa y lúdica.', '2022-06-08 06:03:12', 1),
                                                                                                                (146, 4, 'a:1:{i:0;s:1:\"1\";}', 'Interpreta textos literarios como parte de su iniciación en la comprensión de textos.', '2022-06-08 06:17:22', 1),
                                                                                                                (147, 4, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce las temáticas presentes en los mensajes que escucha, a partir de la diferenciación de los sonidos que componen las palabras.', '2022-06-08 06:17:51', 1),
                                                                                                                (148, 4, 'a:1:{i:0;s:1:\"1\";}', 'Interpreta diversos textos a partir de la lectura de palabras sencillas y de las imágenes que contienen.', '2022-06-08 06:18:23', 1),
                                                                                                                (149, 4, 'a:1:{i:0;s:1:\"1\";}', 'Enuncia textos orales de diferente índole sobre temas de su interés o sugeridos por otros.', '2022-06-08 06:18:49', 1),
                                                                                                                (150, 4, 'a:1:{i:0;s:1:\"1\";}', 'Escribe palabras que le permiten comunicar sus ideas, preferencias y aprendizajes.', '2022-06-08 06:19:11', 1),
                                                                                                                (151, 4, 'a:1:{i:0;s:1:\"2\";}', 'Identifica las características de los medios de comunicación masiva a los que tiene acceso.', '2022-06-08 06:21:28', 1),
                                                                                                                (152, 4, 'a:1:{i:0;s:1:\"2\";}', 'Identifica la función que cumplen las señales y símbolos que aparecen en su entorno.', '2022-06-08 06:21:44', 1),
                                                                                                                (153, 4, 'a:1:{i:0;s:1:\"2\";}', 'Identifica algunos elementos constitutivos de textos literarios como personajes, espacios y acciones.', '2022-06-08 06:22:05', 1),
                                                                                                                (154, 4, 'a:1:{i:0;s:1:\"2\";}', 'Comprende diversos textos literarios a partir de sus propias vivencias.', '2022-06-08 06:22:31', 1),
                                                                                                                (155, 4, 'a:1:{i:0;s:1:\"2\";}', 'Identifica las palabras relevantes de un mensaje y las agrupa en unidades significativas: sonidos en palabras y palabras en oraciones.', '2022-06-08 06:22:55', 1),
                                                                                                                (156, 4, 'a:1:{i:0;s:1:\"2\";}', 'Predice y analiza los contenidos y estructuras de diversos tipos de texto, a partir de sus conocimientos previos.', '2022-06-08 06:23:14', 1),
                                                                                                                (157, 4, 'a:1:{i:0;s:1:\"2\";}', 'Expresa sus ideas atendiendo a las características del contexto comunicativo en que las enuncia (interlocutores, temas, lugares).', '2022-06-08 06:23:50', 1),
                                                                                                                (158, 4, 'a:1:{i:0;s:1:\"2\";}', 'Produce diferentes tipos de textos para atender a un propósito comunicativo particular.', '2022-06-08 06:24:10', 1),
                                                                                                                (159, 4, 'a:1:{i:0;s:1:\"3\";}', 'Comprende las funciones que cumplen los medios de comunicación propios de su contexto.', '2022-06-08 06:24:43', 1),
                                                                                                                (160, 4, 'a:1:{i:0;s:1:\"3\";}', 'Comprende que algunos escritos y manifestaciones artísticas pueden estar compuestos por texto, sonido e imágenes.', '2022-06-08 06:25:01', 1),
                                                                                                                (161, 4, 'a:1:{i:0;s:1:\"3\";}', 'Reconoce algunas características de los textos narrativos, tales como el concepto de narrador y estructura narrativa, a partir de la recreación y disfrute de los mismos.', '2022-06-08 06:25:28', 1),
                                                                                                                (162, 4, 'a:1:{i:0;s:1:\"3\";}', 'Escribe textos literarios coherentes, atendiendo a las características textuales e integrando sus saberes e intereses.', '2022-06-08 06:25:48', 1),
                                                                                                                (163, 4, 'a:1:{i:0;s:1:\"3\";}', 'Identifica el papel del emisor y el receptor y sus propósitos comunicativos en una situación específica.', '2022-06-08 06:26:11', 1),
                                                                                                                (164, 4, 'a:1:{i:0;s:1:\"3\";}', 'Interpreta el contenido y la estructura del texto, respondiendo preguntas de orden inferencial y crítico.', '2022-06-08 06:26:32', 1),
                                                                                                                (165, 4, 'a:1:{i:0;s:1:\"3\";}', 'Produce textos orales breves de diferente tipo ajustando el volumen, el tono de la voz, los movimientos corporales y los gestos, al tema y a la situación comunicativa.', '2022-06-08 06:26:59', 1),
                                                                                                                (166, 4, 'a:1:{i:0;s:1:\"3\";}', 'Produce textos verbales y no verbales en los que tiene en cuenta aspectos gramaticales y ortográficos.', '2022-06-08 06:27:19', 1),
                                                                                                                (167, 4, 'a:1:{i:0;s:1:\"4\";}', 'Analiza la información presentada por los diferentes medios de comunicación con los cuales interactúa.', '2022-06-08 06:27:50', 1),
                                                                                                                (168, 4, 'a:1:{i:0;s:1:\"4\";}', 'Escribe textos a partir de información dispuesta en imágenes, fotografías, manifestaciones artísticas o conversaciones cotidianas.', '2022-06-08 06:44:08', 1),
                                                                                                                (169, 4, 'a:1:{i:0;s:1:\"4\";}', 'Crea textos literarios en los que articula lecturas previas e impresiones sobre un tema o situación.', '2022-06-08 06:57:59', 1),
                                                                                                                (170, 4, 'a:1:{i:0;s:1:\"4\";}', 'Construye textos poéticos, empleando algunas figuras literarias.', '2022-06-08 06:58:22', 1),
                                                                                                                (171, 4, 'a:1:{i:0;s:1:\"4\";}', 'Interpreta el tono del discurso de su interlocutor, a partir de las características de la voz, del ritmo, de las pausas y de la entonación.', '2022-06-08 06:58:57', 1),
                                                                                                                (172, 4, 'a:1:{i:0;s:1:\"4\";}', 'Organiza la información que encuentra en los textos que lee, utilizando técnicas para el procesamiento de la información que le facilitan el proceso de compresión e\r\ninterpretación textual.', '2022-06-08 06:59:27', 1),
                                                                                                                (173, 4, 'a:1:{i:0;s:1:\"4\";}', 'Participa en espacios de discusión en los que adapta sus emisiones a los requerimientos de la situación comunicativa.', '2022-06-08 06:59:56', 1),
                                                                                                                (174, 4, 'a:1:{i:0;s:1:\"4\";}', 'Produce textos atiendo a elementos como el tipo de público al que va dirigido, el contexto de circulación, sus saberes previos y la diversidad de formatos de la que dispone para su presentación.', '2022-06-08 07:00:22', 1),
                                                                                                                (175, 4, 'a:1:{i:0;s:1:\"5\";}', 'Utiliza la información que recibe de los medios de comunicación para participar en espacios discursivos de opinión.', '2022-06-08 07:00:44', 1),
                                                                                                                (176, 4, 'a:1:{i:0;s:1:\"5\";}', 'Interpreta mensajes directos e indirectos en algunas imágenes, símbolos o gestos.', '2022-06-08 07:01:06', 1),
                                                                                                                (177, 4, 'a:1:{i:0;s:1:\"5\";}', 'Comprende los roles que asumen los personajes en las obras literarias y su relación con la temática y la época en las que estas se desarrollan.', '2022-06-08 07:01:56', 1),
                                                                                                                (178, 4, 'a:1:{i:0;s:1:\"5\";}', 'Reconoce en la lectura de los distintos géneros literarios diferentes posibilidades de recrear y ampliar su visión de mundo.', '2022-06-08 07:03:06', 1),
                                                                                                                (179, 4, 'a:1:{i:0;s:1:\"5\";}', 'Comprende el sentido global de los mensajes, a partir de la relación entre la información explícita e implícita.', '2022-06-08 07:04:28', 1),
                                                                                                                (180, 4, 'a:1:{i:0;s:1:\"5\";}', 'Identifica la intención comunicativa de los textos con los que interactúa a partir del análisis de su contenido y estructura.', '2022-06-08 07:05:05', 1),
                                                                                                                (181, 4, 'a:1:{i:0;s:1:\"5\";}', 'Construye textos orales atendiendo a los contextos de uso, a los posibles interlocutores y a las líneas temáticas pertinentes con el propósito comunicativo en el que se enmarca el discurso.', '2022-06-08 07:05:33', 1),
                                                                                                                (182, 4, 'a:1:{i:0;s:1:\"5\";}', 'Produce textos verbales y no verbales a partir de los planes textuales que elabora según la tipología a desarrollar.', '2022-06-08 07:06:01', 1),
                                                                                                                (183, 4, 'a:1:{i:0;s:1:\"6\";}', 'Utiliza la información ofrecida por los medios de comunicación, teniendo en cuenta el mensaje, los interlocutores, la intencionalidad y el contexto de producción, para participar en los procesos comunicativos de su entorno.', '2022-06-08 07:07:40', 1),
                                                                                                                (184, 4, 'a:1:{i:0;s:1:\"6\";}', 'Crea organizadores gráficos en los que integra signos verbales y no verbales para dar cuenta de sus conocimientos.', '2022-06-08 07:07:59', 1),
                                                                                                                (185, 4, 'a:1:{i:0;s:1:\"6\";}', 'Reconoce las obras literarias como una posibilidad de circulación del conocimiento y de desarrollo de su imaginación.', '2022-06-08 07:08:23', 1),
                                                                                                                (186, 4, 'a:1:{i:0;s:1:\"6\";}', 'Identifica algunas expresiones de diferentes regiones y contextos en las obras literarias.', '2022-06-08 07:08:47', 1),
                                                                                                                (187, 4, 'a:1:{i:0;s:1:\"6\";}', 'Interpreta obras de la tradición popular propias de su entorno.', '2022-06-08 07:09:08', 1),
                                                                                                                (188, 4, 'a:1:{i:0;s:1:\"6\";}', 'Comprende diversos tipos de texto, a partir del análisis de sus contenidos, características formales e intenciones comunicativas.', '2022-06-08 07:09:29', 1),
                                                                                                                (189, 4, 'a:1:{i:0;s:1:\"6\";}', 'Produce discursos orales y los adecúa a las circunstancias del contexto: el público, la intención comunicativa y el tema a desarrollar.', '2022-06-08 07:09:51', 1),
                                                                                                                (190, 4, 'a:1:{i:0;s:1:\"6\";}', 'Produce diversos tipos de texto atendiendo a los destinatarios, al medio en que se escribirá y a los propósitos comunicativos.', '2022-06-08 07:10:11', 1),
                                                                                                                (191, 4, 'a:1:{i:0;s:1:\"7\";}', 'Clasifica la información que circula en los medios de comunicación con los que interactúa y la retoma como referente para sus producciones discursivas.', '2022-06-08 07:10:36', 1),
                                                                                                                (192, 4, 'a:1:{i:0;s:1:\"7\";}', 'Reconoce las diferencias y semejanzas entre sistemas verbales y no verbales para utilizarlos en contextos escolares y sociales.', '2022-06-08 07:10:57', 1),
                                                                                                                (193, 4, 'a:1:{i:0;s:1:\"7\";}', 'Establece conexiones entre los elementos presentes en la literatura y los hechos históricos, culturales y sociales en los que se han producido.', '2022-06-08 07:12:04', 1),
                                                                                                                (194, 4, 'a:1:{i:0;s:1:\"7\";}', 'Clasifica las producciones literarias a partir del análisis de su contenido y estructura en diferentes géneros literarios.', '2022-06-08 07:13:18', 1),
                                                                                                                (195, 4, 'a:1:{i:0;s:1:\"7\";}', 'Comprende discursos orales producidos con un objetivo determinado en diversos contextos sociales y escolares.', '2022-06-08 07:13:40', 1),
                                                                                                                (196, 4, 'a:1:{i:0;s:1:\"7\";}', 'Interpreta textos informativos, expositivos, narrativos, líricos, argumentativos y descriptivos, y da cuenta de sus características formales y no formales.', '2022-06-08 07:13:59', 1),
                                                                                                                (197, 4, 'a:1:{i:0;s:1:\"7\";}', 'Construye narraciones orales, para lo cual retoma las características de los géneros que quiere relatar y los contextos de circulación de su discurso.', '2022-06-08 07:14:26', 1),
                                                                                                                (198, 4, 'a:1:{i:0;s:1:\"7\";}', 'Produce textos verbales y no verbales conforme a las características de una tipología seleccionada, a partir de un proceso de planificación textual.', '2022-06-08 07:14:47', 1),
                                                                                                                (199, 4, 'a:1:{i:0;s:1:\"8\";}', 'Caracteriza los discursos presentes en los medios de comunicación y otras fuentes de información, atendiendo al contenido, la intención comunicativa del autor y al contexto en que se producen.', '2022-06-08 07:16:11', 1),
                                                                                                                (200, 4, 'a:1:{i:0;s:1:\"8\";}', 'Relaciona las manifestaciones artísticas con las comunidades y culturas en las que se producen.', '2022-06-08 07:16:32', 1),
                                                                                                                (201, 4, 'a:1:{i:0;s:1:\"8\";}', 'Reconoce en las producciones literarias como cuentos, relatos cortos, fábulas y novelas, aspectos referidos a la estructura formal del género y a la identidad cultural que recrea.', '2022-06-08 07:16:55', 1),
                                                                                                                (202, 4, 'a:1:{i:0;s:1:\"8\";}', 'Comprende que el género lírico es una construcción mediada por la musicalidad, la rima y el uso de figuras retóricas, que permiten recrear una idea, un sentimiento o\r\nuna situación.', '2022-06-08 07:17:15', 1),
                                                                                                                (203, 4, 'a:1:{i:0;s:1:\"8\";}', 'Escucha con atención a sus compañeros en diálogos informales y predice los contenidos de la comunicación.', '2022-06-08 07:17:34', 1),
                                                                                                                (204, 4, 'a:1:{i:0;s:1:\"8\";}', 'Infiere múltiples sentidos en los textos que lee y los relaciona con los conceptos macro del texto y con sus contextos de producción y circulación.', '2022-06-08 07:17:55', 1),
                                                                                                                (205, 4, 'a:1:{i:0;s:1:\"8\";}', 'Reconstruye en sus intervenciones el sentido de los textos desde la relación existente entre la temática, los interlocutores y el contexto histórico-cultural.', '2022-06-08 07:18:18', 1),
                                                                                                                (206, 4, 'a:1:{i:0;s:1:\"8\";}', 'Compone diferentes tipos de texto atendiendo a las características de sus ámbitos de uso: privado/público o cotidiano/científico.', '2022-06-08 07:18:39', 1),
                                                                                                                (207, 4, 'a:1:{i:0;s:1:\"9\";}', 'Confronta los discursos provenientes de los medios de comunicación con los que interactúa en el medio para afianzar su punto de vista particular.', '2022-06-08 07:19:03', 1),
                                                                                                                (208, 4, 'a:1:{i:0;s:1:\"9\";}', 'Incorpora símbolos de orden deportivo, cívico, político, religioso, científico o publicitario en los discursos que produce, teniendo claro su uso dentro del contexto.', '2022-06-08 07:19:28', 1),
                                                                                                                (209, 4, 'a:1:{i:0;s:1:\"9\";}', 'Analiza el lenguaje literario como una manifestación artística que permite crear ficciones y expresar pensamientos o emociones.', '2022-06-08 07:19:57', 1),
                                                                                                                (210, 4, 'a:1:{i:0;s:1:\"9\";}', 'Compara los formatos de obras literarias y de producciones audiovisuales con el propósito de analizar elementos propios de la narración.', '2022-06-08 07:20:16', 1),
                                                                                                                (211, 4, 'a:1:{i:0;s:1:\"9\";}', 'Comprende y respeta las opiniones en debates sobre temas de actualidad social.', '2022-06-08 07:20:33', 1),
                                                                                                                (212, 4, 'a:1:{i:0;s:1:\"9\";}', 'Interpreta textos atendiendo al funcionamiento de la lengua en situaciones de comunicación, a partir del uso de estrategias de lectura.', '2022-06-08 07:20:57', 1),
                                                                                                                (213, 4, 'a:1:{i:0;s:1:\"9\";}', 'Produce textos orales, a partir del empleo de diversas estrategias para exponer sus argumentos.', '2022-06-08 07:21:16', 1),
                                                                                                                (214, 4, 'a:1:{i:0;s:1:\"9\";}', 'Produce textos verbales y no verbales, a partir de los planes textuales que elabora, y siguiendo procedimientos sistemáticos de corrección lingüística.', '2022-06-08 07:21:36', 1),
                                                                                                                (215, 4, 'a:1:{i:0;s:2:\"10\";}', 'Asume una posición crítica y propositiva frente a los medios de comunicación masiva para analizar su influencia en la sociedad actual.', '2022-06-08 07:21:57', 1),
                                                                                                                (216, 4, 'a:1:{i:0;s:2:\"10\";}', 'Planea la producción de textos audiovisuales en los que articula elementos verbales y no verbales de la comunicación para desarrollar un tema o una historia.', '2022-06-08 07:22:17', 1),
                                                                                                                (217, 4, 'a:1:{i:0;s:2:\"10\";}', 'Caracteriza la literatura en un momento particular de la historia desde el acercamiento a sus principales exponentes, textos, temáticas y recursos estilísticos.', '2022-06-08 07:24:01', 1),
                                                                                                                (218, 4, 'a:1:{i:0;s:2:\"10\";}', 'Formula puntos de encuentro entre la literatura y las artes plásticas y visuales.', '2022-06-08 07:24:24', 1),
                                                                                                                (219, 4, 'a:1:{i:0;s:2:\"10\";}', 'Participa en discursos orales en los que evalúa aspectos relacionados con la progresión temática, manejo de la voz, tono, estilo y puntos de vista sobre temas sociales, culturales, políticos y científicos.', '2022-06-08 07:24:50', 1),
                                                                                                                (220, 4, 'a:1:{i:0;s:2:\"10\";}', 'Comprende diversos tipos de texto, asumiendo una actitud crítica y argumentando sus puntos de vista frente a lo leído.', '2022-06-08 07:25:12', 1),
                                                                                                                (221, 4, 'a:1:{i:0;s:2:\"10\";}', 'Produce textos orales como ponencias, comentarios, relatorías o entrevistas, atendiendo a la progresión temática, a los interlocutores, al propósito y a la situación\r\ncomunicativa.', '2022-06-08 07:25:35', 1),
                                                                                                                (222, 4, 'a:1:{i:0;s:2:\"10\";}', 'Escribe textos que evidencian procedimientos sistemáticos de corrección lingüística y el uso de estrategias de producción textual.', '2022-06-08 07:26:00', 1),
                                                                                                                (223, 4, 'a:1:{i:0;s:2:\"11\";}', 'Participa en escenarios académicos, políticos y culturales; asumiendo una posición crítica y propositiva frente a los discursos que le presentan los distintos medios de comunicación y otras fuentes de información.', '2022-06-08 07:26:29', 1),
                                                                                                                (224, 4, 'a:1:{i:0;s:2:\"11\";}', 'Expresa, con sentido crítico, cómo se articulan los códigos verbales y no verbales en diversas manifestaciones humanas y da cuenta de sus implicaciones culturales, sociales e ideológicas.', '2022-06-08 07:26:52', 1),
                                                                                                                (225, 4, 'a:1:{i:0;s:2:\"11\";}', 'Determina los textos que desea leer y la manera en que abordará su comprensión, con base en sus experiencias de formación e inclinaciones literarias.', '2022-06-08 07:27:17', 1),
                                                                                                                (226, 4, 'a:1:{i:0;s:2:\"11\";}', 'Identifica, en las producciones literarias clásicas, diferentes temas que le permiten establecer comparaciones con las visiones de mundo de otras épocas.', '2022-06-08 07:27:43', 1),
                                                                                                                (227, 4, 'a:1:{i:0;s:2:\"11\";}', 'Comprende que los argumentos de sus interlocutores involucran procesos de comprensión, crítica y proposición.', '2022-06-08 07:28:07', 1),
                                                                                                                (228, 4, 'a:1:{i:0;s:2:\"11\";}', 'Compara diversos tipos de texto, con capacidad crítica y argumentativa para establecer relaciones entre temáticas, características y los múltiples contextos en\r\nlos que fueron producidos.', '2022-06-08 07:29:27', 1),
                                                                                                                (229, 4, 'a:1:{i:0;s:2:\"11\";}', 'Expresa por medio de producciones orales el dominio de un tema, un texto o la obra de un autor.', '2022-06-08 07:29:49', 1),
                                                                                                                (230, 4, 'a:1:{i:0;s:2:\"11\";}', 'Produce textos académicos a partir de procedimientos sistemáticos de corrección lingüística, atendiendo al tipo de texto y al contexto comunicativo.', '2022-06-08 07:30:11', 1),
                                                                                                                (231, 1, 'a:1:{i:0;s:1:\"1\";}', 'Identifica los usos de los números (como código, cardinal, medida, ordinal) y las operaciones (suma y resta) en contextos de juego, familiares, económicos, entre otros.', '2022-06-08 07:32:59', 1),
                                                                                                                (232, 1, 'a:1:{i:0;s:1:\"1\";}', 'Utiliza diferentes estrategias para contar, realizar operaciones (suma y resta ) y resolver problemas aditivos.', '2022-06-08 07:33:17', 1),
                                                                                                                (233, 1, 'a:1:{i:0;s:1:\"1\";}', 'Utiliza las características posicionales del Sistema de Numeración Decimal (SND) para establecer relaciones entre cantidades y comparar números.', '2022-06-08 07:33:45', 1),
                                                                                                                (234, 1, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce y compara atributos que pueden ser medidos en objetos y eventos (longitud, duración, rapidez, masa, peso, capacidad, cantidad de elementos de una colección, entre otros).', '2022-06-08 07:34:12', 1),
                                                                                                                (235, 1, 'a:1:{i:0;s:1:\"1\";}', 'Realiza medición de longitudes, capacidades, peso, masa, entre otros, para ello utiliza instrumentos y unidades no estandarizadas y estandarizadas.', '2022-06-08 07:34:32', 1),
                                                                                                                (236, 1, 'a:1:{i:0;s:1:\"1\";}', 'Compara objetos del entorno y establece semejanzas y diferencias empleando características geométricas de las formas bidimensionales y tridimensionales (Curvo\r\no recto, abierto o cerrado, plano o sólido, número de lados, número de caras, entre otros)', '2022-06-08 07:34:59', 1),
                                                                                                                (237, 1, 'a:1:{i:0;s:1:\"1\";}', 'Describe y representa trayectorias y posiciones de objetos y personas para orientar a otros o a sí mismo en el espacio circundante.', '2022-06-08 07:35:17', 1),
                                                                                                                (238, 1, 'a:1:{i:0;s:1:\"1\";}', 'Describe cualitativamente situaciones para identificar el cambio y la variación usando gestos, dibujos, diagramas, medios gráficos y simbólicos.', '2022-06-08 07:35:37', 1),
                                                                                                                (239, 1, 'a:1:{i:0;s:1:\"1\";}', 'Reconoce el signo igual como una equivalencia entre expresiones con sumas y restas.', '2022-06-08 07:36:02', 1),
                                                                                                                (240, 1, 'a:1:{i:0;s:1:\"1\";}', 'Clasifica y organiza datos, los representa utilizando tablas de conteo y pictogramas sin escalas, y comunica los resultados obtenidos para responder preguntas sencillas.', '2022-06-08 07:36:22', 1),
                                                                                                                (241, 1, 'a:1:{i:0;s:1:\"2\";}', 'Interpreta, propone y resuelve problemas aditivos (de composición, transformación y relación) que involucren la cantidad en una colección, la medida de magnitudes (longitud, peso, capacidad y duración de eventos) y problemas multiplicativos sencillos', '2022-06-08 07:40:38', 1),
                                                                                                                (242, 1, 'a:1:{i:0;s:1:\"2\";}', 'Utiliza diferentes estrategias para calcular (agrupar, representar elementos en colecciones, etc.) o estimar el resultado de una suma y resta, multiplicación o reparto\r\nequitativo.', '2022-06-08 07:41:04', 1);
INSERT INTO `caracterizacion_dba` (`id_dba`, `id_area`, `grado`, `descripcion_dba`, `created_at`, `estado`) VALUES
                                                                                                                (243, 1, 'a:1:{i:0;s:1:\"2\";}', 'Utiliza el Sistema de Numeración Decimal para comparar, ordenar y establecer diferentes relaciones entre dos o más secuencias de números con ayuda de diferentes recursos.', '2022-06-08 07:41:29', 1),
                                                                                                                (244, 1, 'a:1:{i:0;s:1:\"2\";}', 'Compara y explica características que se pueden medir, en el proceso de resolución de problemas relativos a longitud, superficie, velocidad, peso o duración de los eventos, entre otros.', '2022-06-08 07:41:51', 1),
                                                                                                                (245, 1, 'a:1:{i:0;s:1:\"2\";}', 'Utiliza patrones, unidades e instrumentos convencionales y no convencionales en procesos de medición, cálculo y estimación de magnitudes como longitud, peso, capacidad y tiempo.', '2022-06-08 07:42:17', 1),
                                                                                                                (246, 1, 'a:1:{i:0;s:1:\"2\";}', 'Clasifica, describe y representa objetos del entorno a partir de sus propiedades geométricas para establecer relaciones entre las formas bidimensionales y tridimensionales.', '2022-06-08 07:42:45', 1),
                                                                                                                (247, 1, 'a:1:{i:0;s:1:\"2\";}', 'Describe desplazamientos y referencia la posición de un objeto mediante nociones de horizontalidad, verticalidad, paralelismo y perpendicularidad en la solución de\r\nproblemas.', '2022-06-08 07:43:09', 1),
                                                                                                                (248, 1, 'a:1:{i:0;s:1:\"2\";}', 'Propone e identifica patrones y utiliza propiedades de los números y de las operaciones para calcular valores desconocidos en expresiones aritméticas.', '2022-06-08 07:43:31', 1),
                                                                                                                (249, 1, 'a:1:{i:0;s:1:\"2\";}', 'Opera sobre secuencias numéricas para encontrar números u operaciones faltantes y utiliza las propiedades de las operaciones en contextos escolares o extraescolares.', '2022-06-08 07:43:55', 1),
                                                                                                                (250, 1, 'a:1:{i:0;s:1:\"2\";}', 'Clasifica y organiza datos, los representa utilizando tablas de conteo, pictogramas con escalas y gráficos de puntos, comunica los resultados obtenidos para responder preguntas sencillas.', '2022-06-08 07:44:22', 1),
                                                                                                                (251, 1, 'a:1:{i:0;s:1:\"2\";}', 'Explica, a partir de la experiencia, la posibilidad de ocurrencia o no de un evento cotidiano y el resultado lo utiliza para predecir la ocurrencia de otros eventos.', '2022-06-08 07:45:08', 1),
                                                                                                                (252, 1, 'a:1:{i:0;s:1:\"3\";}', 'Interpreta, formula y resuelve problemas aditivos de composición, transformación y comparación en diferentes contextos; y multiplicativos, directos e inversos, en diferentes contextos.', '2022-06-08 08:36:09', 1),
                                                                                                                (253, 1, 'a:1:{i:0;s:1:\"3\";}', 'Propone, desarrolla y justifica estrategias para hacer estimaciones y cálculos con operaciones básicas en la solución de problemas.', '2022-06-08 08:37:17', 1),
                                                                                                                (254, 1, 'a:1:{i:0;s:1:\"3\";}', 'Establece comparaciones entre cantidades y expresiones que involucran operaciones y relaciones aditivas y multiplicativas y sus representaciones numéricas.', '2022-06-08 08:38:02', 1),
                                                                                                                (255, 1, 'a:1:{i:0;s:1:\"3\";}', 'Describe y argumenta posibles relaciones entre los valores del área y el perímetro de figuras planas (especialmente cuadriláteros).', '2022-06-08 08:38:26', 1),
                                                                                                                (256, 1, 'a:1:{i:0;s:1:\"3\";}', 'Realiza estimaciones y mediciones de volumen, capacidad, longitud, área, peso de objetos o la duración de eventos como parte del proceso para resolver diferentes problemas.', '2022-06-08 08:38:52', 1),
                                                                                                                (257, 1, 'a:1:{i:0;s:1:\"3\";}', 'Describe y representa formas bidimensionales y tridimensionales de acuerdo con las propiedades geométricas.', '2022-06-08 08:39:12', 1),
                                                                                                                (258, 1, 'a:1:{i:0;s:1:\"3\";}', 'Formula y resuelve problemas que se relacionan con la posición, la dirección y el movimiento de objetos en el entorno.', '2022-06-08 08:42:24', 1),
                                                                                                                (259, 1, 'a:1:{i:0;s:1:\"3\";}', 'Describe y representa los aspectos que cambian y permanecen constantes en secuencias y en otras situaciones de variación.', '2022-06-08 08:42:54', 1),
                                                                                                                (260, 1, 'a:1:{i:0;s:1:\"3\";}', 'Argumenta sobre situaciones numéricas, geométricas y enunciados verbales en los que aparecen datos desconocidos para definir sus posibles valores según el contexto.', '2022-06-08 08:44:27', 1),
                                                                                                                (261, 1, 'a:1:{i:0;s:1:\"3\";}', 'Lee e interpreta información contenida en tablas de frecuencia, gráficos de barras y/o pictogramas con escala, para formular y resolver preguntas de situaciones de su\r\nentorno.', '2022-06-08 08:44:55', 1),
                                                                                                                (262, 1, 'a:1:{i:0;s:1:\"3\";}', 'Plantea y resuelve preguntas sobre la posibilidad de ocurrencia de situaciones aleatorias cotidianas y cuantifica la posibilidad de ocurrencia de eventos simples en una\r\nescala cualitativa (mayor, menor e igual).', '2022-06-08 08:47:03', 1),
                                                                                                                (263, 1, 'a:1:{i:0;s:1:\"4\";}', 'Interpreta las fracciones como razón, relación parte todo, cociente y operador en diferentes contextos.', '2022-06-08 08:47:25', 1),
                                                                                                                (264, 1, 'a:1:{i:0;s:1:\"4\";}', 'Describe y justifica diferentes estrategias para representar, operar y hacer estimaciones con números naturales y números racionales (fraccionarios)1, expresados como fracción o como decimal.', '2022-06-08 08:47:53', 1),
                                                                                                                (265, 1, 'a:1:{i:0;s:1:\"4\";}', 'Establece relaciones mayor que, menor que, igual que y relaciones multiplicativas entre números racionales en sus formas de fracción o decimal.', '2022-06-08 08:48:19', 1),
                                                                                                                (266, 1, 'a:1:{i:0;s:1:\"4\";}', 'Caracteriza y compara atributos medibles de los objetos (densidad, dureza, viscosidad, masa, capacidad de los recipientes, temperatura) con respecto a procedimientos, instrumentos y unidades de medición; y con respecto a las necesidades a las que res', '2022-06-08 08:48:47', 1),
                                                                                                                (267, 1, 'a:1:{i:0;s:1:\"4\";}', 'Elige instrumentos y unidades estandarizadas y no estandarizadas para estimar y medir longitud, área, volumen, capacidad, peso y masa, duración, rapidez, temperatura, y a partir de ellos hace los cálculos necesarios para resolver problemas.', '2022-06-08 08:49:21', 1),
                                                                                                                (268, 1, 'a:1:{i:0;s:1:\"4\";}', 'Identifica, describe y representa figuras bidimensionales y tridimensionales, y establece relaciones entre ellas.', '2022-06-08 08:49:43', 1),
                                                                                                                (269, 1, 'a:1:{i:0;s:1:\"4\";}', 'Identifica los movimientos realizados a una figura en el plano respecto a una posición o eje (rotación, traslación y simetría) y las modificaciones que pueden sufrir las formas (ampliación- reducción).', '2022-06-08 08:50:11', 1),
                                                                                                                (270, 1, 'a:1:{i:0;s:1:\"4\";}', 'Identifica, documenta e interpreta variaciones de dependencia entre cantidades en diferentes fenómenos (en las matemáticas y en otras ciencias) y los representa por medio de gráficas.', '2022-06-08 08:50:48', 1),
                                                                                                                (271, 1, 'a:1:{i:0;s:1:\"4\";}', 'Identifica patrones en secuencias (aditivas o multiplicativas) y los utiliza para establecer generalizaciones aritméticas o algebraicas.', '2022-06-08 08:51:17', 1),
                                                                                                                (272, 1, 'a:1:{i:0;s:1:\"4\";}', 'Recopila y organiza datos en tablas de doble entrada y los representa en gráficos de barras agrupadas o gráficos de líneas, para dar respuesta a una pregunta planteada.\r\nInterpreta la información y comunica sus conclusiones.', '2022-06-08 08:51:53', 1),
                                                                                                                (273, 1, 'a:1:{i:0;s:1:\"4\";}', 'Comprende y explica, usando vocabulario adecuado, la diferencia entre una situación aleatoria y una determinística y predice, en una situación de la vida cotidiana, la presencia o no del azar', '2022-06-08 08:53:02', 1),
                                                                                                                (274, 1, 'a:1:{i:0;s:1:\"5\";}', 'Interpreta y utiliza los números naturales y racionales en su representación fraccionaria para formular y resolver problemas aditivos, multiplicativos y que involucren operaciones de potenciación.', '2022-06-08 08:53:37', 1),
                                                                                                                (275, 1, 'a:1:{i:0;s:1:\"5\";}', 'Describe y desarrolla estrategias (algoritmos, propiedades de las operaciones básicas y sus relaciones) para hacer estimaciones y cálculos al solucionar problemas de potenciación.', '2022-06-08 08:54:02', 1),
                                                                                                                (276, 1, 'a:1:{i:0;s:1:\"5\";}', 'Compara y ordena números fraccionarios a través de diversas interpretaciones, recursos y representaciones.', '2022-06-08 08:54:24', 1),
                                                                                                                (277, 1, 'a:1:{i:0;s:1:\"5\";}', 'Justifica relaciones entre superficie y volumen, respecto a dimensiones de figuras y sólidos, y elige las unidades apropiadas según el tipo de medición (directa e indirecta), los instrumentos y los procedimientos.', '2022-06-08 08:54:56', 1),
                                                                                                                (278, 1, 'a:1:{i:0;s:1:\"5\";}', 'Explica las relaciones entre el perímetro y el área de diferentes figuras (variaciones en el perímetro no implican variaciones en el área y viceversa) a partir de mediciones,\r\nsuperposición de figuras, cálculo, entre otras.', '2022-06-08 08:55:24', 1),
                                                                                                                (279, 1, 'a:1:{i:0;s:1:\"5\";}', 'Identifica y describe propiedades que caracterizan un cuerpo en términos de la bidimensionalidad y la tridimensionalidad y resuelve problemas en relación con la\r\ncomposición y descomposición de las formas.', '2022-06-08 08:55:49', 1),
                                                                                                                (280, 1, 'a:1:{i:0;s:1:\"5\";}', 'Resuelve y propone situaciones en las que es necesario describir y localizar la posición y la trayectoria de un objeto con referencia al plano cartesiano.', '2022-06-08 08:56:11', 1),
                                                                                                                (281, 1, 'a:1:{i:0;s:1:\"5\";}', 'Describe e interpreta variaciones de dependencia entre cantidades y las representa por medio de gráficas.', '2022-06-08 08:58:11', 1),
                                                                                                                (282, 1, 'a:1:{i:0;s:1:\"5\";}', 'Utiliza operaciones no convencionales, encuentra propiedades y resuelve ecuaciones en donde están involucradas.', '2022-06-08 08:58:27', 1),
                                                                                                                (283, 1, 'a:1:{i:0;s:1:\"5\";}', 'Formula preguntas que requieren comparar dos grupos de datos, para lo cual recolecta, organiza y usa tablas de frecuencia, gráficos de barras, circulares, de línea, entre otros. Analiza la información presentada y comunica los resultados.', '2022-06-08 08:59:07', 1),
                                                                                                                (284, 1, 'a:1:{i:0;s:1:\"5\";}', 'Utiliza la media y la mediana para resolver problemas en los que se requiere presentar o resumir el comportamiento de un conjunto de datos.', '2022-06-08 08:59:31', 1),
                                                                                                                (285, 1, 'a:1:{i:0;s:1:\"5\";}', 'Predice la posibilidad de ocurrencia de un evento simple a partir de la relación entre los elementos del espacio muestral y los elementos del evento definido.', '2022-06-08 08:59:53', 1),
                                                                                                                (286, 1, 'a:1:{i:0;s:1:\"6\";}', 'Interpreta los números enteros y racionales (en sus representaciones de fracción y de decimal) con sus operaciones, en diferentes contextos, al resolver problemas de variación, repartos, particiones, estimaciones, etc. Reconoce y establece diferentes', '2022-06-08 09:01:34', 1),
                                                                                                                (287, 1, 'a:1:{i:0;s:1:\"6\";}', 'Utiliza las propiedades de los números enteros y racionales y las propiedades de sus operaciones para proponer estrategias y procedimientos de cálculo en la solución\r\nde problemas.', '2022-06-08 09:01:55', 1),
                                                                                                                (288, 1, 'a:1:{i:0;s:1:\"6\";}', 'Reconoce y establece diferentes relaciones (orden y equivalencia) entre elementos de diversos dominios numéricos y los utiliza para argumentar procedimientos sencillos.', '2022-06-08 09:02:17', 1),
                                                                                                                (289, 1, 'a:1:{i:0;s:1:\"6\";}', 'Utiliza y explica diferentes estrategias (desarrollo de la forma o plantillas) e instrumentos (regla, compás o software) para la construcción de figuras planas y cuerpos.', '2022-06-08 09:02:39', 1),
                                                                                                                (290, 1, 'a:1:{i:0;s:1:\"6\";}', 'Propone y desarrolla estrategias de estimación, medición y cálculo de diferentes cantidades (ángulos, longitudes, áreas, volúmenes, etc.) para resolver problemas.', '2022-06-08 09:03:07', 1),
                                                                                                                (291, 1, 'a:1:{i:0;s:1:\"6\";}', 'Representa y construye formas bidimensionales y tridimensionales con el apoyo en instrumentos de medida apropiados.', '2022-06-08 09:03:28', 1),
                                                                                                                (292, 1, 'a:1:{i:0;s:1:\"6\";}', 'Reconoce el plano cartesiano como un sistema bidimensional que permite ubicar puntos como sistema de referencia gráfico o geográfico.', '2022-06-08 09:03:48', 1),
                                                                                                                (293, 1, 'a:1:{i:0;s:1:\"6\";}', 'Identifica y analiza propiedades de covariación directa e inversa entre variables, en contextos numéricos, geométricos y cotidianos y las representa mediante gráficas (cartesianas de puntos, continuas, formadas por segmentos, etc.).', '2022-06-08 09:04:21', 1),
                                                                                                                (294, 1, 'a:1:{i:0;s:1:\"6\";}', 'Opera sobre números desconocidos y encuentra las operaciones apropiadas al contexto para resolver problemas.', '2022-06-08 09:04:42', 1),
                                                                                                                (295, 1, 'a:1:{i:0;s:1:\"6\";}', 'Interpreta información estadística presentada en diversas fuentes de información, la analiza y la usa para plantear y resolver preguntas que sean de su interés.', '2022-06-08 09:05:26', 1),
                                                                                                                (296, 1, 'a:1:{i:0;s:1:\"6\";}', 'Compara características compartidas por dos o más poblaciones o características diferentes dentro de una misma población para lo cual seleccionan muestras, utiliza\r\nrepresentaciones gráficas adecuadas y analiza los resultados obtenidos usando conjunt', '2022-06-08 09:05:57', 1),
                                                                                                                (297, 1, 'a:1:{i:0;s:1:\"6\";}', 'A partir de la información previamente obtenida en repeticiones de experimentos aleatorios sencillos, compara las frecuencias esperadas con las frecuencias observadas.', '2022-06-08 09:06:27', 1),
                                                                                                                (298, 1, 'a:1:{i:0;s:1:\"7\";}', 'Comprende y resuelve problemas, que involucran los números racionales con las operaciones (suma, resta, multiplicación, división, potenciación, radicación) en\r\ncontextos escolares y extraescolares.', '2022-06-08 09:12:02', 1),
                                                                                                                (299, 1, 'a:1:{i:0;s:1:\"7\";}', 'Describe y utiliza diferentes algoritmos, convencionales y no convencionales, al realizar operaciones entre números racionales en sus diferentes representaciones (fracciones y decimales) y los emplea con sentido en la solución de problemas.', '2022-06-08 09:12:35', 1),
                                                                                                                (300, 1, 'a:1:{i:0;s:1:\"7\";}', 'Utiliza diferentes relaciones, operaciones y representaciones en los números racionales para argumentar y solucionar problemas en los que aparecen cantidades desconocidas.', '2022-06-08 09:13:03', 1),
                                                                                                                (301, 1, 'a:1:{i:0;s:1:\"7\";}', 'Utiliza escalas apropiadas para representar e interpretar planos, mapas y maquetas con diferentes unidades.', '2022-06-08 09:14:29', 1),
                                                                                                                (302, 1, 'a:1:{i:0;s:1:\"7\";}', 'Observa objetos tridimensionales desde diferentes puntos de vista, los representa según su ubicación y los reconoce cuando se transforman mediante rotaciones, traslaciones y reflexiones.', '2022-06-08 09:14:51', 1),
                                                                                                                (303, 1, 'a:1:{i:0;s:1:\"7\";}', 'Representa en el plano cartesiano la variación de magnitudes (áreas y perímetro) y con base en la variación explica el comportamiento de situaciones y fenómenos de la vida diaria.', '2022-06-08 09:15:12', 1),
                                                                                                                (304, 1, 'a:1:{i:0;s:1:\"7\";}', 'Plantea y resuelve ecuaciones, las describe verbalmente y representa situaciones de variación de manera numérica, simbólica o gráfica.', '2022-06-08 09:15:34', 1),
                                                                                                                (305, 1, 'a:1:{i:0;s:1:\"7\";}', 'Plantea preguntas para realizar estudios estadísticos en los que representa información mediante histogramas, polígonos de frecuencia, gráficos de línea entre otros;\r\nidentifica variaciones, relaciones o tendencias para dar respuesta a las preguntas ', '2022-06-08 09:16:02', 1),
                                                                                                                (306, 1, 'a:1:{i:0;s:1:\"7\";}', 'Usa el principio multiplicativo en situaciones aleatorias sencillas y lo representa con tablas o diagramas de árbol. Asigna probabilidades a eventos compuestos y los interpreta a partir de propiedades básicas de la probabilidad.', '2022-06-08 09:16:26', 1),
                                                                                                                (307, 1, 'a:1:{i:0;s:1:\"8\";}', 'Reconoce la existencia de los números irracionales como números no racionales y los describe de acuerdo con sus características y propiedades.', '2022-06-08 09:16:57', 1),
                                                                                                                (308, 1, 'a:1:{i:0;s:1:\"8\";}', 'Construye representaciones, argumentos y ejemplos de propiedades de los números racionales y no racionales.', '2022-06-08 09:17:16', 1),
                                                                                                                (309, 1, 'a:1:{i:0;s:1:\"8\";}', 'Reconoce los diferentes usos y significados de las operaciones (convencionales y no convencionales) y del signo igual (relación de equivalencia e igualdad condicionada) y los utiliza para argumentar equivalencias entre expresiones algebraicas y resol', '2022-06-08 09:17:47', 1),
                                                                                                                (310, 1, 'a:1:{i:0;s:1:\"8\";}', 'Describe atributos medibles de diferentes sólidos y explica relaciones entre ellos por medio del lenguaje algebraico.', '2022-06-08 09:18:10', 1),
                                                                                                                (311, 1, 'a:1:{i:0;s:1:\"8\";}', 'Utiliza y explica diferentes estrategias para encontrar el volumen de objetos regulares e irregulares en la solución de problemas en las matemáticas y en otras ciencias.', '2022-06-08 09:18:33', 1),
                                                                                                                (312, 1, 'a:1:{i:0;s:1:\"8\";}', 'Identifica relaciones de congruencia y semejanza entre las formas geométricas que configuran el diseño de un objeto.', '2022-06-08 09:18:52', 1),
                                                                                                                (313, 1, 'a:1:{i:0;s:1:\"8\";}', 'Identifica regularidades y argumenta propiedades de figuras geométricas a partir de teoremas y las aplica en situaciones reales.', '2022-06-08 09:19:13', 1),
                                                                                                                (314, 1, 'a:1:{i:0;s:1:\"8\";}', 'Identifica y analiza relaciones entre propiedades de las gráficas y propiedades de expresiones algebraicas y relaciona la variación y covariación con los comportamientos gráficos, numéricos y características de las expresiones algebraicas en situacio', '2022-06-08 09:19:53', 1),
                                                                                                                (315, 1, 'a:1:{i:0;s:1:\"8\";}', 'Propone, compara y usa procedimientos inductivos y lenguaje algebraico para formular y poner a prueba conjeturas en diversas situaciones o contextos.', '2022-06-08 09:20:16', 1),
                                                                                                                (316, 1, 'a:1:{i:0;s:1:\"8\";}', 'Propone relaciones o modelos funcionales entre variables e identifica y analiza propiedades de covariación entre variables, en contextos numéricos, geométricos y cotidianos y las representa mediante gráficas (cartesianas de puntos, continuas, formada', '2022-06-08 09:20:47', 1),
                                                                                                                (317, 1, 'a:1:{i:0;s:1:\"8\";}', 'Interpreta información presentada en tablas de frecuencia y gráficos cuyos datos están agrupados en intervalos y decide cuál es la medida de tendencia central que mejor representa el comportamiento de dicho conjunto.', '2022-06-08 09:21:34', 1),
                                                                                                                (318, 1, 'a:1:{i:0;s:1:\"8\";}', 'Hace predicciones sobre la posibilidad de ocurrencia de un evento compuesto e interpreta la predicción a partir del uso de propiedades básicas de la probabilidad.', '2022-06-08 09:22:02', 1),
                                                                                                                (319, 1, 'a:1:{i:0;s:1:\"9\";}', 'Utiliza los números reales (sus operaciones, relaciones y propiedades) para resolver problemas con expresiones polinómicas.', '2022-06-08 09:25:21', 1),
                                                                                                                (320, 1, 'a:1:{i:0;s:1:\"9\";}', 'Propone y desarrolla expresiones algebraicas en el conjunto de los números reales y utiliza las propiedades de la igualdad y de orden para determinar el conjunto solución de relaciones entre tales expresiones.', '2022-06-08 09:25:52', 1),
                                                                                                                (321, 1, 'a:1:{i:0;s:1:\"9\";}', 'Utiliza los números reales, sus operaciones, relaciones y representaciones para analizar procesos infinitos y resolver problemas.', '2022-06-08 09:26:17', 1),
                                                                                                                (322, 1, 'a:1:{i:0;s:1:\"9\";}', 'Identifica y utiliza relaciones entre el volumen y la capacidad de algunos cuerpos redondos (cilindro, cono y esfera) con referencia a las situaciones escolares y extraescolares.', '2022-06-08 09:26:41', 1),
                                                                                                                (323, 1, 'a:1:{i:0;s:1:\"9\";}', 'Utiliza teoremas, propiedades y relaciones geométricas (teorema de Thales y el teorema de Pitágoras) para proponer y justificar estrategias de medición y cálculo de longitudes.', '2022-06-08 09:27:07', 1),
                                                                                                                (324, 1, 'a:1:{i:0;s:1:\"9\";}', 'Conjetura acerca de las regularidades de las formas bidimensionales y tridimensionales y realiza inferencias a partir de los criterios de semejanza, congruencia y teoremas básicos.', '2022-06-08 09:27:29', 1),
                                                                                                                (325, 1, 'a:1:{i:0;s:1:\"9\";}', 'Grafica los datos registrados en la tabla y encuentra la relación con respecto a la primera gráfica. Explica a qué se deben las diferencias o las similitudes en caso de que existan y el significado de la expresión (Variación de la velocidad)/(Variaci', '2022-06-08 09:28:25', 1),
                                                                                                                (326, 1, 'a:1:{i:0;s:1:\"9\";}', 'Utiliza expresiones numéricas, algebraicas o gráficas para hacer descripciones de situaciones concretas y tomar decisiones con base en su interpretación.', '2022-06-08 09:29:37', 1),
                                                                                                                (327, 1, 'a:1:{i:0;s:1:\"9\";}', 'Utiliza procesos inductivos y lenguaje simbólico o algebraico para formular, proponer y resolver conjeturas en la solución de problemas numéricos, geométricos, métricos, en situaciones cotidianas y no cotidianas.', '2022-06-08 09:31:38', 1),
                                                                                                                (328, 1, 'a:1:{i:0;s:1:\"9\";}', 'Propone un diseño estadístico adecuado para resolver una pregunta que indaga por la comparación sobre las distribuciones de dos grupos de datos, para lo cual usa\r\ncomprensivamente diagramas de caja, medidas de tendencia central, de variación y de loc', '2022-06-08 09:32:05', 1),
                                                                                                                (329, 1, 'a:1:{i:0;s:1:\"9\";}', 'Encuentra el número de posibles resultados de experimentos aleatorios, con reemplazo y sin reemplazo, usando técnicas de conteo adecuadas, y argumenta la selección\r\nrealizada en el contexto de la situación abordada. Encuentra la probabilidad de event', '2022-06-08 09:32:53', 1),
                                                                                                                (330, 1, 'a:1:{i:0;s:2:\"10\";}', 'Utiliza las propiedades de los números reales para justificar procedimientos y diferentes representaciones de subconjuntos de ellos.', '2022-06-08 09:34:06', 1),
                                                                                                                (331, 1, 'a:1:{i:0;s:2:\"10\";}', 'Utiliza las propiedades algebraicas de equivalencia y de orden de los números reales para comprender y crear estrategias que permitan compararlos y comparar\r\nsubconjuntos de ellos (por ejemplo, intervalos).', '2022-06-08 09:34:28', 1),
                                                                                                                (332, 1, 'a:1:{i:0;s:2:\"10\";}', 'Resuelve problemas que involucran el significado de medidas de magnitudes relacionales (velocidad media, aceleración media) a partir de tablas, gráficas y expresiones\r\nalgebraicas.', '2022-06-08 09:34:51', 1),
                                                                                                                (333, 1, 'a:1:{i:0;s:2:\"10\";}', 'Comprende y utiliza funciones para modelar fenómenos periódicos y justifica las soluciones.', '2022-06-08 09:35:09', 1),
                                                                                                                (334, 1, 'a:1:{i:0;s:2:\"10\";}', 'Explora y describe las propiedades de los lugares geométricos y de sus transformaciones a partir de diferentes representaciones.', '2022-06-08 09:35:34', 1),
                                                                                                                (335, 1, 'a:1:{i:0;s:2:\"10\";}', 'Comprende y usa el concepto de razón de cambio para estudiar el cambio promedio y el cambio alrededor de un punto y lo reconoce en representaciones gráficas, numéricas y algebraicas.', '2022-06-08 09:36:03', 1),
                                                                                                                (336, 1, 'a:1:{i:0;s:2:\"10\";}', 'Resuelve problemas mediante el uso de las propiedades de las funciones y usa representaciones tabulares, gráficas y algebraicas para estudiar la variación, la\r\ntendencia numérica y las razones de cambio entre magnitudes.', '2022-06-08 09:36:38', 1),
                                                                                                                (337, 1, 'a:1:{i:0;s:2:\"10\";}', 'Selecciona muestras aleatorias en poblaciones grandes para inferir el comportamiento de las variables en estudio. Interpreta, valora y analiza críticamente los resultados y las inferencias presentadas en estudios estadísticos.', '2022-06-08 09:38:17', 1),
                                                                                                                (338, 1, 'a:1:{i:0;s:2:\"10\";}', 'Comprende y explica el carácter relativo de las medidas de tendencias central y de dispersión, junto con algunas de sus propiedades, y la necesidad de complementar una medida con otra para obtener mejores lecturas de los datos.', '2022-06-08 09:38:58', 1),
                                                                                                                (339, 1, 'a:1:{i:0;s:2:\"10\";}', 'Propone y realiza experimentos aleatorios en contextos de las ciencias naturales o sociales y predice la ocurrencia de eventos, en casos para los cuales el espacio muestral es indeterminado.', '2022-06-08 09:40:23', 1),
                                                                                                                (340, 1, 'a:1:{i:0;s:2:\"11\";}', 'Utiliza las propiedades de los números (naturales, enteros, racionales y reales) y sus relaciones y operaciones para construir y comparar los distintos sistemas numéricos.', '2022-06-08 09:40:52', 1),
                                                                                                                (341, 1, 'a:1:{i:0;s:2:\"11\";}', 'Justifica la validez de las propiedades de orden de los números reales y las utiliza para resolver problemas analíticos que se modelen con inecuaciones.', '2022-06-08 09:41:15', 1),
                                                                                                                (342, 1, 'a:1:{i:0;s:2:\"11\";}', 'Utiliza instrumentos, unidades de medida, sus relaciones y la noción de derivada como razón de cambio, para resolver problemas, estimar cantidades y juzgar la pertinencia de las soluciones de acuerdo al contexto.', '2022-06-08 09:41:40', 1),
                                                                                                                (343, 1, 'a:1:{i:0;s:2:\"11\";}', 'Interpreta y diseña técnicas para hacer mediciones con niveles crecientes de precisión (uso de diferentes instrumentos para la misma medición, revisión de escalas y rangos de medida, estimaciones, verificaciones a través de mediciones indirectas).', '2022-06-08 09:42:14', 1),
                                                                                                                (344, 1, 'a:1:{i:0;s:1:\"4\";}', 'Interpreta la noción de derivada como razón de cambio y como valor de la pendiente de la tangente a una curva y desarrolla métodos para hallar las derivadas de algunas\r\nfunciones básicas en contextos matemáticos y no matemáticos.', '2022-06-08 09:42:48', 1),
                                                                                                                (345, 2, 'a:1:{i:0;s:2:\"11\";}', 'Modela objetos geométricos en diversos sistemas de coordenadas (cartesiano, polar, esférico) y realiza comparaciones y toma decisiones con respecto a los modelos', '2022-06-08 09:43:20', 1),
                                                                                                                (346, 1, 'a:1:{i:0;s:2:\"11\";}', 'Interpreta la noción de derivada como razón de cambio y como valor de la pendiente de la tangente a una curva y desarrolla métodos para hallar las derivadas de algunas\r\nfunciones básicas en contextos matemáticos y no matemáticos.', '2022-06-08 09:48:46', 1),
                                                                                                                (347, 1, 'a:1:{i:0;s:2:\"11\";}', 'Modela objetos geométricos en diversos sistemas de coordenadas (cartesiano, polar, esférico) y realiza comparaciones y toma decisiones con respecto a los modelos.', '2022-06-08 09:49:07', 1),
                                                                                                                (348, 1, 'a:1:{i:0;s:2:\"11\";}', 'Usa propiedades y modelos funcionales para analizar situaciones y para establecer relaciones funcionales entre variables que permiten estudiar la variación en situaciones intraescolares y extraescolares.', '2022-06-08 09:49:32', 1),
                                                                                                                (349, 1, 'a:1:{i:0;s:2:\"11\";}', 'Encuentra derivadas de funciones, reconoce sus propiedades y las utiliza para resolver problemas.', '2022-06-08 09:49:54', 1),
                                                                                                                (350, 1, 'a:1:{i:0;s:2:\"11\";}', 'Plantea y resuelve situaciones problemáticas del contexto real y/o matemático que implican la exploración de posibles asociaciones o correlaciones entre las variables estudiadas.', '2022-06-08 09:50:31', 1),
                                                                                                                (351, 1, 'a:1:{i:0;s:2:\"11\";}', 'Plantea y resuelve problemas en los que se reconoce cuando dos eventos son o no independientes y usa la probabilidad condicional para comprobarlo.', '2022-06-08 09:50:54', 1),
                                                                                                                (352, 5, 'null', 'Toma decisiones frente a algunas situaciones cotidianas.', '2022-06-08 09:57:47', 0),
                                                                                                                (353, 5, 'a:1:{i:0;s:1:\"0\";}', 'Toma decisiones frente a algunas situaciones cotidianas.', '2022-06-09 18:38:51', 1),
                                                                                                                (354, 5, 'a:1:{i:0;s:1:\"0\";}', 'Se apropia de hábitos y prácticas para el cuidado personal y de su entorno.', '2022-06-09 18:39:12', 1),
                                                                                                                (355, 5, 'a:1:{i:0;s:1:\"0\";}', 'Identifica y valora las características corporales y emocionales en sí mismo y en los demás.', '2022-06-09 18:39:33', 1),
                                                                                                                (356, 5, 'a:1:{i:0;s:1:\"0\";}', 'Reconoce que es parte de una familia, de una comunidad y un territorio con costumbres, valores y tradiciones.', '2022-06-09 18:39:53', 1),
                                                                                                                (357, 5, 'a:1:{i:0;s:1:\"0\";}', 'Participa en la construcción colectiva de acuerdos, objetivos y proyectos comunes.', '2022-06-09 18:42:33', 1),
                                                                                                                (358, 5, 'a:1:{i:0;s:1:\"0\";}', 'Demuestra consideración y respeto al relacionarse con otros.', '2022-06-09 18:42:50', 1),
                                                                                                                (359, 5, 'a:1:{i:0;s:1:\"0\";}', 'Expresa y representa lo que observa, siente, piensa e imagina, a través del juego, la música, el dibujo y la expresión corporal.', '2022-06-09 18:43:17', 1),
                                                                                                                (360, 5, 'a:1:{i:0;s:1:\"0\";}', 'Identifica las relaciones sonoras en el lenguaje oral.', '2022-06-09 18:43:39', 1),
                                                                                                                (361, 5, 'a:1:{i:0;s:1:\"0\";}', 'Establece relaciones e interpreta imágenes, letras, objetos, personajes que encuentra en distintos tipos de textos.', '2022-06-09 18:44:06', 1),
                                                                                                                (362, 5, 'a:1:{i:0;s:1:\"0\";}', 'Expresa ideas, intereses y emociones a través de sus propias grafías y formas semejantes a las letras convencionales en formatos con diferentes intenciones comunicativas.', '2022-06-09 18:44:30', 1),
                                                                                                                (363, 5, 'a:1:{i:0;s:1:\"0\";}', 'Crea situaciones y propone alternativas de solución a problemas cotidianos a partir de sus conocimientos e imaginación.', '2022-06-09 18:44:51', 1),
                                                                                                                (364, 5, 'a:1:{i:0;s:1:\"0\";}', 'Establece relaciones entre las causas y consecuencias de los acontecimientos que le suceden a él o a su alrededor.', '2022-06-09 18:45:12', 1),
                                                                                                                (365, 5, 'a:1:{i:0;s:1:\"0\";}', 'Usa diferentes herramientas y objetos con variadas posibilidades.', '2022-06-09 18:45:32', 1),
                                                                                                                (366, 5, 'a:1:{i:0;s:1:\"0\";}', 'Construye nociones de espacio, tiempo y medida a través de experiencias cotidianas.', '2022-06-09 18:45:48', 1),
                                                                                                                (367, 5, 'a:1:{i:0;s:1:\"0\";}', 'Compara, ordena, clasifica objetos e identifica patrones de acuerdo con diferentes criterios.', '2022-06-09 18:46:07', 1),
                                                                                                                (368, 5, 'a:1:{i:0;s:1:\"0\";}', 'Determina la cantidad de objetos que conforman una colección, al establecer relaciones de correspondencia y acciones de juntar y separar.', '2022-06-09 18:46:27', 1),
                                                                                                                (369, 5, 'a:1:{i:0;s:1:\"0\";}', 'Determina la cantidad de objetos que conforman una colección, al establecer relaciones de correspondencia y acciones de juntar y separar.', '2022-06-09 18:46:55', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion_estandar`
--

CREATE TABLE `caracterizacion_estandar` (
                                            `id_estandar` int(11) NOT NULL,
                                            `id_area` int(11) NOT NULL,
                                            `grado` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                            `descripcion_estandar` mediumtext COLLATE utf8_spanish2_ci NOT NULL,
                                            `estado` tinyint(1) NOT NULL DEFAULT '1',
                                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_estandar`
--

INSERT INTO `caracterizacion_estandar` (`id_estandar`, `id_area`, `grado`, `descripcion_estandar`, `estado`, `created_at`) VALUES
                                                                                                                               (1, 1, 'a:1:{i:0;s:1:\"2\";}', 'Test', 0, '2022-05-25 19:50:04'),
                                                                                                                               (2, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco significados del número en diferentes contextos (medición, conteo, comparación, codificación, localización entre otros).', 1, '2022-06-09 18:51:15'),
                                                                                                                               (3, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo, comparo y cuantifico situaciones con números, en diferentes contextos y con diversas representaciones.', 1, '2022-06-09 18:51:41'),
                                                                                                                               (4, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo situaciones que requieren el uso de medidas relativas.', 1, '2022-06-09 18:52:00'),
                                                                                                                               (5, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo situaciones de medición utilizando fracciones comunes.', 1, '2022-06-09 18:52:17'),
                                                                                                                               (6, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso representaciones –principalmente concretas y pictóricas– para explicar el valor de posición en el sistema de numeración decimal.', 1, '2022-06-09 18:52:59'),
                                                                                                                               (7, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso representaciones –principalmente concretas y pictóricas– para realizar equivalencias de un número en las diferentes unidades del sistema decimal.', 1, '2022-06-09 19:03:42'),
                                                                                                                               (8, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco propiedades de los números (ser par, ser impar, etc.) y relaciones entre ellos (ser mayor que, ser menor que, ser múltiplo de, ser divisible por, etc.) en diferentes contextos.', 1, '2022-06-09 19:04:07'),
                                                                                                                               (9, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Resuelvo y formulo problemas en situaciones aditivas de composición y de transformación.', 1, '2022-06-09 19:04:26'),
                                                                                                                               (10, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Resuelvo y formulo problemas en situaciones de variación proporcional.', 1, '2022-06-09 19:04:45'),
                                                                                                                               (11, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso diversas estrategias de cálculo (especialmente cálculo mental) y de estimación para resolver problemas en situaciones aditivas y multiplicativas.', 1, '2022-06-09 19:05:11'),
                                                                                                                               (12, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico, si a la luz de los datos de un problema, los resultados obtenidos son o no razonables.', 1, '2022-06-09 19:05:39'),
                                                                                                                               (13, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico regularidades y propiedades de los números utilizando diferentes instrumentos de cálculo (calculadoras, ábacos, bloques multibase, etc.).', 1, '2022-06-09 19:06:04'),
                                                                                                                               (14, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Diferencio atributos y propiedades de objetos tridimensionales.', 1, '2022-06-09 19:07:00'),
                                                                                                                               (15, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Dibujo y describo cuerpos o figuras tridimensionales en distintas posiciones y tamaños.', 1, '2022-06-09 19:07:18'),
                                                                                                                               (16, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco nociones de horizontalidad, verticalidad, paralelismo y perpendicularidad en distintos contextos y su condición relativa con respecto a diferentes sistemas de\r\nreferencia.', 1, '2022-06-09 19:07:40'),
                                                                                                                               (17, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Represento el espacio circundante para establecer relaciones espaciales.', 1, '2022-06-09 19:07:59'),
                                                                                                                               (18, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y aplico traslaciones y giros sobre una figura.', 1, '2022-06-09 19:08:16'),
                                                                                                                               (19, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y valoro simetrías en distintos aspectos del arte y el diseño.', 1, '2022-06-09 19:08:34'),
                                                                                                                               (20, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco congruencia y semejanza entre figuras (ampliar, reducir).', 1, '2022-06-09 19:08:57'),
                                                                                                                               (21, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Realizo construcciones y diseños utilizando cuerpos y figuras geométricas tridimensionales y dibujos o figuras geométricas bidimensionales.', 1, '2022-06-09 19:09:19'),
                                                                                                                               (22, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Desarrollo habilidades para relacionar dirección, distancia y posición en el espacio.', 1, '2022-06-09 19:09:37'),
                                                                                                                               (23, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco en los objetos propiedades o atributos que se puedan medir (longitud, área, volumen, capacidad, peso y masa) y, en los eventos, su duración.', 1, '2022-06-09 19:10:08'),
                                                                                                                               (24, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comparo y ordeno objetos respecto a atributos medibles.', 1, '2022-06-09 19:10:25'),
                                                                                                                               (25, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Realizo y describo procesos de medición con patrones arbitrarios y algunos estandarizados, de acuerdo al contexto.', 1, '2022-06-09 19:10:56'),
                                                                                                                               (26, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Analizo y explico sobre la pertinencia de patrones e instrumentos en procesos de medición.', 1, '2022-06-09 19:11:15'),
                                                                                                                               (27, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Realizo estimaciones de medidas requeridas en la resolución de problemas relativos particularmente a la vida social, económica y de las ciencias.', 1, '2022-06-09 19:11:51'),
                                                                                                                               (28, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco el uso de las magnitudes y sus unidades de medida en situaciones aditivas y multiplicativas.', 1, '2022-06-09 19:12:12'),
                                                                                                                               (29, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Clasifico y organizo datos de acuerdo a cualidades y atributos y los presento en tablas.', 1, '2022-06-09 19:12:42'),
                                                                                                                               (30, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Interpreto cualitativamente datos referidos a situaciones del entorno escolar.', 1, '2022-06-09 19:13:05'),
                                                                                                                               (31, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo situaciones o eventos a partir de un conjunto de datos.', 1, '2022-06-09 19:13:24'),
                                                                                                                               (32, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Represento datos relativos a mi entorno usando objetos concretos, pictogramas y diagramas de barras.', 1, '2022-06-09 19:13:46'),
                                                                                                                               (33, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico regularidades y tendencias en un conjunto de datos.', 1, '2022-06-09 19:14:04'),
                                                                                                                               (34, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Explico –desde mi experiencia– la posibilidad o imposibilidad de ocurrencia de eventos cotidianos.', 1, '2022-06-09 19:14:27'),
                                                                                                                               (35, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Predigo si la posibilidad de ocurrencia de un evento es mayor que la de otro.', 1, '2022-06-09 19:14:47'),
                                                                                                                               (36, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Resuelvo y formulo preguntas que requieran para su solución coleccionar y analizar datos del entorno próximo.', 1, '2022-06-09 19:15:13'),
                                                                                                                               (37, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y describo regularidades y patrones en distintos contextos (numérico, geométrico, musical, entre otros).', 1, '2022-06-09 19:15:42'),
                                                                                                                               (38, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo cualitativamente situaciones de cambio y variación utilizando el lenguaje natural, dibujos y gráficas.', 1, '2022-06-09 19:16:05'),
                                                                                                                               (39, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y genero equivalencias entre expresiones numéricas y describo cómo cambian los símbolos aunque el valor siga igual.', 1, '2022-06-09 19:16:27'),
                                                                                                                               (40, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Construyo secuencias numéricas y geométricas utilizando propiedades de los números y de las figuras geométricas.', 1, '2022-06-09 19:16:54'),
                                                                                                                               (41, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Interpreto las fracciones en diferentes contextos: situaciones de medición, relaciones parte todo, cociente, razones y proporciones.', 1, '2022-06-09 19:18:11'),
                                                                                                                               (42, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y uso medidas relativas en distintos contextos.', 1, '2022-06-09 19:18:39'),
                                                                                                                               (43, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo la notación decimal para expresar fracciones en diferentes contextos y relaciono estas dos notaciones con la de los porcentajes.', 1, '2022-06-09 19:19:07'),
                                                                                                                               (44, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Justifico el valor de posición en el sistema de numeración decimal en relación con el conteo recurrente de unidades.', 1, '2022-06-09 19:19:31'),
                                                                                                                               (45, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Resuelvo y formulo problemas cuya estrategia de solución requiera de las relaciones y propiedades de los números naturales y sus operaciones.', 1, '2022-06-09 19:19:55'),
                                                                                                                               (46, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Resuelvo y formulo problemas en situaciones aditivas de composición, transformación, comparación e igualación.', 1, '2022-06-09 19:20:15'),
                                                                                                                               (47, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Resuelvo y formulo problemas en situaciones de proporcionalidad directa, inversa y producto de medidas.', 1, '2022-06-09 19:20:35'),
                                                                                                                               (48, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico la potenciación y la radicación en contextos matemáticos y no matemáticos.', 1, '2022-06-09 19:21:00'),
                                                                                                                               (49, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Modelo situaciones de dependencia mediante la proporcionalidad directa e inversa.', 1, '2022-06-09 19:21:22'),
                                                                                                                               (50, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Uso diversas estrategias de cálculo y de estimación para resolver problemas en situaciones aditivas y multiplicativas.', 1, '2022-06-09 19:21:40'),
                                                                                                                               (51, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico, en el contexto de una situación, la necesidad de un cálculo exacto o aproximado y lo razonable de los resultados obtenidos.', 1, '2022-06-09 19:22:06'),
                                                                                                                               (52, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Justifico regularidades y propiedades de los números, sus relaciones y operaciones.', 1, '2022-06-09 19:22:32'),
                                                                                                                               (53, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo y clasifico objetos tridimensionales de acuerdo con componentes (caras, lados) y propiedades.', 1, '2022-06-09 19:22:50'),
                                                                                                                               (54, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo y clasifico figuras bidimensionales de acuerdo con sus componentes (ángulos, vértices) y características.', 1, '2022-06-09 19:23:19'),
                                                                                                                               (55, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico, represento y utilizo ángulos en giros, aberturas, inclinaciones, figuras, puntas y esquinas en situaciones estáticas y dinámicas.', 1, '2022-06-09 19:23:43'),
                                                                                                                               (56, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo sistemas de coordenadas para especificar localizaciones y describir relaciones espaciales.', 1, '2022-06-09 19:24:06'),
                                                                                                                               (57, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y justifico relaciones de congruencia y semejanza entre figuras.', 1, '2022-06-09 19:24:40'),
                                                                                                                               (58, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Construyo y descompongo figuras y sólidos a partir de condiciones dadas.', 1, '2022-06-09 19:25:00'),
                                                                                                                               (59, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Conjeturo y verifico los resultados de aplicar transformaciones a figuras en el plano para construir diseños.', 1, '2022-06-09 19:25:23'),
                                                                                                                               (60, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Construyo objetos tridimensionales a partir de representaciones bidimensionales y puedo realizar el proceso contrario en contextos de arte, diseño y arquitectura.', 1, '2022-06-09 19:25:45'),
                                                                                                                               (61, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Diferencio y ordeno, en objetos y eventos, propiedades o atributos que se puedan medir (longitudes, distancias, áreas de superficies, volúmenes de cuerpos sólidos, volúmenes de líquidos y capacidades de recipientes; pesos y masa de cuerpos sólidos; duración de eventos o procesos; amplitud de ángulos).', 1, '2022-06-09 19:26:38'),
                                                                                                                               (62, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Selecciono unidades, tanto convencionales como estandarizadas, apropiadas para diferentes mediciones.', 1, '2022-06-09 19:27:03'),
                                                                                                                               (63, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo y justifico el uso de la estimación para resolver problemas relativos a la vida social, económica y de las ciencias, utilizando rangos de variación.', 1, '2022-06-09 19:27:31'),
                                                                                                                               (64, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo diferentes procedimientos de cálculo para hallar el área de la superficie exterior y el volumen de algunos cuerpos sólidos.', 1, '2022-06-09 19:27:52'),
                                                                                                                               (65, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Justifico relaciones de dependencia del área y volumen, respecto a las dimensiones de figuras y sólidos.', 1, '2022-06-09 19:28:17'),
                                                                                                                               (66, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco el uso de algunas magnitudes (longitud, área, volumen, capacidad, peso y masa, duración, rapidez, temperatura) y de algunas de las unidades que se usan para medir cantidades de la magnitud respectiva en situaciones aditivas y multiplicativas.', 1, '2022-06-09 19:28:49'),
                                                                                                                               (67, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo y argumento relaciones entre el perímetro y el área de figuras diferentes, cuando se fija una de estas medidas.', 1, '2022-06-09 19:29:11'),
                                                                                                                               (68, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Represento datos usando tablas y gráficas (pictogramas, gráficas de barras, diagramas de líneas, diagramas circulares).', 1, '2022-06-09 19:29:36'),
                                                                                                                               (69, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo diferentes representaciones del mismo conjunto de datos.', 1, '2022-06-09 19:30:00'),
                                                                                                                               (70, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Interpreto información presentada en tablas y gráficas. (pictogramas, gráficas de barras, diagramas de líneas, diagramas circulares).', 1, '2022-06-09 19:30:47'),
                                                                                                                               (71, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Conjeturo y pongo a prueba predicciones acerca de la posibilidad de ocurrencia de eventos.', 1, '2022-06-09 19:31:07'),
                                                                                                                               (72, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo la manera como parecen distribuirse los distintos datos de un conjunto de ellos y la comparo con la manera como se distribuyen en otros conjuntos de datos.', 1, '2022-06-09 19:31:29'),
                                                                                                                               (73, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Uso e interpreto la media (o promedio) y la mediana y comparo lo que indican.', 1, '2022-06-09 19:31:51'),
                                                                                                                               (74, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Resuelvo y formulo problemas a partir de un conjunto de datos provenientes de observaciones, consultas o experimentos.', 1, '2022-06-09 19:32:16'),
                                                                                                                               (75, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo e interpreto variaciones representadas en gráficos.', 1, '2022-06-09 19:32:36'),
                                                                                                                               (76, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Predigo patrones de variación en una secuencia numérica, geométrica o gráfica.', 1, '2022-06-09 19:33:00'),
                                                                                                                               (77, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Represento y relaciono patrones numéricos con tablas y reglas verbales.', 1, '2022-06-09 19:33:21'),
                                                                                                                               (78, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Analizo y explico relaciones de dependencia entre cantidades que varían en el tiempo con cierta regularidad en situaciones económicas, sociales y de las ciencias naturales.', 1, '2022-06-09 19:33:52'),
                                                                                                                               (79, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Construyo igualdades y desigualdades numéricas como representación de relaciones entre distintos datos.', 1, '2022-06-09 19:34:14'),
                                                                                                                               (80, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas en contextos de medidas relativas y de variaciones en las medidas', 1, '2022-06-10 08:41:55'),
                                                                                                                               (81, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo números racionales, en sus distintas expresiones (fracciones, razones, decimales o porcentajes) para resolver problemas en contextos de medida.', 1, '2022-06-10 08:42:18'),
                                                                                                                               (82, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico la extensión de la representación polinomial decimal usual de los números naturales a la representación decimal usual de los números racionales, utilizando las\r\npropiedades del sistema de numeración decimal.', 1, '2022-06-10 08:42:51'),
                                                                                                                               (83, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco y generalizo propiedades de las relaciones entre números racionales (simétrica, transitiva, etc.) y de las operaciones entre ellos (conmutativa, asociativa, etc.)\r\nen diferentes contextos.', 1, '2022-06-10 08:43:14'),
                                                                                                                               (84, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas utilizando propiedades básicas de la teoría de números, como las de la igualdad, las de las distintas formas de la desigualdad y las de la adición, sustracción, multiplicación, división y potenciación.', 1, '2022-06-10 08:43:43'),
                                                                                                                               (85, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico procedimientos aritméticos utilizando las relaciones y propiedades de las operaciones.', 1, '2022-06-10 08:44:04'),
                                                                                                                               (86, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo y resuelvo problemas en situaciones aditivas y multiplicativas, en diferentes contextos y dominios numéricos.', 1, '2022-06-10 08:44:25'),
                                                                                                                               (87, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas cuya solución requiere de la potenciación o radicación.', 1, '2022-06-10 08:44:42'),
                                                                                                                               (88, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico el uso de representaciones y procedimientos en situaciones de proporcionalidad directa e inversa.', 1, '2022-06-10 08:45:07'),
                                                                                                                               (89, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico la pertinencia de un cálculo exacto o aproximado en la solución de un problema y lo razonable o no de las respuestas obtenidas.', 1, '2022-06-10 08:45:31'),
                                                                                                                               (90, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco conjeturas sobre propiedades y relaciones de los números, utilizando calculadoras o computadores.', 1, '2022-06-10 08:45:50'),
                                                                                                                               (91, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico la elección de métodos e instrumentos de cálculo en la resolución de problemas.', 1, '2022-06-10 08:46:13'),
                                                                                                                               (92, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco argumentos combinatorios como herramienta para interpretación de situaciones diversas de conteo.', 1, '2022-06-10 08:46:30'),
                                                                                                                               (93, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Represento objetos tridimensionales desde diferentes posiciones y vistas.', 1, '2022-06-10 08:47:38'),
                                                                                                                               (94, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y describo figuras y cuerpos generados por cortes rectos y transversales de objetos tridimensionales.', 1, '2022-06-10 08:47:56'),
                                                                                                                               (95, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico polígonos en relación con sus propiedades.', 1, '2022-06-10 08:48:12'),
                                                                                                                               (96, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Predigo y comparo los resultados de aplicar transformaciones rígidas (traslaciones, rotaciones, reflexiones) y homotecias (ampliaciones y reducciones) sobre figuras\r\nbidimensionales en situaciones matemáticas y en el arte.', 1, '2022-06-10 08:48:58'),
                                                                                                                               (97, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas que involucren relaciones y propiedades de semejanza y congruencia usando representaciones visuales.', 1, '2022-06-10 08:49:45'),
                                                                                                                               (98, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas usando modelos geométricos.', 1, '2022-06-10 08:50:04'),
                                                                                                                               (99, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico características de localización de objetos en sistemas de representación cartesiana y geográfica.', 1, '2022-06-10 08:50:23'),
                                                                                                                               (100, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo técnicas y herramientas para la construcción de figuras planas y cuerpos con medidas dadas.', 1, '2022-06-10 08:50:44'),
                                                                                                                               (101, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas que involucren factores escalares (diseño de maquetas, mapas).', 1, '2022-06-10 08:51:47'),
                                                                                                                               (102, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Calculo áreas y volúmenes a través de composición y descomposición de figuras y cuerpos.', 1, '2022-06-10 08:52:13'),
                                                                                                                               (103, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico relaciones entre distintas unidades utilizadas para medir cantidades de la misma magnitud.', 1, '2022-06-10 08:52:38'),
                                                                                                                               (104, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas que requieren técnicas de estimación.', 1, '2022-06-10 08:53:00'),
                                                                                                                               (105, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo e interpreto datos provenientes de diversas fuentes (prensa, revistas, televisión, experimentos, consultas, entrevistas).', 1, '2022-06-10 08:53:24'),
                                                                                                                               (106, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco la relación entre un conjunto de datos y su representación.', 1, '2022-06-10 08:53:40'),
                                                                                                                               (107, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Interpreto, produzco y comparo representaciones gráficas adecuadas para presentar diversos tipos de datos. (diagramas de barras, diagramas circulares.)', 1, '2022-06-10 08:54:05'),
                                                                                                                               (108, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Uso medidas de tendencia central (media, mediana, moda) para interpretar comportamiento de un conjunto de datos.', 1, '2022-06-10 08:54:30'),
                                                                                                                               (109, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Uso modelos (diagramas de árbol, por ejemplo) para discutir y predecir posibilidad de ocurrencia de un evento.', 1, '2022-06-10 08:54:53'),
                                                                                                                               (110, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Conjeturo acerca del resultado de un experimento aleatorio usando proporcionalidad y nociones básicas de probabilidad.', 1, '2022-06-10 08:56:09'),
                                                                                                                               (111, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Resuelvo y formulo problemas a partir de un conjunto de datos presentados en tablas, diagramas de barras, diagramas circulares.', 1, '2022-06-10 08:56:30'),
                                                                                                                               (112, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Predigo y justifico razonamientos y conclusiones usando información estadística.', 1, '2022-06-10 08:56:55'),
                                                                                                                               (113, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo y represento situaciones de variación relacionando diferentes representaciones (diagramas, expresiones verbales generalizadas y tablas).', 1, '2022-06-10 08:57:20'),
                                                                                                                               (114, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco el conjunto de valores de cada una de las cantidades variables ligadas entre sí en situaciones concretas de cambio (variación).', 1, '2022-06-10 08:57:49'),
                                                                                                                               (115, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo las propiedades de correlación positiva y negativa entre variables, de variación lineal o de proporcionalidad directa y de proporcionalidad inversa en contextos\r\naritméticos y geométricos.', 1, '2022-06-10 08:58:20'),
                                                                                                                               (116, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo métodos informales (ensayo y error, complementación) en la solución de ecuaciones.', 1, '2022-06-10 08:58:46'),
                                                                                                                               (117, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico las características de las diversas gráficas cartesianas (de puntos, continuas, formadas por segmentos, etc.) en relación con la situación que representan.', 1, '2022-06-10 08:59:21'),
                                                                                                                               (118, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo números reales en sus diferentes representaciones y en diversos contextos.', 1, '2022-06-10 09:02:02'),
                                                                                                                               (119, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Resuelvo problemas y simplifico cálculos usando propiedades y relaciones de los números reales y de las relaciones y operaciones entre ellos.', 1, '2022-06-10 09:02:33'),
                                                                                                                               (120, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo la notación científica para representar medidas de cantidades de diferentes magnitudes.', 1, '2022-06-10 09:03:20'),
                                                                                                                               (121, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y utilizo la potenciación, la radicación y la logaritmación para representar situaciones matemáticas y no matemáticas y para resolver problemas.', 1, '2022-06-10 09:03:43'),
                                                                                                                               (122, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Conjeturo y verifico propiedades de congruencias y semejanzas entre figuras bidimensionales y entre objetos tridimensionales en la solución de problemas.', 1, '2022-06-10 09:04:08'),
                                                                                                                               (123, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco y contrasto propiedades y relaciones geométricas utilizadas en demostración de teoremas básicos (Pitágoras y Tales).', 1, '2022-06-10 09:04:28'),
                                                                                                                               (124, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Aplico y justifico criterios de congruencias y semejanza entre triángulos en la resolución y formulación de problemas.', 1, '2022-06-10 09:04:55'),
                                                                                                                               (125, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso representaciones geométricas para resolver y formular problemas en las matemáticas y en otras disciplinas.', 1, '2022-06-10 09:05:17'),
                                                                                                                               (126, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Generalizo procedimientos de cálculo válidos para encontrar el área de regiones planas y el volumen de sólidos.', 1, '2022-06-10 09:05:47'),
                                                                                                                               (127, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Selecciono y uso técnicas e instrumentos para medir longitudes, áreas de superficies, volúmenes y ángulos con niveles de precisión apropiados.', 1, '2022-06-10 09:06:21'),
                                                                                                                               (128, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Justifico la pertinencia de utilizar unidades de medida estandarizadas en situaciones tomadas de distintas ciencias.', 1, '2022-06-10 09:06:46'),
                                                                                                                               (129, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco cómo diferentes maneras de presentación de información pueden originar distintas interpretaciones.', 1, '2022-06-10 09:07:20'),
                                                                                                                               (130, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Interpreto analítica y críticamente información estadística proveniente de diversas fuentes (prensa, revistas, televisión, experimentos, consultas, entrevistas.', 1, '2022-06-10 09:07:50'),
                                                                                                                               (131, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Interpreto y utilizo conceptos de media, mediana y moda y explicito sus diferencias en distribuciones de distinta dispersión y asimetría', 1, '2022-06-10 09:08:20'),
                                                                                                                               (132, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Selecciono y uso algunos métodos estadísticos adecuados al tipo de problema, de información y al nivel de la escala en la que esta se representa (nominal, ordinal, de intervalo o de razón).', 1, '2022-06-10 09:08:47'),
                                                                                                                               (133, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo resultados de experimentos aleatorios con los resultados previstos por un modelo matemático probabilístico.', 1, '2022-06-10 09:09:10'),
                                                                                                                               (134, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Resuelvo y formulo problemas seleccionando información relevante en conjuntos de datos provenientes de fuentes diversas. (prensa, revistas, televisión, experimentos, consultas, entrevistas).', 1, '2022-06-10 09:09:49'),
                                                                                                                               (135, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco tendencias que se presentan en conjuntos de variables relacionadas.', 1, '2022-06-10 09:10:14'),
                                                                                                                               (136, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Calculo probabilidad de eventos simples usando métodos diversos (listados, diagramas de árbol, técnicas de conteo).', 1, '2022-06-10 09:10:40'),
                                                                                                                               (137, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso conceptos básicos de probabilidad (espacio muestral, evento, independencia, etc.).', 1, '2022-06-10 09:14:45'),
                                                                                                                               (138, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico relaciones entre propiedades de las gráficas y propiedades de las ecuaciones algebraicas.', 1, '2022-06-10 09:15:10'),
                                                                                                                               (139, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Construyo expresiones algebraicas equivalentes a una expresión algebraica dada.', 1, '2022-06-10 09:15:37'),
                                                                                                                               (140, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso procesos inductivos y lenguaje algebraico para formular y poner a prueba conjeturas.', 1, '2022-06-10 09:15:55'),
                                                                                                                               (141, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Modelo situaciones de variación con funciones polinómicas.', 1, '2022-06-10 09:16:11'),
                                                                                                                               (142, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico diferentes métodos para solucionar sistemas de ecuaciones lineales.', 1, '2022-06-10 09:16:31'),
                                                                                                                               (143, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo los procesos infinitos que subyacen en las notaciones decimales.', 1, '2022-06-10 09:16:54'),
                                                                                                                               (144, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y utilizo diferentes maneras de definir y medir la pendiente de una curva que representa en el plano cartesiano situaciones de variación.', 1, '2022-06-10 09:17:20'),
                                                                                                                               (145, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico la relación entre los cambios en los parámetros de la representación algebraica de una familia de funciones y los cambios en las gráficas que las representan.', 1, '2022-06-10 09:17:49'),
                                                                                                                               (146, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo en representaciones gráficas cartesianas los comportamientos de cambio de funciones específicas pertenecientes a familias de funciones polinómicas, racionales, exponenciales y logarítmicas.', 1, '2022-06-10 09:18:23'),
                                                                                                                               (147, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo representaciones decimales de los números reales para diferenciar entre racionales e irracionales.', 1, '2022-06-10 09:20:52'),
                                                                                                                               (148, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco la densidad e incompletitud de los números racionales a través de métodos numéricos, geométricos y algebraicos.', 1, '2022-06-10 09:21:11'),
                                                                                                                               (149, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comparo y contrasto las propiedades de los números (naturales, enteros, racionales y reales) y las de sus relaciones y operaciones para construir, manejar y utilizar\r\napropiadamente los distintos sistemas numéricos.', 1, '2022-06-10 09:21:34'),
                                                                                                                               (150, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo argumentos de la teoría de números para justificar relaciones que involucran números naturales.', 1, '2022-06-10 09:21:53'),
                                                                                                                               (151, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones y diferencias entre diferentes notaciones de números reales para decidir sobre su uso en una situación dada.', 1, '2022-06-10 09:22:12'),
                                                                                                                               (152, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico en forma visual, gráfica y algebraica algunas propiedades de las curvas que se observan en los bordes obtenidos por cortes longitudinales, diagonales y transversales en un cilindro y en un cono.', 1, '2022-06-10 09:22:41'),
                                                                                                                               (153, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico características de localización de objetos geométricos en sistemas de representación cartesiana y otros (polares, cilíndricos y esféricos) y en particular de\r\nlas curvas y figuras cónicas.', 1, '2022-06-10 09:23:20'),
                                                                                                                               (154, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Resuelvo problemas en los que se usen las propiedades geométricas de figuras cónicas por medio de transformaciones de las representaciones algebraicas de esas figu\r\nras.', 1, '2022-06-10 09:23:44'),
                                                                                                                               (155, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso argumentos geométricos para resolver y formular problemas en contextos matemáticos y en otras ciencias.', 1, '2022-06-10 09:24:04'),
                                                                                                                               (156, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo y modelo fenómenos periódicos del mundo real usando relaciones y funciones trigonométricas.', 1, '2022-06-10 09:24:27'),
                                                                                                                               (157, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco y describo curvas y o lugares geométricos.', 1, '2022-06-10 09:24:51'),
                                                                                                                               (158, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Diseño estrategias para abordar situaciones de medición que requieran grados de precisión específicos.', 1, '2022-06-10 09:25:23'),
                                                                                                                               (159, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Resuelvo y formulo problemas que involucren magnitudes cuyos valores medios se suelen definir indirectamente como razones entre valores de otras magnitudes, como\r\nla velocidad media, la aceleración media y la densidad media.', 1, '2022-06-10 09:25:51'),
                                                                                                                               (160, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Justifico resultados obtenidos mediante procesos de aproximación sucesiva, rangos de variación y límites en situaciones de medición', 0, '2022-06-10 09:27:17'),
                                                                                                                               (161, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Justifico resultados obtenidos mediante procesos de aproximación sucesiva, rangos de variación y límites en situaciones de medición.', 1, '2022-06-10 09:28:45'),
                                                                                                                               (162, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto y comparo resultados de estudios con información estadística provenientes de medios de comunicación.', 1, '2022-06-10 09:29:44'),
                                                                                                                               (163, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Justifico o refuto inferencias basadas en razonamientos estadísticos a partir de resultados de estudios publicados en los medios o diseñados\r\nen el ámbito escolar.', 1, '2022-06-10 09:30:17'),
                                                                                                                               (164, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Diseño experimentos aleatorios (de las ciencias físicas, naturales o sociales) para estudiar un problema o pregunta.', 1, '2022-06-10 09:30:38'),
                                                                                                                               (165, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo tendencias que se observan en conjuntos de variables relacionadas.', 1, '2022-06-10 09:31:02'),
                                                                                                                               (166, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto nociones básicas relacionadas con el manejo de información como población, muestra, variable aleatoria, distribución de frecuencias, parámetros y estadígrafos).', 1, '2022-06-10 09:31:34'),
                                                                                                                               (167, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso comprensivamente algunas medidas de centralización, localización, dispersión y correlación (percentiles, cuartiles, centralidad, distancia, rango, varianza, covarianza y normalidad).', 1, '2022-06-10 09:32:07'),
                                                                                                                               (168, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto conceptos de probabilidad condicional e independencia de eventos.', 1, '2022-06-10 09:32:35'),
                                                                                                                               (169, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto conceptos de probabilidad condicional e independencia de eventos.', 1, '2022-06-10 09:33:28'),
                                                                                                                               (170, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Resuelvo y planteo problemas usando conceptos básicos de conteo y probabilidad (combinaciones, permutaciones, espacio muestral, muestreo aleatorio, muestreo con\r\nremplazo).', 1, '2022-06-10 09:33:58'),
                                                                                                                               (171, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Propongo inferencias a partir del estudio de muestras probabilísticas.', 1, '2022-06-10 09:34:29'),
                                                                                                                               (172, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo las técnicas de aproximación en procesos infinitos numéricos.', 1, '2022-06-10 09:34:53'),
                                                                                                                               (173, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto la noción de derivada como razón de cambio y como valor de la pendiente de la tangente a una curva y desarrollo métodos para hallar las derivadas de algunas\r\nfunciones básicas en contextos matemáticos y no matemáticos.', 1, '2022-06-10 09:35:23'),
                                                                                                                               (174, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo las relaciones y propiedades entre las expresiones algebraicas y las gráficas de funciones polinómicas y racionales y de sus derivadas.', 1, '2022-06-10 09:35:52'),
                                                                                                                               (175, 1, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Modelo situaciones de variación periódica con funciones trigonométricas e interpreto y utilizo sus derivadas.', 1, '2022-06-10 09:36:25'),
                                                                                                                               (176, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo la importancia de algunos artefactos en el desarrollo de actividades cotidianas de mi entorno y el de mis antepasados.', 1, '2022-06-10 10:23:08'),
                                                                                                                               (177, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico algunos artefactos, productos y procesos de mi entorno cotidiano, explico algunos aspectos de su funcionamiento y los utilizo en forma segura y apropiada.', 1, '2022-06-10 10:23:38'),
                                                                                                                               (178, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico productos tecnológicos, en particular artefactos, para solucionar problemas de la vida cotidiana.', 1, '2022-06-10 10:24:07'),
                                                                                                                               (179, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Exploro mi entorno cotidiano y reconozco la presencia de elementos naturales y de artefactos elaborados con la intención de mejorar las condiciones de vida.', 1, '2022-06-10 10:24:49'),
                                                                                                                               (180, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco objetos producidos por el hombre, explico su desarrollo histórico, sus efectos en la sociedad, su proceso de producción y la relación con los recursos naturales involucrados.', 1, '2022-06-10 10:25:38'),
                                                                                                                               (181, 1, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo y explico las características y el funcionamiento de algunos artefactos, productos, procesos y sistemas de mi entorno y los uso en forma segura y apropiada.', 1, '2022-06-10 10:26:10'),
                                                                                                                               (182, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo y analizo las ventajas y desventajas de la utilización de artefactos y procesos, y los empleo para solucionar problemas de la vida cotidiana.', 1, '2022-06-10 10:26:34'),
                                                                                                                               (183, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico, describo y analizo situaciones en las que se evidencian los efectos sociales y ambientales de las manifestaciones tecnológicas.', 1, '2022-06-10 10:27:03'),
                                                                                                                               (184, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo y explico la evolución y vinculación que los procesos técnicos han tenido en la fabricación de artefactos y productos que permiten al hombre transformar el entorno y resolver problemas', 1, '2022-06-10 10:27:38'),
                                                                                                                               (185, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo y explico las características y funcionamiento de algunos artefactos, productos, procesos y sistemas tecnológicos y los utilizo en forma segura y apropiada.', 1, '2022-06-10 10:28:14'),
                                                                                                                               (186, 1, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Selecciono, adapto y utilizo artefactos, procesos y sistemas tecnológicos sencillos en la solución de problemas en diferentes contextos.', 1, '2022-06-10 10:28:39'),
                                                                                                                               (187, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo y explico la relación que existe entre la transformación de los recursos naturales y el desarrollo tecnológico, así como su impacto sobre el medio ambiente, la salud y la sociedad.', 1, '2022-06-10 10:29:08'),
                                                                                                                               (188, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo y explico la manera como el hombre, en diversas culturas y regiones del mundo, ha empleado conocimientos científicos y tecnológicos para desarrollar artefactos, procesos y sistemas que buscan resolver problemas y que han transformado el entorno.', 1, '2022-06-10 10:29:51'),
                                                                                                                               (189, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo y explico los principios científicos y leyes en las que se basa el funcionamiento de artefactos, productos, servicios, procesos y sistemas tecnológicos de mi  entorno y los utilizo en forma eficiente y segura.', 1, '2022-06-10 10:30:30'),
                                                                                                                               (190, 1, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico, formulo y resuelvo problemas apropiando conocimiento científico y tecnológico, teniendo en cuenta algunas restricciones y condiciones; reconozco y comparo las diferentes soluciones.', 1, '2022-06-10 10:31:19'),
                                                                                                                               (191, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Participo en discusiones y debates sobre las causas y los efectos sociales, económicos y culturales de los desarrollos tecnológicos y actúo en consecuencia, de manera ética y responsable.', 1, '2022-06-10 10:31:48'),
                                                                                                                               (192, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto la tecnología y sus manifestaciones (artefactos, procesos, productos, servicios y sistemas) como elaboración cultural, que ha evolucionado a través del tiempo para cubrir necesidades, mejorar condiciones de vida y solucionar problemas.', 1, '2022-06-10 10:32:28'),
                                                                                                                               (193, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Selecciono y utilizo eficientemente, en el ámbito personal y social, artefactos, productos, servicios, procesos y sistemas tecnológicos teniendo en cuenta su funcionamiento, potencialidades y limitaciones.', 1, '2022-06-10 10:33:13'),
                                                                                                                               (194, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico, formulo y resuelvo problemas a través de la apropiación de conocimiento científico y tecnológico, utilizando diferentes estrategias, y evalúo rigurosa y sistemáticamente las soluciones teniendo en cuenta las condiciones, restricciones y especificaciones del problema planteado.', 1, '2022-06-10 10:33:58'),
                                                                                                                               (195, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo las implicaciones éticas, sociales y ambientales de las manifestaciones tecnológicas del mundo en que vivo, evalúo críticamente los alcances, limitaciones y beneficios de éstas y tomo decisiones responsables relacionadas con sus aplicaciones.', 1, '2022-06-10 10:34:36'),
                                                                                                                               (196, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y describo la importancia de algunos artefactos en el desarrollo de actividades cotidianas en mi entorno y en el de mis antepasados.', 1, '2022-06-10 10:37:00'),
                                                                                                                               (197, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco productos tecnológicos de mi entorno cotidiano y los utilizo en forma segura y apropiada.', 1, '2022-06-10 10:37:23'),
                                                                                                                               (198, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y menciono productos tecnológicos que contribuyen a la solución de problemas de la vida cotidiana.', 1, '2022-06-10 10:37:48'),
                                                                                                                               (199, 7, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Exploro mi entorno cotidiano y diferencio elementos naturales de artefactos elaborados con la intención de mejorar las condiciones de vida.', 1, '2022-06-10 10:38:11'),
                                                                                                                               (200, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco artefactos creados por el hombre para satisfacer sus necesidades, los relaciono con los procesos de producción y con los recursos naturales involucrados.', 1, '2022-06-10 10:38:38'),
                                                                                                                               (201, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco características del funcionamiento de algunos productos tecnológicos de mi entorno y los utilizo en forma segura.', 1, '2022-06-10 10:38:59'),
                                                                                                                               (202, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y comparo ventajas y desventajas en la utilización de artefactos y procesos tecnológicos en la solución de problemas de la vida cotidiana.', 1, '2022-06-10 10:39:21'),
                                                                                                                               (203, 7, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y menciono situaciones en las que se evidencian los efectos sociales y ambientales, producto de la utilización de procesos y artefactos de la tecnología.', 1, '2022-06-10 10:39:44'),
                                                                                                                               (204, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco principios y conceptos propios de la tecnología, así como momentos de la historia que le han permitido al hombre transformar el entorno para resolver problemas y satisfacer necesidades.', 1, '2022-06-10 10:49:10'),
                                                                                                                               (205, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono el funcionamiento de algunos artefactos, productos, procesos y sistemas tecnológicos con su utilización segura.', 1, '2022-06-10 10:49:35'),
                                                                                                                               (206, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Propongo estrategias para soluciones tecnológicas a problemas, en diferentes contextos.', 1, '2022-06-10 10:50:14'),
                                                                                                                               (207, 7, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono la transformación de los recursos naturales con el desarrollo tecnológico y su impacto en el bienestar de la sociedad.', 1, '2022-06-10 10:50:33'),
                                                                                                                               (208, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Relaciono los conocimientos científicos y tecnológicos que se han empleado en diversas culturas y regiones del mundo a través de la historia para resolver problemas y transformar el entorno.', 1, '2022-06-10 10:50:57'),
                                                                                                                               (209, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Tengo en cuenta normas de mantenimiento y utilización de artefactos, productos, servicios, procesos y sistemas tecnológicos de mi entorno para su uso eficiente y seguro.', 1, '2022-06-10 10:51:18'),
                                                                                                                               (210, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Resuelvo problemas utilizando conocimientos tecnológicos y teniendo en cuenta algunas restricciones y condiciones.', 1, '2022-06-10 10:51:40'),
                                                                                                                               (211, 7, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco las causas y los efectos sociales, económicos y culturales de los desarrollos tecnológicos y actúo en consecuencia, de manera ética y responsable.', 1, '2022-06-10 10:52:00'),
                                                                                                                               (212, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo y valoro críticamente los componentes y evolución de los sistemas tecnológicos y las estrategias para su desarrollo.', 1, '2022-06-10 10:52:19'),
                                                                                                                               (213, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Tengo en cuenta principios de funcionamiento y criterios de selección, para la utilización eficiente y segura de artefactos, productos, servicios, procesos y sistemas tecnológicos de mi entorno.', 1, '2022-06-10 10:52:40'),
                                                                                                                               (214, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Resuelvo problemas tecnológicos y evalúo las soluciones teniendo en cuenta las condiciones, restricciones y especificaciones del problema planteado.', 1, '2022-06-10 10:53:02'),
                                                                                                                               (215, 7, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco las implicaciones éticas, sociales y ambientales de las manifestaciones tecnológicas del mundo en que vivo, y actúo responsablemente.', 1, '2022-06-10 10:53:22'),
                                                                                                                               (216, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco cuando me hablan en inglés y reacciono de manera verbal y no verbal. ', 1, '2022-06-12 10:34:59'),
                                                                                                                               (217, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Entiendo cuando me saludan y se despiden de mí.', 1, '2022-06-12 10:35:17'),
                                                                                                                               (218, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Sigo instrucciones relacionadas con actividades de clase y recreativas propuestas por mi profesor. ', 1, '2022-06-12 10:35:36'),
                                                                                                                               (219, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo canciones, rimas y rondas infantiles, y lo demuestro con gestos y movimientos. ', 1, '2022-06-12 10:35:57'),
                                                                                                                               (220, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Demuestro comprensión de preguntas sencillas sobre mí, mi familia y mi entorno. ', 1, '2022-06-12 10:36:17'),
                                                                                                                               (221, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo descripciones cortas y sencillas de objetos y lugares conocidos. ', 1, '2022-06-12 10:36:38'),
                                                                                                                               (222, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico a las personas que participan en una conversación. ', 1, '2022-06-12 10:37:08'),
                                                                                                                               (223, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Sigo la secuencia de un cuento corto apoyado en imágenes. ', 1, '2022-06-12 10:37:25'),
                                                                                                                               (224, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Entiendo la idea general de una historia contada por mi profesor cuando se apoya en movimientos, gestos y cambios de voz. ', 1, '2022-06-12 10:37:48'),
                                                                                                                               (225, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco que hay otras personas como yo que se comunican en inglés. ', 1, '2022-06-12 10:38:10'),
                                                                                                                               (226, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo secuencias relacionadas con hábitos y rutinas. ', 1, '2022-06-12 10:38:28'),
                                                                                                                               (227, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico palabras relacionadas entre sí sobre temas que me son familiares. ', 1, '2022-06-12 10:38:45'),
                                                                                                                               (228, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco palabras y frases cortas en inglés en libros, objetos, juguetes, propagandas y lugares de mi escuela. ', 1, '2022-06-12 10:39:05'),
                                                                                                                               (229, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Relaciono ilustraciones con oraciones simples. ', 1, '2022-06-12 10:39:21'),
                                                                                                                               (230, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y sigo instrucciones sencillas, si están ilustradas. ', 1, '2022-06-12 10:39:40'),
                                                                                                                               (231, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Puedo predecir una historia a partir del título, las ilustraciones y las palabras clave.', 1, '2022-06-12 10:40:01'),
                                                                                                                               (232, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Sigo la secuencia de una historia sencilla.', 1, '2022-06-12 10:40:16'),
                                                                                                                               (233, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Utilizo diagramas para organizar la información de cuentos cortos leídos en clase. ', 1, '2022-06-12 10:40:33'),
                                                                                                                               (234, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Disfruto la lectura como una actividad de esparcimiento que me ayuda a descubrir el mundo.', 1, '2022-06-12 10:40:53'),
                                                                                                                               (235, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Copio y transcribo palabras que comprendo y que uso con frecuencia en el salón de clase. ', 1, '2022-06-12 11:08:21'),
                                                                                                                               (236, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Escribo el nombre de lugares y elementos que reconozco en una ilustración. ', 1, '2022-06-12 11:08:42'),
                                                                                                                               (237, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respondo brevemente a las preguntas “qué, quién, cuándo y dónde”, si se refieren a mi familia, mis amigos o mi colegio. ', 1, '2022-06-12 11:09:06'),
                                                                                                                               (238, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Escribo información personal en formatos sencillos. ', 1, '2022-06-12 11:09:25'),
                                                                                                                               (239, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Escribo mensajes de invitación y felicitación usando formatos sencillos. ', 1, '2022-06-12 11:09:45'),
                                                                                                                               (240, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Demuestro conocimiento de las estructuras básicas del inglés. ', 1, '2022-06-12 11:10:04'),
                                                                                                                               (241, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Recito y canto rimas, poemas y trabalenguas que comprendo, con ritmo y entonación adecuados. ', 1, '2022-06-12 11:10:26'),
                                                                                                                               (242, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Expreso mis sentimientos y estados de ánimo. ', 1, '2022-06-12 11:10:46'),
                                                                                                                               (243, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Menciono lo que me gusta y lo que no me gusta. ', 1, '2022-06-12 11:11:08'),
                                                                                                                               (244, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo lo que estoy haciendo. ', 1, '2022-06-12 11:11:25'),
                                                                                                                               (245, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Nombro algunas cosas que puedo hacer y que no puedo hacer. ', 1, '2022-06-12 11:11:47'),
                                                                                                                               (246, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo lo que hacen algunos miembros de mi comunidad. ', 1, '2022-06-12 11:12:09'),
                                                                                                                               (247, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso gestos y movimientos corporales para hacerme entender mejor. ', 1, '2022-06-12 11:12:28'),
                                                                                                                               (248, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo algunas características de mí mismo, de otras personas, de animales, de lugares y del clima. ', 1, '2022-06-12 11:12:50'),
                                                                                                                               (249, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Participo en representaciones cortas; memorizo y comprendo los parlamentos. ', 1, '2022-06-12 11:13:09'),
                                                                                                                               (250, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respondo a saludos y a despedidas. ', 1, '2022-06-12 11:13:31');
INSERT INTO `caracterizacion_estandar` (`id_estandar`, `id_area`, `grado`, `descripcion_estandar`, `estado`, `created_at`) VALUES
                                                                                                                               (251, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respondo a preguntas sobre cómo me siento. ', 1, '2022-06-12 11:13:47'),
                                                                                                                               (252, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso expresiones cotidianas para expresar mis necesidades inmediatas en el aula. ', 1, '2022-06-12 11:14:08'),
                                                                                                                               (253, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Utilizo el lenguaje no verbal cuando no puedo responder verbalmente a preguntas sobre mis preferencias. Por ejemplo, asintiendo o negando con la cabeza. ', 1, '2022-06-12 11:14:35'),
                                                                                                                               (254, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Expreso e indico necesidades personales básicas relacionadas con el aula. ', 1, '2022-06-12 11:14:56'),
                                                                                                                               (255, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respondo a preguntas sobre personas, objetos y lugares de mi entorno. ', 1, '2022-06-12 11:22:52'),
                                                                                                                               (256, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Pido que me repitan el mensaje cuando no lo comprendo.', 1, '2022-06-12 11:23:14'),
                                                                                                                               (257, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', '', 0, '2022-06-12 11:23:30'),
                                                                                                                               (258, 8, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', '', 0, '2022-06-12 11:23:45'),
                                                                                                                               (259, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Sigo atentamente lo que dicen mi profesor y mis compañeros durante un juego o una actividad.', 1, '2022-06-13 09:20:33'),
                                                                                                                               (260, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Participo en juegos y actividades siguiendo instrucciones simples. ', 1, '2022-06-13 09:20:56'),
                                                                                                                               (261, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico los nombres de los personajes y los eventos principales de un cuento leído por el profesor y apoyado en imágenes, videos o cualquier tipo de material visual. ', 1, '2022-06-13 09:21:29'),
                                                                                                                               (262, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco algunos estados de ánimo a través del tono o volumen de voz en una historia leída por el profesor o en una grabación. ', 1, '2022-06-13 09:21:50'),
                                                                                                                               (263, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico de quién me hablan a partir de su descripción física. ', 1, '2022-06-13 09:22:12'),
                                                                                                                               (264, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comprendo información personal proporcionada por mis compañeros y mi profesor. ', 1, '2022-06-13 09:22:30'),
                                                                                                                               (265, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico objetos, personas y acciones que me son conocidas en un texto descriptivo corto leído por el profesor. ', 1, '2022-06-13 09:22:50'),
                                                                                                                               (266, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico la secuencia de las acciones y las asocio con los momentos del día, cuando alguien describe su rutina diaria. ', 1, '2022-06-13 09:23:10'),
                                                                                                                               (267, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Memorizo y sigo el ritmo de canciones populares de países angloparlantes. ', 1, '2022-06-13 09:23:32'),
                                                                                                                               (268, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Asocio un dibujo con su descripción escrita. ', 1, '2022-06-13 09:23:49'),
                                                                                                                               (269, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comprendo descripciones cortas sobre personas, lugares y acciones conocidas.', 1, '2022-06-13 09:24:12'),
                                                                                                                               (270, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Ubico en un texto corto los lugares y momentos en que suceden las acciones. ', 1, '2022-06-13 09:24:52'),
                                                                                                                               (271, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico las acciones en una secuencia corta de eventos. ', 1, '2022-06-13 09:25:11'),
                                                                                                                               (272, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo gráficas para representar la información más relevante de un texto. ', 1, '2022-06-13 09:25:28'),
                                                                                                                               (273, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo el diccionario como apoyo a la comprensión de textos.', 1, '2022-06-13 09:25:46'),
                                                                                                                               (274, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico elementos culturales como nombres propios y lugares, en textos sencillos. ', 1, '2022-06-13 09:26:06'),
                                                                                                                               (275, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Leo y entiendo textos auténticos y sencillos sobre acontecimientos concretos asociados a tradiciones culturales que conozco (cumpleaños, navidad, etc.). ', 1, '2022-06-13 09:26:28'),
                                                                                                                               (276, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco, en un texto narrativo corto, aspectos como qué, quién, cuándo y dónde. ', 1, '2022-06-13 09:26:50'),
                                                                                                                               (277, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Participo en juegos de búsqueda de palabras desconocidas. ', 1, '2022-06-13 09:27:07'),
                                                                                                                               (278, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escribo sobre temas de mi interés. ', 1, '2022-06-13 09:27:25'),
                                                                                                                               (279, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escribo descripciones y narraciones cortas basadas en una secuencia de ilustraciones. ', 1, '2022-06-13 09:27:50'),
                                                                                                                               (280, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escribo tarjetas con mensajes cortos de felicitación o invitación. ', 1, '2022-06-13 09:28:07'),
                                                                                                                               (281, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo los rasgos personales de gente de mi entorno. ', 1, '2022-06-13 09:28:25'),
                                                                                                                               (282, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Enlazo frases y oraciones usando conectores que expresan secuencia y adición. ', 1, '2022-06-13 09:28:49'),
                                                                                                                               (283, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escribo textos cortos que describen mi estado de ánimo y mis preferencias. ', 1, '2022-06-13 09:29:09'),
                                                                                                                               (284, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Uso adecuadamente estructuras y patrones gramaticales de uso frecuente. ', 1, '2022-06-13 09:29:31'),
                                                                                                                               (285, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Verifico la ortografía de las palabras que escribo con frecuencia.', 1, '2022-06-13 09:29:51'),
                                                                                                                               (286, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escribo pequeñas historias que me imagino. ', 1, '2022-06-13 09:30:09'),
                                                                                                                               (287, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Me describo a mí o a otra persona conocida, con frases simples y cortas, teniendo en cuenta su edad y sus características físicas. ', 1, '2022-06-13 09:30:33'),
                                                                                                                               (288, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Me describo a mí o a otra persona conocida, con frases simples y cortas, teniendo en cuenta su edad y sus características físicas. ', 1, '2022-06-13 09:30:54'),
                                                                                                                               (289, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Deletreo palabras que me son conocidas. ', 1, '2022-06-13 09:31:12'),
                                                                                                                               (290, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Expreso en una palabra o frase corta, cómo me siento. ', 1, '2022-06-13 09:31:30'),
                                                                                                                               (291, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Digo un texto corto memorizado en una dramatización, ayudándome con gestos.', 1, '2022-06-13 09:31:52'),
                                                                                                                               (292, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo con oraciones simples el clima y determino la ropa necesaria, según corresponda. ', 1, '2022-06-13 09:32:14'),
                                                                                                                               (293, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Recito un trabalenguas sencillo o una rima, o canto el coro de una canción. ', 1, '2022-06-13 09:32:45'),
                                                                                                                               (294, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Hablo de las actividades que realizo habitualmente.', 1, '2022-06-13 09:33:05'),
                                                                                                                               (295, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Busco oportunidades para usar lo que sé en inglés.', 1, '2022-06-13 09:33:26'),
                                                                                                                               (296, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Puedo hablar de cantidades y contar objetos hasta mil. ', 1, '2022-06-13 09:33:43'),
                                                                                                                               (297, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Respondo a preguntas personales como nombre, edad, nacionalidad y dirección, con apoyo de repeticiones cuando sea necesario. ', 1, '2022-06-13 09:34:06'),
                                                                                                                               (298, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Puedo saludar de acuerdo con la hora del día, de forma natural y apropiada. ', 1, '2022-06-13 09:34:26'),
                                                                                                                               (299, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Solicito a mi profesor y a mis compañeros que me aclaren una duda o me expliquen algo sobre lo que hablamos.', 1, '2022-06-13 09:35:10'),
                                                                                                                               (300, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Pido y acepto disculpas de forma simple y cortés.', 1, '2022-06-13 09:35:27'),
                                                                                                                               (301, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Sigo y doy instrucciones básicas cuando participo en juegos conocidos. ', 1, '2022-06-13 09:35:56'),
                                                                                                                               (302, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Mantengo una conversación simple en inglés con un compañero cuando desarrollo una actividad de aula. ', 1, '2022-06-13 09:37:13'),
                                                                                                                               (303, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Pregunto y respondo sobre las características físicas de objetos familiares. ', 1, '2022-06-13 09:37:56'),
                                                                                                                               (304, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Respondo preguntas sobre mis gustos y preferencias. ', 1, '2022-06-13 09:38:20'),
                                                                                                                               (305, 8, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Puedo cortésmente llamar la atención de mi profesor con una frase corta. ', 1, '2022-06-13 09:38:41'),
                                                                                                                               (306, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo información básica sobre temas relacionados con mis actividades cotidianas y con mi entorno. ', 1, '2022-06-13 09:46:20'),
                                                                                                                               (307, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo preguntas y expresiones orales que se refieren a mí, a mi familia, mis amigos y mi entorno.', 1, '2022-06-13 09:46:42'),
                                                                                                                               (308, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo mensajes cortos y simples relacionados con mi entorno y mis intereses personales y académicos.', 1, '2022-06-13 09:46:59'),
                                                                                                                               (309, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo y sigo instrucciones puntuales cuando éstas se presentan en forma clara y con vocabulario conocido. ', 1, '2022-06-13 09:47:19'),
                                                                                                                               (310, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo una descripción oral sobre una situación, persona, lugar u objeto. ', 1, '2022-06-13 09:47:36'),
                                                                                                                               (311, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico el tema general y los detalles relevantes en conversaciones, informaciones radiales o exposiciones orales. ', 1, '2022-06-13 09:47:54'),
                                                                                                                               (312, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo la idea general en una descripción y en una narración.', 1, '2022-06-13 09:48:13'),
                                                                                                                               (313, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo instrucciones escritas para llevar a cabo actividades cotidianas, personales y académicas.', 1, '2022-06-13 09:48:35'),
                                                                                                                               (314, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo textos literarios, académicos y de interés general, escritos con un lenguaje sencillo.', 1, '2022-06-13 09:48:56'),
                                                                                                                               (315, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Puedo extraer información general y específica de un texto corto y escrito en un lenguaje sencillo.', 1, '2022-06-13 09:49:13'),
                                                                                                                               (316, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo relaciones establecidas por palabras como and (adición), but (contraste), first, second... (orden temporal),\r\nen enunciados sencillos. ', 1, '2022-06-13 09:49:32'),
                                                                                                                               (317, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Valoro la lectura como un hábito importante de enriquecimiento personal y académico.', 1, '2022-06-13 09:49:52'),
                                                                                                                               (318, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico el significado adecuado de las palabras en el diccionario según el contexto. ', 1, '2022-06-13 09:50:08'),
                                                                                                                               (319, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Aplico estrategias de lectura relacionadas con el propósito de la misma. ', 1, '2022-06-13 09:50:24'),
                                                                                                                               (320, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico en textos sencillos, elementos culturales como costumbres y celebraciones.', 1, '2022-06-13 09:50:42'),
                                                                                                                               (321, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico la acción, los personajes y el entorno en textos narrativos. ', 1, '2022-06-13 09:51:00'),
                                                                                                                               (322, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo con frases cortas personas, lugares, objetos o hechos relacionados con temas y situaciones que me son familiares. ', 1, '2022-06-13 09:52:02'),
                                                                                                                               (323, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Escribo mensajes cortos y con diferentes propósitos relacionados con situaciones, objetos o personas de mi entorno inmediato. ', 1, '2022-06-13 09:52:27'),
                                                                                                                               (324, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Completo información personal básica en formatos y documentos sencillos. ', 1, '2022-06-13 09:52:47'),
                                                                                                                               (325, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Escribo un texto corto relativo a mí, a mi familia, mis amigos, mi entorno o sobre hechos que me son familiares. ', 1, '2022-06-13 09:53:09'),
                                                                                                                               (326, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Escribo textos cortos en los que expreso contraste, adición, causa y efecto entre ideas.', 1, '2022-06-13 09:53:46'),
                                                                                                                               (327, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo vocabulario adecuado para darle coherencia a mis escritos. ', 1, '2022-06-13 09:54:13'),
                                                                                                                               (328, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo con oraciones simples a una persona, lugar u objeto que me son familiares aunque, si lo requiero, me apoyo en apuntes o en mi profesor. ', 1, '2022-06-13 09:54:46'),
                                                                                                                               (329, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Doy instrucciones orales sencillas en situaciones escolares, familiares y de mi entorno cercano. ', 1, '2022-06-13 09:55:15'),
                                                                                                                               (330, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco comparaciones entre personajes, lugares y objetos. ', 1, '2022-06-13 09:55:44'),
                                                                                                                               (331, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Expreso de manera sencilla lo que me gusta y me disgusta respecto a algo.', 1, '2022-06-13 09:56:10'),
                                                                                                                               (332, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Narro o describo de forma sencilla hechos y actividades que me son familiares. ', 1, '2022-06-13 09:56:31'),
                                                                                                                               (333, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Hago exposiciones muy breves, de contenido predecible y aprendido. ', 1, '2022-06-13 10:01:54'),
                                                                                                                               (334, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo con oraciones simples mi rutina diaria y la de otras personas. ', 1, '2022-06-13 10:02:25'),
                                                                                                                               (335, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Respondo con frases cortas a preguntas sencillas sobre temas que me son familiares.', 1, '2022-06-13 10:02:52'),
                                                                                                                               (336, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Solicito explicaciones sobre situaciones puntuales en mi escuela, mi familia y mi entorno cercano. ', 1, '2022-06-13 10:03:12'),
                                                                                                                               (337, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Participo en situaciones comunicativas cotidianas tales como pedir favores, disculparme y agradecer. ', 1, '2022-06-13 10:03:38'),
                                                                                                                               (338, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo códigos no verbales como gestos y entonación, entre otros. ', 1, '2022-06-13 10:04:01'),
                                                                                                                               (339, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo preguntas sencillas sobre temas que me son familiares apoyándome en gestos y repetición. ', 1, '2022-06-13 10:04:24'),
                                                                                                                               (340, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Hago propuestas a mis compañeros sobre qué hacer, dónde, cuándo o cómo. ', 1, '2022-06-13 10:04:43'),
                                                                                                                               (341, 8, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Inicio, mantengo y cierro una conversación sencilla sobre un tema conocido.', 1, '2022-06-13 10:05:06'),
                                                                                                                               (342, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Inicio, mantengo y cierro una conversación sencilla sobre un tema conocido.', 0, '2022-06-13 10:33:07'),
                                                                                                                               (343, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Sigo las instrucciones dadas en clase para realizar actividades académicas. ', 1, '2022-06-13 10:34:31'),
                                                                                                                               (344, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Entiendo lo que me dicen el profesor y mis compañeros en interacciones cotidianas dentro del aula, sin necesidad de repetición. ', 1, '2022-06-13 10:34:52'),
                                                                                                                               (345, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico ideas generales y específicas en textos orales, si tengo conocimiento del tema y del vocabulario utilizado. ', 1, '2022-06-13 10:35:14'),
                                                                                                                               (346, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco los elementos de enlace de un texto oral para identificar su secuencia. ', 1, '2022-06-13 10:35:45'),
                                                                                                                               (347, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Muestro una actitud respetuosa y tolerante al escuchar a otros. ', 1, '2022-06-13 10:36:03'),
                                                                                                                               (348, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico diferentes roles de los hablantes que participan en conversaciones de temas relacionados con mis intereses. ', 1, '2022-06-13 10:36:21'),
                                                                                                                               (349, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo mi conocimiento general del mundo para comprender lo que escucho.', 1, '2022-06-13 10:36:37'),
                                                                                                                               (350, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Infiero información específica a partir de un texto oral. ', 1, '2022-06-13 10:36:55'),
                                                                                                                               (351, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico la información clave en conversaciones breves tomadas de la vida real, si están acompañadas por imágenes. ', 1, '2022-06-13 10:37:31'),
                                                                                                                               (352, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco el propósito de diferentes tipos dectextos que presentan mis compañeros en clase.', 1, '2022-06-13 10:37:51'),
                                                                                                                               (353, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico iniciación, nudo y desenlace en una narración. ', 1, '2022-06-13 10:38:08'),
                                                                                                                               (354, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco el propósito de una descripción en textos narrativos de mediana extensión. ', 1, '2022-06-13 10:38:24'),
                                                                                                                               (355, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico puntos a favor y en contra en un texto argumentativo sobre temas con los que estoy\r\nfamiliarizado. ', 1, '2022-06-13 10:39:03'),
                                                                                                                               (356, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comprendo relaciones de adición, contraste, orden temporal y espacial y causa-efecto entre enunciados sencillos. ', 1, '2022-06-13 10:40:19'),
                                                                                                                               (357, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico la recurrencia de ideas en un mismo texto.', 1, '2022-06-13 10:40:38'),
                                                                                                                               (358, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico relaciones de significado expresadas en textos sobre temas que me son familiares. ', 1, '2022-06-13 10:41:00'),
                                                                                                                               (359, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Represento, en forma gráfica, la información que encuentro en textos que comparan y contrastan objetos, animales y personas. ', 1, '2022-06-13 10:41:20'),
                                                                                                                               (360, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Valoro la lectura como una actividad importante para todas las áreas de mi vida.', 1, '2022-06-13 10:41:50'),
                                                                                                                               (361, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comprendo la información implícita en textos relacionados con temas de mi interés. ', 1, '2022-06-13 10:42:06'),
                                                                                                                               (362, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Diferencio la estructura organizativa de textos descriptivos, narrativos y argumentativos. ', 1, '2022-06-13 10:42:27'),
                                                                                                                               (363, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico elementos culturales presentes en textos sencillos. ', 1, '2022-06-13 10:42:46'),
                                                                                                                               (364, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Escribo narraciones sobre experiencias personales y hechos a mi alrededor. ', 1, '2022-06-13 10:43:08'),
                                                                                                                               (365, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Escribo mensajes en diferentes formatos sobre temas de mi interés. ', 1, '2022-06-13 10:43:51'),
                                                                                                                               (366, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Diligencio efectivamente formatos con información personal.', 1, '2022-06-13 10:44:12'),
                                                                                                                               (367, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Contesto, en forma escrita, preguntas relacionadas con textos que he leído. ', 1, '2022-06-13 10:44:35'),
                                                                                                                               (368, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Produzco textos sencillos con diferentes funciones (describir, narrar, argumentar) sobre temas personales y relacionados con otras asignaturas. ', 1, '2022-06-13 10:45:04'),
                                                                                                                               (369, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Parafraseo información que leo como parte de mis actividades académicas.', 1, '2022-06-13 10:45:22'),
                                                                                                                               (370, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Organizo párrafos coherentes cortos, teniendo en cuenta elementos formales del lenguaje como ortografía y puntuación.', 1, '2022-06-13 10:45:46'),
                                                                                                                               (371, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso planes representados en mapas o diagramas para desarrollar mis escritos. ', 1, '2022-06-13 10:46:03'),
                                                                                                                               (372, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Ejemplifico mis puntos de vista sobre los temas que escribo. ', 1, '2022-06-13 10:46:22'),
                                                                                                                               (373, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Edito mis escritos en clase, teniendo en cuenta reglas de ortografía, adecuación del vocabulario y estructuras gramaticales. ', 1, '2022-06-13 10:46:45'),
                                                                                                                               (374, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Hago presentaciones cortas y ensayadas sobre temas cotidianos y personales. ', 1, '2022-06-13 11:52:54'),
                                                                                                                               (375, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Narro historias cortas enlazando mis ideas de manera apropiada. ', 1, '2022-06-13 11:53:21'),
                                                                                                                               (376, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Expreso mi opinión sobre asuntos de interés general para mí y mis compañeros. ', 1, '2022-06-13 11:53:42'),
                                                                                                                               (377, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico y justifico brevemente mis planes y acciones.', 1, '2022-06-13 11:54:08'),
                                                                                                                               (378, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Hago descripciones sencillas sobre diversos asuntos cotidianos de mi entorno. ', 1, '2022-06-13 11:54:29'),
                                                                                                                               (379, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Hago exposiciones ensayadas y breves sobre algún tema académico de mi interés.', 1, '2022-06-13 11:54:56'),
                                                                                                                               (380, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Expreso mis opiniones, gustos y preferencias sobre temas que he trabajado en clase, utilizando estrategias para monitorear mi pronunciación. ', 1, '2022-06-13 11:55:51'),
                                                                                                                               (381, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso un plan para exponer temas relacionados con el entorno académico de otras asignaturas. ', 1, '2022-06-13 11:56:08'),
                                                                                                                               (382, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Participo en una conversación cuando mi interlocutor me da el tiempo para pensar mis respuestas. ', 1, '2022-06-13 11:56:34'),
                                                                                                                               (383, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Converso con mis compañeros y mi profesor sobre experiencias pasadas y planes futuros. ', 1, '2022-06-13 11:56:54'),
                                                                                                                               (384, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Me arriesgo a participar en una conversación con mis compañeros y mi profesor. ', 1, '2022-06-13 11:57:19'),
                                                                                                                               (385, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Me apoyo en mis conocimientos generales del mundo para participar en una conversación.', 1, '2022-06-13 11:57:42'),
                                                                                                                               (386, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Interactúo con mis compañeros y profesor para tomar decisiones sobre temas específicos que conozco', 1, '2022-06-13 11:58:06'),
                                                                                                                               (387, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Uso lenguaje formal o informal en juegos de rol improvisados, según el contexto. ', 1, '2022-06-13 11:58:29'),
                                                                                                                               (388, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Monitoreo la toma de turnos entre los participantes en discusiones sobre temas preparados con anterioridad.', 1, '2022-06-13 11:58:50'),
                                                                                                                               (389, 8, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Demuestro que reconozco elementos de la cultura extranjera y los relaciono con mi cultura. ', 1, '2022-06-13 11:59:12'),
                                                                                                                               (390, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Entiendo instrucciones para ejecutar acciones cotidianas. ', 1, '2022-06-13 12:00:16'),
                                                                                                                               (391, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico la idea principal de un texto oral cuando tengo conocimiento previo del tema. ', 1, '2022-06-13 12:00:45'),
                                                                                                                               (392, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico conectores en una situación de habla para comprender su sentido. ', 1, '2022-06-13 12:01:06'),
                                                                                                                               (393, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico personas, situaciones, lugares y el tema en conversaciones sencillas. ', 1, '2022-06-13 12:01:26'),
                                                                                                                               (394, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico el propósito de un texto oral. ', 1, '2022-06-13 12:01:58'),
                                                                                                                               (395, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Muestro una actitud respetuosa y tolerante cuando escucho a otros.', 1, '2022-06-13 12:02:16'),
                                                                                                                               (396, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo estrategias adecuadas al propósito y al tipo de texto (activación de conocimientos previos, apoyo en el lenguaje corporal y gestual, uso de imágenes) para\r\ncomprender lo que escucho.', 1, '2022-06-13 12:02:46'),
                                                                                                                               (397, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comprendo el sentido general del texto oral aunque no entienda todas sus palabras. ', 1, '2022-06-13 12:03:10'),
                                                                                                                               (398, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Me apoyo en el lenguaje corporal y gestual del hablante para comprender mejor lo que dice.', 1, '2022-06-13 12:03:44'),
                                                                                                                               (399, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Me apoyo en el lenguaje corporal y gestual del hablante para comprender mejor lo que dice.', 1, '2022-06-13 12:04:07'),
                                                                                                                               (400, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo las imágenes e información del contexto de habla para comprender mejor lo que escucho. ', 1, '2022-06-13 12:04:29'),
                                                                                                                               (401, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico palabras clave dentro del texto que me permiten comprender su sentido general. ', 1, '2022-06-13 12:18:26'),
                                                                                                                               (402, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico el punto de vista del autor. ', 1, '2022-06-13 12:18:47'),
                                                                                                                               (403, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Asumo una posición crítica frente al punto de vista del autor.', 1, '2022-06-13 12:19:07'),
                                                                                                                               (404, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico los valores de otras culturas y eso me permite construir mi interpretación de su identidad.', 1, '2022-06-13 12:19:29'),
                                                                                                                               (405, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Valoro la lectura como un medio para adquirir información de diferentes disciplinas que amplían mi conocimiento.', 1, '2022-06-13 12:19:50'),
                                                                                                                               (406, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo variedad de estrategias de comprensión de lectura adecuadas al propósito y al tipo de texto. ', 1, '2022-06-13 12:20:09'),
                                                                                                                               (407, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo textos descriptivos, narrativos y argumentativos con el fin de comprender las ideas principales y específicas.', 1, '2022-06-13 12:20:28'),
                                                                                                                               (408, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Hago inferencias a partir de la información en un texto. ', 1, '2022-06-13 12:20:43'),
                                                                                                                               (409, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'En un texto identifico los elementos que me permiten apreciar los valores de la cultura angloparlante.', 1, '2022-06-13 12:21:00'),
                                                                                                                               (410, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comprendo variedad de textos informativos provenientes de diferentes fuentes. ', 1, '2022-06-13 12:21:25'),
                                                                                                                               (411, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Estructuro mis textos teniendo en cuenta elementos formales del lenguaje como la puntuación, la ortografía, la sintaxis, la coherencia y la cohesión. ', 1, '2022-06-13 12:23:17'),
                                                                                                                               (412, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Planeo, reviso y edito mis escritos con la ayuda de mis compañeros y del profesor. ', 1, '2022-06-13 12:23:36'),
                                                                                                                               (413, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Expreso valores de mi cultura a través de los textos que escribo.', 1, '2022-06-13 12:23:54'),
                                                                                                                               (414, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Escribo diferentes tipos de textos de mediana longitud y con una estructura sencilla (cartas, notas, mensajes, correos electrónicos, etc.). ', 1, '2022-06-13 12:24:19'),
                                                                                                                               (415, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Escribo resúmenes e informes que demuestran mi conocimiento sobre temas de otras disciplinas. ', 1, '2022-06-13 12:24:38'),
                                                                                                                               (416, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Escribo textos de diferentes tipos teniendo en cuenta a mi posible lector. ', 1, '2022-06-13 12:24:58'),
                                                                                                                               (417, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Valoro la escritura como un medio de expresión de mis ideas y pensamientos, quién soy y qué sé del mundo.', 1, '2022-06-13 12:25:21'),
                                                                                                                               (418, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Escribo textos a través de los cuales explico mis preferencias, decisiones o actuaciones. ', 1, '2022-06-13 12:25:41'),
                                                                                                                               (419, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Narro en forma detallada experiencias, hechos o historias de mi interés y del interés de mi audiencia. ', 1, '2022-06-13 12:27:51'),
                                                                                                                               (420, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Hago presentaciones orales sobre temas de mi interés y relacionados con el currículo escolar. ', 1, '2022-06-13 12:28:12'),
                                                                                                                               (421, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo un vocabulario apropiado para expresar mis ideas con claridad sobre temas del currículo y de mi interés. ', 1, '2022-06-13 12:28:49'),
                                                                                                                               (422, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Puedo expresarme con la seguridad y confianza propios de mi personalidad.', 1, '2022-06-13 12:29:08'),
                                                                                                                               (423, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo elementos metalingüísticos como gestos y entonación para hacer más comprensible lo que digo. ', 1, '2022-06-13 12:29:30'),
                                                                                                                               (424, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Sustento mis opiniones, planes y proyectos. ', 1, '2022-06-13 12:29:55'),
                                                                                                                               (425, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso estrategias como el parafraseo para compensar dificultades en la comunicación. ', 1, '2022-06-13 12:33:52'),
                                                                                                                               (426, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Opino sobre los estilos de vida de la gente de otras culturas, apoyándome en textos escritos y orales previamente estudiados. ', 1, '2022-06-13 12:34:32'),
                                                                                                                               (427, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Participo espontáneamente en conversaciones sobre temas de mi interés utilizando un lenguaje claro y sencillo. ', 1, '2022-06-13 12:34:55'),
                                                                                                                               (428, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Respondo preguntas teniendo en cuenta a mi interlocutor y el contexto. ', 1, '2022-06-13 12:35:20'),
                                                                                                                               (429, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo una pronunciación inteligible para lograr una comunicación efectiva. ', 1, '2022-06-13 12:35:41'),
                                                                                                                               (430, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso mis conocimientos previos para participar en una conversación.', 1, '2022-06-13 12:36:03'),
                                                                                                                               (431, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo en forma oral mis ambiciones, sueños y esperanzas utilizando un lenguaje claro y sencillo. ', 1, '2022-06-13 12:36:31'),
                                                                                                                               (432, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso lenguaje funcional para discutir alternativas, hacer recomendaciones y negociar acuerdos en debates preparados con anterioridad. ', 1, '2022-06-13 12:37:36'),
                                                                                                                               (433, 8, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo estrategias que me permiten iniciar, mantener y cerrar una conversación sencilla sobre temas de mi interés, de una forma natural.', 1, '2022-06-13 12:38:04'),
                                                                                                                               (434, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Observo mi entorno.', 1, '2022-06-13 12:40:48'),
                                                                                                                               (435, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Formulo preguntas sobre objetos, organismos y fenómenos de mi entorno y exploro posibles respuestas.', 1, '2022-06-13 12:41:11'),
                                                                                                                               (436, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Hago conjeturas para responder mis preguntas.', 1, '2022-06-13 12:41:29'),
                                                                                                                               (437, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Diseño y realizo experiencias para poner a prueba mis conjeturas.', 1, '2022-06-13 12:41:49'),
                                                                                                                               (438, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico condiciones que influyen en los resultados de una experiencia.', 1, '2022-06-13 12:43:36'),
                                                                                                                               (439, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Realizo mediciones con instrumentos convencionales (regla, metro, termómetro, reloj, balanza...) y no convencionales (vasos, tazas, cuartas, pies, pasos...).', 1, '2022-06-13 12:43:58'),
                                                                                                                               (440, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Registro mis observaciones en forma organizada y rigurosa (sin alteraciones), utilizando dibujos, palabras y números.', 1, '2022-06-13 12:44:17'),
                                                                                                                               (441, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Busco información en diversas fuentes (libros, Internet, experiencias propias y de otros...) y doy el crédito correspondiente.', 1, '2022-06-13 12:44:37'),
                                                                                                                               (442, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Selecciono la información apropiada para dar respuesta a mis preguntas.', 1, '2022-06-13 12:44:57'),
                                                                                                                               (443, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Analizo, con la ayuda del profesor, si la información obtenida es suficiente para contestar mis preguntas.', 1, '2022-06-13 12:45:16'),
                                                                                                                               (444, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Persisto en la búsqueda de respuestas a mis preguntas.', 1, '2022-06-13 12:45:35'),
                                                                                                                               (445, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Propongo respuestas a mis preguntas y las comparo con las de otras personas.', 1, '2022-06-13 12:45:51'),
                                                                                                                               (446, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comunico de diferentes maneras el proceso de indagación y los resultados obtenidos.', 1, '2022-06-13 12:46:08'),
                                                                                                                               (447, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre las funciones de los cinco sentidos.', 1, '2022-06-13 12:46:50'),
                                                                                                                               (448, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo mi cuerpo y el de mis compañeros y compañeras', 1, '2022-06-13 12:47:09'),
                                                                                                                               (449, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo características de seres vivos y objetos inertes, establezco semejanzas y diferencias entre ellos y los clasifico.', 1, '2022-06-13 12:47:31'),
                                                                                                                               (450, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Propongo y verifico necesidades de los seres vivos.', 1, '2022-06-13 12:47:53'),
                                                                                                                               (451, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Observo y describo cambios en mi desarrollo y en el de otros seres vivos.', 1, '2022-06-13 12:48:12'),
                                                                                                                               (452, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo y verifico ciclos de vida de seres vivos.', 1, '2022-06-13 12:51:12'),
                                                                                                                               (453, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco que los hijos y las hijas se parecen a sus padres y describo algunas características que se heredan.', 1, '2022-06-13 12:51:37'),
                                                                                                                               (454, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo la flora, la fauna, el agua y el suelo de mi entorno.', 1, '2022-06-13 12:51:58'),
                                                                                                                               (455, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Explico adaptaciones de los seres vivos al ambiente.', 1, '2022-06-13 12:52:18'),
                                                                                                                               (456, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comparo fósiles y seres vivos; identifico características que se mantienen en el tiempo.', 1, '2022-06-13 12:52:38'),
                                                                                                                               (457, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico patrones comunes a los seres vivos.', 1, '2022-06-13 12:53:02'),
                                                                                                                               (458, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Describo y clasifico objetos según características que percibo con los cinco sentidos.', 1, '2022-06-13 12:53:30'),
                                                                                                                               (459, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Propongo y verifico diversas formas de medir sólidos y líquidos.', 1, '2022-06-13 12:53:48'),
                                                                                                                               (460, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre magnitudes y unidades de medida apropiadas.', 1, '2022-06-13 12:54:08'),
                                                                                                                               (461, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico diferentes estados físicos de la materia (el agua, por ejemplo) y verifico causas para cambios de estado.', 1, '2022-06-13 12:54:33'),
                                                                                                                               (462, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y comparo fuentes de luz, calor y sonido y su efecto sobre diferentes seres vivos.', 1, '2022-06-13 12:54:50'),
                                                                                                                               (463, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico situaciones en las que ocurre transferencia de energía térmica y realizo experiencias para verificar el fenómeno.', 1, '2022-06-13 12:55:19'),
                                                                                                                               (464, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Clasifico luces según color, intensidad y fuente.', 1, '2022-06-13 12:55:41'),
                                                                                                                               (465, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Clasifico sonidos según tono, volumen y fuente.', 1, '2022-06-13 12:55:57'),
                                                                                                                               (466, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Propongo experiencias para comprobar la propagación de la luz y del sonido.', 1, '2022-06-13 12:56:13'),
                                                                                                                               (467, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico tipos de movimiento en seres vivos y objetos, y las fuerzas que los producen.', 1, '2022-06-13 12:57:58'),
                                                                                                                               (468, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Verifico las fuerzas a distancia generadas por imanes sobre diferentes objetos.', 1, '2022-06-13 12:58:18'),
                                                                                                                               (469, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Construyo circuitos eléctricos simples con pilas.', 1, '2022-06-13 12:58:35'),
                                                                                                                               (470, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Registro el movimiento del Sol, la Luna y las estrellas en el cielo, en un periodo de tiempo.', 1, '2022-06-13 12:58:56'),
                                                                                                                               (471, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Clasifico y comparo objetos según sus usos.', 1, '2022-06-13 12:59:17'),
                                                                                                                               (472, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Diferencio objetos naturales de objetos creados por el ser humano.', 1, '2022-06-13 12:59:37'),
                                                                                                                               (473, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico objetos que emitan luz o sonido.', 1, '2022-06-13 12:59:57'),
                                                                                                                               (474, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico circuitos eléctricos en mi entorno.', 1, '2022-06-13 13:00:14'),
                                                                                                                               (475, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Analizo la utilidad de algunos aparatos eléctricos a mi alrededor.', 1, '2022-06-13 13:00:35'),
                                                                                                                               (476, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico aparatos que utilizamos hoy y que no se utilizaban en épocas pasadas.', 1, '2022-06-13 13:00:53'),
                                                                                                                               (477, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Asocio el clima con la forma de vida de diferentes comunidades.', 1, '2022-06-13 13:01:12'),
                                                                                                                               (478, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico necesidades de cuidado de mi cuerpo y el de otras personas.', 1, '2022-06-13 13:01:29'),
                                                                                                                               (479, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Escucho activamente a mis compañeros y compañeras y reconozco puntos de vista diferentes.', 1, '2022-06-13 13:02:00'),
                                                                                                                               (480, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Valoro y utilizo el conocimiento de diversas personas de mi entorno.', 1, '2022-06-13 13:02:20'),
                                                                                                                               (481, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Valoro y utilizo el conocimiento de diversas personas de mi entorno.', 1, '2022-06-13 13:02:38'),
                                                                                                                               (482, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Cumplo mi función y respeto la de otras personas en el trabajo en grupo.', 1, '2022-06-13 13:02:56'),
                                                                                                                               (483, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco la importancia de animales, plantas, agua y suelo de mi entorno y propongo estrategias para cuidarlos.', 1, '2022-06-13 13:03:18'),
                                                                                                                               (484, 2, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respeto y cuido los seres vivos y los objetos de mi entorno.', 1, '2022-06-13 13:03:35'),
                                                                                                                               (485, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Observo el mundo en el que vivo.', 1, '2022-06-13 13:04:55'),
                                                                                                                               (486, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Formulo preguntas a partir de una observación o experiencia y escojo algunas de ellas para buscar posibles respuestas.', 1, '2022-06-13 13:05:14'),
                                                                                                                               (487, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Propongo explicaciones provisionales para responder mis preguntas.', 1, '2022-06-13 13:05:31'),
                                                                                                                               (488, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico condiciones que influyen en los resultados de una experiencia y que pueden permanecer constantes o cambiar (variables).', 1, '2022-06-13 13:05:56'),
                                                                                                                               (489, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Diseño y realizo experimentos modificando una sola variable para dar respuesta a preguntas.', 1, '2022-06-13 13:06:14'),
                                                                                                                               (490, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Realizo mediciones con instrumentos convencionales (balanza, báscula, cronómetro, termómetro...) y no convencionales (paso, cuarta, pie, braza, vaso...).', 1, '2022-06-13 13:08:45'),
                                                                                                                               (491, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Registro mis observaciones, datos y resultados de manera organizada y rigurosa (sin alteraciones), en forma escrita y utilizando esquemas, gráficos y tablas.', 1, '2022-06-13 13:09:06'),
                                                                                                                               (492, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Busco información en diversas fuentes (libros, Internet, experiencias y experimentos propios y de otros...) y doy el crédito correspondiente.', 1, '2022-06-13 13:09:25'),
                                                                                                                               (493, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre la información y los datos recopilados.', 1, '2022-06-13 13:09:41'),
                                                                                                                               (494, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Selecciono la información que me permite responder a mis preguntas y determino si es suficiente.', 1, '2022-06-13 13:09:59'),
                                                                                                                               (495, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Saco conclusiones de mis experimentos, aunque no obtenga los resultados esperados.', 1, '2022-06-13 13:10:17'),
                                                                                                                               (496, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Propongo respuestas a mis preguntas y las comparo con las de otras personas.', 1, '2022-06-13 13:10:35'),
                                                                                                                               (497, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Persisto en la búsqueda de respuestas a mis preguntas.', 1, '2022-06-13 13:10:53'),
                                                                                                                               (498, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comunico, oralmente y por escrito, el proceso de indagación y los resultados que obtengo.', 1, '2022-06-13 13:11:12'),
                                                                                                                               (499, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Explico la importancia de la célula como unidad básica de los seres vivos.', 1, '2022-06-13 13:11:33'),
                                                                                                                               (500, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico los niveles de organización celular de los seres vivos.', 1, '2022-06-13 13:11:51'),
                                                                                                                               (501, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico en mi entorno objetos que cumplen funciones similares a las de mis órganos y sustento la comparación.', 1, '2022-06-13 13:12:12'),
                                                                                                                               (502, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Represento los diversos sistemas de órganos del ser humano y explico su función.', 1, '2022-06-13 13:12:31'),
                                                                                                                               (503, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Clasifico seres vivos en diversos grupos taxonómicos (plantas, animales, microorganismos...).', 1, '2022-06-13 13:12:53'),
                                                                                                                               (504, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Indago acerca del tipo de fuerza (compresión, tensión o torsión) que puede fracturar diferentes tipos de huesos.', 1, '2022-06-13 13:13:14'),
                                                                                                                               (505, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico máquinas simples en el cuerpo de seres vivos y explico su función.', 1, '2022-06-13 13:13:31'),
                                                                                                                               (506, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Investigo y describo diversos tipos de neuronas, las comparo entre sí y con circuitos eléctricos.', 1, '2022-06-13 13:13:50'),
                                                                                                                               (507, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Analizo el ecosistema que me rodea y lo comparo con otros.', 1, '2022-06-13 13:14:07'),
                                                                                                                               (508, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico adaptaciones de los seres vivos teniendo en cuenta las características de los ecosistemas en que viven.', 1, '2022-06-13 13:14:30'),
                                                                                                                               (509, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Explico la dinámica de un ecosistema teniendo en cuenta las necesidades de energía y nutrientes de los seres vivos (cadena alimentaria).', 1, '2022-06-13 13:14:54'),
                                                                                                                               (510, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico fenómenos de camuflaje en el entorno y los relaciono con las necesidades de los seres vivos.', 1, '2022-06-13 13:15:15'),
                                                                                                                               (511, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo y verifico el efecto de la transferencia de energía térmica en los cambios de estado de algunas sustancias.', 1, '2022-06-13 13:21:34'),
                                                                                                                               (512, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Verifico la posibilidad de mezclar diversos líquidos, sólidos y gases.', 1, '2022-06-13 13:21:53'),
                                                                                                                               (513, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Propongo y verifico diferentes métodos de separación de mezclas.', 1, '2022-06-13 13:27:57'),
                                                                                                                               (514, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre objetos que tienen masas iguales y volúmenes diferentes o viceversa y su posibilidad de flotar.', 1, '2022-06-13 13:28:17'),
                                                                                                                               (515, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo movimientos y desplazamientos de seres vivos y objetos.', 1, '2022-06-13 13:28:36'),
                                                                                                                               (516, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Relaciono el estado de reposo o movimiento de un objeto con las fuerzas aplicadas sobre éste.', 1, '2022-06-13 13:28:56'),
                                                                                                                               (517, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo fuerzas en máquinas simples.', 1, '2022-06-13 13:29:11'),
                                                                                                                               (518, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Verifico la conducción de electricidad o calor en materiales.', 1, '2022-06-13 13:29:29'),
                                                                                                                               (519, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico las funciones de los componentes de un circuito eléctrico.', 1, '2022-06-13 13:29:47'),
                                                                                                                               (520, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo los principales elementos del sistema solar y establezco relaciones de tamaño, movimiento y posición.', 1, '2022-06-13 13:30:09'),
                                                                                                                               (521, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo el peso y la masa de un objeto en diferentes puntos del sistema solar.', 1, '2022-06-13 13:30:31'),
                                                                                                                               (522, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Describo las características físicas de la Tierra y su atmósfera.', 1, '2022-06-13 13:30:48'),
                                                                                                                               (523, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Relaciono el movimiento de traslación con los cambios climáticos.', 1, '2022-06-13 13:31:06'),
                                                                                                                               (524, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre mareas, corrientes marinas, movimiento de placas tectónicas, formas del paisaje y relieve, y las fuerzas que los generan.', 1, '2022-06-13 13:31:30'),
                                                                                                                               (525, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico máquinas simples en objetos cotidianos y describo su utilidad.', 1, '2022-06-13 13:31:51'),
                                                                                                                               (526, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Construyo máquinas simples para solucionar problemas cotidianos.', 1, '2022-06-13 13:32:21'),
                                                                                                                               (527, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico en la historia, situaciones en las que en ausencia de motores potentes, se utilizaron máquinas simples.', 1, '2022-06-13 13:32:42'),
                                                                                                                               (528, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Analizo características ambientales de mi entorno y peligros que lo amenazan.', 1, '2022-06-13 13:33:01'),
                                                                                                                               (529, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre el efecto invernadero, la lluvia ácida y el debilitamiento de la capa de ozono con la contaminación atmosférica.', 1, '2022-06-13 13:33:23'),
                                                                                                                               (530, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Asocio el clima y otras características del entorno con los materiales de construcción, los aparatos eléctricos más utilizados, los recursos naturales y las costumbres de diferentes comunidades.', 1, '2022-06-13 13:33:47'),
                                                                                                                               (531, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Verifico que la cocción de alimentos genera cambios físicos y químicos.', 1, '2022-06-13 13:35:02'),
                                                                                                                               (532, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y describo aparatos que generan energía luminosa, térmica y mecánica.', 1, '2022-06-13 13:35:22'),
                                                                                                                               (533, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y establezco las aplicaciones de los circuitos eléctricos en el desarrollo tecnológico.', 1, '2022-06-13 13:35:40'),
                                                                                                                               (534, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre microorganismos y salud.', 1, '2022-06-13 13:36:02'),
                                                                                                                               (535, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco los efectos nocivos del exceso en el consumo de cafeína, tabaco, drogas y licores.', 1, '2022-06-13 13:36:22'),
                                                                                                                               (536, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre deporte y salud física y mental.', 1, '2022-06-13 13:36:42'),
                                                                                                                               (537, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Escucho activamente a mis compañeros y compañeras, reconozco puntos de vista diferentes y los comparo con los míos.', 1, '2022-06-13 13:37:06'),
                                                                                                                               (538, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco y acepto el escepticismo de mis compañeros y compañeras ante la información que presento.', 1, '2022-06-13 13:37:29'),
                                                                                                                               (539, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Valoro y utilizo el conocimiento de diferentes personas de mi entorno.', 1, '2022-06-13 13:37:45'),
                                                                                                                               (540, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Cumplo mi función cuando trabajo en grupo, respeto las funciones de otros y contribuyo a lograr productos comunes.', 1, '2022-06-13 13:38:23'),
                                                                                                                               (541, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y acepto diferencias en las formas de vida y de pensar.', 1, '2022-06-13 13:40:42'),
                                                                                                                               (542, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco y respeto mis semejanzas y diferencias con los demás en cuanto a género, aspecto y limitaciones físicas.', 1, '2022-06-13 13:41:06'),
                                                                                                                               (543, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Propongo alternativas para cuidar mi entorno y evitar peligros que lo amenazan.', 1, '2022-06-13 13:43:35'),
                                                                                                                               (544, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Cuido, respeto y exijo respeto por mi cuerpo y el de las demás personas.', 1, '2022-06-13 13:43:53'),
                                                                                                                               (545, 2, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Respeto y cuido los seres vivos y los objetos de mi entorno.', 1, '2022-06-13 13:44:11'),
                                                                                                                               (546, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Observo fenómenos específicos.', 1, '2022-06-13 14:10:48'),
                                                                                                                               (547, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo preguntas específicas sobre una observación o experiencia y escojo una para indagar y encontrar posibles respuestas.', 1, '2022-06-13 14:11:11'),
                                                                                                                               (548, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo explicaciones posibles, con base en el conocimiento cotidiano, teorías y modelos científicos, para contestar preguntas.', 1, '2022-06-13 14:11:38'),
                                                                                                                               (549, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico condiciones que influyen en los resultados de un experimento y que pueden permanecer constantes o cambiar (variables).', 1, '2022-06-13 14:11:55'),
                                                                                                                               (550, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Diseño y realizo experimentos y verifico el efecto de modificar diversas variables para dar respuesta a preguntas.', 1, '2022-06-13 14:12:14'),
                                                                                                                               (551, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Realizo mediciones con instrumentos y equipos adecuados a las características y magnitudes de los objetos y las expreso en las unidades correspondientes.', 1, '2022-06-13 14:12:32'),
                                                                                                                               (552, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Registro mis observaciones y resultados utilizando esquemas, gráficos y tablas.', 1, '2022-06-13 14:12:49');
INSERT INTO `caracterizacion_estandar` (`id_estandar`, `id_area`, `grado`, `descripcion_estandar`, `estado`, `created_at`) VALUES
                                                                                                                               (553, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Registro mis resultados en forma organizada y sin alteración alguna.', 1, '2022-06-13 14:13:03'),
                                                                                                                               (554, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco diferencias entre descripción, explicación y evidencia.', 1, '2022-06-13 14:13:17'),
                                                                                                                               (555, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco diferencias entre descripción, explicación y evidencia.', 1, '2022-06-13 14:13:30'),
                                                                                                                               (556, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Busco información en diferentes fuentes.', 1, '2022-06-13 14:13:47'),
                                                                                                                               (557, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Evalúo la calidad de la información, escojo la pertinente y doy el crédito correspondiente.', 1, '2022-06-13 14:14:04'),
                                                                                                                               (558, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones causales entre los datos recopilados.', 1, '2022-06-13 14:14:19'),
                                                                                                                               (559, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre la información recopilada en otras fuentes y los datos generados en mis experimentos.', 1, '2022-06-13 14:14:36'),
                                                                                                                               (560, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo si la información que he obtenido es suficiente para contestar mis preguntas o sustentar mis explicaciones.', 1, '2022-06-13 14:14:53'),
                                                                                                                               (561, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Saco conclusiones de los experimentos que realizo, aunque no obtenga los resultados esperados.', 1, '2022-06-13 14:15:10'),
                                                                                                                               (562, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Persisto en la búsqueda de respuestas a mis preguntas.', 1, '2022-06-13 14:15:28'),
                                                                                                                               (563, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Propongo respuestas a mis preguntas y las comparo con las de otras personas y con las de teorías científicas.', 1, '2022-06-13 14:15:44'),
                                                                                                                               (564, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Sustento mis respuestas con diversos argumentos.', 1, '2022-06-13 14:15:57'),
                                                                                                                               (565, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y uso adecuadamente el lenguaje propio de las ciencias.', 1, '2022-06-13 14:16:17'),
                                                                                                                               (566, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comunico oralmente y por escrito el proceso de indagación y los resultados que obtengo, utilizando gráficas, tablas y ecuaciones aritméticas.', 1, '2022-06-13 14:16:35'),
                                                                                                                               (567, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono mis conclusiones con las presentadas por otros autores y formulo nuevas preguntas.', 1, '2022-06-13 14:16:51'),
                                                                                                                               (568, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico la estructura de la célula y las funciones básicas de sus componentes.', 1, '2022-06-13 14:17:11'),
                                                                                                                               (569, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Verifico y explico los procesos de ósmosis y difusión.', 1, '2022-06-13 14:17:28'),
                                                                                                                               (570, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico membranas de los seres vivos de acuerdo con su permeabilidad frente a diversas sustancias.', 1, '2022-06-13 14:17:45'),
                                                                                                                               (571, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico organismos en grupos taxonómicos de acuerdo con las características de sus células.', 1, '2022-06-13 14:18:04'),
                                                                                                                               (572, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo sistemas de división celular y argumento su importancia en la generación de nuevos organismos y tejidos.', 1, '2022-06-13 14:18:21'),
                                                                                                                               (573, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico las funciones de los seres vivos a partir de las relaciones entre diferentes sistemas de órganos.', 1, '2022-06-13 14:18:39'),
                                                                                                                               (574, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo mecanismos de obtención de energía en los seres vivos.', 1, '2022-06-13 14:18:55'),
                                                                                                                               (575, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco en diversos grupos taxonómicos la presencia de las mismas moléculas orgánicas.', 1, '2022-06-13 14:19:15'),
                                                                                                                               (576, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico el origen del universo y de la vida a partir de varias teorías.', 1, '2022-06-13 14:19:30'),
                                                                                                                               (577, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Caracterizo ecosistemas y analizo el equilibrio dinámico entre sus poblaciones.', 1, '2022-06-13 14:19:47'),
                                                                                                                               (578, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Propongo explicaciones sobre la diversidad biológica teniendo en cuenta el movimiento de placas tectónicas y las características climáticas.', 1, '2022-06-13 14:20:07'),
                                                                                                                               (579, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco las adaptaciones de algunos seres vivos en ecosistemas de Colombia.', 1, '2022-06-13 14:20:23'),
                                                                                                                               (580, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo hipótesis sobre las causas de extinción de un grupo taxonómico.', 1, '2022-06-13 14:20:39'),
                                                                                                                               (581, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico la importancia del agua en el sostenimiento de la vida.', 1, '2022-06-13 14:20:56'),
                                                                                                                               (582, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo y relaciono los ciclos del agua, de algunos elementos y de la energía en los ecosistemas.', 1, '2022-06-13 14:21:24'),
                                                                                                                               (583, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico la función del suelo como depósito de nutrientes.', 1, '2022-06-13 14:21:35'),
                                                                                                                               (584, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico y verifico las propiedades de la materia.', 1, '2022-06-13 14:29:01'),
                                                                                                                               (585, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Verifico la acción de fuerzas electrostáticas y magnéticas y explico su relación con la carga eléctrica.', 1, '2022-06-13 14:29:19'),
                                                                                                                               (586, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo el desarrollo de modelos que explican la estructura de la materia.', 1, '2022-06-13 14:29:36'),
                                                                                                                               (587, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico materiales en sustancias puras o mezclas.', 1, '2022-06-13 14:29:50'),
                                                                                                                               (588, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Verifico diferentes métodos de separación de mezclas.', 1, '2022-06-13 14:30:07'),
                                                                                                                               (589, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico cómo un número limitado de elementos hace posible la diversidad de la materia conocida.', 1, '2022-06-13 14:30:27'),
                                                                                                                               (590, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico el desarrollo de modelos de organización de los elementos químicos.', 1, '2022-06-13 14:30:43'),
                                                                                                                               (591, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico y utilizo la tabla periódica como herramienta para predecir procesos químicos.', 1, '2022-06-13 14:31:02'),
                                                                                                                               (592, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico la formación de moléculas y los estados de la materia a partir de fuerzas electrostáticas.', 1, '2022-06-13 14:31:20'),
                                                                                                                               (593, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono energía y movimiento.', 1, '2022-06-13 14:31:34'),
                                                                                                                               (594, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Verifico relaciones entre distancia recorrida, velocidad y fuerza involucrada en diversos tipos de movimiento.', 1, '2022-06-13 14:31:51'),
                                                                                                                               (595, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo masa, peso y densidad de diferentes materiales mediante experimentos.', 1, '2022-06-13 14:32:08'),
                                                                                                                               (596, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico el modelo planetario desde las fuerzas gravitacionales.', 1, '2022-06-13 14:32:30'),
                                                                                                                               (597, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo el proceso de formación y extinción de estrellas.', 1, '2022-06-13 14:32:48'),
                                                                                                                               (598, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono masa, peso y densidad con la aceleración de la gravedad en distintos puntos del sistema solar.', 1, '2022-06-13 14:33:06'),
                                                                                                                               (599, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico las consecuencias del movimiento de las placas tectónicas sobre la corteza de la Tierra.', 1, '2022-06-13 14:33:26'),
                                                                                                                               (600, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo el potencial de los recursos naturales de mi entorno para la obtención de energía e indico sus posibles usos.', 1, '2022-06-13 14:33:46'),
                                                                                                                               (601, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico recursos renovables y no renovables y los peligros a los que están expuestos debido al desarrollo de los grupos humanos.', 1, '2022-06-13 14:34:08'),
                                                                                                                               (602, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Justifico la importancia del recurso hídrico en el surgimiento y desarrollo de comunidades humanas.', 1, '2022-06-13 14:34:25'),
                                                                                                                               (603, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico factores de contaminación en mi entorno y sus implicaciones para la salud.', 1, '2022-06-13 14:34:41'),
                                                                                                                               (604, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono la dieta de algunas comunidades humanas con los recursos disponibles y determino si es balanceada.', 1, '2022-06-13 14:34:58'),
                                                                                                                               (605, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo las implicaciones y responsabilidades de la sexualidad y la reproducción para el individuo y para su comunidad.', 1, '2022-06-13 14:35:18'),
                                                                                                                               (606, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre transmisión de enfermedades y medidas de prevención y control.', 1, '2022-06-13 14:35:36'),
                                                                                                                               (607, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico aplicaciones de diversos métodos de separación de mezclas en procesos industriales.', 1, '2022-06-13 14:36:05'),
                                                                                                                               (608, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco los efectos nocivos del exceso en el consumo de cafeína, tabaco, drogas y licores.', 1, '2022-06-13 14:36:24'),
                                                                                                                               (609, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre deporte y salud física y mental.', 1, '2022-06-13 14:36:38'),
                                                                                                                               (610, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Indago sobre los adelantos científicos y tecnológicos que han hecho posible la exploración del universo.', 1, '2022-06-13 14:36:57'),
                                                                                                                               (611, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Indago sobre un avance tecnológico en medicina y explico el uso de las ciencias naturales en su desarrollo.', 1, '2022-06-13 14:37:15'),
                                                                                                                               (612, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Indago acerca del uso industrial de microorganismos que habitan en ambientes extremos.', 1, '2022-06-13 14:37:34'),
                                                                                                                               (613, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Escucho activamente a mis compañeros y compañeras, reconozco otros puntos de vista, los comparo con los míos y puedo modificar lo que pienso ante argumentos más sólidos.', 1, '2022-06-13 14:38:00'),
                                                                                                                               (614, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco y acepto el escepticismo de mis compañeros y compañeras ante la información que presento.', 1, '2022-06-13 14:38:20'),
                                                                                                                               (615, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco los aportes de conocimientos diferentes al científico.', 1, '2022-06-13 14:38:38'),
                                                                                                                               (616, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco que los modelos de la ciencia cambian con el tiempo y que varios pueden ser válidos simultáneamente.', 1, '2022-06-13 14:38:59'),
                                                                                                                               (617, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Cumplo mi función cuando trabajo en grupo y respeto las funciones de las demás personas.', 1, '2022-06-13 14:39:19'),
                                                                                                                               (618, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y acepto diferencias en las formas de vivir, pensar, solucionar problemas o aplicar conocimientos.', 1, '2022-06-13 14:39:42'),
                                                                                                                               (619, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Me informo para participar en debates sobre temas de interés general en ciencias.', 1, '2022-06-13 14:40:06'),
                                                                                                                               (620, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Diseño y aplico estrategias para el manejo de basuras en mi colegio.', 1, '2022-06-13 14:40:24'),
                                                                                                                               (621, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Cuido, respeto y exijo respeto por mi cuerpo y por los cambios corporales que estoy viviendo y que viven las demás personas.', 1, '2022-06-13 14:40:49'),
                                                                                                                               (622, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Tomo decisiones sobre alimentación y práctica de ejercicio que favorezcan mi salud.', 1, '2022-06-13 14:41:05'),
                                                                                                                               (623, 2, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Respeto y cuido los seres vivos y los objetos de mi entorno.', 1, '2022-06-13 14:41:21'),
                                                                                                                               (624, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Observo fenómenos específicos.', 1, '2022-06-14 05:03:39'),
                                                                                                                               (625, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Formulo preguntas específicas sobre una observación, sobre una experiencia o sobre las aplicaciones de teorías científicas.', 1, '2022-06-14 05:03:58'),
                                                                                                                               (626, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Formulo preguntas específicas sobre una observación, sobre una experiencia o sobre las aplicaciones de teorías científicas.', 0, '2022-06-14 05:04:17'),
                                                                                                                               (627, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Formulo preguntas específicas sobre una observación, sobre una experiencia o sobre las aplicaciones de teorías científicas.', 0, '2022-06-14 05:04:40'),
                                                                                                                               (628, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Propongo modelos para predecir los resultados de mis experimentos.', 1, '2022-06-14 05:05:17'),
                                                                                                                               (629, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Realizo mediciones con instrumentos adecuados a las características y magnitudes de los objetos de estudio y las expreso en las unidades correspondientes.', 1, '2022-06-14 05:05:45'),
                                                                                                                               (630, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Registro mis observaciones y resultados utilizando esquemas, gráficos y tablas.', 1, '2022-06-14 05:06:06'),
                                                                                                                               (631, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Registro mis resultados en forma organizada y sin alteración alguna.', 0, '2022-06-14 05:06:26'),
                                                                                                                               (632, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Registro mis resultados en forma organizada y sin alteración alguna.', 1, '2022-06-14 05:06:40'),
                                                                                                                               (633, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo las matemáticas como herramienta para modelar, analizar y presentar datos.', 1, '2022-06-14 05:07:00'),
                                                                                                                               (634, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Busco información en diferentes fuentes.', 1, '2022-06-14 05:07:17'),
                                                                                                                               (635, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Busco información en diferentes fuentes.', 1, '2022-06-14 05:07:39'),
                                                                                                                               (636, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Busco información en diferentes fuentes.', 1, '2022-06-14 05:07:53'),
                                                                                                                               (637, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre la información recopilada y mis resultados.', 1, '2022-06-14 05:08:11'),
                                                                                                                               (638, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre la información recopilada y mis resultados.', 0, '2022-06-14 05:08:26'),
                                                                                                                               (639, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Saco conclusiones de los experimentos que realizo, aunque no obtenga los resultados esperados.', 1, '2022-06-14 05:09:04'),
                                                                                                                               (640, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Persisto en la búsqueda de respuestas a mis preguntas.', 1, '2022-06-14 05:10:11'),
                                                                                                                               (641, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Propongo y sustento respuestas a mis preguntas y las comparo con las de otras personas y con las de teorías científicas.', 1, '2022-06-14 05:10:34'),
                                                                                                                               (642, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y uso adecuadamente el lenguaje propio de las ciencias.', 1, '2022-06-14 05:10:50'),
                                                                                                                               (643, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comunico el proceso de indagación y los resultados, utilizando gráficas, tablas, ecuaciones aritméticas y algebraicas.', 1, '2022-06-14 05:11:08'),
                                                                                                                               (644, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Relaciono mis conclusiones con las presentadas por otros autores y formulo nuevas preguntas.', 1, '2022-06-14 05:11:25'),
                                                                                                                               (645, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco la importancia del modelo de la doble hélice para la explicación del almacenamiento y transmisión del material hereditario.', 1, '2022-06-14 05:11:48'),
                                                                                                                               (646, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre los genes, las proteínas y las funciones celulares.', 1, '2022-06-14 05:12:09'),
                                                                                                                               (647, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo diferentes sistemas de reproducción.', 1, '2022-06-14 05:12:30'),
                                                                                                                               (648, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Justifico la importancia de la reproducción sexual en el mantenimiento de la variabilidad.', 1, '2022-06-14 05:12:52'),
                                                                                                                               (649, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco la relación entre el ciclo menstrual y la reproducción humana.', 1, '2022-06-14 05:13:12'),
                                                                                                                               (650, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo las consecuencias del control de la natalidad en las poblaciones.', 1, '2022-06-14 05:13:33'),
                                                                                                                               (651, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Clasifico organismos en grupos taxonómicos de acuerdo con sus características celulares.', 1, '2022-06-14 05:13:53'),
                                                                                                                               (652, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Propongo alternativas de clasificación de algunos organismos de difícil ubicación taxonómica.', 1, '2022-06-14 05:14:18'),
                                                                                                                               (653, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico criterios para clasificar individuos dentro de una misma especie.', 1, '2022-06-14 05:14:36'),
                                                                                                                               (654, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo sistemas de órganos de diferentes grupos taxonómicos.', 1, '2022-06-14 05:14:53'),
                                                                                                                               (655, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico la importancia de las hormonas en la regulación de las funciones en el ser humano.', 1, '2022-06-14 05:15:15'),
                                                                                                                               (656, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo y explico los sistemas de defensa y ataque de algunos animales y plantas en el aspecto morfológico y fisiológico.', 1, '2022-06-14 05:15:38'),
                                                                                                                               (657, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Formulo hipótesis acerca del origen y evolución de un grupo de organismos.', 1, '2022-06-14 05:15:57'),
                                                                                                                               (658, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre el clima en las diferentes eras geológicas y las adaptaciones de los seres vivos.', 1, '2022-06-14 05:16:23'),
                                                                                                                               (659, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo diferentes teorías sobre el origen de las especies.', 1, '2022-06-14 05:16:44'),
                                                                                                                               (660, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo masa, peso, cantidad de sustancia y densidad de diferentes materiales.', 1, '2022-06-14 05:20:01'),
                                                                                                                               (661, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo sólidos, líquidos y gases teniendo en cuenta el movimiento de sus moléculas y las fuerzas electroestáticas.', 1, '2022-06-14 05:20:21'),
                                                                                                                               (662, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Verifico las diferencias entre cambios químicos y mezclas.', 1, '2022-06-14 05:20:41'),
                                                                                                                               (663, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Verifico las diferencias entre cambios químicos y mezclas.', 1, '2022-06-14 05:21:10'),
                                                                                                                               (664, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones cuantitativas entre los componentes de una solución.', 1, '2022-06-14 05:21:26'),
                                                                                                                               (665, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo los modelos que sustentan la definición ácido-base.', 1, '2022-06-14 05:21:43'),
                                                                                                                               (666, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre las variables de estado en un sistema termodinámico para predecir cambios físicos y químicos y las expreso matemáticamente.', 1, '2022-06-14 05:22:05'),
                                                                                                                               (667, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo los modelos que explican el comportamiento de gases ideales y reales.', 1, '2022-06-14 05:22:39'),
                                                                                                                               (668, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre energía interna de un sistema termodinámico, trabajo y transferencia de energía térmica; las expreso matemáticamente.', 1, '2022-06-14 05:23:00'),
                                                                                                                               (669, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Relaciono las diversas formas de transferencia de energía térmica con la formación de vientos.', 1, '2022-06-14 05:23:20'),
                                                                                                                               (670, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre frecuencia, amplitud, velocidad de propagación y longitud de onda en diversos tipos de ondas mecánicas.', 1, '2022-06-14 05:23:44'),
                                                                                                                               (671, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico el principio de conservación de la energía en ondas que cambian de medio de propagación.', 1, '2022-06-14 05:24:08'),
                                                                                                                               (672, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco y diferencio modelos para explicar la naturaleza y el comportamiento de la luz.', 1, '2022-06-14 05:24:32'),
                                                                                                                               (673, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico la utilidad del ADN como herramienta de análisis genético.', 1, '2022-06-14 05:25:06'),
                                                                                                                               (674, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Argumento las ventajas y desventajas de la manipulación genética.', 1, '2022-06-14 05:25:25'),
                                                                                                                               (675, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco la importancia de mantener la biodiversidad para estimular el desarrollo del país.', 1, '2022-06-14 05:25:46'),
                                                                                                                               (676, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Indago sobre aplicaciones de la microbiología en la industria.', 1, '2022-06-14 05:26:09'),
                                                                                                                               (677, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo información química de las etiquetas de productos manufacturados por diferentes casas comerciales.', 1, '2022-06-14 05:26:30'),
                                                                                                                               (678, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico productos que pueden tener diferentes niveles de pH y explico algunos de sus usos en actividades cotidianas.', 1, '2022-06-14 05:27:00'),
                                                                                                                               (679, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico la relación entre ciclos termodinámicos y el funcionamiento de motores.', 1, '2022-06-14 05:27:20'),
                                                                                                                               (680, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico las aplicaciones de las ondas estacionarias en el desarrollo de instrumentos musicales.', 1, '2022-06-14 05:27:40'),
                                                                                                                               (681, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico aplicaciones de los diferentes modelos de la luz.', 1, '2022-06-14 05:27:57'),
                                                                                                                               (682, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Describo factores culturales y tecnológicos que inciden en la sexualidad y reproducción humanas.', 1, '2022-06-14 05:28:17'),
                                                                                                                               (683, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y explico medidas de prevención del embarazo y de las enfermedades de transmisión sexual.', 1, '2022-06-14 05:28:42'),
                                                                                                                               (684, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco los efectos nocivos del exceso en el consumo de cafeína, tabaco, drogas y licores.', 1, '2022-06-14 05:29:03'),
                                                                                                                               (685, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Establezco relaciones entre el deporte y la salud física y mental.', 1, '2022-06-14 05:29:22'),
                                                                                                                               (686, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Indago sobre avances tecnológicos en comunicaciones y explico sus implicaciones para la sociedad.', 1, '2022-06-14 05:29:43'),
                                                                                                                               (687, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Describo procesos físicos y químicos de la contaminación atmosférica.', 1, '2022-06-14 05:30:00'),
                                                                                                                               (688, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Escucho activamente a mis compañeros y compañeras, reconozco otros puntos de vista, los comparo con los míos y puedo modificar lo que pienso ante argumentos más sólidos.', 1, '2022-06-14 05:30:28'),
                                                                                                                               (689, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco y acepto el escepticismo de mis compañeros y compañeras ante la información que presento.', 1, '2022-06-14 05:30:47'),
                                                                                                                               (690, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco los aportes de conocimientos diferentes al científico.', 1, '2022-06-14 05:31:04'),
                                                                                                                               (691, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco que los modelos de la ciencia cambian con el tiempo y que varios pueden ser válidos simultáneamente.', 1, '2022-06-14 05:31:25'),
                                                                                                                               (692, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Cumplo mi función cuando trabajo en grupo y respeto las funciones de las demás personas.', 1, '2022-06-14 05:31:44'),
                                                                                                                               (693, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Me informo para participar en debates sobre temas de interés general en ciencias.', 1, '2022-06-14 05:32:09'),
                                                                                                                               (694, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Diseño y aplico estrategias para el manejo de basuras en mi colegio.', 1, '2022-06-14 05:32:24'),
                                                                                                                               (695, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Cuido, respeto y exijo respeto por mi cuerpo y por los cambios corporales que estoy viviendo y que viven las demás personas.', 1, '2022-06-14 05:32:52'),
                                                                                                                               (696, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Tomo decisiones responsables y compartidas sobre mi sexualidad.', 1, '2022-06-14 05:33:18'),
                                                                                                                               (697, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo críticamente los papeles tradicionales de género en nuestra cultura con respecto a la sexualidad y la reproducción.', 1, '2022-06-14 05:33:42'),
                                                                                                                               (698, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Tomo decisiones sobre alimentación y práctica de ejercicio que favorezcan mi salud.', 1, '2022-06-14 05:34:05'),
                                                                                                                               (699, 2, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Respeto y cuido los seres vivos y los objetos de mi entorno.', 1, '2022-06-14 05:34:24'),
                                                                                                                               (700, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Observo y formulo preguntas específicas sobre aplicaciones de teorías científicas.', 1, '2022-06-14 05:37:59'),
                                                                                                                               (701, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Formulo hipótesis con base en el conocimiento cotidiano, teorías y modelos científicos.', 1, '2022-06-14 05:38:16'),
                                                                                                                               (702, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico variables que influyen en los resultados de un experimento.', 1, '2022-06-14 05:39:02'),
                                                                                                                               (703, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Propongo modelos para predecir los resultados de mis experimentos y simulaciones.', 1, '2022-06-14 05:41:01'),
                                                                                                                               (704, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Realizo mediciones con instrumentos y equipos adecuados.', 1, '2022-06-14 05:41:20'),
                                                                                                                               (705, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Registro mis observaciones y resultados utilizando esquemas, gráficos y tablas.', 1, '2022-06-14 05:41:39'),
                                                                                                                               (706, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Registro mis resultados en forma organizada y sin alteración alguna.', 1, '2022-06-14 05:41:57'),
                                                                                                                               (707, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco diferencias entre descripción, explicación y evidencia.', 1, '2022-06-14 05:42:12'),
                                                                                                                               (708, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco diferencias entre modelos, teorías, leyes e hipótesis.', 1, '2022-06-14 05:42:33'),
                                                                                                                               (709, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo las matemáticas para modelar, analizar y presentar datos y modelos en forma de ecuaciones, funciones y conversiones.', 1, '2022-06-14 05:42:51'),
                                                                                                                               (710, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Busco información en diferentes fuentes, escojo la pertinente y doy el crédito correspondiente.', 1, '2022-06-14 05:43:12'),
                                                                                                                               (711, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones causales y multicausales entre los datos recopilados.', 1, '2022-06-14 05:43:27'),
                                                                                                                               (712, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono la información recopilada con los datos de mis experimentos y simulaciones.', 1, '2022-06-14 05:43:56'),
                                                                                                                               (713, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto los resultados teniendo en cuenta el orden de magnitud del error experimental.', 1, '2022-06-14 05:44:29'),
                                                                                                                               (714, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Saco conclusiones de los experimentos que realizo, aunque no obtenga los resultados esperados.', 1, '2022-06-14 05:44:51'),
                                                                                                                               (715, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Persisto en la búsqueda de respuestas a mis preguntas.', 1, '2022-06-14 05:45:16'),
                                                                                                                               (716, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Propongo y sustento respuestas a mis preguntas y las comparo con las de otros y con las de teorías científicas.', 1, '2022-06-14 05:45:37'),
                                                                                                                               (717, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comunico el proceso de indagación y los resultados, utilizando gráficas, tablas, ecuaciones aritméticas y algebraicas.', 1, '2022-06-14 05:45:57'),
                                                                                                                               (718, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono mis conclusiones con las presentadas por otros autores y formulo nuevas preguntas.', 1, '2022-06-14 05:46:14'),
                                                                                                                               (719, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la relación entre el ADN, el ambiente y la diversidad de los seres vivos.', 1, '2022-06-14 06:01:32'),
                                                                                                                               (720, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre mutación, selección natural y herencia.', 1, '2022-06-14 06:03:32'),
                                                                                                                               (721, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comparo casos en especies actuales que ilustren diferentes acciones de la selección natural.', 1, '2022-06-14 06:03:54'),
                                                                                                                               (722, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico las relaciones entre materia y energía en las cadenas alimentarias.', 1, '2022-06-14 06:04:16'),
                                                                                                                               (723, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Argumento la importancia de la fotosíntesis como un proceso de conversión de energía necesaria para organismos aerobios.', 1, '2022-06-14 06:04:47'),
                                                                                                                               (724, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Busco ejemplos de principios termodinámicos en algunos ecosistemas.', 1, '2022-06-14 06:05:25'),
                                                                                                                               (725, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico y explico ejemplos del modelo de mecánica de fluidos en los seres vivos.', 1, '2022-06-14 06:05:45'),
                                                                                                                               (726, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico el funcionamiento de neuronas a partir de modelos químicos y eléctricos.', 1, '2022-06-14 06:06:08'),
                                                                                                                               (727, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono los ciclos del agua y de los elementos con la energía de los ecosistemas.', 1, '2022-06-14 06:06:31'),
                                                                                                                               (728, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico diversos tipos de relaciones entre especies en los ecosistemas.', 1, '2022-06-14 06:06:54'),
                                                                                                                               (729, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre individuo, población, comunidad y ecosistema.', 1, '2022-06-14 06:07:14'),
                                                                                                                               (730, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico y comparo algunas adaptaciones de seres vivos en ecosistemas del mundo y de Colombia.', 1, '2022-06-14 06:07:47'),
                                                                                                                               (731, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la estructura de los átomos a partir de diferentes teorías.', 1, '2022-06-14 06:09:56'),
                                                                                                                               (732, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la estructura de los átomos a partir de diferentes teorías.', 1, '2022-06-14 06:10:30'),
                                                                                                                               (733, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la obtención de energía nuclear a partir de la alteración de la estructura del átomo.', 1, '2022-06-14 06:10:53'),
                                                                                                                               (734, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico cambios químicos en la vida cotidiana y en el ambiente.', 1, '2022-06-14 06:11:15'),
                                                                                                                               (735, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico los cambios químicos desde diferentes modelos.', 1, '2022-06-14 06:12:18'),
                                                                                                                               (736, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la relación entre la estructura de los átomos y los enlaces que realiza.', 1, '2022-06-14 06:12:49'),
                                                                                                                               (737, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Verifico el efecto de presión y temperatura en los cambios químicos.', 1, '2022-06-14 06:13:17'),
                                                                                                                               (738, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Uso la tabla periódica para determinar propiedades físicas y químicas de los elementos.', 1, '2022-06-14 06:13:49'),
                                                                                                                               (739, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Realizo cálculos cuantitativos en cambios químicos.', 1, '2022-06-14 06:14:08'),
                                                                                                                               (740, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico condiciones para controlar la velocidad de cambios químicos.', 1, '2022-06-14 06:14:31'),
                                                                                                                               (741, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Caracterizo cambios químicos en condiciones de equilibrio.', 1, '2022-06-14 06:14:50'),
                                                                                                                               (742, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono la estructura del carbono con la formación de moléculas orgánicas.', 1, '2022-06-14 06:15:19'),
                                                                                                                               (743, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono grupos funcionales con las propiedades físicas y químicas de las sustancias.', 1, '2022-06-14 06:15:50'),
                                                                                                                               (744, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico algunos cambios químicos que ocurren en el ser humano.', 1, '2022-06-14 06:16:35'),
                                                                                                                               (745, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre las diferentes fuerzas que actúan sobre los cuerpos en reposo o en movimiento rectilíneo uniforme y establezco condiciones para\r\nconservar la energía mecánica.', 1, '2022-06-14 06:21:53'),
                                                                                                                               (746, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Modelo matemáticamente el movimiento de objetos cotidianos a partir de las fuerzas que actúan sobre ellos.', 1, '2022-06-14 06:22:18'),
                                                                                                                               (747, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico la transformación de energía mecánica en energía térmica.', 1, '2022-06-14 06:22:36'),
                                                                                                                               (748, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre estabilidad y centro de masa de un objeto.', 1, '2022-06-14 06:24:00'),
                                                                                                                               (749, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre la conservación del momento lineal y el impulso en sistemas de objetos.', 1, '2022-06-14 06:24:25'),
                                                                                                                               (750, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico el comportamiento de fluidos en movimiento y en reposo.', 1, '2022-06-14 06:24:51'),
                                                                                                                               (751, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono masa, distancia y fuerza de atracción gravitacional entre objetos.', 1, '2022-06-14 06:25:23'),
                                                                                                                               (752, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre el modelo del campo gravitacional y la ley de gravitación universal.', 1, '2022-06-14 06:25:49'),
                                                                                                                               (753, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre fuerzas macroscópicas y fuerzas electrostáticas.', 1, '2022-06-14 06:26:09'),
                                                                                                                               (754, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre campo gravitacional y electrostático y entre campo eléctrico y magnético.', 1, '2022-06-14 06:26:41'),
                                                                                                                               (755, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Relaciono voltaje y corriente con los diferentes elementos de un circuito eléctrico complejo y para todo el sistema.', 1, '2022-06-14 06:27:23'),
                                                                                                                               (756, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico aplicaciones tecnológicas del modelo de mecánica de fluidos.', 1, '2022-06-14 06:27:43'),
                                                                                                                               (757, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo el desarrollo de los componentes de los circuitos eléctricos y su impacto en la vida diaria.', 1, '2022-06-14 06:28:05'),
                                                                                                                               (758, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo el potencial de los recursos naturales en la obtención de energía para diferentes usos.', 1, '2022-06-14 06:28:33'),
                                                                                                                               (759, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre el deporte y la salud física y mental.', 1, '2022-06-14 06:29:26'),
                                                                                                                               (760, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico el funcionamiento de algún antibiótico y reconozco la importancia de su uso correcto.', 1, '2022-06-14 06:29:46'),
                                                                                                                               (761, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco los efectos nocivos del exceso en el consumo de cafeína, tabaco, drogas y licores.', 1, '2022-06-14 06:30:07'),
                                                                                                                               (762, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico cambios químicos en la cocina, la industria y el ambiente.', 1, '2022-06-14 06:30:33'),
                                                                                                                               (763, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Verifico la utilidad de microorganismos en la industria alimenticia.', 1, '2022-06-14 06:30:52'),
                                                                                                                               (764, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo factores culturales y tecnológicos que inciden en la sexualidad y la reproducción humanas.', 1, '2022-06-14 06:31:14'),
                                                                                                                               (765, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Argumento la importancia de las medidas de prevención del embarazo y de las enfermedades de transmisión sexual en el mantenimiento de la salud individual y colectiva.', 1, '2022-06-14 06:31:42'),
                                                                                                                               (766, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico tecnologías desarrolladas en Colombia.', 1, '2022-06-14 06:31:59'),
                                                                                                                               (767, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Escucho activamente a mis compañeros y compañeras, reconozco otros puntos de vista, los comparo con los míos y puedo modificar lo que pienso ante argumentos más sólidos.', 1, '2022-06-14 06:35:31'),
                                                                                                                               (768, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco y acepto el escepticismo de mis compañeros y compañeras ante la información que presento.', 1, '2022-06-14 06:35:54'),
                                                                                                                               (769, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco los aportes de conocimientos diferentes al científico.', 1, '2022-06-14 06:36:16'),
                                                                                                                               (770, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco que los modelos de la ciencia cambian con el tiempo y que varios pueden ser válidos simultáneamente.', 1, '2022-06-14 06:36:38'),
                                                                                                                               (771, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Cumplo mi función cuando trabajo en grupo y respeto las funciones de otras personas.', 1, '2022-06-14 06:36:54'),
                                                                                                                               (772, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Cumplo mi función cuando trabajo en grupo y respeto las funciones de otras personas.', 1, '2022-06-14 06:37:17'),
                                                                                                                               (773, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Me informo para participar en debates sobre temas de interés general en ciencias.', 1, '2022-06-14 06:37:33'),
                                                                                                                               (774, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Diseño y aplico estrategias para el manejo de basuras en mi colegio.', 1, '2022-06-14 06:37:52'),
                                                                                                                               (775, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Cuido, respeto y exijo respeto por mi cuerpo y por el de las demás personas.', 1, '2022-06-14 06:38:16'),
                                                                                                                               (776, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Tomo decisiones responsables y compartidas sobre mi sexualidad.', 1, '2022-06-14 06:38:33'),
                                                                                                                               (777, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo críticamente los papeles tradicionales de género en nuestra cultura con respecto a la sexualidad y la reproducción.', 1, '2022-06-14 06:38:55'),
                                                                                                                               (778, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Tomo decisiones sobre alimentación y práctica de ejercicio que favorezcan mi salud.', 1, '2022-06-14 06:39:12'),
                                                                                                                               (779, 2, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Me informo sobre avances tecnológicos para discutir y asumir posturas fundamentadas sobre sus implicaciones éticas.', 1, '2022-06-14 06:39:41'),
                                                                                                                               (780, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Hago preguntas sobre mí y sobre las organizaciones sociales a las que pertenezco (familia, curso, colegio, barrio...).', 1, '2022-06-14 06:43:04'),
                                                                                                                               (781, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco diversos aspectos míos y de las organizaciones sociales a las que pertenezco, así como los cambios que han ocurrido a través del tiempo.', 1, '2022-06-14 06:43:22'),
                                                                                                                               (782, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso diversas fuentes para obtener la información que necesito (entrevistas a mis familiares y profesores, fotografías, textos escolares y otros).', 1, '2022-06-14 06:43:41'),
                                                                                                                               (783, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Organizo la información utilizando cuadros, gráficas...', 1, '2022-06-14 06:43:59'),
                                                                                                                               (784, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre la información obtenida en diferentes fuentes y propongo respuestas a mis preguntas.', 1, '2022-06-14 06:44:20'),
                                                                                                                               (785, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Utilizo diversas formas de expresión (oral, escrita, gráfica) para comunicar los resultados de mi investigación.', 1, '2022-06-14 06:44:39'),
                                                                                                                               (786, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Doy crédito a las diferentes fuentes de la información obtenida (cuento a quién entrevisté, qué libros miré, qué fotos comparé...).', 1, '2022-06-14 06:45:04'),
                                                                                                                               (787, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico algunas características físicas, sociales, culturales y emocionales que hacen de mí un ser único.', 1, '2022-06-14 06:46:04'),
                                                                                                                               (788, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo algunas características socioculturales de comunidades a las que pertenezco y de otras diferentes a las mías.', 1, '2022-06-14 06:46:29'),
                                                                                                                               (789, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo cambios y aspectos que se mantienen en mí y en las organizaciones de mi entorno.', 1, '2022-06-14 06:46:51'),
                                                                                                                               (790, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco en mi entorno cercano las huellas que dejaron las comunidades que lo ocuparon en el pasado (monumentos, museos, sitios de conservación histórica...).', 1, '2022-06-14 06:47:25'),
                                                                                                                               (791, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo algunos elementos que permiten reconocerme como miembro de un grupo regional y de una nación (territorio, lenguas, costumbres, símbolos\r\npatrios...).', 1, '2022-06-14 06:47:48'),
                                                                                                                               (792, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco características básicas de la diversidad étnica y cultural en Colombia.', 1, '2022-06-14 06:48:32'),
                                                                                                                               (793, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico los aportes culturales que mi comunidad y otras diferentes a la mía han hecho a lo que somos hoy.', 1, '2022-06-14 06:48:54'),
                                                                                                                               (794, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco conflictos que se generan cuando no se respetan mis rasgos particulares o los de otras personas.', 1, '2022-06-14 06:49:29'),
                                                                                                                               (795, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Me ubico en el entorno físico y de representación (en mapas y planos) utilizando referentes espaciales como arriba, abajo, dentro, fuera, derecha, izquierda.', 1, '2022-06-14 06:50:08'),
                                                                                                                               (796, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre los espacios físicos que ocupo (salón de clase, colegio, municipio...) y sus representaciones (mapas, planos, maquetas...).', 1, '2022-06-14 06:50:45'),
                                                                                                                               (797, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco diversas formas de representación de la Tierra.', 1, '2022-06-14 06:51:07'),
                                                                                                                               (798, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y describo las características físicas de las principales formas del paisaje.', 1, '2022-06-14 06:51:33'),
                                                                                                                               (799, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo las características de un paisaje natural y de un paisaje cultural.', 1, '2022-06-14 06:51:52'),
                                                                                                                               (800, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo las características de un paisaje natural y de un paisaje cultural.', 1, '2022-06-14 06:52:16'),
                                                                                                                               (801, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre los accidentes geográficos y su representación gráfica.', 1, '2022-06-14 06:52:32'),
                                                                                                                               (802, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre paisajes naturales y paisajes culturales.', 1, '2022-06-14 06:52:48'),
                                                                                                                               (803, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico formas de medir el tiempo (horas, días, años...) y las relaciono con las actividades de las personas.', 1, '2022-06-14 06:53:26'),
                                                                                                                               (804, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comparo actividades económicas que se llevan a cabo en diferentes entornos.', 1, '2022-06-14 06:53:42'),
                                                                                                                               (805, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Establezco relaciones entre el clima y las actividades económicas de las personas.', 1, '2022-06-14 06:54:09'),
                                                                                                                               (806, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco, describo y comparo las actividades económicas de algunas personas en mi entorno y el efecto de su trabajo en la comunidad.', 1, '2022-06-14 06:54:33'),
                                                                                                                               (807, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico los principales recursos naturales (renovables y no renovables).', 1, '2022-06-14 06:54:57'),
                                                                                                                               (808, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco factores de tipo económico que generan bienestar o conflicto en la vida social.', 1, '2022-06-14 06:55:20'),
                                                                                                                               (809, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco que los recursos naturales son finitos y exigen un uso responsable.', 1, '2022-06-14 06:55:45'),
                                                                                                                               (810, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y describo características y funciones básicas de organizaciones sociales y políticas de mi entorno (familia, colegio, barrio, vereda, corregimiento, resguardo, territorios afrocolombianos, municipio...).', 1, '2022-06-14 06:56:19'),
                                                                                                                               (811, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico situaciones cotidianas que indican cumplimiento o incumplimiento en las funciones de algunas organizaciones sociales y políticas de mi entorno.', 1, '2022-06-14 06:56:42'),
                                                                                                                               (812, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comparo las formas de organización propias de los grupos pequeños (familia, salón de clase, colegio...) con las de los grupos más grandes (resguardo, territorios afrocolombianos, municipio...).', 1, '2022-06-14 06:57:16'),
                                                                                                                               (813, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico factores que generan cooperación y conflicto en las organizaciones sociales y políticas de mi entorno y explico por qué lo hacen.', 1, '2022-06-14 06:57:40'),
                                                                                                                               (814, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico mis derechos y deberes y los de otras personas en las comunidades a las que pertenezco.', 1, '2022-06-14 06:57:58'),
                                                                                                                               (815, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico normas que rigen algunas comunidades a las que pertenezco y explico su utilidad.', 1, '2022-06-14 06:58:21'),
                                                                                                                               (816, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco algunas normas que han sido construidas socialmente y distingo aquellas en cuya construcción y modificación puedo participar (normas del hogar, manual de convivencia escolar, Código de Tránsito...).', 1, '2022-06-14 06:58:47'),
                                                                                                                               (817, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco y respeto diferentes puntos de vista.', 1, '2022-06-14 07:05:52'),
                                                                                                                               (818, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comparo mis aportes con los de mis compañeros y compañeras e incorporo en mis conocimientos y juicios elementos valiosos aportados por otros.', 1, '2022-06-14 07:06:13'),
                                                                                                                               (819, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Respeto mis rasgos individuales y los de otras personas (género, etnia, religión...).', 1, '2022-06-14 07:06:35'),
                                                                                                                               (820, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco situaciones de discriminación y abuso por irrespeto a los rasgos individuales de las personas (religión, etnia, género, discapacidad...) y propongo formas\r\nde cambiarlas.', 1, '2022-06-14 07:06:58'),
                                                                                                                               (821, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco la diversidad étnica y cultural de mi comunidad, mi ciudad...', 1, '2022-06-14 07:07:17'),
                                                                                                                               (822, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Participo en actividades que expresan valores culturales de mi comunidad y de otras diferentes a la mía.', 1, '2022-06-14 07:07:40'),
                                                                                                                               (823, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Participo en la construcción de normas para la convivencia en los grupos sociales y políticos a los que pertenezco (familia, colegio, barrio...).', 1, '2022-06-14 07:08:06'),
                                                                                                                               (824, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Cuido mi cuerpo y mis relaciones con los demás.', 1, '2022-06-14 07:08:23'),
                                                                                                                               (825, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Cuido el entorno que me rodea y manejo responsablemente las basuras.', 1, '2022-06-14 07:08:42'),
                                                                                                                               (826, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Uso responsablemente los recursos (papel, agua, alimentos...).', 1, '2022-06-14 07:09:01'),
                                                                                                                               (827, 3, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Valoro aspectos de las organizaciones sociales y políticas de mi entorno que promueven el desarrollo individual y comunitario.', 1, '2022-06-14 07:09:25'),
                                                                                                                               (828, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Hago preguntas acerca de los fenómenos políticos, económicos sociales y culturales estudiados (Prehistoria, pueblos prehispánicos colombianos...).', 1, '2022-06-14 07:10:37'),
                                                                                                                               (829, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Planteo conjeturas que respondan provisionalmente a estas preguntas.', 1, '2022-06-14 07:10:58'),
                                                                                                                               (830, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo diferentes tipos de fuentes para obtener la información que necesito (textos escolares, cuentos y relatos, entrevistas a profesores y familiares, dibujos, fotografías y recursos virtuales...).', 1, '2022-06-14 07:11:27'),
                                                                                                                               (831, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Organizo la información obtenida utilizando cuadros, gráficas... y la archivo en orden.', 1, '2022-06-14 07:11:51'),
                                                                                                                               (832, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco relaciones entre información localizada en diferentes fuentes y propongo respuestas a las preguntas que planteo.', 1, '2022-06-14 07:12:09'),
                                                                                                                               (833, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco que los fenómenos estudiados tienen diversos aspectos que deben ser tenidos en cuenta (cambios a lo largo del tiempo, ubicación geográfica, aspectos económicos...).', 1, '2022-06-14 07:12:29'),
                                                                                                                               (834, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reviso mis conjeturas iniciales.', 1, '2022-06-14 07:12:44'),
                                                                                                                               (835, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo diversas formas de expresión (exposición oral, dibujos, carteleras, textos cortos...) para comunicar los resultados de mi investigación.', 1, '2022-06-14 07:13:05'),
                                                                                                                               (836, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Doy crédito a las diferentes fuentes de la información obtenida (cuento a mis compañeros a quién entrevisté, qué libros leí, qué dibujos comparé, cito información de fuentes escritas...).', 1, '2022-06-14 07:13:29'),
                                                                                                                               (837, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y explico fenómenos sociales y económicos que permitieron el paso del nomadismo al sedentarismo (agricultura, división del trabajo...).', 1, '2022-06-14 07:13:58'),
                                                                                                                               (838, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y describo características sociales, políticas, económicas y culturales de las primeras organizaciones humanas (banda, clan, tribu...).', 1, '2022-06-14 07:14:21'),
                                                                                                                               (839, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo características de las primeras organizaciones humanas con las de las organizaciones de mi entorno.', 1, '2022-06-14 07:14:39'),
                                                                                                                               (840, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico algunas condiciones políticas, sociales, económicas y tecnológicas que permitieron las exploraciones de la antigüedad y el medioevo.', 1, '2022-06-14 07:15:03'),
                                                                                                                               (841, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Establezco algunas relaciones entre exploraciones de la antigüedad y el medioevo y exploraciones de la actualidad.', 1, '2022-06-14 07:15:52'),
                                                                                                                               (842, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico, describo y comparo algunas características sociales, políticas, económicas y culturales de las comunidades prehispánicas de Colombia y América.', 1, '2022-06-14 07:18:45');
INSERT INTO `caracterizacion_estandar` (`id_estandar`, `id_area`, `grado`, `descripcion_estandar`, `estado`, `created_at`) VALUES
                                                                                                                               (843, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Relaciono estas características con las condiciones del entorno particular de cada cultura.', 1, '2022-06-14 07:19:06'),
                                                                                                                               (844, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo características de los grupos prehispánicos con las características sociales, políticas, económicas y culturales actuales.', 1, '2022-06-14 07:19:33'),
                                                                                                                               (845, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico los propósitos de las organizaciones coloniales españolas y describo aspectos básicos de su funcionamiento.', 1, '2022-06-14 07:20:04'),
                                                                                                                               (846, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y comparo algunas causas que dieron lugar a los diferentes períodos históricos en Colombia (Descubrimiento, Colonia, Independencia...).', 1, '2022-06-14 07:20:27'),
                                                                                                                               (847, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Me ubico en el entorno físico utilizando referentes espaciales (izquierda, derecha, puntos cardinales).', 1, '2022-06-14 07:21:56'),
                                                                                                                               (848, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Utilizo coordenadas, escalas y convenciones para ubicar los fenómenos históricos y culturales en mapas y planos de representación.', 1, '2022-06-14 07:22:15'),
                                                                                                                               (849, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y describo características de las diferentes regiones naturales del mundo (desiertos, polos, selva húmeda tropical, océanos...).', 1, '2022-06-14 07:22:48'),
                                                                                                                               (850, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y describo algunas de las características humanas (sociales, culturales...) de las diferentes regiones naturales del mundo.', 1, '2022-06-14 07:23:24'),
                                                                                                                               (851, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Clasifico y describo diferentes actividades económicas (producción, distribución, consumo...) en diferentes sectores económicos (agrícola, ganadero, minero, industrial...) y reconozco su impacto en las comunidades.', 1, '2022-06-14 07:23:51'),
                                                                                                                               (852, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco los diferentes usos que se le dan a la tierra y a los recursos naturales en mi entorno y en otros (parques naturales, ecoturismo, ganadería, agricultura...).', 1, '2022-06-14 07:24:15'),
                                                                                                                               (853, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico organizaciones que resuelven las necesidades básicas (salud, educación, vivienda, servicios públicos, vías de comunicación...) en mi comunidad, en otras y en diferentes épocas y culturas; identifico su impacto sobre el desarrollo.', 1, '2022-06-14 07:24:46'),
                                                                                                                               (854, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Identifico y describo algunas características de las organizaciones político-administrativas colombianas en diferentes épocas (Real Audiencia, Congreso, Concejo Municipal...).', 1, '2022-06-14 07:25:11'),
                                                                                                                               (855, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comparo características del sistema político-administrativo de Colombia –ramas del poder público– en las diferentes épocas.', 1, '2022-06-14 07:25:37'),
                                                                                                                               (856, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Explico semejanzas y diferencias entre organizaciones político-administrativas.', 1, '2022-06-14 07:25:54'),
                                                                                                                               (857, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Explico el impacto de algunos hechos históricos en la formación limítrofe del territorio colombiano (Virreinato de la Nueva Granada, Gran Colombia, separación de Panamá...).', 1, '2022-06-14 07:26:19'),
                                                                                                                               (858, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco las responsabilidades que tienen las personas elegidas por voto popular y algunas características de sus cargos (personeros estudiantiles, concejales, congresistas, presidente...)', 1, '2022-06-14 07:26:48'),
                                                                                                                               (859, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Conozco los Derechos de los Niños e identifico algunas instituciones locales, nacionales e internacionales que velan por su cumplimiento (personería estudiantil, comisaría de familia, Unicef...).', 1, '2022-06-14 07:27:16'),
                                                                                                                               (860, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco y respeto diferentes puntos de vista acerca de un fenómeno social.', 1, '2022-06-14 07:28:10'),
                                                                                                                               (861, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Participo en debates y discusiones: asumo una posición, la confronto con la de otros, la defiendo y soy capaz de modificar mis posturas si lo considero pertinente.', 1, '2022-06-14 07:28:47'),
                                                                                                                               (862, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Respeto mis rasgos individuales y culturales y los de otras personas (género, etnia...).', 1, '2022-06-14 07:29:07'),
                                                                                                                               (863, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Asumo una posición crítica frente a situaciones de discriminación y abuso por irrespeto a los rasgos individuales de las personas (etnia, género...) y propongo formas de cambiarlas.', 1, '2022-06-14 07:29:32'),
                                                                                                                               (864, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco la importancia de los aportes de algunos legados culturales, científicos, tecnológicos, artísticos, religiosos... en diversas épocas y entornos.', 1, '2022-06-14 07:29:58'),
                                                                                                                               (865, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Participo en la construcción de normas para la convivencia en los grupos a los que pertenezco (familia, colegio, barrio...).', 1, '2022-06-14 07:30:18'),
                                                                                                                               (866, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Cuido mi cuerpo y mis relaciones con las demás personas.', 1, '2022-06-14 07:30:41'),
                                                                                                                               (867, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Cuido el entorno que me rodea y manejo responsablemente las basuras.', 1, '2022-06-14 07:32:33'),
                                                                                                                               (868, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Uso responsablemente los recursos (papel, agua, alimento, energía...).', 1, '2022-06-14 07:32:56'),
                                                                                                                               (869, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Uso responsablemente los recursos (papel, agua, alimento, energía...).', 1, '2022-06-14 07:33:25'),
                                                                                                                               (870, 3, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Defiendo mis derechos y los de otras personas y contribuyo a denunciar ante las autoridades competentes (profesor, padres, comisaría de familia...) casos en los que\r\nson vulnerados.', 1, '2022-06-14 07:33:51'),
                                                                                                                               (871, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Formulo preguntas acerca de hechos políticos, económicos sociales y culturales.', 1, '2022-06-14 07:35:15'),
                                                                                                                               (872, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Planteo conjeturas que respondan provisionalmente estas preguntas.', 1, '2022-06-14 07:35:34'),
                                                                                                                               (873, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Recolecto y registro sistemáticamente información que obtengo de diferentes fuentes (orales, escritas, iconográficas, virtuales...).', 1, '2022-06-14 07:36:00'),
                                                                                                                               (874, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico las características básicas de los documentos que utilizo (qué tipo de documento es, quién es el autor, a quién está dirigido, de qué habla...).', 1, '2022-06-14 07:36:23'),
                                                                                                                               (875, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Clasifico correctamente las fuentes que utilizo (primarias, secundarias, orales, escritas, iconográficas...).', 1, '2022-06-14 07:36:41'),
                                                                                                                               (876, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Tomo notas de las fuentes estudiadas; clasifico, organizo y archivo la información obtenida.', 1, '2022-06-14 07:36:59'),
                                                                                                                               (877, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre información localizada en diferentes fuentes y propongo respuestas a las preguntas que planteo.', 1, '2022-06-14 07:37:16'),
                                                                                                                               (878, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Analizo los resultados y saco conclusiones.', 1, '2022-06-14 07:37:33'),
                                                                                                                               (879, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo las conclusiones a las que llego después de hacer la investigación con mis conjeturas iniciales.', 1, '2022-06-14 07:39:09'),
                                                                                                                               (880, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco que los fenómenos estudiados pueden observarse desde diversos puntos de vista.', 1, '2022-06-14 07:39:25'),
                                                                                                                               (881, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y tengo en cuenta los diversos aspectos que hacen parte de los fenómenos que estudio (ubicación geográfica, evolución histórica, organización\r\npolítica, económica, social y cultural...).', 1, '2022-06-14 07:40:06'),
                                                                                                                               (882, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco redes complejas de relaciones entre eventos históricos, sus causas, sus consecuencias y su incidencia en la vida de los diferentes agentes involucrados.', 1, '2022-06-14 07:40:45'),
                                                                                                                               (883, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo diversas formas de expresión (escritos, exposiciones orales, carteleras...), para comunicar los resultados de mi investigación.', 1, '2022-06-14 07:41:07'),
                                                                                                                               (884, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Cito adecuadamente las diferentes fuentes de la información obtenida.', 1, '2022-06-14 07:41:24'),
                                                                                                                               (885, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo características de la organización social, política o económica en algunas culturas y épocas (la democracia en los griegos, los sistemas de producción de la\r\ncivilización inca, el feudalismo en el medioevo, el surgimiento del Estado en el Renacimiento...).', 1, '2022-06-14 09:23:19'),
                                                                                                                               (886, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre estas culturas y sus épocas.', 1, '2022-06-14 09:23:34'),
                                                                                                                               (887, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo diferentes culturas con la sociedad colombiana actual, y propongo explicaciones para las semejanzas y diferencias que encuentro.', 1, '2022-06-14 09:24:02'),
                                                                                                                               (888, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo legados culturales (científicos tecnológicos, artísticos, religiosos...) de diferentes grupos culturales y reconozco su impacto en la actualidad.', 1, '2022-06-14 09:24:57'),
                                                                                                                               (889, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco que la división entre un período histórico y otro es un intento por caracterizar los hechos históricos a partir de marcadas transformaciones sociales.', 1, '2022-06-14 09:25:33'),
                                                                                                                               (890, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico algunas características sociales, políticas y económicas de diferentes períodos históricos a partir de manifestaciones artísticas de cada época.', 1, '2022-06-14 09:26:02'),
                                                                                                                               (891, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico algunas situaciones que han generado conflictos en las organizaciones sociales (el uso de la mano de obra en el imperio egipcio, la expansión de los imperios, la tenencia de la tierra en el medioevo...).', 1, '2022-06-14 09:26:40'),
                                                                                                                               (892, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y comparo las características de la organización social en las colonias españolas, portuguesas e inglesas en América.', 1, '2022-06-14 09:27:01'),
                                                                                                                               (893, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y comparo el legado de cada una de las culturas involucradas en el encuentro Europa - América - África.', 1, '2022-06-14 09:27:21'),
                                                                                                                               (894, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco características de la Tierra que la hacen un planeta vivo.', 1, '2022-06-14 09:27:54'),
                                                                                                                               (895, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Utilizo coordenadas, convenciones y escalas para trabajar con mapas y planos de representación.', 1, '2022-06-14 09:28:15'),
                                                                                                                               (896, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco y utilizo los husos horarios.', 1, '2022-06-14 09:28:30'),
                                                                                                                               (897, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Localizo diversas culturas en el espacio geográfico y reconozco las principales características físicas de su entorno.', 1, '2022-06-14 09:28:51'),
                                                                                                                               (898, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Establezco relaciones entre la ubicación geoespacial y las características climáticas del entorno de diferentes culturas.', 1, '2022-06-14 09:29:10'),
                                                                                                                               (899, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico sistemas de producción en diferentes culturas y períodos históricos y establezco relaciones entre ellos.', 1, '2022-06-14 09:29:35'),
                                                                                                                               (900, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo las organizaciones económicas de diferentes culturas con las de la actualidad en Colombia y propongo explicaciones para las semejanzas y diferencias que encuentro.', 1, '2022-06-14 09:30:06'),
                                                                                                                               (901, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Describo las características que permiten dividir a Colombia en regiones naturales.', 1, '2022-06-14 09:30:29'),
                                                                                                                               (902, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico factores económicos, sociales, políticos y geográficos que han generado procesos de movilidad poblacional en las diferentes culturas y períodos históricos.', 1, '2022-06-14 09:30:55'),
                                                                                                                               (903, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo características de la organización económica (tenencia de la tierra, uso de la mano de obra, tipos de explotación) de las colonias españolas, portuguesas e inglesas en América.', 1, '2022-06-14 09:32:02'),
                                                                                                                               (904, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Explico el impacto de las culturas involucradas en el encuentro Europa - América - África sobre los sistemas de producción tradicionales (tenencia de la tierra, uso de la mano de obra, tipos de explotación).', 1, '2022-06-14 09:54:47'),
                                                                                                                               (905, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico normas en algunas de las culturas y épocas estudiadas y las comparo con algunas normas vigentes en Colombia.', 1, '2022-06-14 09:55:32'),
                                                                                                                               (906, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico las ideas que legitimaban el sistema político y el sistema jurídico en algunas de las culturas estudiadas.', 1, '2022-06-14 09:55:51'),
                                                                                                                               (907, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco y describo diferentes formas que ha asumido la democracia a través de la historia.', 1, '2022-06-14 09:56:09'),
                                                                                                                               (908, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparo entre sí algunos sistemas políticos estudiados y al vez con el sistema político colombiano.', 1, '2022-06-14 09:56:29'),
                                                                                                                               (909, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico variaciones en el significado del concepto de ciudadanía en diversas culturas a través del tiempo.', 1, '2022-06-14 09:58:41'),
                                                                                                                               (910, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico criterios que permiten establecer la división política de un territorio.', 1, '2022-06-14 09:59:05'),
                                                                                                                               (911, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico criterios que permiten establecer la división política de un territorio.', 1, '2022-06-14 09:59:28'),
                                                                                                                               (912, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y comparo las características de la organización política en las colonias españolas, portuguesas e inglesas en América.', 1, '2022-06-14 09:59:53'),
                                                                                                                               (913, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco y respeto las diferentes posturas frente a los fenómenos sociales.', 1, '2022-06-14 10:01:27'),
                                                                                                                               (914, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Participo en debates y discusiones: asumo una posición, la confronto, la defiendo y soy capaz de modificar mis posturas cuando reconozco mayor peso en los argumentos de otras personas.', 1, '2022-06-14 10:01:52'),
                                                                                                                               (915, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Asumo una posición crítica frente a situaciones de discriminación (etnia, género...) y propongo formas de cambiarlas.', 1, '2022-06-14 10:02:25'),
                                                                                                                               (916, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Participo en la construcción de normas para la convivencia en los grupos a los que pertenezco (familia, colegio, organización juvenil, equipos deportivos...).', 1, '2022-06-14 10:02:47'),
                                                                                                                               (917, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comparto y acato las normas que ayudan a regular la convivencia en los grupos sociales a los que pertenezco.', 1, '2022-06-14 10:03:07'),
                                                                                                                               (918, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Participo activamente en la conformación del gobierno escolar.', 1, '2022-06-14 10:03:24'),
                                                                                                                               (919, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Tomo decisiones responsables frente al cuidado de mi cuerpo y de mis relaciones con los demás (drogas, relaciones sexuales...).', 1, '2022-06-14 10:03:46'),
                                                                                                                               (920, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Apoyo a mis amigos y amigas en la toma responsable de decisiones sobre el cuidado de su cuerpo.', 1, '2022-06-14 10:04:08'),
                                                                                                                               (921, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Asumo una posición crítica frente al deterioro del medio ambiente y participo en su protección.', 1, '2022-06-14 10:04:29'),
                                                                                                                               (922, 3, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico diferencias en las concepciones que legitiman las actuaciones en la historia y asumo posiciones críticas frente a ellas (esclavitud, Inquisición...).', 1, '2022-06-14 10:04:56'),
                                                                                                                               (923, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Formulo preguntas acerca de hechos políticos, económicos sociales y culturales.', 1, '2022-06-14 10:30:36'),
                                                                                                                               (924, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Planteo hipótesis que respondan provisionalmente estas preguntas.', 1, '2022-06-14 10:30:57'),
                                                                                                                               (925, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Hago planes de búsqueda que incluyan posibles fuentes primarias y secundarias (orales, escritas, iconográficas, virtuales...) y diferentes términos para encontrar información que conteste mis preguntas.', 1, '2022-06-14 10:31:20'),
                                                                                                                               (926, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Recolecto y registro la información que obtengo de diferentes fuentes.', 1, '2022-06-14 10:31:37'),
                                                                                                                               (927, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Clasifico las fuentes que utilizo (en primarias o secundarias, y en orales, escritas, iconográficas, estadísticas...).', 1, '2022-06-14 10:31:54'),
                                                                                                                               (928, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico las características básicas de los documentos que utilizo (qué tipo de documento es, quién es el autor, a quién está dirigido, de qué habla, por qué se produjo...).', 1, '2022-06-14 10:32:14'),
                                                                                                                               (929, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo críticamente los documentos que utilizo e identifico sus tesis.', 1, '2022-06-14 10:32:31'),
                                                                                                                               (930, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Tomo notas de las fuentes estudiadas; clasifico, organizo, comparo y archivo la información obtenida.', 1, '2022-06-14 10:32:47'),
                                                                                                                               (931, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo mapas, cuadros, tablas, gráficas y cálculos estadísticos para analizar información.', 1, '2022-06-14 10:33:08'),
                                                                                                                               (932, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Analizo los resultados de mis búsquedas y saco conclusiones.', 1, '2022-06-14 10:33:26'),
                                                                                                                               (933, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo las conclusiones a las que llego después de hacer la investigación con las hipótesis iniciales.', 1, '2022-06-14 10:33:56'),
                                                                                                                               (934, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco que los fenómenos sociales pueden observarse desde diversos puntos de vista (visiones e intereses).', 1, '2022-06-14 10:34:17'),
                                                                                                                               (935, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y estudio los diversos aspectos de interés para las ciencias sociales (ubicación geográfica, evolución histórica, organización política, económica, social y cultural...).', 1, '2022-06-14 10:34:38'),
                                                                                                                               (936, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco múltiples relaciones entre eventos históricos: sus causas, sus consecuencias y su incidencia en la vida de los diferentes agentes y grupos involucrados.', 1, '2022-06-14 10:34:59'),
                                                                                                                               (937, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco, en los hechos históricos, complejas relaciones sociales políticas, económicas y culturales.', 1, '2022-06-14 10:35:22'),
                                                                                                                               (938, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo diversas formas de expresión para comunicar los resultados de mi investigación.', 1, '2022-06-14 10:35:57'),
                                                                                                                               (939, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Cito adecuadamente las diferentes fuentes de la información obtenida.', 1, '2022-06-14 10:36:18'),
                                                                                                                               (940, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Promuevo debates para discutir los resultados de mis observaciones.', 1, '2022-06-14 10:36:35'),
                                                                                                                               (941, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico las principales características de algunas revoluciones de los siglos XVIII y XIX (Revolución Francesa, Revolución Industrial...).', 1, '2022-06-14 10:37:00'),
                                                                                                                               (942, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico la influencia de estas revoluciones en algunos procesos sociales, políticos y económicos posteriores en Colombia y América Latina.', 1, '2022-06-14 10:37:35'),
                                                                                                                               (943, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico la influencia de estas revoluciones en algunos procesos sociales, políticos y económicos posteriores en Colombia y América Latina.', 1, '2022-06-14 10:37:58'),
                                                                                                                               (944, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico algunos de los grandes cambios sociales que se dieron en Colombia entre los siglos XIX y primera mitad del XX (abolición de la esclavitud, surgimiento de movimientos obreros...).', 1, '2022-06-14 10:38:23'),
                                                                                                                               (945, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo estos procesos teniendo en cuenta sus orígenes y su impacto en situaciones políticas, económicas, sociales y culturales posteriores.', 1, '2022-06-14 10:38:51'),
                                                                                                                               (946, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico algunas corrientes de pensamiento económico, político, cultural y filosófico del siglo XIX y explico su influencia en el pensamiento colombiano y el de América Latina.', 1, '2022-06-14 10:39:19'),
                                                                                                                               (947, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco, en el pasado y en la actualidad, el aporte de algunas tradiciones artísticas y saberes científicos de diferentes grupos étnicos colombianos a nuestra identidad.', 1, '2022-06-14 10:39:48'),
                                                                                                                               (948, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Describo el impacto del proceso de modernización (desarrollo de los medios de comunicación, industrialización, urbanización...) en la organización social, política, económica y cultural de Colombia en el siglo XIX y en la primera mitad del XX.', 1, '2022-06-14 10:40:22'),
                                                                                                                               (949, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Describo las principales características físicas de los diversos ecosistemas.', 1, '2022-06-15 06:05:22'),
                                                                                                                               (950, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico la manera como el medio ambiente influye en el tipo de organización social y económica que se da en las regiones de Colombia.', 1, '2022-06-15 06:05:47'),
                                                                                                                               (951, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo las maneras como distintas comunidades, etnias y culturas se han relacionado económicamente con el medio ambiente en Colombia a lo largo de la historia (pesca de subienda, cultivo en terrazas...).', 1, '2022-06-15 06:06:16'),
                                                                                                                               (952, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo las causas de algunas olas de migración y desplazamiento humano en nuestro territorio a lo largo del siglo XIX y la primera mitad del siglo XX (colonización antioqueña, urbanización del país...).', 1, '2022-06-15 06:06:42'),
                                                                                                                               (953, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico el impacto de las migraciones y desplazamientos humanos en la vida política, económica, social y cultural de nuestro país en el siglo XIX y la primera mitad del siglo XX y lo comparo con los de la actualidad.', 1, '2022-06-15 06:07:08'),
                                                                                                                               (954, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico algunos de los procesos que condujeron a la modernización en Colombia en el siglo XIX y primera mitad del siglo XX (bonanzas agrícolas, procesos de industrialización, urbanización...).', 1, '2022-06-15 06:07:47'),
                                                                                                                               (955, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Explico las políticas que orientaron la economía colombiana a lo largo del siglo XIX y primera mitad del XX (proteccionismo, liberalismo económico...).', 1, '2022-06-15 06:08:11'),
                                                                                                                               (956, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo los mecanismos de participación ciudadana contemplados en las constituciones políticas de 1886 y  1991 y evalúo su aplicabilidad.', 1, '2022-06-15 06:19:51'),
                                                                                                                               (957, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico algunas formas en las que organizaciones estudiantiles, movimientos sociales, partidos políticos, sindicatos... participaron en la actividad política colombiana a lo largo del siglo XIX y la primera mitad del siglo XX.', 1, '2022-06-15 06:20:21'),
                                                                                                                               (958, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y explico algunos de los principales procesos políticos del siglo XIX en Colombia (federalismo, centralismo, radicalismo liberal, Regeneración...).', 1, '2022-06-15 06:20:47'),
                                                                                                                               (959, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comparo algunos de los procesos políticos que tuvieron lugar en Colombia en los siglos XIX y XX (por ejemplo, radicalismo liberal y Revolución en Marcha; Regeneración y Frente Nacional; constituciones políticas de 1886 y 1991...).', 1, '2022-06-15 06:21:14'),
                                                                                                                               (960, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Identifico y comparo algunos de los procesos políticos que tuvieron lugar en el mundo en el siglo XIX y primera mitad del siglo XX (procesos coloniales en África y Asia; Revolución Rusa y Revolución China; Primera y Segunda Guerra Mundial...).', 1, '2022-06-15 06:21:58'),
                                                                                                                               (961, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Relaciono algunos de estos procesos políticos internacionales con los procesos colombianos en el siglo XIX y primera mitad del siglo XX.', 1, '2022-06-15 06:22:18'),
                                                                                                                               (962, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Respeto diferentes posturas frente a los fenómenos sociales.', 1, '2022-06-15 06:22:42'),
                                                                                                                               (963, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Participo en discusiones y debates académicos.', 1, '2022-06-15 06:23:00'),
                                                                                                                               (964, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Asumo una posición crítica frente a situaciones de discriminación y abuso por irrespeto a las posiciones ideológicas y propongo formas de cambiarlas.', 1, '2022-06-15 06:23:23'),
                                                                                                                               (965, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco que los derechos fundamentales de las personas están por encima de su género, su filiación política, religión, etnia...', 1, '2022-06-15 06:23:59'),
                                                                                                                               (966, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco la importancia del patrimonio cultural y contribuyo con su preservación.', 1, '2022-06-15 06:24:23'),
                                                                                                                               (967, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco la importancia del patrimonio cultural y contribuyo con su preservación.', 1, '2022-06-15 06:24:44'),
                                                                                                                               (968, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reconozco en el pago de los impuestos una forma importante de solidaridad ciudadana.', 1, '2022-06-15 06:25:08'),
                                                                                                                               (969, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Utilizo mecanismos de participación establecidos en la Constitución y en organizaciones a las que pertenezco.', 1, '2022-06-15 06:25:28'),
                                                                                                                               (970, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Tomo decisiones responsables frente al cuidado de mi cuerpo y mis relaciones con los demás.', 1, '2022-06-15 06:25:45'),
                                                                                                                               (971, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Apoyo a mis amigos en la toma responsable de decisiones sobre el cuidado de su cuerpo.', 1, '2022-06-15 06:26:04'),
                                                                                                                               (972, 3, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Asumo una posición crítica frente al deterioro del medio ambiente y participo en su conservación.', 1, '2022-06-15 06:26:29'),
                                                                                                                               (973, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Realizo investigaciones como lo hacen los científicos sociales: diseño proyectos, desarrollo investigaciones y presento resultados.', 1, '2022-06-15 06:27:27'),
                                                                                                                               (974, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Planteo un tema o problema de investigación.', 1, '2022-06-15 06:28:02'),
                                                                                                                               (975, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Delimito el tema o problema espacial y temporalmente.', 1, '2022-06-15 06:28:23'),
                                                                                                                               (976, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Justifico la importancia de la investigación que propongo.', 1, '2022-06-15 06:28:45'),
                                                                                                                               (977, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Defino los objetivos y la hipótesis del trabajo.', 1, '2022-06-15 06:29:02'),
                                                                                                                               (978, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo la metodología que seguiré en mi investigación que incluya un plan de búsqueda de diversos tipos de información pertinente a los propósitos de mi investigación.', 1, '2022-06-15 06:29:27'),
                                                                                                                               (979, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Diseño un cronograma de trabajo.', 1, '2022-06-15 06:29:58'),
                                                                                                                               (980, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Diseño un plan de búsqueda bibliográfica con diferentes términos y combinación de términos para encontrar información pertinente.', 1, '2022-06-15 06:30:17'),
                                                                                                                               (981, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Hago una revisión bibliográfica siguiendo mi plan.', 1, '2022-06-15 06:30:34'),
                                                                                                                               (982, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo críticamente los documentos (qué tipo de documento es, quién es el autor, a quién está dirigido, de qué habla, por qué se produjo, desde qué posición ideológica está hablando, qué significa para mí...).', 1, '2022-06-15 06:31:00'),
                                                                                                                               (983, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Recojo información de otras fuentes pertinentes según mi plan.', 1, '2022-06-15 06:31:14'),
                                                                                                                               (984, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Registro información de manera sistemática.', 1, '2022-06-15 06:31:49'),
                                                                                                                               (985, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Clasifico, comparo e interpreto la información obtenida en las diversas fuentes.', 1, '2022-06-15 06:32:03'),
                                                                                                                               (986, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo herramientas de las diferentes disciplinas de las ciencias sociales para analizar la información.', 1, '2022-06-15 06:32:21'),
                                                                                                                               (987, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Saco conclusiones.', 1, '2022-06-15 06:32:36'),
                                                                                                                               (988, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Utilizo diversas formas de expresión, para dar a conocer los resultados de mi investigación.', 1, '2022-06-15 06:32:54'),
                                                                                                                               (989, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Cito adecuadamente las diferentes fuentes de la información obtenida.', 1, '2022-06-15 06:33:10'),
                                                                                                                               (990, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Promuevo debates para discutir los resultados de mi investigación y relacionarlos con otros.', 1, '2022-06-15 06:33:25'),
                                                                                                                               (991, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico el origen del régimen bipartidista en Colombia.', 1, '2022-06-15 06:40:26'),
                                                                                                                               (992, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo el periodo conocido como “la violencia” y establezco relaciones con las formas actuales de violencia.', 1, '2022-06-15 06:40:51'),
                                                                                                                               (993, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico las causas, características y consecuencias del Frente Nacional.', 1, '2022-06-15 06:41:18'),
                                                                                                                               (994, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico el surgimiento de la guerrilla, el paramilitarismo y el narcotráfico en Colombia.', 1, '2022-06-15 06:41:44'),
                                                                                                                               (995, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo desde el punto de vista político, económico, social y cultural algunos de los hechos históricos mundiales sobresalientes del siglo XX (guerras mundiales, conflicto en el Medio Oriente, caída del muro de Berlín...).', 1, '2022-06-15 06:42:09'),
                                                                                                                               (996, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico y analizo las diferentes formas del orden mundial en el siglo XX (Guerra Fría, globalización, enfrentamiento Oriente-Occidente...).', 1, '2022-06-15 06:42:48'),
                                                                                                                               (997, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo y describo algunas dictaduras en América Latina a lo largo del siglo XX.', 1, '2022-06-15 06:43:08'),
                                                                                                                               (998, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo y describo algunas revoluciones en América Latina a lo largo del siglo XX.', 1, '2022-06-15 06:43:26'),
                                                                                                                               (999, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco el cambio en la posición de la mujer en el mundo y en Colombia a lo largo del siglo XX y su incidencia en el desarrollo político, económico, social, cultural, familiar y personal.', 1, '2022-06-15 06:44:03'),
                                                                                                                               (1000, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico y explico las luchas de los grupos étnicos en Colombia y América en busca de su reconocimiento social e igualdad de derechos desde comienzos del siglo XX hasta la actualidad.', 1, '2022-06-15 06:44:27'),
                                                                                                                               (1001, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco relaciones entre las distintas manifestaciones artísticas y las corrientes ideológicas del siglo XX.', 1, '2022-06-15 06:44:54'),
                                                                                                                               (1002, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico los principales postulados del liberalismo clásico, el socialismo, el marxismo-leninismo... y analizo la vigencia actual de algunos de ellos.', 1, '2022-06-15 06:45:17'),
                                                                                                                               (1003, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Establezco algunas relaciones entre los diferentes modelos de desarrollo económico utilizados en Colombia y América Latina y las ideologías que los sustentan.', 1, '2022-06-15 06:45:51'),
                                                                                                                               (1004, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo el impacto de estos modelos en la región.', 1, '2022-06-15 06:46:07'),
                                                                                                                               (1005, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Explico y evalúo el impacto del desarrollo industrial y tecnológico sobre el medio ambiente y el ser humano.', 1, '2022-06-15 06:46:27'),
                                                                                                                               (1006, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo críticamente los factores que ponen en riesgo el derecho del ser humano a una alimentación sana y suficiente (uso de la tierra, desertización, transgénicos...).', 1, '2022-06-15 06:47:17'),
                                                                                                                               (1007, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico algunos factores que han dado origen a las nuevas formas de organización de la economía mundial (bloques económicos, tratados de libre comercio, áreas de libre comercio...).', 1, '2022-06-15 06:47:46'),
                                                                                                                               (1008, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo consecuencias de estas nuevas formas de organización sobre las relaciones económicas, políticas y sociales entre los estados.', 1, '2022-06-15 06:48:10'),
                                                                                                                               (1009, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco el impacto de la globalización sobre las distintas economías y reconozco diferentes reacciones ante este fenómeno.', 1, '2022-06-15 06:48:33'),
                                                                                                                               (1010, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico y analizo las consecuencias sociales, económicas, políticas y culturales de los procesos de concentración de la población en los centros urbanos y abandono del campo.', 1, '2022-06-15 06:48:57'),
                                                                                                                               (1011, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Describo el impacto de hechos políticos de mediados del siglo XX (9 de abril, Frente Nacional...) en las organizaciones sociales, políticas y económicas del país.', 1, '2022-06-15 06:49:23'),
                                                                                                                               (1012, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo el paso de un sistema democrático representativo a un sistema democrático participativo en Colombia.', 1, '2022-06-15 06:49:58'),
                                                                                                                               (1013, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico y explico algunas consecuencias de la crisis del bipartidismo.', 1, '2022-06-15 06:50:15'),
                                                                                                                               (1014, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco y explico los cambios y continuidades en los movimientos guerrilleros en Colombia desde su surgimiento hasta la actualidad.', 1, '2022-06-15 06:50:36'),
                                                                                                                               (1015, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico causas y consecuencias de los procesos de desplazamiento forzado de poblaciones y reconozco los derechos que protegen a estas personas.', 1, '2022-06-15 06:50:58'),
                                                                                                                               (1016, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico las organizaciones internacionales que surgieron a lo largo del siglo XX (ONU, OEA...) y evalúo el impacto de su gestión en el ámbito nacional e internacional.', 1, '2022-06-15 06:51:21'),
                                                                                                                               (1017, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo las tensiones que los hechos históricos mundiales del siglo XX han generado en las relaciones internacionales (Guerra Fría, globalización, bloques económicos...)', 1, '2022-06-15 06:51:45'),
                                                                                                                               (1018, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comparo diferentes dictaduras y revoluciones en América Latina y su impacto en la construcción de la democracia.', 1, '2022-06-15 06:52:05'),
                                                                                                                               (1019, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico las funciones que cumplen las oficinas de vigilancia y control del Estado.', 1, '2022-06-15 06:52:21'),
                                                                                                                               (1020, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Identifico mecanismos e instituciones constitucionales que protegen los derechos fundamentales de los ciudadanos y las ciudadanas.', 1, '2022-06-15 06:52:46'),
                                                                                                                               (1021, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Respeto diferentes posturas frente a los fenómenos sociales.', 1, '2022-06-15 06:53:03'),
                                                                                                                               (1022, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Participo en debates y discusiones académicas.', 1, '2022-06-15 06:53:20'),
                                                                                                                               (1023, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Propongo la realización de eventos académicos (foros, mesas redondas, paneles...).', 1, '2022-06-15 06:53:38'),
                                                                                                                               (1024, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Asumo una posición crítica frente a situaciones de discriminación ante posiciones ideológicas y propongo mecanismos para cambiar estas situaciones.', 1, '2022-06-15 06:53:58'),
                                                                                                                               (1025, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Reconozco que los derechos fundamentales de las personas están por encima de su género, su filiación política, etnia, religión...', 1, '2022-06-15 06:54:20'),
                                                                                                                               (1026, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo críticamente la influencia de los medios de comunicación en la vida de las personas y de las comunidades.', 1, '2022-06-15 06:54:40'),
                                                                                                                               (1027, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Promuevo campañas para fomentar la cultura del pago de impuestos y ejerzo vigilancia sobre el gasto público en mi comunidad.', 1, '2022-06-15 06:55:03'),
                                                                                                                               (1028, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Tomo decisiones responsables frente al cuidado de mi cuerpo y de mis relaciones con otras personas.', 1, '2022-06-15 06:55:23'),
                                                                                                                               (1029, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Apoyo a mis amigos y amigas en la toma responsable de decisiones sobre el cuidado de su cuerpo.', 1, '2022-06-15 06:55:44'),
                                                                                                                               (1030, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Asumo una posición crítica frente a las acciones violentas de los distintos grupos armados en el país y en el mundo.', 1, '2022-06-15 06:56:06'),
                                                                                                                               (1031, 3, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Asumo una posición crítica frente a los procesos de paz que se han llevado a cabo en Colombia, teniendo en cuenta las posturas de las partes involucradas.', 1, '2022-06-15 06:56:30'),
                                                                                                                               (1032, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Produzco textos orales que responden a distintos propósitos comunicativos.', 1, '2022-06-15 07:04:29'),
                                                                                                                               (1033, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Produzco textos escritos que responden a diversas necesidades comunicativas.', 1, '2022-06-15 07:04:47'),
                                                                                                                               (1034, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo textos que tienen diferentes formatos y finalidades.', 1, '2022-06-15 07:06:01'),
                                                                                                                               (1035, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo textos literarios para propiciar el desarrollo de mi capacidad creativa y lúdica.', 1, '2022-06-15 07:07:12'),
                                                                                                                               (1036, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Reconozco los medios de comunicación masiva y caracterizo la información que difunden.', 1, '2022-06-15 07:07:40'),
                                                                                                                               (1037, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo la información que circula a través de algunos sistemas de comunicación no verbal.', 1, '2022-06-15 07:08:07'),
                                                                                                                               (1038, 4, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico los principales elementos y roles de la comunicación para enriquecer procesos comunicativos auténticos.', 1, '2022-06-15 07:08:35'),
                                                                                                                               (1039, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Produzco textos orales, en situaciones comunicativas que permiten evidenciar el uso significativo de la entonación y la pertinencia articulatoria.', 1, '2022-06-15 07:11:52'),
                                                                                                                               (1040, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Produzco textos escritos que responden a diversas necesidades comunicativas y que siguen un procedimiento estratégico para su elaboración.', 1, '2022-06-15 07:12:43'),
                                                                                                                               (1041, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Comprendo diversos tipos de texto, utilizando algunas estrategias de búsqueda, organización y almacenamiento de la información.', 1, '2022-06-15 07:13:07'),
                                                                                                                               (1042, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Elaboro hipótesis de lectura acerca de las relaciones entre los elementos constitutivos de un texto literario, y entre éste y el contexto.', 1, '2022-06-15 07:13:36'),
                                                                                                                               (1043, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Elaboro hipótesis de lectura acerca de las relaciones entre los elementos constitutivos de un texto literario, y entre éste y el contexto.', 1, '2022-06-15 07:14:00'),
                                                                                                                               (1044, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Caracterizo el funcionamiento de algunos códigos no verbales con miras a su uso en situaciones comunicativas auténticas.', 1, '2022-06-15 07:14:32'),
                                                                                                                               (1045, 4, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Conozco y analizo los elementos, roles, relaciones y reglas básicas de la comunicación, para inferir las intenciones y expectativas de mis interlocutores y hacer más eficaces mis procesos comunicativos.', 1, '2022-06-15 07:15:10'),
                                                                                                                               (1046, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Conozco y utilizo algunas estrategias argumentativas que posibilitan la construcción de textos orales en situaciones comunicativas auténticas.', 1, '2022-06-15 07:15:55'),
                                                                                                                               (1047, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Produzco textos escritos que responden a necesidades específicas de comunicación, a procedimientos sistemáticos de elaboración y establezco nexos intertextuales y extratextuales.', 1, '2022-06-15 07:16:25'),
                                                                                                                               (1048, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Comprendo e interpreto diversos tipos de texto, para establecer sus relaciones internas y su clasificación en una tipología textual.', 1, '2022-06-15 07:16:53'),
                                                                                                                               (1049, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco la tradición oral como fuente de la conformación y desarrollo de la literatura.', 1, '2022-06-15 07:17:15'),
                                                                                                                               (1050, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco la tradición oral como fuente de la conformación y desarrollo de la literatura.', 1, '2022-06-15 07:17:43'),
                                                                                                                               (1051, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Caracterizo los medios de comunicación masiva y selecciono la información que emiten para clasificarla y almacenarla.', 1, '2022-06-15 07:18:06'),
                                                                                                                               (1052, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Relaciono de manera intertextual obras que emplean el lenguaje no verbal y obras que emplean el lenguaje verbal.', 1, '2022-06-15 07:18:32'),
                                                                                                                               (1053, 4, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Reconozco, en situaciones comunicativas auténticas, la diversidad y el encuentro de culturas, con el fin de afianzar mis actitudes de respeto y tolerancia.', 1, '2022-06-15 07:19:06'),
                                                                                                                               (1054, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Produzco textos orales de tipo argumentativo para exponer mis ideas y llegar a acuerdos en los que prime el respeto por mi interlocutor y la valoración de los contextos comunicativos.', 1, '2022-06-15 07:20:25'),
                                                                                                                               (1055, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Produzco textos escritos que evidencian el conocimiento que he alcanzado acerca del funcionamiento de la lengua en situaciones de comunicación y el uso de las estrategias de producción textual', 1, '2022-06-15 07:21:00'),
                                                                                                                               (1056, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comprendo e interpreto textos, teniendo en cuenta el funcionamiento de la lengua en situaciones de comunicación, el uso de estrategias de lectura y el papel del\r\ninterlocutor y del contexto.', 1, '2022-06-15 07:21:27'),
                                                                                                                               (1057, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Determino en las obras literarias latinoamericanas, elementos textuales que dan cuenta de sus características estéticas, históricas y sociológicas, cuando sea\r\npertinente.', 1, '2022-06-15 07:21:52'),
                                                                                                                               (1058, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Retomo crítica y selectivamente la información que circula a través de los medios de comunicación masiva, para confrontarla con la que proviene de otras fuentes.', 1, '2022-06-15 07:22:18'),
                                                                                                                               (1059, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Comprendo los factores sociales y culturales que determinan algunas manifestaciones del lenguaje no verbal.', 1, '2022-06-15 07:22:41'),
                                                                                                                               (1060, 4, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Reflexiono en forma crítica acerca de los actos comunicativos y explico los componentes del proceso de comunicación, con énfasis en los agentes, los discursos, los contextos y el funcionamiento de la lengua, en tanto sistema de signos, símbolos y reglas de uso.', 1, '2022-06-15 07:23:56'),
                                                                                                                               (1061, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Produzco textos argumentativos que evidencian mi conocimiento de la lengua y el control sobre el uso que hago de ella en contextos comunicativos orales y escritos.', 1, '2022-06-15 07:24:21'),
                                                                                                                               (1062, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Comprendo e interpreto textos con actitud crítica y capacidad argumentativa.', 1, '2022-06-15 07:25:05'),
                                                                                                                               (1063, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Analizo crítica y creativamente diferentes manifestaciones literarias del contexto universal.', 1, '2022-06-15 07:26:08'),
                                                                                                                               (1064, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto en forma crítica la información difundida por los medios de comunicación masiva.', 1, '2022-06-15 07:26:32'),
                                                                                                                               (1065, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Interpreto en forma crítica la información difundida por los medios de comunicación masiva.', 1, '2022-06-15 07:27:14'),
                                                                                                                               (1066, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Retomo críticamente los lenguajes no verbales para desarrollar procesos comunicativos intencionados.', 1, '2022-06-15 07:27:35'),
                                                                                                                               (1067, 4, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Expreso respeto por la diversidad cultural y social del mundo contemporáneo, en las situaciones comunicativas en las que intervengo.', 1, '2022-06-15 07:27:58'),
                                                                                                                               (1068, 6, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Comprendo la importancia de valores básicos de la convivencia ciudadana como la solidaridad, el cuidado, el buen trato y el respeto por mí mismo y por los demás, y los practico en mi contexto cercano (hogar, salón de clase, recreo, etc.).', 1, '2022-06-15 07:41:09'),
                                                                                                                               (1069, 6, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Participo, en mi contexto cercano (con mi familia y compañeros), en la construcción de acuerdos básicos sobre normas para el logro de metas comunes y las cumplo.', 1, '2022-06-15 07:41:53'),
                                                                                                                               (1070, 6, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 'Identifico y respeto las diferencias y semejanzas entre los demás y yo, y rechazo situaciones de exclusión o discriminación en mi familia, con mis amigas y amigos y en mi salón.', 1, '2022-06-15 07:42:13'),
                                                                                                                               (1071, 6, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Asumo, de manera pacífica y constructiva, los conflictos cotidianos en mi vida escolar y familiar y contribuyo a la protección de los derechos de las niñas y los niños.', 1, '2022-06-15 07:43:01'),
                                                                                                                               (1072, 6, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Participo constructivamente en procesos democráticos en mi salón y en el medio escolar.', 1, '2022-06-15 07:43:25'),
                                                                                                                               (1073, 6, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 'Reconozco y rechazo las situaciones de exclusión o discriminación en mi medio escolar.', 1, '2022-06-15 07:43:48'),
                                                                                                                               (1074, 6, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Contribuyo, de manera constructiva, a la convivencia en mi medio escolar y en mi comunidad (barrio o vereda).', 1, '2022-06-15 07:44:11'),
                                                                                                                               (1075, 6, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y rechazo las situaciones en las que se vulneran los derechos fundamentales y utilizo formas y mecanismos de participación democrática en mi medio escolar.', 1, '2022-06-15 07:44:42'),
                                                                                                                               (1076, 6, 'a:2:{i:0;s:1:\"6\";i:1;s:1:\"7\";}', 'Identifico y rechazo las diversas formas de discriminación en mi medio escolar y en mi comunidad, y analizo críticamente las razones que pueden favorecer estas discriminaciones.', 1, '2022-06-15 07:45:04'),
                                                                                                                               (1077, 6, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Construyo relaciones pacíficas que contribuyen a la convivencia cotidiana en mi comunidad y municipio.', 1, '2022-06-15 07:45:27'),
                                                                                                                               (1078, 6, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Participo o lidero iniciativas democráticas en mi medio escolar o en mi comunidad, con criterios de justicia, solidaridad y equidad, y en defensa de los derechos civiles y políticos.', 1, '2022-06-15 07:45:50'),
                                                                                                                               (1079, 6, 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 'Rechazo las situaciones de discriminación y exclusión social en el país; comprendo sus posibles causas y las consecuencias negativas para la sociedad.', 1, '2022-06-15 07:46:11'),
                                                                                                                               (1080, 6, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Participo constructivamente en iniciativas o proyectos a favor de la no-violencia en el nivel local o global.', 1, '2022-06-15 07:46:30'),
                                                                                                                               (1081, 6, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Conozco y sé usar los mecanismos constitucionales de participación que permiten expresar mis opiniones y participar en la toma de decisiones políticas tanto a nivel local como a nivel nacional.', 1, '2022-06-15 07:46:50'),
                                                                                                                               (1082, 6, 'a:2:{i:0;s:2:\"10\";i:1;s:2:\"11\";}', 'Expreso rechazo ante toda forma de discriminación o exclusión social y hago uso de los mecanismos democráticos para la superación de la discriminación y el respeto a la diversidad.', 1, '2022-06-15 07:47:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion_lineamiento_curricular`
--

CREATE TABLE `caracterizacion_lineamiento_curricular` (
                                                          `id_lineamiento_curricular` int(11) NOT NULL,
                                                          `id_area` int(11) NOT NULL,
                                                          `grado` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
                                                          `descripcion_lineamiento_curricular` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                                          `estado` tinyint(1) NOT NULL DEFAULT '1',
                                                          `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_areas`
--

CREATE TABLE `cfg_areas` (
                             `codarea` int(11) NOT NULL,
                             `nomarea` char(50) DEFAULT NULL,
                             `tipo` char(10) NOT NULL,
                             `icoarea` char(50) DEFAULT NULL,
                             `fecha` date DEFAULT NULL,
                             `caracterizacion_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Configuración de Areas ';

--
-- Estructura de tabla para la tabla `cfg_materias`
--

CREATE TABLE `cfg_materias` (
                                `codmateria` int(11) NOT NULL,
                                `nommateria` char(50) NOT NULL,
                                `area` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
                                `grado` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
                                `titulo` char(50) NOT NULL,
                                `visible` char(50) NOT NULL,
                                `icomateria` char(50) NOT NULL,
                                `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_menu`
--

CREATE TABLE `cfg_menu` (
                            `id` int(11) NOT NULL,
                            `nombre` char(50) NOT NULL,
                            `nivel` int(11) NOT NULL,
                            `nivel_sup` int(11) DEFAULT '0',
                            `orden` int(11) NOT NULL,
                            `tipo` char(50) NOT NULL,
                            `enlace` char(100) NOT NULL,
                            `icono` char(50) NOT NULL,
                            `areas` char(100) NOT NULL,
                            `descripcion` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cfg_menu`
--

INSERT INTO `cfg_menu` (`id`, `nombre`, `nivel`, `nivel_sup`, `orden`, `tipo`, `enlace`, `icono`, `areas`, `descripcion`) VALUES
                                                                                                                              (4, 'aprender', 1, 1, 3, 'aplica', 'aprender', 'aprender.png', 'MATEMATICAS, LENGUAJE, NATURALES, SOCIALES', ''),
                                                                                                                              (5, 'Kolibri', 1, 1, 5, 'web', 'http://gsantander.aulasteam.co:8030', 'kolibri.png', '', 'CONTENIDOS'),
                                                                                                                              (6, 'aprender digital', 1, 1, 4, 'web', 'https://contenidos.colombiaaprende.edu.co/#block-bannerssliders-1', 'aprender_digital.png', 'PLATAFORMA', ''),
                                                                                                                              (7, 'wikimedia', 1, 1, 4, 'web', 'http://gsantander.aulasteam.co:8090', 'wikimedia.png', 'MATEMATICAS,CIENCIAS NATURALES,LENGUAJE,CIENCIAS SOCIALES,TECNOLOGIA', ''),
                                                                                                                              (8, 'campus virtual aula steam', 1, 1, 5, 'web', 'http://gsantander.aulasteam.co:8088/lms', 'moodlegs.png', 'PLATAFORMA', ''),
                                                                                                                              (9, 'proyecto descartes', 1, 1, 6, 'submenu', 'descartes', 'pro_descartes.png', 'MATEMATICAS,IDIOMAS,CIENCIAS NATURALES', ''),
                                                                                                                              (10, 'Curriculos Exploratorios en TIC', 1, 1, 7, 'submenu', 'explora', 'exploratorios.png', 'TECNOLOGIA, MATEMATICAS, CIENCIAS NATURALES', ''),
                                                                                                                              (11, 'laboratorio virtual', 1, 1, 8, 'submenu', 'lab', 'virtualab.png', 'MATEMATICAS,NATURALES', ''),
                                                                                                                              (12, 'cidead', 1, 1, 9, 'aplica', 'cidead/edad', 'cidead.png', 'LENGUAJE, IDIOMAS,MATEMATICAS,TECNOLOGIA,ETICA,CIENCIAS SOCIALES', ''),
                                                                                                                              (13, 'icfes', 1, 1, 10, 'carpeta', 'saber', 'saber.png', 'LENGUAJE, IDIOMAS,MATEMATICAS,CIENCIAS SOCIALES', 'SIMULACROS PRUEBAS SABER'),
                                                                                                                              (14, 'colombia bilingüe', 1, 1, 11, 'aplica', 'project', 'bilingue.png', 'IDIOMAS', ''),
                                                                                                                              (15, 'claseweb', 1, 1, 12, 'aplica', 'claseweb', 'claseweb.png', 'IDIOMAS', ''),
                                                                                                                              (16, 'proyecto bilinguismo quindio', 1, 1, 13, 'carpeta', 'bilinguismo', 'bilinguismo.png', 'IDIOMAS', 'PROYECTO BILINGUISMO QUINDIO'),
                                                                                                                              (17, 'animaciones para ingles', 1, 1, 14, 'carpeta', 'animaingles', 'animaciones.png', 'IDIOMAS', 'ANIMACIONES PARA INGLES'),
                                                                                                                              (18, 'english for little children', 1, 1, 15, 'aplica', 'little_children', 'little_children.png', 'IDIOMAS', ''),
                                                                                                                              (19, 'english for kids', 1, 1, 16, 'aplica', 'ingles', 'ingles.png', 'IDIOMAS', ''),
                                                                                                                              (20, 'interactive english', 1, 1, 17, 'aplica', 'ienglish', 'ienglish.png', 'IDIOMAS', ''),
                                                                                                                              (21, 'playcomic', 1, 1, 18, 'aplica', 'playcomic', 'playcomic.png', 'IDIOMAS', ''),
                                                                                                                              (22, 'colour your english', 1, 1, 19, 'aplica', 'colour_english', 'colour_english.png', 'IDIOMAS', ''),
                                                                                                                              (23, 'geogebra', 1, 1, 20, 'aplica', 'geogebra', 'geogebra.png', 'MATEMATICAS', ''),
                                                                                                                              (34, 'circuitos electricos de corriente continua', 1, 1, 31, 'aplica', 'corriente_continua', 'corriente_continua.png', 'TECNOLOGIA,NATURALES', ''),
                                                                                                                              (35, 'iniciacion a la electricidad y electronica', 1, 1, 32, 'aplica', 'electricidad', 'electricidad.png', 'TECNOLOGIA,NATURALES', ''),
                                                                                                                              (36, 'introduccion a la electricidad', 1, 1, 33, 'aplica', 'intro_electricidad', 'intro_electricidad.png', 'TECNOLOGIA,NATURALES', ''),
                                                                                                                              (43, 'colección semilla', 1, 1, 40, 'carpeta', 'semilla', 'semilla.png', 'LENGUAJE', 'COLECCION SEMILLA'),
                                                                                                                              (44, 'biblioteca virtual', 1, 1, 41, 'submenu', 'biblioteca', 'biblioteca.png', 'LENGUAJE,NATURALES, CIENCIAS SOCIALES, MATEMATICAS', 'BIBLIOTECA VIRTUAL'),
                                                                                                                              (45, 'aprendizaje de la lectoescritura', 1, 1, 42, 'aplica', 'lectoescritura', 'lectoescritura.png', 'LENGUAJE', ''),
                                                                                                                              (46, 'las vocales', 1, 1, 43, 'aplica', 'vocales', 'vocales.png', 'LENGUAJE', ''),
                                                                                                                              (47, 'dibujo tecnico', 1, 1, 44, 'aplica', 'dibujo', 'dibujo.png', 'ARTISTICA,TECNOLOGIA', ''),
                                                                                                                              (48, 'construcciones de dibujo tecnico', 1, 1, 45, 'aplica', 'construcciones', 'construcciones.png', 'ARTISTICA,TECNOLOGIA', ''),
                                                                                                                              (49, 'normalizacion', 1, 1, 46, 'aplica', 'normalizacion', 'normalizacion.png', 'ARTISTICA,TECNOLOGIA', ''),
                                                                                                                              (50, 'proyecto techno', 1, 1, 47, 'aplica', 'tecno', 'tecno.png', 'TECNOLOGIA', ''),
                                                                                                                              (51, 'mecanica basica', 1, 1, 48, 'aplica', 'mecanica_basica', 'mecanica_basica.png', 'TECNOLOGIA, NATURALES', ''),
                                                                                                                              (52, 'taller virtual de tecnologia', 1, 1, 49, 'aplica', 'taller_tec', 'taller_tec.png', 'TECNOLOGIA', ''),
                                                                                                                              (53, 'mecaneso', 1, 1, 50, 'aplica', 'mecaneso', 'mecaneso.png', 'TECNOLOGIA, NATURALES', ''),
                                                                                                                              (54, 'ritmo y simetria', 1, 1, 51, 'aplica', 'ritmo_simetria', 'ritmo_simetria.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (55, 'aprende a ver arquitectura', 1, 1, 52, 'aplica', 'arquitectura', 'arquitectura.png', 'EDUCACION ARTISTICA,TECNOLOGIA', ''),
                                                                                                                              (56, 'artes plasticas', 1, 1, 53, 'submenu', 'artes_plasticas', 'artes_plasticas.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (57, 'la obra de arte', 1, 1, 54, 'aplica', 'obra_arte', 'obra.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (58, 'la luz en el arte', 1, 1, 55, 'aplica', 'luz', 'luz.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (59, 'los pequeños musicos', 1, 1, 56, 'aplica', 'pequenos_musicos', 'pequenos_musicos.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (60, 'musica educa', 1, 1, 57, 'aplica', 'musica_educa', 'musica_educa.png', 'EDUCACION ARTISTICA', ''),
                                                                                                                              (213, 'pierdele el miedo a las potencias', 1, 1, 213, 'aplica', 'potencias', 'potencias.png', 'MATEMATICAS', ''),
                                                                                                                              (214, 'las horas', 1, 1, 214, 'aplica', 'las_horas', 'las_horas.png', 'MATEMATICAS', ''),
                                                                                                                              (215, 'a medir', 1, 1, 215, 'aplica', 'a_medir', 'a_medir.png', 'MATEMATICAS', ''),
                                                                                                                              (216, 'tablas de multiplicar', 1, 1, 216, 'aplica', 'tablas_multiplicar', 'tablas_multiplicar.png', 'MATEMATICAS', ''),
                                                                                                                              (217, 'retomatic', 1, 1, 217, 'aplica', 'retomatic', 'retomatic.png', 'MATEMATICAS,CIENCIAS NATURALES,IDIOMAS,LENGUAJE', ''),
                                                                                                                              (218, 'dpensar', 1, 1, 218, 'carpeta', 'dpensar', 'dpensar.png', 'MATEMATICAS', 'APLICACIONES DPENSAR'),
                                                                                                                              (219, 'metamodelos tic', 1, 1, 219, 'aplica', 'problematic', 'problematic.png', 'MATEMATICAS', ''),
                                                                                                                              (220, 'animaciones para matematicas', 1, 1, 220, 'carpeta', 'animat', 'animat.png', 'MATEMATICAS', 'ANIMACIONES PARA MATEMATICAS'),
                                                                                                                              (221, 'geometria para matematicas', 1, 1, 221, 'aplica', 'geo_mat', 'geo_mat.png', 'MATEMATICAS', ''),
                                                                                                                              (223, 'numeros y colores', 1, 1, 223, 'aplica', 'numeros_colores', 'numeros_colores.png', 'MATEMATICAS', ''),
                                                                                                                              (224, 'laboratorio virtual para el estudio del sistema di', 1, 1, 224, 'aplica', 'diedrico', 'diedrico.png', 'MATEMATICAS', ''),
                                                                                                                              (225, 'curvas conicas', 1, 1, 225, 'aplica', 'curvas_conicas', 'curvas_conicas.png', 'MATEMATICAS', ''),
                                                                                                                              (226, 'proble+', 1, 1, 226, 'aplica', 'problemas', 'problemas.png', 'MATEMATICAS', ''),
                                                                                                                              (227, 'series matematicas', 1, 1, 227, 'aplica', 'series_matematicas', 'series_matematicas.png', 'MATEMATICAS,NATURALES', ''),
                                                                                                                              (228, 'el planeta azul', 1, 1, 228, 'aplica', 'planeta_azul', 'planeta_azul.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (229, 'clima y cambio climatico', 1, 1, 229, 'aplica', 'clima', 'clima.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (230, 'en el laboratorio', 1, 1, 230, 'aplica', 'en_el_laboratorio', 'en_el_laboratorio.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (231, 'clasificar seres vivos', 1, 1, 231, 'aplica', 'seres_vivos', 'seres_vivos.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (232, 'las leyes de newton y las fuerzas', 1, 1, 232, 'aplica', 'leyes_newton', 'leyes_newton.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (233, 'dinamica las leyes de newton', 1, 1, 233, 'aplica', 'dinamica', 'dinamica.png', 'NATURALES', ''),
                                                                                                                              (234, 'vectores', 1, 1, 234, 'aplica', 'vectores', 'vectores.png', 'MATEMATICAS, NATURALES', ''),
                                                                                                                              (235, 'fisica entretenida', 1, 1, 235, 'carpeta', 'fisica_entretenida', 'entretenida.png', 'NATURALES,VIDEOS', 'VIDEOS FISICA ENTRETENIDA'),
                                                                                                                              (236, 'el universo mecanico', 1, 1, 236, 'carpeta', 'mecanico', 'universo.png', 'NATURALES,VIDEOS', 'VIDEOS EL UNIVERSO MECANICO'),
                                                                                                                              (237, 'ondas', 1, 1, 237, 'aplica', 'ondas', 'ondas.png', 'NATURALES', ''),
                                                                                                                              (238, 'curso fisica por ordenador', 1, 1, 238, 'aplica', 'fisica', 'fisicaor.png', 'NATURALES', ''),
                                                                                                                              (239, 'virus y vacunas', 1, 1, 239, 'aplica', 'virus', 'virus.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (240, 'las incomprendidas bacterias', 1, 1, 240, 'aplica', 'bacterias', 'bacterias.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (241, 'en la variedad esta el gusto', 1, 1, 241, 'aplica', 'variedad', 'variedad.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (242, 'mas plantas por favor', 1, 1, 242, 'aplica', 'plantas_por_favor', 'plantas_por_favor.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (243, 'mueve el esqueleto', 1, 1, 243, 'aplica', 'mueve_esqueleto', 'mueve_esqueleto.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (244, 'el corazon', 1, 1, 244, 'aplica', 'el_corazon', 'el_corazon.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (245, 'los vasos sanguineos', 1, 1, 245, 'aplica', 'vasos_sanguineos', 'vasos_sanguineos.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (246, 'funciones vitales de la celula', 1, 1, 246, 'aplica', 'funciones_vitales_celula', 'funciones_vitales_celula.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (247, 'la celulca funciones y partes', 1, 1, 247, 'aplica', 'funciones_celula', 'funciones_celula.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (248, 'el sistema circulatorio', 1, 1, 248, 'aplica', 'circulatorio', 'circulatorio.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (249, 'Enfermedades del cuerpo humano', 1, 1, 249, 'aplica', 'enfermedades', 'enfermedades.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (250, 'la ciencia es divertida', 1, 1, 58, 'aplica', 'divertida', 'divertida.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (251, 'viaje al interior de la materia', 1, 1, 59, 'aplica', 'materia', 'materia.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (252, 'iniciacion interactiva a la materia', 1, 1, 60, 'aplica', 'iniciacion_materia', 'iniciacion_materia.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (253, 'proyecto biosfera', 1, 1, 61, 'aplica', 'biosfera', 'biosfera.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (254, 'la celula eucariota', 1, 1, 62, 'aplica', 'eucariota', 'eucariota.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (255, 'la ventana de hooke', 1, 1, 63, 'aplica', 'hooke', 'hooke.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (256, 'nuestro cuerpo', 1, 1, 64, 'aplica', 'cuerpo', 'cuerpo.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (257, 'la desertizacion', 1, 1, 65, 'aplica', 'desertizacion', 'desertizacion.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (258, 'explorando el cambio climatico', 1, 1, 66, 'aplica', 'climatico', 'climatico.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (259, 'la isla de las ciencias', 1, 1, 67, 'aplica', 'isla', 'isla.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (260, 'principios de genetica', 1, 1, 68, 'aplica', 'genetica', 'genetica.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (271, 'las reacciones quimicas', 1, 1, 69, 'aplica', 'reacciones', 'reacciones.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (272, 'elementos quimicos', 1, 1, 70, 'aplica', 'elementos_quimicos', 'elementos_quimicos.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (273, 'leyes de los gases', 1, 1, 71, 'aplica', 'gases', 'gases.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (274, 'la tabla periodica', 1, 1, 72, 'aplica', 'tablap', 'tablap.png', 'CIENCIAS NATURALES', ''),
                                                                                                                              (275, 'materiales y materias primas', 1, 1, 73, 'carpeta', 'materiales', 'materiales.png', 'NATURALES,TECNOLOGIA', 'VIDEOS MATERIALES Y MATERIAS PRIMAS'),
                                                                                                                              (276, 'atlas de geografia universal', 1, 1, 74, 'carpeta', 'atlas', 'atlas.png', 'CIENCIAS SOCIALES', 'ATLAS GEOGRAFIA UNIVERSAL'),
                                                                                                                              (277, 'las fuentes de energia', 1, 1, 75, 'aplica', 'fuentes', 'fuentes.png', 'CIENCIAS NATURALES,TECNOLOGIA', ''),
                                                                                                                              (278, 'la tierra vista desde satelite', 1, 1, 76, 'aplica', 'tierra', 'tierra.png', 'CIENCIAS SOCIALES, NATURALES', ''),
                                                                                                                              (279, 'antares', 1, 1, 77, 'aplica', 'antares', 'antares.png', 'CIENCIAS SOCIALES, NATURALES', ''),
                                                                                                                              (280, 'mitologia y arte', 1, 1, 78, 'carpeta', 'mitologia', 'mitologia.png', 'CIENCIAS SOCIALES, VIDEOS', 'VIDEOS MITOLOGIA Y ARTE'),
                                                                                                                              (281, 'historias del cielo', 1, 1, 78, 'aplica', 'cielo', 'cielo.png', 'CIENCIAS SOCIALES, NATURALES', ''),
                                                                                                                              (282, 'observaciones y modelos en astronomia', 1, 1, 79, 'aplica', 'astronomia', 'astronomia.png', 'CIENCIAS SOCIALES, NATURALES', ''),
                                                                                                                              (283, 'claves de la evolucion humana', 1, 1, 80, 'aplica', 'evolucion', 'evolucion.png', 'CIENCIAS SOCIALES, NATURALES', ''),
                                                                                                                              (284, 'tras las huellas de nuestros origenes', 1, 1, 81, 'aplica', 'huellas', 'huellas.png', 'CIENCIAS SOCIALES', ''),
                                                                                                                              (285, 'artehistoria', 1, 1, 82, 'carpeta', 'artehistoria', 'artehistoria.png', 'CIENCIAS SOCIALES, VIDEOS', 'VIDEOS ARTEHISTORIA'),
                                                                                                                              (286, 'historia del mundo', 1, 1, 83, 'carpeta', 'historia_mundo', 'historia_mundo.png', 'CIENCIAS SOCIALES', 'AUDIOS HISTORIA DEL MUNDO'),
                                                                                                                              (287, 'escuela de atenas contemporanea', 1, 1, 84, 'aplica', 'atenas', 'atenas.png', 'CIENCIAS SOCIALES', ''),
                                                                                                                              (288, 'el viaje a grecia', 1, 1, 85, 'aplica', 'viaje_grecia', 'viaje_grecia.png', 'CIENCIAS SOCIALES', ''),
                                                                                                                              (289, 'bicentenario', 1, 1, 100, 'carpeta', 'bicentenario', 'bicentenario.png', 'SOCIALES', 'BICENTENARIO DE LA INDEPENDENCIA DE COLOMBIA'),
                                                                                                                              (290, 'la biblia', 1, 1, 86, 'aplica', 'biblia', 'biblia.png', 'EDUCACION RELIGIOSA', ''),
                                                                                                                              (291, 'la biblia de estudio infantil', 1, 1, 87, 'aplica', 'biblia_infantil', 'biblia_infantil.png', 'EDUCACION RELIGIOSA', ''),
                                                                                                                              (292, 'academiaplay', 1, 1, 88, 'carpeta', 'academiaplay', 'academia.png', 'CIENCIAS SOCIALES,CIENCIAS NATURALES, LENGUAJE,FISICA, VIDEOS', 'VIDEOS ACADEMIAPLAY'),
                                                                                                                              (296, 'verdetopia', 1, 1, 93, 'carpeta', 'verdetopia', 'verdetopia.png', 'CIENCIAS SOCIALES', 'VERDETOPIA'),
                                                                                                                              (297, 'living in the coffee cultural landscape', 1, 1, 94, 'carpeta', 'viviendopcc', 'viviendoPCC.png', 'CIENCIAS SOCIALES', 'LIVING IN THE COFFEE CULTURAL LANDSCAPE'),
                                                                                                                              (298, 'seguimiento uso de tabletas', 1, 1, 95, 'carpeta', 'seguimiento', 'seguimiento.png', 'TECNOLOGIA', 'SEGUIMIENTO AL USO DE TABLETAS'),
                                                                                                                              (300, 'smart board', 1, 1, 97, 'carpeta', 'smart_board', 'smart.png', '', 'TABLEROS INTERACTIVOS SMART BOARD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_menuad`
--

CREATE TABLE `cfg_menuad` (
                              `id` int(11) NOT NULL,
                              `nombre` char(50) NOT NULL,
                              `nivel` int(11) NOT NULL,
                              `nivel_sup` int(11) DEFAULT '0',
                              `orden` int(11) NOT NULL,
                              `tipo` char(50) NOT NULL,
                              `enlace` char(100) NOT NULL,
                              `icono` char(50) NOT NULL,
                              `areas` char(100) NOT NULL,
                              `descripcion` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_menu_planea`
--

CREATE TABLE `cfg_menu_planea` (
                                   `id` int(11) NOT NULL,
                                   `nombre` char(50) NOT NULL,
                                   `nivel` int(11) NOT NULL,
                                   `nivel_sup` int(11) DEFAULT '0',
                                   `orden` int(11) NOT NULL,
                                   `tipo` char(50) NOT NULL,
                                   `enlace` char(100) NOT NULL,
                                   `icono` char(50) NOT NULL,
                                   `areas` char(100) NOT NULL,
                                   `descripcion` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cfg_menu_planea`
--

INSERT INTO `cfg_menu_planea` (`id`, `nombre`, `nivel`, `nivel_sup`, `orden`, `tipo`, `enlace`, `icono`, `areas`, `descripcion`) VALUES
                                                                                                                                     (1, 'pei', 1, 1, 1, 'raiz', 'pei', 'pei.png', '', 'PROYECTO EDUCATIVO INSTITUCIONAL'),
                                                                                                                                     (2, 'siee', 1, 1, 2, 'raiz', 'siee', 'siee.png', '', 'SISTEMA INSTITUCIONAL DE EVALUACIÓN DE ESTUDIANTES'),
                                                                                                                                     (3, 'manual de convivencia', 1, 1, 3, 'raiz', 'convivencia', 'convivencia.png', '', 'MANUAL DE CONVIVENCIA'),
                                                                                                                                     (4, 'pmi', 1, 1, 4, 'raiz', 'pmi', 'pmi.png', '', 'PLAN DE MEJORAMIENTO INSTITUCIONAL'),
                                                                                                                                     (5, 'plan de area', 1, 1, 1, 'raiz', 'plan_area', 'plan_area.png', '', 'PLAN DE AREA'),
                                                                                                                                     (6, 'plan de aula', 1, 1, 2, 'raiz', 'plan_aula', 'plan_aula.png', '', 'PLAN DE AULA'),
                                                                                                                                     (7, 'piar', 1, 1, 3, 'raiz', 'piar', 'piar.png', '', 'PLAN INDIVIDUAL DE AJUSTES RAZONABLES'),
                                                                                                                                     (8, 'picc', 1, 1, 4, 'raiz', 'picc', 'picc.png', '', 'PROGRAMA DE INTEGRACIÓN DE COMPONENTES CURRICULARES'),
                                                                                                                                     (9, 'ebc\r\n', 1, 1, 5, 'raiz', 'ebc', 'ebc.png', '', 'ESTÁNDARES BÁSICOS DE COMPETENCIAS'),
                                                                                                                                     (10, 'lineamientos curriculares', 1, 1, 6, 'raiz', 'lineamientos', 'lineamientos.png', '', 'LINEAMIENTOS CURRICULARES'),
                                                                                                                                     (11, 'matriz de referencia', 1, 1, 7, 'raiz', 'matriz', 'matriz.png', '', 'MATRIZ DE REFERENCIA'),
                                                                                                                                     (12, 'orientaciones pedagogicas', 1, 1, 8, 'raiz', 'orientaciones', 'orientaciones.png', '', 'ORIENTACIONES PEDAGÓGICAS'),
                                                                                                                                     (13, 'dba', 1, 1, 9, 'raiz', 'dba', 'dba.png', '', 'DERECHOS BÁSICOS DE APRENDIZAJE'),
                                                                                                                                     (14, 'mallas de aprendizaje', 1, 1, 10, 'raiz', 'mallas', 'mallas.png', '', 'MALLAS DE APRENDIZAJE'),
                                                                                                                                     (17, 'saber 11', 1, 1, 16, 'raiz', 'saber_11', 'saber_11.png', '', 'RESULTADOS SABER 11'),
                                                                                                                                     (19, 'evidencias evaluación de desempeño', 1, 1, 19, 'raiz', 'evidencias', 'evidencias.png', '', 'EVIDENCIAS EVALUACIÓN DE DESEMPEÑO 1278'),
                                                                                                                                     (21, 'guías de trabajo en casa', 1, 1, 1, 'raiz', 'guias', 'guías.png', '', 'GUÍAS PARA TRABAJO EN CASA'),
                                                                                                                                     (22, 'stem', 1, 1, 22, 'raiz', 'stem', 'stem.png', '', 'GUIAS STEM'),
                                                                                                                                     (23, 'caracterizacion estudiantes', 1, 1, 23, 'raiz', 'caracterizacion', 'caracterizacion.png', '', 'CARACTERIZACION ESTUDIANTES'),
                                                                                                                                     (24, 'documentos prae pgire', 1, 1, 24, 'raiz', 'doc prae', 'doc prae.png', '', 'DOCUMENTOS PRAE PGIRE'),
                                                                                                                                     (25, 'plan de direccion de grupo', 1, 1, 25, 'raiz', 'direccion', 'dir_grupo.png', '', 'PLAN DE DIRECCION DE GRUPO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_procesos`
--

CREATE TABLE `cfg_procesos` (
                                `codpro` int(11) NOT NULL,
                                `nomproceso` varchar(70) NOT NULL DEFAULT '0',
                                `icono` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_proyectos`
--

CREATE TABLE `cfg_proyectos` (
                                 `codpro` int(11) NOT NULL,
                                 `nomproyecto` varchar(70) NOT NULL DEFAULT '0',
                                 `icono` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
                               `id` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
                               `ip_address` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
                               `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
                               `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
                                 `id_configuracion` int(11) NOT NULL,
                                 `logo_institucion` varchar(100) NOT NULL,
                                 `nombre_institucion` varchar(200) NOT NULL,
                                 `ciudad` varchar(100) NOT NULL,
                                 `color_principal` varchar(50) NOT NULL,
                                 `color_secundario` varchar(50) NOT NULL,
                                 `color_boton_primary` varchar(45) NOT NULL,
                                 `color_boton_success` varchar(45) NOT NULL,
                                 `color_boton_danger` varchar(45) NOT NULL,
                                 `color_boton_warning` varchar(45) NOT NULL,
                                 `banner_principal` varchar(250) NOT NULL,
                                 `modal_principal` varchar(250) NOT NULL,
                                 `color_modal` varchar(45) NOT NULL,
                                 `calificacion_sobre` int(11) NOT NULL,
                                 `smtp_host` varchar(50) NOT NULL,
                                 `smtp_port` int(11) NOT NULL,
                                 `smtp_user` varchar(50) NOT NULL,
                                 `smtp_pass` varchar(50) NOT NULL,
                                 `departamental` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `logo_institucion`, `nombre_institucion`, `ciudad`, `color_principal`, `color_secundario`, `color_boton_primary`, `color_boton_success`, `color_boton_danger`, `color_boton_warning`, `banner_principal`, `modal_principal`, `color_modal`, `calificacion_sobre`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `departamental`) VALUES
    (1, 'logo.png', 'Nombre colegio', 'Quindío', '#317756', '#41662b', '#2d2e5b', '#2b3973', '#215c61', '#8459f2', 'banner ie integratic hosting 1.png', 'bienvenida.png', '#307a50', 5, '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `core_participantes_pruebas`
--

CREATE TABLE `core_participantes_pruebas` (
                                              `id_participante_prueba` int(11) NOT NULL,
                                              `identificacion` varchar(50) NOT NULL,
                                              `nombres` varchar(250) NOT NULL,
                                              `apellidos` varchar(250) NOT NULL,
                                              `telefono` varchar(50) NOT NULL,
                                              `email` varchar(200) NOT NULL,
                                              `municipio` int(11) NOT NULL,
                                              `institucion` varchar(250) DEFAULT NULL,
                                              `grado` varchar(45) DEFAULT NULL,
                                              `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
                          `id_curso` int(11) NOT NULL,
                          `created_by` int(11) NOT NULL,
                          `nombre_curso` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                          `descripcion_curso` longtext COLLATE utf8_spanish2_ci NOT NULL,
                          `grados` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                          `disponible_desde` datetime NOT NULL,
                          `disponible_hasta` datetime NOT NULL,
                          `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
                              `documento` varchar(20) NOT NULL,
                              `nombre` varchar(100) NOT NULL,
                              `email` varchar(100) NOT NULL,
                              `grado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencias_aprendizaje`
--

CREATE TABLE `evidencias_aprendizaje` (
                                          `id_evidencia_aprendizaje` int(11) NOT NULL,
                                          `id_plan_area` int(11) NOT NULL,
                                          `semanas` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                          `evidencia_aprendizaje` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `exploracion` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `estructuracion` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `transferencia` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `valoracion` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `recursos` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `is_only_row` tinyint(1) NOT NULL,
                                          `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          `is_completo` int(11) NOT NULL DEFAULT '0',
                                          `observaciones_completo` text COLLATE utf8_spanish2_ci NOT NULL,
                                          `estado_completo` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1. Pendiente, 2. Completo, 3. No Completo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
                         `id_foro` int(11) NOT NULL,
                         `created_by` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
                         `titulo` text COLLATE utf8_spanish2_ci NOT NULL,
                         `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                         `disponible_desde` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `disponible_hasta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `created_at` datetime NOT NULL,
                         `materia` int(5) NOT NULL,
                         `grupo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
                         `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
                            `id` int(11) NOT NULL,
                            `documento` varchar(20) NOT NULL,
                            `fecha` date NOT NULL,
                            `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones_educativas`
--

CREATE TABLE `instituciones_educativas` (
                                            `id_institucion_educativa` int(11) NOT NULL,
                                            `nombre_institucion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                                            `id_municipio` int(11) NOT NULL,
                                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
                              `id_municipio` int(11) NOT NULL,
                              `municipio` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `municipio`, `created_at`) VALUES
                                                                         (1, 'Armenia', '2023-10-24 15:31:07'),
                                                                         (2, 'Calarca', '2023-10-24 15:31:07'),
                                                                         (3, 'La Tebaida', '2023-10-25 17:50:24'),
                                                                         (4, 'Buenavista', '2024-01-03 10:49:12'),
                                                                         (5, 'Filandia', '2024-01-03 10:49:41'),
                                                                         (6, 'Génova', '2024-01-03 10:49:41'),
                                                                         (7, 'Pijao', '2024-01-03 10:50:00'),
                                                                         (8, 'Quimbaya', '2024-01-03 10:50:00'),
                                                                         (9, 'Montenegro', '2024-01-03 10:50:32'),
                                                                         (10, 'Cordoba', '2024-01-03 10:50:32'),
                                                                         (11, 'Salento', '2024-01-03 10:51:50'),
                                                                         (12, 'Circasia', '2024-01-03 10:51:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
                                  `id_notificacion` int(11) NOT NULL,
                                  `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                  `materia` int(11) NOT NULL,
                                  `grado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                                  `grupo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                                  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
                            `id_periodo` int(11) NOT NULL,
                            `periodo` int(11) NOT NULL,
                            `fecha_inicio` date NOT NULL,
                            `fecha_fin` date NOT NULL,
                            `descripcion_periodo` text COLLATE utf8_spanish2_ci NOT NULL,
                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_areas`
--

CREATE TABLE `plan_areas` (
                              `id_plan_area` int(11) NOT NULL,
                              `created_by` int(11) NOT NULL,
                              `area` int(11) NOT NULL,
                              `materia` int(11) NOT NULL,
                              `periodo` int(11) NOT NULL,
                              `fecha_inicio` date NOT NULL,
                              `fecha_fin` date NOT NULL,
                              `intensidad_horaria` int(11) NOT NULL,
                              `diagnostico` longtext COLLATE utf8_spanish2_ci NOT NULL,
                              `estado_actual` longtext COLLATE utf8_spanish2_ci NOT NULL,
                              `situacion_deseada` longtext COLLATE utf8_spanish2_ci NOT NULL,
                              `observaciones` longtext COLLATE utf8_spanish2_ci NOT NULL,
                              `pactos_clase` text COLLATE utf8_spanish2_ci NOT NULL,
                              `estandares_basicos` text COLLATE utf8_spanish2_ci NOT NULL,
                              `dbas` text COLLATE utf8_spanish2_ci NOT NULL,
                              `codigo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                              `version` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_prueba`
--

CREATE TABLE `preguntas_prueba` (
                                    `id_pregunta_prueba` int(11) NOT NULL,
                                    `nombre_author` varchar(250) DEFAULT NULL,
                                    `email_author` varchar(250) DEFAULT NULL,
                                    `id_materia` varchar(45) DEFAULT NULL,
                                    `id_tema` int(11) NOT NULL,
                                    `descripcion_pregunta` longtext NOT NULL,
                                    `comentarios_pregunta` mediumtext,
                                    `dificultad` tinyint(2) NOT NULL,
                                    `archivo` varchar(250) DEFAULT NULL,
                                    `nombre_archivo` varchar(250) DEFAULT NULL,
                                    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    `created_by` varchar(45) NOT NULL,
                                    `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
                           `id_prueba` int(11) NOT NULL,
                           `id_periodo` int(11) NOT NULL,
                           `mostrar_respuestas` tinyint(1) NOT NULL,
                           `tipo_prueba` int(11) NOT NULL,
                           `alcance_prueba` int(11) NOT NULL,
                           `cantidad_preguntas` int(11) NOT NULL,
                           `nombre_prueba` varchar(250) NOT NULL,
                           `descripcion_prueba` longtext,
                           `materias` longtext NOT NULL,
                           `dificultad` varchar(250) NOT NULL,
                           `fecha_inicio` datetime NOT NULL,
                           `fecha_finaliza` datetime NOT NULL,
                           `duracion` int(11) NOT NULL,
                           `estado` int(11) NOT NULL DEFAULT '1',
                           `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realizar_prueba`
--

CREATE TABLE `realizar_prueba` (
                                   `id_realizar_prueba` int(11) NOT NULL,
                                   `id_participante` int(11) NOT NULL,
                                   `id_prueba` int(11) NOT NULL,
                                   `institucion` varchar(250) NOT NULL,
                                   `grado` varchar(45) NOT NULL,
                                   `calificacion` double DEFAULT NULL,
                                   `nota` double NOT NULL,
                                   `is_closed` tinyint(1) NOT NULL DEFAULT '0',
                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   `finished_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_actividades`
--

CREATE TABLE `respuestas_actividades` (
                                          `id_respuestas_actividades` int(11) NOT NULL,
                                          `id_actividad` int(11) NOT NULL,
                                          `created_by` int(11) NOT NULL,
                                          `url_archivo` varchar(250) NOT NULL,
                                          `created_at` datetime NOT NULL,
                                          `estudiante_notas` longtext,
                                          `docente_notas` longtext,
                                          `calificacion` varchar(45) DEFAULT '1',
                                          `fecha_calificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_foro`
--

CREATE TABLE `respuestas_foro` (
                                   `id_respuesta` int(11) NOT NULL,
                                   `created_by` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
                                   `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   `id_foro` int(11) DEFAULT NULL,
                                   `id_relacion_respuesta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_preguntas_pruebas`
--

CREATE TABLE `respuestas_preguntas_pruebas` (
                                                `id_respuesta_pregunta_prueba` int(11) NOT NULL,
                                                `id_pregunta` int(11) NOT NULL,
                                                `descripcion_respuesta` longtext NOT NULL,
                                                `archivo_respuesta` varchar(250) DEFAULT NULL,
                                                `nombre_archivo_respuesta` varchar(250) DEFAULT NULL,
                                                `tipo_respuesta` tinyint(4) NOT NULL,
                                                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_realizar_prueba`
--

CREATE TABLE `respuestas_realizar_prueba` (
                                              `id_respuesta_realizar_prueba` int(11) NOT NULL,
                                              `id_realizar_prueba` int(11) NOT NULL,
                                              `id_pregunta` int(11) NOT NULL,
                                              `id_respuesta` int(11) NOT NULL,
                                              `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semanas_periodo`
--

CREATE TABLE `semanas_periodo` (
                                   `id_semana_periodo` int(11) NOT NULL,
                                   `periodo` int(11) NOT NULL,
                                   `semana` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
                                   `fecha_inicio` date NOT NULL,
                                   `fecha_fin` date NOT NULL,
                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
                         `id_tema` int(11) NOT NULL,
                         `nombre_tema` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                         `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `status` int(11) NOT NULL DEFAULT '1',
                         `materias` text COLLATE utf8_spanish2_ci NOT NULL,
                         `dba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_prueba`
--

CREATE TABLE `tipo_prueba` (
                               `id_tipo_prueba` int(11) NOT NULL,
                               `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_prueba`
--

INSERT INTO `tipo_prueba` (`id_tipo_prueba`, `descripcion`) VALUES
                                                                (1, 'Simulacro ICFES'),
                                                                (2, 'Prueba de conocimiento general'),
                                                                (3, 'Prueba de conocimiento en el área');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
                            `id` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
                            `nombres` varchar(50) NOT NULL,
                            `apellidos` varchar(50) NOT NULL,
                            `email` varchar(100) NOT NULL,
                            `cargo` varchar(25) NOT NULL,
                            `rol` varchar(25) NOT NULL,
                            `nocel` varchar(25) NOT NULL,
                            `usuario` varchar(50) NOT NULL,
                            `clave` varchar(25) NOT NULL,
                            `fecha` datetime NOT NULL,
                            `ultima_fecha_anuncios` datetime DEFAULT NULL,
                            `estado` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `cargo`, `rol`, `nocel`, `usuario`, `clave`, `fecha`, `ultima_fecha_anuncios`, `estado`) VALUES ('1', 'Administrador', '', '', 'Super', 'super', '0', 'admin', 'admin', '0000-00-00 00:00:00', '2023-10-26 09:21:58', 'ac');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
    ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `alcance_prueba`
--
ALTER TABLE `alcance_prueba`
    ADD PRIMARY KEY (`id_alcance_prueba`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
    ADD PRIMARY KEY (`id_anuncio`);

--
-- Indices de la tabla `archivos_curso`
--
ALTER TABLE `archivos_curso`
    ADD PRIMARY KEY (`id_archivo_curso`);

--
-- Indices de la tabla `asg_materias`
--
ALTER TABLE `asg_materias`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asg_procesos`
--
ALTER TABLE `asg_procesos`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asg_proyectos`
--
ALTER TABLE `asg_proyectos`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion_participantes_prueba`
--
ALTER TABLE `asignacion_participantes_prueba`
    ADD PRIMARY KEY (`id_asignacion_participante_prueba`),
  ADD KEY `prueba_participante` (`id_prueba`);

--
-- Indices de la tabla `asignacion_preguntas_prueba`
--
ALTER TABLE `asignacion_preguntas_prueba`
    ADD PRIMARY KEY (`id_asignacion_pregunta_prueba`);

--
-- Indices de la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
    ADD PRIMARY KEY (`id_caracterizacion`),
  ADD KEY `caracterizacion_area_idx` (`id_area`);

--
-- Indices de la tabla `caracterizacion_area`
--
ALTER TABLE `caracterizacion_area`
    ADD PRIMARY KEY (`id_caracterizacion_area`);

--
-- Indices de la tabla `caracterizacion_dba`
--
ALTER TABLE `caracterizacion_dba`
    ADD PRIMARY KEY (`id_dba`),
  ADD KEY `area_dba_idx` (`id_area`);

--
-- Indices de la tabla `caracterizacion_estandar`
--
ALTER TABLE `caracterizacion_estandar`
    ADD PRIMARY KEY (`id_estandar`),
  ADD KEY `estandar_area_idx` (`id_area`);

--
-- Indices de la tabla `caracterizacion_lineamiento_curricular`
--
ALTER TABLE `caracterizacion_lineamiento_curricular`
    ADD PRIMARY KEY (`id_lineamiento_curricular`),
  ADD KEY `lineamiento_area_idx` (`id_area`);

--
-- Indices de la tabla `cfg_areas`
--
ALTER TABLE `cfg_areas`
    ADD PRIMARY KEY (`codarea`);

--
-- Indices de la tabla `cfg_materias`
--
ALTER TABLE `cfg_materias`
    ADD PRIMARY KEY (`codmateria`);

--
-- Indices de la tabla `cfg_menu`
--
ALTER TABLE `cfg_menu`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cfg_menuad`
--
ALTER TABLE `cfg_menuad`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cfg_menu_planea`
--
ALTER TABLE `cfg_menu_planea`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cfg_procesos`
--
ALTER TABLE `cfg_procesos`
    ADD PRIMARY KEY (`codpro`);

--
-- Indices de la tabla `cfg_proyectos`
--
ALTER TABLE `cfg_proyectos`
    ADD PRIMARY KEY (`codpro`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
    ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
    ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `core_participantes_pruebas`
--
ALTER TABLE `core_participantes_pruebas`
    ADD PRIMARY KEY (`id_participante_prueba`),
  ADD UNIQUE KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
    ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
    ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
    ADD PRIMARY KEY (`id_evidencia_aprendizaje`),
  ADD KEY `plan_area` (`id_plan_area`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
    ADD PRIMARY KEY (`id_foro`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
    ADD PRIMARY KEY (`id_institucion_educativa`),
  ADD KEY `institucion_municipio` (`id_municipio`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
    ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
    ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
    ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `plan_areas`
--
ALTER TABLE `plan_areas`
    ADD PRIMARY KEY (`id_plan_area`);

--
-- Indices de la tabla `preguntas_prueba`
--
ALTER TABLE `preguntas_prueba`
    ADD PRIMARY KEY (`id_pregunta_prueba`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
    ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `FK_prueba_tipo_prueba` (`tipo_prueba`),
  ADD KEY `FK_prueba_alcance` (`alcance_prueba`);

--
-- Indices de la tabla `realizar_prueba`
--
ALTER TABLE `realizar_prueba`
    ADD PRIMARY KEY (`id_realizar_prueba`),
  ADD KEY `usuario_realizar_prueba_idx` (`id_participante`),
  ADD KEY `prueba_realizar_prueba_idx` (`id_prueba`);

--
-- Indices de la tabla `respuestas_actividades`
--
ALTER TABLE `respuestas_actividades`
    ADD PRIMARY KEY (`id_respuestas_actividades`);

--
-- Indices de la tabla `respuestas_foro`
--
ALTER TABLE `respuestas_foro`
    ADD PRIMARY KEY (`id_respuesta`);

--
-- Indices de la tabla `respuestas_preguntas_pruebas`
--
ALTER TABLE `respuestas_preguntas_pruebas`
    ADD PRIMARY KEY (`id_respuesta_pregunta_prueba`);

--
-- Indices de la tabla `respuestas_realizar_prueba`
--
ALTER TABLE `respuestas_realizar_prueba`
    ADD PRIMARY KEY (`id_respuesta_realizar_prueba`),
  ADD KEY `respuestas_realizar_prueba_pregunta_idx` (`id_pregunta`),
  ADD KEY `respuestas_realizar_prueba_respuesta_idx` (`id_respuesta`),
  ADD KEY `respuestas_realizar_prueba_id_idx` (`id_realizar_prueba`);

--
-- Indices de la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
    ADD PRIMARY KEY (`id_semana_periodo`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
    ADD PRIMARY KEY (`id_tema`);

--
-- Indices de la tabla `tipo_prueba`
--
ALTER TABLE `tipo_prueba`
    ADD PRIMARY KEY (`id_tipo_prueba`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
    MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
    MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_curso`
--
ALTER TABLE `archivos_curso`
    MODIFY `id_archivo_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asg_materias`
--
ALTER TABLE `asg_materias`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asg_procesos`
--
ALTER TABLE `asg_procesos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asg_proyectos`
--
ALTER TABLE `asg_proyectos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion_participantes_prueba`
--
ALTER TABLE `asignacion_participantes_prueba`
    MODIFY `id_asignacion_participante_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion_preguntas_prueba`
--
ALTER TABLE `asignacion_preguntas_prueba`
    MODIFY `id_asignacion_pregunta_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
    MODIFY `id_caracterizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `caracterizacion_area`
--
ALTER TABLE `caracterizacion_area`
    MODIFY `id_caracterizacion_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `caracterizacion_dba`
--
ALTER TABLE `caracterizacion_dba`
    MODIFY `id_dba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT de la tabla `caracterizacion_estandar`
--
ALTER TABLE `caracterizacion_estandar`
    MODIFY `id_estandar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1083;

--
-- AUTO_INCREMENT de la tabla `caracterizacion_lineamiento_curricular`
--
ALTER TABLE `caracterizacion_lineamiento_curricular`
    MODIFY `id_lineamiento_curricular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cfg_areas`
--
ALTER TABLE `cfg_areas`
    MODIFY `codarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT de la tabla `cfg_materias`
--
ALTER TABLE `cfg_materias`
    MODIFY `codmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT de la tabla `cfg_menuad`
--
ALTER TABLE `cfg_menuad`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cfg_menu_planea`
--
ALTER TABLE `cfg_menu_planea`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `cfg_procesos`
--
ALTER TABLE `cfg_procesos`
    MODIFY `codpro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cfg_proyectos`
--
ALTER TABLE `cfg_proyectos`
    MODIFY `codpro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
    MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `core_participantes_pruebas`
--
ALTER TABLE `core_participantes_pruebas`
    MODIFY `id_participante_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
    MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
    MODIFY `id_evidencia_aprendizaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
    MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37869;

--
-- AUTO_INCREMENT de la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
    MODIFY `id_institucion_educativa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
    MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
    MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
    MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_areas`
--
ALTER TABLE `plan_areas`
    MODIFY `id_plan_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_prueba`
--
ALTER TABLE `preguntas_prueba`
    MODIFY `id_pregunta_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
    MODIFY `id_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `realizar_prueba`
--
ALTER TABLE `realizar_prueba`
    MODIFY `id_realizar_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas_actividades`
--
ALTER TABLE `respuestas_actividades`
    MODIFY `id_respuestas_actividades` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas_foro`
--
ALTER TABLE `respuestas_foro`
    MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas_preguntas_pruebas`
--
ALTER TABLE `respuestas_preguntas_pruebas`
    MODIFY `id_respuesta_pregunta_prueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3508;

--
-- AUTO_INCREMENT de la tabla `respuestas_realizar_prueba`
--
ALTER TABLE `respuestas_realizar_prueba`
    MODIFY `id_respuesta_realizar_prueba` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
    MODIFY `id_semana_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
    MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
    ADD CONSTRAINT `caracterizacion_area` FOREIGN KEY (`id_area`) REFERENCES `caracterizacion_area` (`id_caracterizacion_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
    ADD CONSTRAINT `plan_area` FOREIGN KEY (`id_plan_area`) REFERENCES `plan_areas` (`id_plan_area`);

--
-- Filtros para la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
    ADD CONSTRAINT `institucion_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`);

--
-- Filtros para la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
    ADD CONSTRAINT `periodo` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
