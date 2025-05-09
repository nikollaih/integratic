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
                                                         `filtro` tinyint(1) DEFAULT '0',
                                                         `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_estudiantes_preguntas`
--

INSERT INTO `caracterizacion_estudiantes_preguntas` (`id`, `pregunta`, `titulo_excel`, `tipo_etiqueta`, `tipo_input`, `placeholder`, `es_multiple`, `opciones`, `tiene_otro`, `es_obligatoria`, `orden`, `filtro`, `categoria`) VALUES
        (1, 'Tipo de documento del o la estudiante', 'Tipo de documento del o la estudiante', 'select', NULL, NULL, 0, 'a:8:{i:0;s:19:\"Registro civil \'RC\'\";i:1;s:41:\"Número de identificación personal \'NIP\'\";i:2;s:49:\"Número único de identificación personal \'NUIP\'\";i:3;s:25:\"Tarjeta de identidad \'TI\'\";i:4;s:26:\"Cedula de ciudadanía \'CC\'\";i:5;s:37:\"Permiso especial de permanencia \'PEP\'\";i:6;s:38:\"Permiso por protección temporal \'PPT\'\";i:7;s:4:\"Otro\";}', 1, 1, 2, 1, 1),
        (2, 'Número del documento de identidad del o la estudiante ', 'Número del documento de identidad del o la estudiante ', 'input', 'number', '12345678', 0, NULL, 0, 1, 4, 0, 1),
        (3, '¿El o la estudiante usa alguno de los siguientes elementos?\n', '¿El o la estudiante usa alguno de los siguientes elementos?\n', 'checkbox', NULL, NULL, 1, 'a:3:{i:0;s:5:\"Gafas\";i:1;s:18:\"Lentes de contacto\";i:2;s:20:\"Audífonos medicados\";}', 1, 1, 35, 1, 4),
        (4, '¿El o la estudiante se desplaza solo(a) hasta su casa?', 'Va solo a casa', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 58, 0, 5),
        (5, '¿Cuál es el grado escolar del o la estudiante? ', 'Grado del o la estudiante', 'select', NULL, NULL, 0, 'a:24:{i:0;s:13:\"Transición A\";i:1;s:13:\"Transición B\";i:2;s:9:\"Primero A\";i:3;s:9:\"Primero B\";i:4;s:9:\"Segundo A\";i:5;s:9:\"Segundo B\";i:6;s:9:\"Tercero A\";i:7;s:9:\"Tercero B\";i:8;s:8:\"Cuarto A\";i:9;s:8:\"Cuarto B\";i:10;s:8:\"Quinto A\";i:11;s:8:\"Quinto B\";i:12;s:7:\"Sexto A\";i:13;s:7:\"Sexto B\";i:14;s:10:\"Séptimo A\";i:15;s:10:\"Séptimo B\";i:16;s:8:\"Octavo A\";i:17;s:8:\"Octavo B\";i:18;s:8:\"Noveno A\";i:19;s:8:\"Noveno B\";i:20;s:8:\"Decimo A\";i:21;s:8:\"Decimo B\";i:22;s:11:\"Undécimo A\";i:23;s:11:\"Undécimo B\";}', 0, 1, 28, 1, 3),
        (6, '¿Cuál es el tipo de matricula del o la estudiante?', 'Tipo de matricula', 'select', NULL, NULL, 0, 'a:7:{i:0;s:27:\"Ordinaria (sin compromisos)\";i:1;s:36:\"Con compromiso familiar e individual\";i:2;s:25:\"Con compromiso Académico\";i:3;s:27:\"Con compromiso Convivencial\";i:4;s:40:\"Con compromiso Académico y convivencial\";i:5;s:15:\"En observación\";i:6;s:24:\"En observación especial\";}', 0, 1, 29, 1, 3),
        (7, 'Fecha de nacimiento del o la estudiante ', 'Fecha de nacimiento del o la estudiante ', 'input', 'date', '01/01/2000', 0, NULL, 0, 1, 5, 1, 1),
        (8, 'Género del o la estudiante', 'Género del o la estudiante', 'select', NULL, NULL, 0, 'a:3:{i:0;s:91:\"Femenina (Persona que se identifica con los atributos sociales y culturales de las mujeres)\";i:1;s:92:\"Masculino (Persona que se identifica con los atributos sociales y culturales de los hombres)\";i:2;s:81:\"OSIGD (personas diversas con orientación sexual e identidad de género diversas)\";}', 0, 1, 10, 1, 2),
        (10, 'Edad del o la estudiante', 'Edad del o la estudiante', 'select', NULL, NULL, 0, 'a:16:{i:0;s:7:\"4 años\";i:1;s:7:\"5 años\";i:2;s:7:\"6 años\";i:3;s:7:\"7 años\";i:4;s:7:\"8 años\";i:5;s:7:\"9 años\";i:6;s:8:\"10 años\";i:7;s:8:\"11 años\";i:8;s:8:\"12 años\";i:9;s:8:\"13 años\";i:10;s:8:\"14 años\";i:11;s:8:\"15 años\";i:12;s:8:\"16 años\";i:13;s:8:\"17 años\";i:14;s:8:\"18 años\";i:15;s:8:\"19 años\";}', 1, 1, 6, 1, 1),
        (11, '¿Cuál es el tipo de Sangre \"RH\" del o la estudiante?', '¿Cuál es el tipo de Sangre \"RH\" del o la estudiante?', 'select', NULL, NULL, 0, 'a:9:{i:0;s:2:\"A+\";i:1;s:2:\"A-\";i:2;s:2:\"B+\";i:3;s:2:\"B-\";i:4;s:3:\"AB+\";i:5;s:3:\"AB-\";i:6;s:2:\"O+\";i:7;s:2:\"O-\";i:8;s:9:\"Pendiente\";}', 0, 1, 7, 1, 1),
        (12, '¿Cuál es la estatura del estudiante en centímetros?', 'Estatura (cm)', 'input', 'number', NULL, 0, NULL, 0, 1, 8, 1, 1),
        (13, '¿Cuál es el peso del estudiante en kilogramos?', 'Peso (kg)', 'input', 'number', NULL, 0, NULL, 0, 1, 9, 1, 1),
        (14, '¿El o la estudiante tiene alguna de las siguientes barreras o discapacidades? (diagnosticada por un especialista)', '¿El o la estudiante tiene alguna de las siguientes barreras o discapacidades? (diagnosticada por un especialista)', 'checkbox', NULL, NULL, 1, 'a:11:{i:0;s:6:\"Visual\";i:1;s:8:\"Auditiva\";i:2;s:6:\"Motriz\";i:3;s:11:\"Intelectual\";i:4;s:30:\"Trastorno del espectro autista\";i:5;s:66:\"Trastorno de Déficit de Atención con o sin Hiperactividad \'TDAH\'\";i:6;s:33:\"Trastorno del control de impulsos\";i:7;s:34:\"Trastorno de habilidades escolares\";i:8;s:9:\"Múltiple\";i:9;s:9:\"Sistemica\";i:10;s:7:\"Ninguna\";}', 1, 1, 38, 1, 4),
        (15, 'Si el estudiante presenta alguna barrera o discapacidad, por favor indique si requiere tomar algún medicamento.', 'Toma medicamentos', 'select', NULL, NULL, 0, 'a:3:{i:0;s:2:\"si\";i:1;s:2:\"no\";i:2;s:9:\"no aplica\";}', 0, 1, 37, 0, 4),
        (16, 'Si el estudiante toma algún medicamento, por favor indique cual, si no toma medicamento no responda esta pregunta.', 'Medicamentos', 'input', 'text', NULL, 0, NULL, 0, 0, 39, 0, 4),
        (17, '¿El o la estudiante asiste o asistió a algún proceso con médico especialista?\n', 'Asistió con especialista', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 40, 1, 4),
        (18, 'si el o la estudiante ha asistido a proceso con especialista, por favor indique cual', 'Tipo de especialista', 'checkbox', NULL, NULL, 0, 'a:9:{i:0;s:11:\"Psicología\";i:1;s:12:\"Psiquiatría\";i:2;s:11:\"Neurología\";i:3;s:9:\"Endocrino\";i:4;s:11:\"Cardiólogo\";i:5;s:14:\"Fonoaudiólogo\";i:6;s:10:\"Pediatría\";i:7;s:19:\"Terapia Ocupacional\";i:8;s:9:\"no aplica\";}', 1, 1, 41, 0, 4),
        (19, '¿El o la estudiante sufre de alguna otra enfermedad?\r\n', 'Sufre algúna enfermedad', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 42, 1, 4),
        (20, 'si el o la estudiante sufre de algún otra enfermedad por favor indíquenos cual', 'Enfermedad que sufre', 'input', 'text', NULL, 0, NULL, 0, 0, 43, 0, 4),
        (21, '¿El o la estudiante tiene algún impedimento o limitación dada por un especialista para la no realización de educación física?', 'Tiene impedimento o limitación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 44, 1, 4),
        (22, '¿Cuál es la limitación que el o la estudiante tiene que impida realizar esfuerzo físico o practicar un deporte? (si no tiene ninguna limitación, no responda esta pregunta)', 'Impedimento o limitación', 'input', 'text', NULL, 0, NULL, 0, 0, 45, 0, 4),
        (24, '¿Cuál de los siguientes síntomas el o la estudiante presenta con frecuencia?', 'Sintomas frecuentes', 'checkbox', NULL, NULL, 1, 'a:13:{i:0;s:19:\"Mal humor constante\";i:1;s:9:\"Rebeldía\";i:2;s:6:\"Llanto\";i:3;s:40:\"Cambios constantes en el estado de animo\";i:4;s:81:\"Uso excesivo de la tecnología (celular, computador, tablet, play, nintendo, etc)\";i:5;s:8:\"Tristeza\";i:6;s:46:\"Disminución o aumento en la toma de alimentos\";i:7;s:65:\"Hiperactividad (no se queda quieto por periodos largos de tiempo)\";i:8;s:33:\"Insomnio o dificultad para dormir\";i:9;s:31:\"Aislamiento social por voluntad\";i:10;s:13:\"Desobediencia\";i:11;s:32:\"Desorden constante con sus cosas\";i:12;s:7:\"Ninguno\";}', 0, 1, 46, 0, 4),
        (25, '¿Cuántos hermanos(as) tiene el estudiante?', 'Número de hermanos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:7:\"ninguno\";i:1;s:3:\"uno\";i:2;s:3:\"dos\";i:3;s:4:\"tres\";i:4;s:6:\"cuatro\";i:5;s:5:\"cinco\";i:6;s:13:\"más de cinco\";}\n', 0, 1, 47, 1, 5),
        (26, 'Si el o la estudiante tiene hermanos estudiando en la Institución Educativa, por favor indique ¿Cuál es su nombre completo? (Si son varios, por favor sepárelos con una coma cada nombre)', 'Hermanos en la institución', 'input', 'text', NULL, 0, NULL, 0, 0, 48, 0, 5),
        (27, '¿Cuál es la Eps del o la estudiante?', 'EPS ó IPS', 'select', NULL, NULL, 0, 'a:11:{i:0;s:4:\"Sura\";i:1;s:12:\"La nueva EPS\";i:2;s:7:\"Medimas\";i:3;s:6:\"Sisben\";i:4;s:8:\"Cosmitet\";i:5;s:11:\"Salud Total\";i:6;s:9:\"Cafesalud\";i:7;s:7:\"Sanitas\";i:8;s:9:\"Famisanar\";i:9;s:9:\"Saludvida\";i:10;s:4:\"Otra\";}', 0, 1, 33, 1, 4),
        (28, '¿El o la estudiante pertenece a Renta Ciudadana el anterior Familias en\nAcción?', 'Renta ciudadana', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 23, 1, 2),
        (29, '¿Cúal es la estrategia con la cual El o la estudiante es beneficiario(a) del Programa de Alimentación escolar  \"PAE\"?', 'Estrategía PAE', 'select', NULL, NULL, 0, 'a:4:{i:0;s:15:\"Industrializado\";i:1;s:36:\"Cps (complemento preparado en sitio)\";i:2;s:33:\"Aps (almuerzo preparado en sitio)\";i:3;s:21:\"no esta focalizado(a)\";}', 0, 0, 24, 1, 2),
        (30, 'El o la estudiante vive en Zona:', 'Ubicación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:21:\"Rural (zona de campo)\";i:1;s:23:\"Urbana (zona de ciudad)\";}', 0, 1, 16, 1, 2),
        (31, '¿Cuál es el Estrato socioeconómico (verificar con recibos públicos) del o la estudiante?', 'Estrato', 'select', NULL, NULL, 0, 'a:6:{i:0;s:13:\"1 (Bajo-bajo)\";i:1;s:8:\"2 (Bajo)\";i:2;s:14:\"3 (Medio-bajo)\";i:3;s:9:\"4 (Medio)\";i:4;s:14:\"5 (Medio-Alto)\";i:5;s:8:\"6 (Alto)\";}', 0, 1, 17, 1, 2),
        (32, '¿Cuál de los siguientes servicios, el o la estudiante tiene en su casa?\r\n', 'Servicios', 'checkbox', NULL, NULL, 0, 'a:6:{i:0;s:4:\"Agua\";i:1;s:7:\"Energia\";i:2;s:8:\"Internet\";i:3;s:16:\"Gas domiciliario\";i:4;s:9:\"Teléfono\";i:5;s:23:\"Recolección de basuras\";}', 0, 1, 18, 1, 2),
        (33, '¿Cuál de los siguientes equipos tecnológicos, el o la estudiante tiene en su casa?', 'Equipo tecnológico', 'checkbox', NULL, NULL, 0, 'a:4:{i:0;s:10:\"Computador\";i:1;s:6:\"Tablet\";i:2;s:34:\"Celular smartphone de uso personal\";i:3;s:34:\"Celular smartphone de uso Familiar\";}', 1, 1, 19, 1, 2),
        (34, '¿Cuál es la posibilidad de conectividad que el o la estudiante tiene?\r\n', 'Conectividad', 'select', NULL, NULL, 0, 'a:4:{i:0;s:30:\"Internet como servicio mensual\";i:1;s:13:\"plan de datos\";i:2;s:8:\"recargas\";i:3;s:46:\"no cuenta con esta posibilidad de conectividad\";}', 0, 1, 22, 1, 2),
        (35, '¿Cuál es la dirección de la casa del o la estudiante?\r\n', 'Dirección', 'input', 'text', NULL, 0, NULL, 0, 1, 15, 0, 2),
        (36, '¿Cuál es el número telefónico del estudiante?', 'Teléfono', 'input', 'number', NULL, 0, NULL, 0, 1, 14, 0, 2),
        (37, '¿Cuál es el nombre completo del acudiente del o la estudiante?', 'Acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 51, 0, 6),
        (39, '¿Cuál es el nombre completo del padre del o la estudiante?', 'Nombre del padre', 'input', 'text', NULL, 0, NULL, 0, 1, 54, 0, 6),
        (40, '¿Cuál es la ocupación del padre?', 'Ocupación del padre', 'input', 'text', NULL, 0, NULL, 0, 1, 57, 0, 6),
        (41, '¿Cuál es el nombre completo de la madre del o la estudiante?', 'Nombre de la madre', 'input', 'text', NULL, 0, NULL, 0, 1, 59, 0, 6),
        (42, '¿Cuál es la ocupación de la madre?', 'Ocupación de la madre', 'input', 'text', NULL, 0, NULL, 0, 1, 61, 0, 2),
        (43, 'En caso de emergencia, y si no es posible comunicarse con el o la acudiente del o la estudiante, ¿a quién se puede contactar? (Escriba el nombre completo y el número telefónico separados por una coma)', 'Contacto de emergencia', 'input', 'text', NULL, 0, NULL, 0, 1, 63, 0, 6),
        (45, '¿El o la estudiante pertenece a alguno de los siguientes grupos?', 'Grupos', 'select', NULL, NULL, 0, 'a:5:{i:0;s:10:\"Juan XXIII\";i:1;s:6:\"Pronic\";i:2;s:4:\"ICBF\";i:3;s:7:\"Abrazar\";i:4;s:38:\"no pertenece a ninguno de estos grupos\";}', 0, 1, 25, 1, 2),
        (46, '¿El o la estudiante pertenece a alguno de los grupos poblacionales?', 'Grupos poblacionales', 'checkbox', NULL, NULL, 1, 'a:8:{i:0;s:10:\"Desplazado\";i:1;s:21:\"Víctima de violencia\";i:2;s:9:\"Indígena\";i:3;s:16:\"Afrodescendiente\";i:4;s:6:\"Raizal\";i:5;s:6:\"Gitano\";i:6;s:4:\"OSIG\";i:7;s:7:\"Ninguno\";}', 1, 1, 11, 1, 2),
        (47, '¿Cuántos años escolares ha perdido el o la estudiante?', 'Años perdidos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:7:\"Ninguno\";i:1;s:3:\"Uno\";i:2;s:3:\"Dos\";i:3;s:4:\"Tres\";i:4;s:6:\"Cuatro\";i:5;s:5:\"Cinco\";i:6;s:13:\"Más de cinco\";}', 0, 1, 30, 1, 3),
        (48, '¿El o la estudiante repite el año anterior?', 'Es repitente', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 31, 0, 3),
        (50, '¿Cuántos años el o la estudiante ha estado desescolarizado(a)? (No ha	\nestudiado) \n', 'Años sin estudiar', 'select', NULL, NULL, 0, 'a:6:{i:0;s:16:\"menos de un año\";i:1;s:7:\"un año\";i:2;s:9:\"dos años\";i:3;s:10:\"tres años\";i:4;s:18:\"Más de tres años\";i:5;s:31:\"no ha estado desescolarizado(a)\";}', 0, 1, 32, 0, 3),
        (52, 'Si el estudiante no se desplaza solo hasta su casa, por favor indique quienes serían las personas autorizadas para recogerlo(a)', 'Personas autorizadas', 'input', 'text', NULL, 0, NULL, 0, 0, 51, 0, 5),
        (53, '¿Cuál es la tipología de la familia de o la estudiante?', 'Tipología de la familia', 'select', NULL, NULL, 0, 'a:8:{i:0;s:52:\"Familia Unipersonal: El o la estudiante vive solo(a)\";i:1;s:72:\"Compuestas: Miembros de la familia y otras personas que no son parientes\";i:2;s:99:\"Recompuesta: Jefe de hogar con pareja (padrastro – madrastra) hijos de cada uno e hijos en común\";i:3;s:27:\"Nuclear: Los padres e hijos\";i:4;s:44:\"Monoparental: Uno solo de los padres e hijos\";i:5;s:55:\"Extensa: La nuclear o monoparental con otros familiares\";i:6;s:67:\"Homoparental: Pareja del mismo sexo, con hijos propios o adoptados.\";i:7;s:24:\"Familia Sustituta (ICBF)\";}', 0, 1, 64, 1, 6),
        (55, '¿Desea proporcionar información adicional sobre el estudiante?', 'Información adicional del estudiante', 'textarea', NULL, NULL, 0, NULL, 0, 0, 67, 0, 6),
        (56, 'Que tema le gustaría recibir en las escuelas de padres', 'Que tema le gustaría recibir en las escuelas de padres', 'input', 'text', NULL, 0, NULL, 0, 0, 65, 0, 6),
        (57, 'Como acudiente del estudiante, ¿cómo podría aportar a la comunidad educativa?', 'Como acudiente del estudiante, ¿cómo podría aportar a la comunidad educativa?', 'checkbox', NULL, NULL, 1, 'a:10:{i:0;s:29:\"Con arte manual y decoración\";i:1;s:52:\"Con conocimientos que aporten a la escuela de padres\";i:2;s:16:\"Con arte musical\";i:3;s:30:\"Con arte por medio de la danza\";i:4;s:23:\"Con asesoría en tareas\";i:5;s:20:\"Con apoyo en deporte\";i:6;s:18:\"Con arte culinario\";i:7;s:41:\"Con obras de teatro para actos culturales\";i:8;s:47:\"Con donaciones de uniformes o útiles escolares\";i:9;s:4:\"otro\";}', 1, 1, 66, 0, 6),
        (58, 'Como padre de familia de que otra forma puede aportar a la comunidad educativa?', 'Como padre de familia de que otra forma puede aportar a la comunidad educativa?', 'input', 'text', NULL, 0, NULL, 0, 0, 57, 0, 5),
        (59, 'Nombres y apellidos del estudiante', 'Nombre del estudiante', 'input', 'text', NULL, 0, NULL, 0, 1, 1, 1, 1),
        (60, 'Si pertenece a la población desplazada, por favor, indique el lugar donde ocurrió el desplazamiento', 'lugar donde ocurrió el desplazamiento', 'input', 'text', NULL, 0, NULL, 0, 0, 12, 0, 2),
        (61, 'Si el equipo tecnológico con el que cuenta no se encuentra entre la lista especifique cual es', 'Otros equipos tecnológicos', 'input', 'text', NULL, 0, NULL, 0, 0, 20, 0, 2),
        (62, '¿Qué habilidades deportivas y artísticas posee el o la estudiante? (Si son varias, por favor separe con una coma)', 'Habilidades deportivas', 'input', 'text', NULL, 0, NULL, 0, 1, 26, 0, 2),
        (63, '¿El estudiante tiene alguna medida de protección o pertenece al sistema de responsabilidad penal adolescente?', 'Medida de protección', 'select', NULL, NULL, 0, 'a:2:{i:0;s:2:\"Si\";i:1;s:2:\"No\";}', 0, 1, 27, 0, 2),
        (64, 'Si la EPS del estudiante no se encuentra en la lista entonces escriba el nombre', '', 'input', 'text', NULL, 0, NULL, 0, 0, 34, 0, 4),
        (65, 'Si el estudiante usa algún elemento que no está en la lista especifique cual', '', 'input', 'text', NULL, 0, NULL, 0, 0, 36, 0, 4),
        (66, '¿Cuál es el grado de los hermanos del o la estudiante que estudian en la institución educativa? (Si son varios, por favor sepárelos con una coma teniendo en cuenta el orden de los nombres, en la pregunta anterior)', '', 'input', 'text', NULL, 0, NULL, 0, 0, 49, 0, 5),
        (67, '¿Cuál es el parentesco del acudiente del o la estudiante? ', 'Parentezco del acudiente', 'select', NULL, NULL, 0, 'a:11:{i:0;s:5:\"Madre\";i:1;s:5:\"Padre\";i:2;s:6:\"Abuela\";i:3;s:4:\"Tía\";i:4;s:4:\"Tío\";i:5;s:7:\"Hermano\";i:6;s:7:\"Hermana\";i:7;s:15:\"Madre sustituta\";i:8;s:15:\"Padre sustituto\";i:9;s:8:\"Prima(o)\";i:10;s:4:\"Otro\";}', 0, 1, 50, 0, 6),
        (68, '¿Cuál es el número telefónico del acudiente del o la estudiante?', 'Teléfono del acudiente', 'input', 'number', NULL, 0, NULL, 0, 1, 52, 0, 6),
        (69, '¿Cuál es la ocupación del acudiente del o la estudiante? ', 'Ocupación acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 53, 0, 6),
        (70, '¿Cuál es el número teléfono del padre del o la estudiante?', 'Teléfono del padre', 'input', 'number', NULL, 0, NULL, 0, 0, 55, 0, 6),
        (71, '¿Cuál es el teléfono telefónico de la madre del o la estudiante?', '', 'input', 'number', NULL, 0, NULL, 0, 0, 60, 0, 6),
        (72, 'Existen antecedentes familiares que puedan afectar al estudiante', '', 'textarea', 'text', NULL, 0, NULL, 0, 0, 62, 0, 6),
        (73, 'Si el tipo de documento no se encuentra en la lista por favor escribalo aqui', 'Tipo de documento otro', 'input', 'text', NULL, 0, NULL, 0, 0, 3, 0, 1);

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
                                  `description` longtext COLLATE utf8_spanish2_ci NOT NULL,
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

ALTER TABLE `core_participantes_pruebas` CHANGE `municipio` `municipio` INT(11) NULL;

ALTER TABLE `estudiante` ADD `email_acudiente` VARCHAR(100) NOT NULL AFTER `email`;

ALTER TABLE `recuperaciones_estudiantes` ADD `observaciones` LONGTEXT NULL AFTER `id_estudiante`;

--
-- Estructura de tabla para la tabla `repositorio_actividades`
--

CREATE TABLE `repositorio_actividades` (
                                           `id_repositorio_actividad` int(11) NOT NULL,
                                           `id_actividad` int(11) NOT NULL,
                                           `titulo` text COLLATE utf8_spanish2_ci NOT NULL,
                                           `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                           `archivo` varchar(250) COLLATE utf8_spanish2_ci NULL,
                                           `nombre_archivo` varchar(250) COLLATE utf8_spanish2_ci NULL,
                                           `materia` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
                                           `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `repositorio_actividades`
--
ALTER TABLE `repositorio_actividades`
    ADD PRIMARY KEY (`id_repositorio_actividad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `repositorio_actividades`
--
ALTER TABLE `repositorio_actividades`
    MODIFY `id_repositorio_actividad` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `preguntas_prueba`
    ADD COLUMN `tipo_pregunta` ENUM('multiple', 'abierta') NOT NULL DEFAULT 'multiple' AFTER `estado`;

--
-- Estructura de tabla para la tabla `respuestas_realizar_prueba_abiertas`
--

CREATE TABLE `respuestas_realizar_prueba_abiertas` (
                                                       `id_respuesta_abierta` int(11) NOT NULL,
                                                       `id_realizar_prueba` int(11) NOT NULL,
                                                       `id_pregunta` int(11) NOT NULL,
                                                       `respuesta` longtext NOT NULL,
                                                       `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `respuestas_realizar_prueba_abiertas`
--
ALTER TABLE `respuestas_realizar_prueba_abiertas`
    ADD PRIMARY KEY (`id_respuesta_abierta`),
    ADD KEY `id_pregunta` (`id_pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuestas_realizar_prueba_abiertas`
--
ALTER TABLE `respuestas_realizar_prueba_abiertas`
    MODIFY `id_respuesta_abierta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuestas_realizar_prueba_abiertas`
--
ALTER TABLE `respuestas_realizar_prueba_abiertas`
    ADD CONSTRAINT `respuestas_realizar_prueba_abiertas_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas_prueba` (`id_pregunta_prueba`) ON DELETE CASCADE;
COMMIT;

ALTER TABLE `respuestas_realizar_prueba_abiertas` ADD `es_correcta` TINYINT NULL DEFAULT '0' AFTER `respuesta`;

ALTER TABLE `preguntas_prueba` ADD `indicio_respuesta` TEXT NULL AFTER `tipo_pregunta`;

ALTER TABLE `preguntas_prueba` CHANGE `dificultad` `dificultad` VARCHAR(250) NOT NULL;

ALTER TABLE `realizar_prueba` CHANGE `institucion` `institucion` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `estudiante` ADD `nee` TINYINT NOT NULL DEFAULT '0' AFTER `grado`;

--
-- Estructura de tabla para la tabla `piar`
--

CREATE TABLE `piar` (
                        `id_piar` int(11) NOT NULL,
                        `id_estudiante` int(11) NOT NULL,
                        `id_docente_apoyo` int(11) DEFAULT NULL,
                        `id_docente_aula` int(11) DEFAULT NULL,
                        `fecha_elaboracion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `entorno_personal` longtext COLLATE utf8_spanish2_ci NOT NULL,
                        `descripcion_general` longtext COLLATE utf8_spanish2_ci,
                        `descripcion_que_hace` longtext COLLATE utf8_spanish2_ci,
                        `lugar_nacimiento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                        `departamento` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `municipio` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `es_centro_proteccion` tinyint(1) NOT NULL,
                        `centro_proteccion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `es_victima_conflicto_armado` tinyint(1) NOT NULL,
                        `registro_victima_conflicto_armado` tinyint(1) DEFAULT NULL,
                        `afiliacion_sistema_salud` tinyint(1) NOT NULL,
                        `tipo_afiliacion_sistema_salud` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `lugar_atencion_emergencia` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                        `es_atendido_sector_salud` tinyint(1) NOT NULL,
                        `es_atendido_frecuencia` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `frecuencia_terapias` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                        `recibe_tratamiento_enfermedad_particular` tinyint(1) NOT NULL,
                        `recibe_tratamiento_enfermedad_particular_cual` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `nivel_educativo_madre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `nivel_educativo_padre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `nombre_cuidador` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `parentesco_cuidador` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
                        `nivel_educativo_cuidador` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
                        `telefono_cuidador` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
                        `correo_electronico_cuidador` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
                        `lugar_que_ocupa_hermanos` int(11) DEFAULT '1',
                        `quienes_apoyan_crianza` text COLLATE utf8_spanish2_ci,
                        `esta_bajo_proteccion` tinyint(1) NOT NULL,
                        `recibe_subsidio_entidad` tinyint(1) NOT NULL,
                        `recibe_subsidio_entidad_cual` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `es_vinculado_otra_institucion` tinyint(1) NOT NULL,
                        `es_vinculado_otra_institucion_cual` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `ultimo_grado_cursado` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `ultimo_grado_cursado_aprobo` tinyint(1) NOT NULL,
                        `ultimo_grado_cursado_observaciones` text COLLATE utf8_spanish2_ci,
                        `recibe_informe_pedagogico` tinyint(1) NOT NULL,
                        `recibe_informe_pedagogico_institucion` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
                        `asiste_programas_complementarios` tinyint(1) NOT NULL,
                        `asiste_programas_complementarios_cuales` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                        `medio_de_transporte` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
                        `distancia_institucion_hogar` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
                        `acciones_familia` longtext COLLATE utf8_spanish2_ci,
                        `estrategias_familia` longtext COLLATE utf8_spanish2_ci,
                        `acciones_docentes` longtext COLLATE utf8_spanish2_ci,
                        `estrategias_docentes` longtext COLLATE utf8_spanish2_ci,
                        `acciones_directivos` longtext COLLATE utf8_spanish2_ci,
                        `estrategias_directivos` longtext COLLATE utf8_spanish2_ci,
                        `acciones_administrativos` longtext COLLATE utf8_spanish2_ci,
                        `estrategias_administrativos` longtext COLLATE utf8_spanish2_ci,
                        `acciones_companeros` longtext COLLATE utf8_spanish2_ci,
                        `estrategias_companeros` longtext COLLATE utf8_spanish2_ci,
                        `compromisos_especificos` longtext COLLATE utf8_spanish2_ci,
                        `comentarios` longtext COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `piar`
--
ALTER TABLE `piar`
    ADD PRIMARY KEY (`id_piar`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `piar`
--
ALTER TABLE `piar`
    MODIFY `id_piar` int(11) NOT NULL AUTO_INCREMENT;

--
-- Estructura de tabla para la tabla `piar_item`
--

CREATE TABLE `piar_item` (
                             `id_piar_item` int(11) NOT NULL,
                             `id_piar` int(11) NOT NULL,
                             `id_docente` int(11) NOT NULL,
                             `id_materia` int(11) DEFAULT NULL,
                             `otro_materia` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
                             `objetivos` longtext COLLATE utf8_spanish2_ci NOT NULL,
                             `barreras` longtext COLLATE utf8_spanish2_ci NOT NULL,
                             `ajustes_razonables` longtext COLLATE utf8_spanish2_ci NOT NULL,
                             `evaluacion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                             `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `piar_item`
--
ALTER TABLE `piar_item`
    ADD PRIMARY KEY (`id_piar_item`),
    ADD KEY `piar_piar_item` (`id_piar`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `piar_item`
--
ALTER TABLE `piar_item`
    MODIFY `id_piar_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `piar_item`
--
ALTER TABLE `piar_item`
    ADD CONSTRAINT `piar_piar_item` FOREIGN KEY (`id_piar`) REFERENCES `piar` (`id_piar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Estructura de tabla para la tabla `piar_actividades`
--

CREATE TABLE `piar_actividades` (
                                    `id_piar_actividad` int(11) NOT NULL,
                                    `id_piar` int(11) NOT NULL,
                                    `actividad` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `frecuencia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `piar_actividades`
--
ALTER TABLE `piar_actividades`
    ADD PRIMARY KEY (`id_piar_actividad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `piar_actividades`
--
ALTER TABLE `piar_actividades`
    MODIFY `id_piar_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- Estructura de tabla para la tabla `piar_items_anual`
--

CREATE TABLE `piar_items_anual` (
                                    `id_piar_item_anual` int(11) NOT NULL,
                                    `id_piar` int(11) NOT NULL,
                                    `id_materia` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                                    `id_docente` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                                    `destrezas_obtenidas` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `dificultades` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `comportamiento` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `desempeno` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                    `recomendaciones` longtext COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `piar_items_anual`
--
ALTER TABLE `piar_items_anual`
    ADD PRIMARY KEY (`id_piar_item_anual`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `piar_items_anual`
--
ALTER TABLE `piar_items_anual`
    MODIFY `id_piar_item_anual` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `tipo_prueba` (`id_tipo_prueba`, `descripcion`) VALUES ('4', 'Simulacro');

ALTER TABLE `pruebas` ADD `temas` TEXT NULL AFTER `materias`;

ALTER TABLE `configuracion` ADD `logo_min_educacion` VARCHAR(250) NULL AFTER `departamental`, ADD `logo_gobierno_colombia` VARCHAR(250) NULL AFTER `logo_min_educacion`;

ALTER TABLE `configuracion` ADD `logo_gobernacion_quindio` VARCHAR(200) NOT NULL AFTER `logo_gobierno_colombia`;

--
-- Estructura de tabla para la tabla `caracterizacion_estudiantes_preguntas_categorias`
--

CREATE TABLE `caracterizacion_estudiantes_preguntas_categorias` (
                                                                    `id_caracterizacion_estudiantes_preguntas_categorias` int(11) NOT NULL,
                                                                    `nombre_categoria` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
                                                                    `orden` int(11) NOT NULL,
                                                                    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caracterizacion_estudiantes_preguntas_categorias`
--

INSERT INTO `caracterizacion_estudiantes_preguntas_categorias` (`id_caracterizacion_estudiantes_preguntas_categorias`, `nombre_categoria`, `orden`, `created_at`) VALUES
                                                                                                                                                                      (1, 'Datos personales del estudiante', 1, '2025-04-22 11:04:41'),
                                                                                                                                                                      (2, 'Datos importantes del estudiante', 2, '2025-04-22 11:04:41'),
                                                                                                                                                                      (3, 'Información académica del estudiante', 3, '2025-04-22 11:05:12'),
                                                                                                                                                                      (4, 'Información médica del estudiante', 4, '2025-04-22 11:05:12'),
                                                                                                                                                                      (5, 'Información familiar del estudiante', 5, '2025-04-22 11:05:24'),
                                                                                                                                                                      (6, 'Datos de padres de familia y/o acudiente', 6, '2025-04-29 16:06:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracterizacion_estudiantes_preguntas_categorias`
--
ALTER TABLE `caracterizacion_estudiantes_preguntas_categorias`
    ADD PRIMARY KEY (`id_caracterizacion_estudiantes_preguntas_categorias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracterizacion_estudiantes_preguntas_categorias`
--
ALTER TABLE `caracterizacion_estudiantes_preguntas_categorias`
    MODIFY `id_caracterizacion_estudiantes_preguntas_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;