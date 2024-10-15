--
-- Estructura de tabla para la tabla `caracterizacion_estudiantes_preguntas`
--

CREATE TABLE `caracterizacion_estudiantes_preguntas` (
                                                         `id` int(11) NOT NULL,
                                                         `pregunta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
                                                         `titulo_excel` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                                         `tipo_etiqueta` enum('input','select','checkbox','textarea') COLLATE utf8_spanish2_ci NOT NULL,
                                                         `tipo_input` enum('text','number','date','') COLLATE utf8_spanish2_ci DEFAULT NULL,
                                                         `placeholder` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                                         `es_multiple` tinyint(1) DEFAULT '0',
                                                         `opciones` text COLLATE utf8_spanish2_ci,
                                                         `tiene_otro` tinyint(1) NOT NULL DEFAULT '0',
                                                         `es_obligatoria` tinyint(1) DEFAULT '1',
                                                         `orden` int(11) DEFAULT NULL,
                                                         `filtro` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_estudiantes_preguntas`
--

INSERT INTO `caracterizacion_estudiantes_preguntas` (`id`, `pregunta`, `titulo_excel`, `tipo_etiqueta`, `tipo_input`, `placeholder`, `es_multiple`, `opciones`, `tiene_otro`, `es_obligatoria`, `orden`, `filtro`) VALUES
       (1, 'Tipo de documento', 'Tipo de documento', 'select', NULL, NULL, 0, 'a:8:{i:0;s:19:\"Registro civil \'RC\'\";i:1;s:41:\"Número de identificación personal \'NIP\'\";i:2;s:49:\"Número único de identificación personal \'NUIP\'\";i:3;s:25:\"Tarjeta de identidad \'TI\'\";i:4;s:26:\"Cedula de ciudadanía \'CC\'\";i:5;s:37:\"Permiso especial de permanencia \'PEP\'\";i:6;s:38:\"Permiso por protección temporal \'PPT\'\";i:7;s:4:\"Otro\";}', 0, 1, 1, 1),
       (2, 'Número del Documento de Identidad\n', 'Número del Documento de Identidad', 'input', 'number', '12345678', 0, NULL, 0, 1, 2, 0),
       (3, '¿El o la estudiante usa alguno de los siguientes elementos?\n', 'Usa algún elemento', 'checkbox', NULL, NULL, 1, 'a:3:{i:0;s:5:\"Gafas\";i:1;s:18:\"Lentes de contacto\";i:2;s:10:\"Audífonos\";}', 1, 1, 12, 1),
       (4, '¿El o la estudiante se desplaza solo(a) hasta su casa?', 'Va solo a casa', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 4, 0),
       (5, 'Grado', 'Grado', 'select', NULL, NULL, 0, 'a:24:{i:0;s:13:\"Transición A\";i:1;s:13:\"Transición B\";i:2;s:9:\"Primero A\";i:3;s:9:\"Primero B\";i:4;s:9:\"Segundo A\";i:5;s:9:\"Segundo B\";i:6;s:9:\"Tercero A\";i:7;s:9:\"Tercero B\";i:8;s:8:\"Cuarto A\";i:9;s:8:\"Cuarto B\";i:10;s:8:\"Quinto A\";i:11;s:8:\"Quinto B\";i:12;s:7:\"Sexto A\";i:13;s:7:\"Sexto B\";i:14;s:10:\"Séptimo A\";i:15;s:10:\"Séptimo B\";i:16;s:8:\"Octavo A\";i:17;s:8:\"Octavo B\";i:18;s:8:\"Noveno A\";i:19;s:8:\"Noveno B\";i:20;s:8:\"Decimo A\";i:21;s:8:\"Decimo B\";i:22;s:11:\"Undécimo A\";i:23;s:11:\"Undécimo B\";}', 0, 1, 3, 1),
       (6, '¿Cuál es el tipo de matricula del o la estudiante?', 'Tipo de matricula', 'select', NULL, NULL, 0, 'a:7:{i:0;s:27:\"Ordinaria (sin compromisos)\";i:1;s:36:\"Con compromiso familiar e individual\";i:2;s:25:\"Con compromiso Académico\";i:3;s:27:\"Con compromiso Convivencial\";i:4;s:40:\"Con compromiso Académico y convivencial\";i:5;s:15:\"En observación\";i:6;s:24:\"En observación especial\";}', 0, 1, 4, 1),
       (7, 'Fecha de Nacimiento', 'Fecha de nacimiento', 'input', 'date', '01/01/2000', 0, NULL, 0, 1, 5, 1),
       (8, 'Género', 'Género', 'select', NULL, NULL, 0, 'a:3:{i:0;s:91:\"Femenina (Persona que se identifica con los atributos sociales y culturales de las mujeres)\";i:1;s:92:\"Masculino (Persona que se identifica con los atributos sociales y culturales de los hombres)\";i:2;s:81:\"OSIGD (personas diversas con orientación sexual e identidad de género diversas)\";}', 0, 1, 6, 1),
       (9, '¿Cuál es el puntaje del sisben tiene el o la estudiante? Si no tiene por favor escriba No aplica ', 'Puntaje del sisben', 'input', 'text', NULL, 0, NULL, 0, 1, 7, 1),
       (10, 'Edad del o la estudiante', 'Edad', 'select', NULL, NULL, 0, 'a:16:{i:0;s:7:\"4 años\";i:1;s:7:\"5 años\";i:2;s:7:\"6 años\";i:3;s:7:\"7 años\";i:4;s:7:\"8 años\";i:5;s:7:\"9 años\";i:6;s:8:\"10 años\";i:7;s:8:\"11 años\";i:8;s:8:\"12 años\";i:9;s:8:\"13 años\";i:10;s:8:\"14 años\";i:11;s:8:\"15 años\";i:12;s:8:\"16 años\";i:13;s:8:\"17 años\";i:14;s:8:\"18 años\";i:15;s:8:\"19 años\";}', 0, 1, 8, 1),
       (11, '¿Cuál es el tipo de Sangre y \"RH\" del o la estudiante?', 'Tipo de sangre', 'select', NULL, NULL, 0, 'a:9:{i:0;s:2:\"A+\";i:1;s:2:\"A-\";i:2;s:2:\"B+\";i:3;s:2:\"B-\";i:4;s:3:\"AB+\";i:5;s:3:\"AB-\";i:6;s:2:\"O+\";i:7;s:2:\"O-\";i:8;s:9:\"Pendiente\";}', 0, 1, 9, 1),
       (12, '¿Cuál es la estatura del estudiante en centímetros?', 'Estatura (cm)', 'input', 'number', NULL, 0, NULL, 0, 1, 10, 1),
       (13, '¿Cuál es el peso del estudiante en kilogramos?', 'Peso (kg)', 'input', 'number', NULL, 0, NULL, 0, 1, 11, 1),
       (14, '¿El o la estudiante tiene alguna de las siguientes barreras o discapacidades? (diagnosticada por un especialista)', 'Barreras o discapacidad', 'checkbox', NULL, NULL, 1, 'a:11:{i:0;s:6:\"Visual\";i:1;s:8:\"Auditiva\";i:2;s:6:\"Motriz\";i:3;s:11:\"Intelectual\";i:4;s:30:\"Trastorno del espectro autista\";i:5;s:66:\"Trastorno de Déficit de Atención con o sin Hiperactividad \'TDAH\'\";i:6;s:33:\"Trastorno del control de impulsos\";i:7;s:34:\"Trastorno de habilidades escolares\";i:8;s:9:\"Múltiple\";i:9;s:9:\"Sistemica\";i:10;s:7:\"Ninguna\";}', 1, 1, 13, 1),
       (15, 'Si el estudiante presenta alguna barrera o discapacidad, por favor indique si requiere tomar algún medicamento.', 'Toma medicamentos', 'select', NULL, NULL, 0, 'a:3:{i:0;s:2:\"si\";i:1;s:2:\"no\";i:2;s:9:\"no aplica\";}', 0, 1, 14, 0),
       (16, 'Si el estudiante toma algún medicamento, por favor indique cual, si no toma medicamento no responda esta pregunta.', 'Medicamentos', 'input', 'text', NULL, 0, NULL, 0, 0, 15, 0),
       (17, '¿El o la estudiante asiste o asistió a algún proceso con médico especialista?\n', 'Asistió con especialista', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 16, 1),
       (18, 'si el o la estudiante ha asistido a proceso con especialista, por favor indique cual', 'Tipo de especialista', 'checkbox', NULL, NULL, 0, 'a:9:{i:0;s:11:\"Psicología\";i:1;s:12:\"Psiquiatría\";i:2;s:11:\"Neurología\";i:3;s:9:\"Endocrino\";i:4;s:11:\"Cardiólogo\";i:5;s:14:\"Fonoaudiólogo\";i:6;s:10:\"Pediatría\";i:7;s:19:\"Terapia Ocupacional\";i:8;s:9:\"no aplica\";}', 1, 1, 17, 0),
       (19, '¿El o la estudiante sufre de alguna otra enfermedad?\r\n', 'Sufre algúna enfermedad', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 18, 1),
       (20, 'si el o la estudiante sufre de algún otra enfermedad por favor indíquenos cual', 'Enfermedad que sufre', 'input', 'text', NULL, 0, NULL, 0, 0, 19, 0),
       (21, '¿El o la estudiante tiene algún impedimento o limitación dada por un especialista para la no realización de educación física?', 'Tiene impedimento o limitación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 20, 1),
       (22, '¿Cuál es la limitación que el o la estudiante tiene para hacer educación física?', 'Impedimento o limitación', 'input', 'text', NULL, 0, NULL, 0, 0, 21, 0),
       (23, 'Indique por favor ¿Cuál es la alergia alimentaria que tiene el o la estudiante? Si no tiene responda no aplica', 'Alergia alimentaria', 'input', 'text', NULL, 0, NULL, 0, 0, 22, 0),
       (24, '¿Cuál de los siguientes síntomas el o la estudiante presenta con frecuencia?', 'Sintomas frecuentes', 'checkbox', NULL, NULL, 1, 'a:13:{i:0;s:19:\"Mal humor constante\";i:1;s:9:\"Rebeldía\";i:2;s:6:\"Llanto\";i:3;s:40:\"Cambios constantes en el estado de animo\";i:4;s:81:\"Uso excesivo de la tecnología (celular, computador, tablet, play, nintendo, etc)\";i:5;s:8:\"Tristeza\";i:6;s:46:\"Disminución o aumento en la toma de alimentos\";i:7;s:65:\"Hiperactividad (no se queda quieto por periodos largos de tiempo)\";i:8;s:33:\"Insomnio o dificultad para dormir\";i:9;s:31:\"Aislamiento social por voluntad\";i:10;s:13:\"Desobediencia\";i:11;s:32:\"Desorden constante con sus cosas\";i:12;s:7:\"Ninguno\";}', 0, 1, 23, 0),
       (25, '¿Cuántos hermanos(as) tiene el estudiante?', 'Número de hermanos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:7:\"ninguno\";i:1;s:3:\"uno\";i:2;s:3:\"dos\";i:3;s:4:\"tres\";i:4;s:6:\"cuatro\";i:5;s:5:\"cinco\";i:6;s:13:\"más de cinco\";}\n', 0, 1, 24, 1),
       (26, 'Si el estudiante tiene hermanos estudiado en la misma I.E., por favor indíquenos  ¿Cuál es el nombre completo y el grado en el que esta matriculado ?', 'Hermanos en la institución', 'input', 'text', NULL, 0, NULL, 0, 0, 25, 0),
       (27, 'Eps o IPS', 'EPS ó IPS', 'select', NULL, NULL, 0, 'a:11:{i:0;s:4:\"Sura\";i:1;s:12:\"La nueva EPS\";i:2;s:7:\"Medimas\";i:3;s:6:\"Sisben\";i:4;s:8:\"Cosmitet\";i:5;s:11:\"Salud Total\";i:6;s:9:\"Cafesalud\";i:7;s:7:\"Sanitas\";i:8;s:9:\"Famisanar\";i:9;s:9:\"Saludvida\";i:10;s:4:\"Otra\";}', 0, 1, 26, 1),
       (28, '¿El o la estudiante pertenece a Familias en Acción ?', 'Familias en acción', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 27, 1),
       (29, '¿Cúal es la estrategia con la cual El o la estudiante es beneficiario(a) del Programa de Alimentación escolar  \"PAE\"?', 'Estrategía PAE', 'select', NULL, NULL, 0, 'a:4:{i:0;s:15:\"Industrializado\";i:1;s:36:\"Cps (complemento preparado en sitio)\";i:2;s:33:\"Aps (almuerzo preparado en sitio)\";i:3;s:21:\"no esta focalizado(a)\";}', 0, 0, 28, 1),
       (30, 'El o la estudiante vive en Zona:', 'Ubicación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:21:\"Rural (zona de campo)\";i:1;s:23:\"Urbana (zona de ciudad)\";}', 0, 1, 29, 1),
       (31, '¿Cuál es el Estrato socioeconómico (verificar con recibos públicos) del o la estudiante?', 'Estrato', 'select', NULL, NULL, 0, 'a:6:{i:0;s:13:\"1 (Bajo-bajo)\";i:1;s:8:\"2 (Bajo)\";i:2;s:14:\"3 (Medio-bajo)\";i:3;s:9:\"4 (Medio)\";i:4;s:14:\"5 (Medio-Alto)\";i:5;s:8:\"6 (Alto)\";}', 0, 1, 30, 1),
       (32, '¿Cuál de los siguientes servicios, el o la estudiante tiene en su casa?\r\n', 'Servicios', 'checkbox', NULL, NULL, 0, 'a:6:{i:0;s:4:\"Agua\";i:1;s:7:\"Energia\";i:2;s:8:\"Internet\";i:3;s:16:\"Gas domiciliario\";i:4;s:9:\"Teléfono\";i:5;s:23:\"Recolección de basuras\";}', 0, 1, 31, 1),
       (33, '¿Cuál de los siguientes equipos tecnológicos, el o la estudiante tiene en su casa?', 'Equipo tecnológico', 'checkbox', NULL, NULL, 0, 'a:4:{i:0;s:10:\"Computador\";i:1;s:6:\"Tablet\";i:2;s:34:\"Celular smartphone de uso personal\";i:3;s:34:\"Celular smartphone de uso Familiar\";}', 1, 1, 32, 1),
       (34, '¿Cuál es la posibilidad de conectividad que el o la estudiante tiene?\r\n', 'Conectividad', 'select', NULL, NULL, 0, 'a:4:{i:0;s:30:\"Internet como servicio mensual\";i:1;s:13:\"plan de datos\";i:2;s:8:\"recargas\";i:3;s:46:\"no cuenta con esta posibilidad de conectividad\";}', 0, 1, 33, 1),
       (35, '¿Cuál es la dirección de la casa del o la estudiante?\r\n', 'Dirección', 'input', 'text', NULL, 0, NULL, 0, 1, 34, 0),
       (36, '¿Cuál es el teléfono de o la estudiante?', 'Teléfono', 'input', 'number', NULL, 0, NULL, 0, 1, 34, 0),
       (37, 'Por favor indique cual es nombre completo del acudiente, el número de celular y el parentesco con el o la estudiante', 'Acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 36, 0),
       (38, '¿Cuál es la ocupación del acudiente?', 'Ocupación acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 37, 0),
       (39, '¿Cuál es el nombre completo del padre del o la estudiante y su número de celular ?', 'Nombre del padre', 'input', 'text', NULL, 0, NULL, 0, 1, 38, 0),
       (40, '¿Cuál es la ocupación del padre?', 'Ocupación del padre', 'input', 'text', NULL, 0, NULL, 0, 1, 39, 0),
       (41, '¿Cuál es el nombre completo de la mamá del o la estudiante y su número de celular?', 'Nombre de la madre', 'input', 'text', NULL, 0, NULL, 0, 1, 40, 0),
       (42, '¿Cuál es la ocupación de la madre?', 'Ocupación de la madre', 'input', 'text', NULL, 0, NULL, 0, 1, 41, 0),
       (43, 'En caso de emergencia, y no contar con la comunicación del o la acudiente o padres ¿A quien se puede llamar? Por favor indique Nombre completo, parentesco con el estudiante y número de celular', 'Contacto de emergencia', 'input', 'text', NULL, 0, NULL, 0, 1, 42, 0),
       (44, 'El o la estudiante tiene ya el esquema completo de vacunación contra el Covid 19 (dos dosis)', 'Esquema de vacunación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 43, 0),
       (45, '¿El o la estudiante pertenece a alguno de los siguientes grupos?', 'Grupos', 'select', NULL, NULL, 0, 'a:5:{i:0;s:10:\"Juan XXIII\";i:1;s:6:\"Pronic\";i:2;s:4:\"ICBF\";i:3;s:7:\"Abrazar\";i:4;s:38:\"no pertenece a ninguno de estos grupos\";}', 0, 1, 44, 1),
       (46, '¿El o la estudiante pertenece a alguno de los grupos poblacionales?', 'Grupos poblacionales', 'checkbox', NULL, NULL, 1, 'a:8:{i:0;s:10:\"Desplazado\";i:1;s:21:\"Víctima de violencia\";i:2;s:9:\"Indígena\";i:3;s:16:\"Afrodescendiente\";i:4;s:6:\"Raizal\";i:5;s:6:\"Gitano\";i:6;s:4:\"OSIG\";i:7;s:7:\"Ninguno\";}', 1, 1, 45, 1),
       (47, '¿Cuántos años el o la estudiante ha perdido?\r\n', 'Años perdidos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:7:\"Ninguno\";i:1;s:3:\"Uno\";i:2;s:3:\"Dos\";i:3;s:4:\"Tres\";i:4;s:6:\"Cuatro\";i:5;s:5:\"Cinco\";i:6;s:13:\"Más de cinco\";}', 0, 1, 46, 1),
       (48, '¿El o la estudiante está repitiendo el grado actual en el que está matriculado(a)?', 'Es repitente', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 47, 0),
       (49, '¿El o la estudiante es nuevo en nuestra Institución educativa?', 'Es nuevo', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 48, 1),
       (50, '¿Cuántos años el o la estudiante ha estado desescolarizado(a) (no ha estudiado)?', 'Años sin estudiar', 'select', NULL, NULL, 0, 'a:6:{i:0;s:16:\"menos de un año\";i:1;s:7:\"un año\";i:2;s:9:\"dos años\";i:3;s:10:\"tres años\";i:4;s:18:\"Más de tres años\";i:5;s:31:\"no ha estado desescolarizado(a)\";}', 0, 1, 49, 0),
       (51, '¿El o la estudiante se desplaza solo(a) hasta su casa?\r\n', 'Va solo(a) a casa', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 50, 0),
       (52, 'Si el estudiante no se desplaza solo hasta su casa, por favor indique quienes serían las personas autorizadas para recogerlo(a)', 'Personas autorizadas', 'input', 'text', NULL, 0, NULL, 0, 0, 51, 0),
       (53, '¿Cuál es la tipología de la familia de o la estudiante?', 'Tipología de la familia', 'select', NULL, NULL, 0, 'a:8:{i:0;s:52:\"Familia Unipersonal: El o la estudiante vive solo(a)\";i:1;s:72:\"Compuestas: Miembros de la familia y otras personas que no son parientes\";i:2;s:99:\"Recompuesta: Jefe de hogar con pareja (padrastro – madrastra) hijos de cada uno e hijos en común\";i:3;s:27:\"Nuclear: Los padres e hijos\";i:4;s:44:\"Monoparental: Uno solo de los padres e hijos\";i:5;s:55:\"Extensa: La nuclear o monoparental con otros familiares\";i:6;s:67:\"Homoparental: Pareja del mismo sexo, con hijos propios o adoptados.\";i:7;s:24:\"Familia Sustituta (ICBF)\";}', 0, 1, 51, 1),
       (54, 'Por favor indique la siguiente información de acuerdo a las personas con las que el o la estudiante vive: \nNombre completo, edad, parentesco', 'Con quien vive', 'textarea', NULL, NULL, 0, NULL, 0, 1, 52, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracterizacion_estudiantes_preguntas`
--
ALTER TABLE `caracterizacion_estudiantes_preguntas`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracterizacion_estudiantes_preguntas`
--
ALTER TABLE `caracterizacion_estudiantes_preguntas`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

CREATE TABLE `caracterizacion_estudiantes_respuestas` (
                                                          `id` int(11) NOT NULL,
                                                          `id_estudiante` int(11) NOT NULL,
                                                          `id_pregunta` int(11) NOT NULL,
                                                          `respuesta` text COLLATE utf8_spanish2_ci,
                                                          `respuesta_otro` text COLLATE utf8_spanish2_ci,
                                                          `fecha_respuesta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracterizacion_estudiantes_respuestas`
--
ALTER TABLE `caracterizacion_estudiantes_respuestas`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_pregunta` (`id_pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracterizacion_estudiantes_respuestas`
--
ALTER TABLE `caracterizacion_estudiantes_respuestas`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracterizacion_estudiantes_respuestas`
--
ALTER TABLE `caracterizacion_estudiantes_respuestas`
    ADD CONSTRAINT `caracterizacion_estudiantes_respuestas_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `caracterizacion_estudiantes_preguntas` (`id`);

CREATE TABLE `direccion_grupo` (
   `id` int(11) NOT NULL,
   `docente` int(11) NOT NULL,
   `grado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `direccion_grupo`
--
ALTER TABLE `direccion_grupo`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direccion_grupo`
--
ALTER TABLE `direccion_grupo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;




ALTER TABLE `evidencias_aprendizaje` ADD `observaciones_coordinador` TEXT NOT NULL AFTER `observaciones_completo`;

--
-- Estructura de tabla para la tabla `evidencias_aprendizaje_soportes`
--

CREATE TABLE `evidencias_aprendizaje_soportes` (
                                                   `id` int(11) NOT NULL,
                                                   `id_evidencia_aprendizaje` int(11) NOT NULL,
                                                   `nombre_archivo` text COLLATE utf8_spanish2_ci NOT NULL,
                                                   `titulo_archivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                                   `comentarios` text COLLATE utf8_spanish2_ci,
                                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evidencias_aprendizaje_soportes`
--
ALTER TABLE `evidencias_aprendizaje_soportes`
    ADD PRIMARY KEY (`id`),
    ADD KEY `evidencias_aprendizaje_soporte` (`id_evidencia_aprendizaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evidencias_aprendizaje_soportes`
--
ALTER TABLE `evidencias_aprendizaje_soportes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evidencias_aprendizaje_soportes`
--
ALTER TABLE `evidencias_aprendizaje_soportes`
    ADD CONSTRAINT `evidencias_aprendizaje_soporte` FOREIGN KEY (`id_evidencia_aprendizaje`) REFERENCES `evidencias_aprendizaje` (`id_evidencia_aprendizaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Estructura de tabla para la tabla `recuperaciones`
--

CREATE TABLE `recuperaciones` (
                                  `id_recuperacion` int(11) NOT NULL,
                                  `title` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                  `description` text COLLATE utf8_spanish2_ci NOT NULL,
                                  `materia` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
                                  `grupo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
                                  `created_by` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                                  `id_periodo` int(11) NOT NULL,
                                  `disponible_desde` datetime DEFAULT NULL,
                                  `disponible_hasta` datetime NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
    ADD PRIMARY KEY (`id_recuperacion`),
    ADD KEY `fk_recuperacion_periodo` (`id_periodo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
    MODIFY `id_recuperacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
    ADD CONSTRAINT `fk_recuperacion_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodos` (`id_periodo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `actividades` ADD `es_recuperacion` TINYINT NULL DEFAULT '0' AFTER `disponible_desde`;

--
-- Estructura de tabla para la tabla `recuperaciones_actividades`
--

CREATE TABLE `recuperaciones_actividades` (
                                              `id_recuperacion_actividad` int(11) NOT NULL,
                                              `id_recuperacion` int(11) NOT NULL,
                                              `id_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recuperaciones_actividades`
--
ALTER TABLE `recuperaciones_actividades`
    ADD PRIMARY KEY (`id_recuperacion_actividad`),
    ADD KEY `recuperacion_actividad` (`id_actividad`),
    ADD KEY `actividad_recuperacion` (`id_recuperacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recuperaciones_actividades`
--
ALTER TABLE `recuperaciones_actividades`
    MODIFY `id_recuperacion_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperaciones_actividades`
--
ALTER TABLE `recuperaciones_actividades`
    ADD CONSTRAINT `actividad_recuperacion` FOREIGN KEY (`id_recuperacion`) REFERENCES `recuperaciones` (`id_recuperacion`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `recuperacion_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `pruebas` ADD `es_recuperacion` TINYINT NOT NULL DEFAULT '0' AFTER `estado`;

--
-- Estructura de tabla para la tabla `recuperaciones_pruebas`
--

CREATE TABLE `recuperaciones_pruebas` (
                                          `id_recuperaciones_pruebas` int(11) NOT NULL,
                                          `id_recuperacion` int(11) NOT NULL,
                                          `id_prueba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recuperaciones_pruebas`
--
ALTER TABLE `recuperaciones_pruebas`
    ADD PRIMARY KEY (`id_recuperaciones_pruebas`),
    ADD KEY `recuperaciones_pruebas` (`id_recuperacion`),
    ADD KEY `prueba_recuperaciones` (`id_prueba`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recuperaciones_pruebas`
--
ALTER TABLE `recuperaciones_pruebas`
    MODIFY `id_recuperaciones_pruebas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperaciones_pruebas`
--
ALTER TABLE `recuperaciones_pruebas`
    ADD CONSTRAINT `prueba_recuperaciones` FOREIGN KEY (`id_prueba`) REFERENCES `pruebas` (`id_prueba`) ON DELETE CASCADE,
    ADD CONSTRAINT `recuperaciones_pruebas` FOREIGN KEY (`id_recuperacion`) REFERENCES `recuperaciones` (`id_recuperacion`) ON DELETE CASCADE;
COMMIT;

--
-- Estructura de tabla para la tabla `recuperaciones_estudiantes`
--

CREATE TABLE `recuperaciones_estudiantes` (
                                              `id_recuperaciones_estudiantes` int(11) NOT NULL,
                                              `id_recuperacion` int(11) NOT NULL,
                                              `id_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recuperaciones_estudiantes`
--
ALTER TABLE `recuperaciones_estudiantes`
    ADD PRIMARY KEY (`id_recuperaciones_estudiantes`),
    ADD KEY `recuperacion_estudiante_recuperacion` (`id_recuperacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recuperaciones_estudiantes`
--
ALTER TABLE `recuperaciones_estudiantes`
    MODIFY `id_recuperaciones_estudiantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperaciones_estudiantes`
--
ALTER TABLE `recuperaciones_estudiantes`
    ADD CONSTRAINT `recuperacion_estudiante_recuperacion` FOREIGN KEY (`id_recuperacion`) REFERENCES `recuperaciones` (`id_recuperacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
