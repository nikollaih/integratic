/* Actualizacion V4 */

CREATE TABLE IF NOT EXISTS `cfg_menu_planea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  `nivel_sup` int(11) DEFAULT 0,
  `orden` int(11) NOT NULL,
  `tipo` char(50) NOT NULL,
  `enlace` char(100) NOT NULL,
  `icono` char(50) NOT NULL,
  `areas` char(100) NOT NULL,
  `descripcion` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla integra_v3.cfg_menu_planea: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `cfg_menu_planea` DISABLE KEYS */;
REPLACE INTO `cfg_menu_planea` (`id`, `nombre`, `nivel`, `nivel_sup`, `orden`, `tipo`, `enlace`, `icono`, `areas`, `descripcion`) VALUES
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
	(21, 'guías de trabajo en casa', 1, 1, 1, 'raiz', 'guias', 'guías.png', '', 'GUÍAS PARA TRABAJO EN CASA');


CREATE TABLE IF NOT EXISTS `archivos_curso` (
  `id_archivo_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nombre_archivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `slug_archivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `nombre_curso` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion_curso` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `grados` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `disponible_desde` datetime NOT NULL,
  `disponible_hasta` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--



CREATE TABLE IF NOT EXISTS `plan_areas` (
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


--
-- Estructura de tabla para la tabla `evidencias_aprendizaje`
--

CREATE TABLE IF NOT EXISTS `evidencias_aprendizaje` (
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


CREATE TABLE IF NOT EXISTS `municipios` (
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


--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `materia` int(11) NOT NULL,
  `grado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `grupo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `instituciones_educativas`
--

CREATE TABLE IF NOT EXISTS `instituciones_educativas` (
  `id_institucion_educativa` int(11) NOT NULL,
  `nombre_institucion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE IF NOT EXISTS `periodos` (
  `id_periodo` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion_periodo` text COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `semanas_periodo`
--

CREATE TABLE IF NOT EXISTS `semanas_periodo` (
  `id_semana_periodo` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `semana` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE IF NOT EXISTS `temas` (
  `id_tema` int(11) NOT NULL,
  `nombre_tema` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `materias` text COLLATE utf8_spanish2_ci NOT NULL,
  `dba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Indices de la tabla `plan_areas`
--
ALTER TABLE `plan_areas`
  ADD PRIMARY KEY (`id_plan_area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plan_areas`
--
ALTER TABLE `plan_areas`
  MODIFY `id_plan_area` int(11) NOT NULL AUTO_INCREMENT;


--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
  ADD PRIMARY KEY (`id_semana_periodo`),
  ADD KEY `periodo` (`periodo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
  MODIFY `id_semana_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `semanas_periodo`
--
ALTER TABLE `semanas_periodo`
  ADD CONSTRAINT `periodo` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`);


--
-- Índices para tablas volcadas
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
  ADD PRIMARY KEY (`id_institucion_educativa`),
  ADD KEY `institucion_municipio` (`id_municipio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
  MODIFY `id_institucion_educativa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `instituciones_educativas`
--
ALTER TABLE `instituciones_educativas`
  ADD CONSTRAINT `institucion_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Índices para tablas volcadas
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
  ADD PRIMARY KEY (`id_evidencia_aprendizaje`),
  ADD KEY `plan_area` (`id_plan_area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
  MODIFY `id_evidencia_aprendizaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evidencias_aprendizaje`
--
ALTER TABLE `evidencias_aprendizaje`
  ADD CONSTRAINT `plan_area` FOREIGN KEY (`id_plan_area`) REFERENCES `plan_areas` (`id_plan_area`);

--
-- Índices para tablas volcadas
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_curso`
--
ALTER TABLE `archivos_curso`
  ADD PRIMARY KEY (`id_archivo_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_curso`
--
ALTER TABLE `archivos_curso`
  MODIFY `id_archivo_curso` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `actividades` ADD `id_periodo` INT NOT NULL AFTER `estudiantes_habilitados`, ADD `porcentaje` DOUBLE NOT NULL AFTER `id_periodo`, ADD `disponible_desde` DATETIME NOT NULL AFTER `porcentaje`;

ALTER TABLE `configuracion` ADD `smtp_host` VARCHAR(50) NOT NULL AFTER `calificacion_sobre`, ADD `smtp_port` INT NOT NULL AFTER `smtp_host`, ADD `smtp_user` VARCHAR(50) NOT NULL AFTER `smtp_port`, ADD `smtp_pass` VARCHAR(50) NOT NULL AFTER `smtp_user`, ADD `departamental` INT NOT NULL AFTER `smtp_pass`;

ALTER TABLE `core_participantes_pruebas` ADD `municipio` INT NOT NULL AFTER `email`;

ALTER TABLE `estudiante` ADD `email` VARCHAR(100) NOT NULL AFTER `nombre`;

ALTER TABLE `preguntas_prueba` ADD `id_tema` INT NOT NULL AFTER `id_materia`;

ALTER TABLE `cfg_areas` ADD `caracterizacion_area` INT DEFAULT NULL AFTER `fecha`;

ALTER TABLE `pruebas` ADD `id_periodo` INT NOT NULL AFTER `id_prueba`, ADD `mostrar_respuestas` TINYINT(1) NOT NULL AFTER `id_periodo`;

ALTER TABLE `usuarios` ADD `email` VARCHAR(100) NOT NULL AFTER `apellidos`;