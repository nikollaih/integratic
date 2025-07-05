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
                                                                                                                                                                                                                                    (1, 'Tipo de documento del o la estudiante.', 'Tipo de documento del o la estudiante.', 'select', NULL, NULL, 0, 'a:8:{i:0;s:20:\"Registro Civil \'RC\'.\";i:1;s:42:\"Número de Identificación Personal \'NIP\'.\";i:2;s:50:\"Número Único de Identificación Personal \'NUIP\'.\";i:3;s:26:\"Tarjeta de Identidad \'TI\'.\";i:4;s:28:\"Cédula de Ciudadanía \'CC\'.\";i:5;s:38:\"Permiso Especial de Permanencia \'PEP\'.\";i:6;s:39:\"Permiso por Protección Temporal \'PPT\'.\";i:7;s:5:\"Otro.\";}', 1, 1, 2, 1, 1),
                                                                                                                                                                                                                                    (2, 'Número del documento de identidad del o la estudiante .', 'Número del documento de identidad del o la estudiante ', 'input', 'number', '12345678', 0, NULL, 0, 1, 4, 0, 1),
                                                                                                                                                                                                                                    (3, '¿El o la estudiante usa alguno de los siguientes elementos? Selecciona todas las opciones que considere, puede marcar más de una respuesta.', '¿El o la estudiante usa alguno de los siguientes elementos?\n', 'checkbox', NULL, NULL, 1, 'a:3:{i:0;s:6:\"Gafas.\";i:1;s:19:\"Lentes de contacto.\";i:2;s:21:\"Audífonos medicados.\";}', 1, 1, 36, 1, 4),
                                                                                                                                                                                                                                    (4, '¿El o la estudiante se desplaza solo(a) hasta su casa?', 'Va solo a casa', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 51, 0, 5),
                                                                                                                                                                                                                                    (5, '¿Cuál es el grado escolar del o la estudiante?', 'Grado del o la estudiante', 'select', NULL, NULL, 0, 'a:12:{i:0;s:12:\"Transición.\";i:1;s:8:\"Primero.\";i:2;s:8:\"Segundo.\";i:3;s:8:\"Tercero.\";i:4;s:7:\"Cuarto.\";i:5;s:7:\"Quinto.\";i:6;s:6:\"Sexto.\";i:7;s:9:\"Séptimo.\";i:8;s:7:\"Octavo.\";i:9;s:7:\"Noveno.\";i:10;s:7:\"Decimo.\";i:11;s:10:\"Undécimo.\";}', 0, 1, 28, 1, 3),
                                                                                                                                                                                                                                    (6, '¿Cuál es el tipo de matricula del o la estudiante?', 'Tipo de matricula', 'select', NULL, NULL, 0, 'a:7:{i:0;s:10:\"Ordinaria.\";i:1;s:37:\"Con compromiso familiar e individual.\";i:2;s:26:\"Con compromiso académico.\";i:3;s:28:\"Con compromiso convivencial.\";i:4;s:41:\"Con compromiso académico y convivencial.\";i:5;s:16:\"En observación.\";i:6;s:25:\"En observación especial.\";}', 0, 1, 29, 1, 3),
                                                                                                                                                                                                                                    (7, 'Fecha de nacimiento del o la estudiante.', 'Fecha de nacimiento del o la estudiante ', 'input', 'date', '01/01/2000', 0, NULL, 0, 1, 5, 1, 1),
                                                                                                                                                                                                                                    (8, '¿Cuál es el género del o la estudiante?', 'Género del o la estudiante', 'select', NULL, NULL, 0, 'a:3:{i:0;s:93:\"Femenino. (Persona que se identifica con los atributos sociales y culturales de las mujeres).\";i:1;s:94:\"Masculino. (Persona que se identifica con los atributos sociales y culturales de los hombres).\";i:2;s:74:\"OSIGD. (Personas con orientación sexual e identidad de género diversas).\";}', 0, 1, 10, 1, 1),
                                                                                                                                                                                                                                    (10, 'Edad del o la estudiante.', 'Edad del o la estudiante', 'select', NULL, NULL, 0, 'a:16:{i:0;s:8:\"4 años.\";i:1;s:8:\"5 años.\";i:2;s:8:\"6 años.\";i:3;s:8:\"7 años.\";i:4;s:8:\"8 años.\";i:5;s:8:\"9 años.\";i:6;s:9:\"10 años.\";i:7;s:9:\"11 años.\";i:8;s:9:\"12 años.\";i:9;s:9:\"13 años.\";i:10;s:9:\"14 años.\";i:11;s:9:\"15 años.\";i:12;s:9:\"16 años.\";i:13;s:9:\"17 años.\";i:14;s:9:\"18 años.\";i:15;s:9:\"19 años.\";}', 1, 1, 6, 1, 1),
                                                                                                                                                                                                                                    (11, '¿Cuál es el tipo de Sangre \"RH\" del o la estudiante?', '¿Cuál es el tipo de Sangre \"RH\" del o la estudiante?', 'select', NULL, NULL, 0, 'a:9:{i:0;s:3:\"A+.\";i:1;s:3:\"A-.\";i:2;s:3:\"B+.\";i:3;s:3:\"B-.\";i:4;s:4:\"AB+.\";i:5;s:4:\"AB-.\";i:6;s:3:\"O+.\";i:7;s:3:\"O-.\";i:8;s:10:\"Pendiente.\";}', 0, 1, 7, 1, 1),
                                                                                                                                                                                                                                    (12, '¿Cuál es la estatura del o la estudiante en centímetros?', 'Estatura (cm)', 'input', 'number', NULL, 0, NULL, 0, 1, 8, 1, 1),
                                                                                                                                                                                                                                    (13, '¿Cuál es el peso del o la estudiante en kilogramos?', 'Peso (kg)', 'input', 'number', NULL, 0, NULL, 0, 1, 9, 1, 1),
                                                                                                                                                                                                                                    (14, '¿El o la estudiante tiene alguna de las siguientes barreras o discapacidades? (diagnosticada por un especialista). Selecciona todas las opciones que considere, puede marcar más de una respuesta.', '¿El o la estudiante tiene alguna de las siguientes barreras o discapacidades? (diagnosticada por un especialista)', 'checkbox', NULL, NULL, 1, 'a:11:{i:0;s:7:\"Visual.\";i:1;s:9:\"Auditiva.\";i:2;s:7:\"Motriz.\";i:3;s:12:\"Intelectual.\";i:4;s:31:\"Trastorno del espectro autista.\";i:5;s:67:\"Trastorno de Déficit de Atención con o sin Hiperactividad \'TDAH\'.\";i:6;s:34:\"Trastorno del control de impulsos.\";i:7;s:35:\"Trastorno de habilidades escolares.\";i:8;s:10:\"Múltiple.\";i:9;s:11:\"Sistémica.\";i:10;s:8:\"Ninguna.\";}', 1, 1, 39, 1, 4),
                                                                                                                                                                                                                                    (15, 'Si el o la estudiante presenta alguna barrera o discapacidad, por favor indique si requiere tomar algún medicamento.', 'Toma medicamentos', 'select', NULL, NULL, 0, 'a:3:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";i:2;s:10:\"No aplica.\";}', 0, 1, 38, 0, 4),
                                                                                                                                                                                                                                    (16, 'Si el o la estudiante toma algún medicamento, por favor indique cuál, de lo contrario escriba \"No aplica\".', 'Medicamentos', 'input', 'text', NULL, 0, NULL, 0, 1, 40, 0, 4),
                                                                                                                                                                                                                                    (17, '¿El o la estudiante asiste o asistió a algún proceso con médico especialista?', 'Asistió con especialista', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 41, 1, 4),
                                                                                                                                                                                                                                    (18, 'Si el o la estudiante ha asistido a proceso con especialista, por favor indique cual, de lo contrario seleccione la opción \"No aplica\". Selecciona todas las opciones que considere, puede marcar más de una respuesta.', 'Tipo de especialista', 'checkbox', NULL, NULL, 1, 'a:9:{i:0;s:12:\"Psicología.\";i:1;s:13:\"Psiquiatría.\";i:2;s:12:\"Neurología.\";i:3;s:10:\"Endocrino.\";i:4;s:12:\"Cardiólogo.\";i:5;s:15:\"Fonoaudiólogo.\";i:6;s:11:\"Pediatría.\";i:7;s:20:\"Terapia Ocupacional.\";i:8;s:10:\"No aplica.\";}', 1, 1, 42, 0, 4),
                                                                                                                                                                                                                                    (19, '¿El o la estudiante sufre de alguna otra enfermedad?', 'Sufre algúna enfermedad', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 43, 1, 4),
                                                                                                                                                                                                                                    (20, 'Si el o la estudiante sufre de algún otra enfermedad por favor indíquenos cuál, de lo contrario escriba \"No aplica\".', 'Enfermedad que sufre', 'input', 'text', NULL, 0, NULL, 0, 1, 44, 0, 4),
                                                                                                                                                                                                                                    (21, '¿El o la estudiante tiene algún impedimento o limitación dada por un especialista que impida realizar esfuerzo físico o practicar un deporte? ', 'Tiene impedimento o limitación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 45, 1, 4),
                                                                                                                                                                                                                                    (22, '¿Cuál es la limitación que el o la estudiante tiene que impida realizar esfuerzo físico o practicar un deporte?, (Si no tiene ninguna escriba \"No aplica\").', 'Impedimento o limitación', 'input', 'text', NULL, 0, NULL, 0, 1, 46, 0, 4),
                                                                                                                                                                                                                                    (24, '¿Cuál de los siguientes síntomas el o la estudiante presenta con frecuencia? Selecciona todas las opciones que considere, puede marcar más de una respuesta.', 'Sintomas frecuentes', 'checkbox', NULL, NULL, 1, 'a:17:{i:0;s:20:\"Mal humor constante.\";i:1;s:10:\"Rebeldía.\";i:2;s:7:\"Llanto.\";i:3;s:41:\"Cambios constantes en el estado de animo.\";i:4;s:82:\"Uso excesivo de la tecnología (celular, computador, tablet, play, nintendo, etc).\";i:5;s:9:\"Tristeza.\";i:6;s:47:\"Disminución o aumento en la toma de alimentos.\";i:7;s:66:\"Hiperactividad (no se queda quieto por periodos largos de tiempo).\";i:8;s:34:\"Insomnio o dificultad para dormir.\";i:9;s:32:\"Aislamiento social por voluntad.\";i:10;s:14:\"Desobediencia.\";i:11;s:33:\"Desorden constante con sus cosas.\";i:12;s:47:\"Falta de disciplina en la vida y en el colegio.\";i:13;s:35:\"Consumo de sustancias psicoactivas.\";i:14;s:44:\"Se corta o hiere cuando se encuentra triste.\";i:15;s:8:\"Ninguno.\";i:16;s:5:\"Otro.\";}', 0, 1, 47, 0, 4),
                                                                                                                                                                                                                                    (25, '¿Cuántos hermanos(as) tiene el o la estudiante?', 'Número de hermanos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:8:\"Uno (1).\";i:1;s:8:\"Dos (2).\";i:2;s:9:\"Tres (3).\";i:3;s:11:\"Cuatro (4).\";i:4;s:10:\"Cinco (5).\";i:5;s:19:\"Más de cinco (5+).\";i:6;s:8:\"Ninguno.\";}', 0, 1, 48, 1, 5),
                                                                                                                                                                                                                                    (26, 'Si el o la estudiante tiene hermanos estudiando en la Institución Educativa, por favor indique ¿Cuál es su nombre completo? (Si son varios, por favor sepárelos con una coma cada nombre), de lo contrario escriba \"No aplica\".', 'Hermanos en la institución', 'input', 'text', NULL, 0, NULL, 0, 1, 49, 0, 5),
                                                                                                                                                                                                                                    (27, '¿Cuál es la Eps del o la estudiante?', 'EPS ó IPS', 'select', NULL, NULL, 0, 'a:11:{i:0;s:5:\"Sura.\";i:1;s:13:\"La nueva EPS.\";i:2;s:8:\"Medimas.\";i:3;s:7:\"Sisben.\";i:4;s:9:\"Cosmitet.\";i:5;s:12:\"Salud Total.\";i:6;s:10:\"Cafesalud.\";i:7;s:8:\"Sanitas.\";i:8;s:10:\"Famisanar.\";i:9;s:10:\"Saludvida.\";i:10;s:5:\"Otra.\";}', 0, 1, 34, 1, 4),
                                                                                                                                                                                                                                    (28, '¿El o la estudiante pertenece a “Renta Ciudadana” anteriormente “Familias en Acción”?', 'Renta ciudadana', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 23, 1, 1),
                                                                                                                                                                                                                                    (29, '¿El o la estudiante es beneficiario(a) del Programa de Alimentación Escolar \"PAE\"? ', 'Estrategía PAE', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 24, 1, 1),
                                                                                                                                                                                                                                    (30, 'El o la estudiante vive en Zona:', 'Ubicación', 'select', NULL, NULL, 0, 'a:2:{i:0;s:22:\"Rural (zona de campo).\";i:1;s:24:\"Urbana (zona de ciudad).\";}', 0, 1, 16, 1, 1),
                                                                                                                                                                                                                                    (31, '¿Cuál es el estrato socioeconómico (verificar con recibos públicos) del o la estudiante?', 'Estrato', 'select', NULL, NULL, 0, 'a:6:{i:0;s:14:\"1 (Bajo-bajo).\";i:1;s:9:\"2 (Bajo).\";i:2;s:15:\"3 (Medio-bajo).\";i:3;s:10:\"4 (Medio).\";i:4;s:15:\"5 (Medio-Alto).\";i:5;s:9:\"6 (Alto).\";}', 0, 1, 17, 1, 1),
                                                                                                                                                                                                                                    (32, '¿Cuál de los siguientes servicios, el o la estudiante tiene en su casa? Selecciona todas las opciones que considere, puede marcar más de una respuesta.', 'Servicios', 'checkbox', NULL, NULL, 1, 'a:6:{i:0;s:5:\"Agua.\";i:1;s:9:\"Energía.\";i:2;s:9:\"Internet.\";i:3;s:17:\"Gas domiciliario.\";i:4;s:10:\"Teléfono.\";i:5;s:24:\"Recolección de basuras.\";}', 0, 1, 18, 1, 1),
                                                                                                                                                                                                                                    (33, '¿Cuál de los siguientes equipos tecnológicos, el o la estudiante tiene en su casa? Selecciona todas las opciones que considere, puede marcar más de una respuesta.', 'Equipo tecnológico', 'checkbox', NULL, NULL, 1, 'a:4:{i:0;s:11:\"Computador.\";i:1;s:7:\"Tablet.\";i:2;s:35:\"Celular smartphone de uso personal.\";i:3;s:35:\"Celular smartphone de uso familiar.\";}', 1, 1, 19, 1, 1),
                                                                                                                                                                                                                                    (34, '¿Cuál es la posibilidad de conectividad que el o la estudiante tiene?', 'Conectividad', 'select', NULL, NULL, 0, 'a:4:{i:0;s:31:\"Internet como servicio mensual.\";i:1;s:14:\"Plan de datos.\";i:2;s:9:\"Recargas.\";i:3;s:47:\"No cuenta con esta posibilidad de conectividad.\";}', 0, 1, 22, 1, 1),
                                                                                                                                                                                                                                    (35, '¿Cuál es la dirección de la casa del o la estudiante?', 'Dirección', 'input', 'text', NULL, 0, NULL, 0, 1, 15, 0, 1),
                                                                                                                                                                                                                                    (36, '¿Cuál es el número telefónico del o la estudiante?', 'Teléfono', 'input', 'number', NULL, 0, NULL, 0, 1, 14, 0, 1),
                                                                                                                                                                                                                                    (37, '¿Cuál es el nombre completo del acudiente del o la estudiante?', 'Acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 54, 0, 6),
                                                                                                                                                                                                                                    (39, '¿Cuál es el nombre completo del padre del o la estudiante?', 'Nombre del padre', 'input', 'text', NULL, 0, NULL, 0, 0, 56, 0, 6),
                                                                                                                                                                                                                                    (40, '¿Cuál es la ocupación del padre?', 'Ocupación del padre', 'input', 'text', NULL, 0, NULL, 0, 0, 59, 0, 6),
                                                                                                                                                                                                                                    (41, '¿Cuál es el nombre completo de la madre del o la estudiante?', 'Nombre de la madre', 'input', 'text', NULL, 0, NULL, 0, 0, 59, 0, 6),
                                                                                                                                                                                                                                    (42, '¿Cuál es la ocupación de la madre?', 'Ocupación de la madre', 'input', 'text', NULL, 0, NULL, 0, 0, 62, 0, 6),
                                                                                                                                                                                                                                    (43, 'En caso de emergencia, y si no es posible comunicarse con el o la acudiente del o la estudiante, ¿a quién se puede contactar? (Escriba el nombre completo y el número telefónico separados por una coma).', 'Contacto de emergencia', 'input', 'text', NULL, 0, NULL, 0, 1, 70, 0, 6),
                                                                                                                                                                                                                                    (45, '¿El o la estudiante pertenece a alguno de los siguientes grupos?', 'Grupos', 'select', NULL, NULL, 0, 'a:6:{i:0;s:11:\"Juan XXIII.\";i:1;s:7:\"Pronic.\";i:2;s:5:\"ICBF.\";i:3;s:8:\"Abrazar.\";i:4;s:11:\"Cultivarte.\";i:5;s:39:\"No pertenece a ninguno de estos grupos.\";}', 0, 1, 25, 1, 1),
                                                                                                                                                                                                                                    (46, '¿El o la estudiante pertenece a alguno de los grupos poblacionales? Selecciona todas las opciones que considere, puede marcar más de una respuesta.', 'Grupos poblacionales', 'checkbox', NULL, NULL, 1, 'a:9:{i:0;s:11:\"Desplazado.\";i:1;s:22:\"Víctima de violencia.\";i:2;s:10:\"Indígena.\";i:3;s:17:\"Afrodescendiente.\";i:4;s:7:\"Raizal.\";i:5;s:7:\"Gitano.\";i:6;s:20:\"OSIGD (Antes LGBTI).\";i:7;s:11:\"Venezolano.\";i:8;s:8:\"Ninguno.\";}', 1, 1, 11, 1, 1),
                                                                                                                                                                                                                                    (47, '¿Cuántos años escolares ha perdido el o la estudiante?', 'Años perdidos', 'select', NULL, NULL, 0, 'a:7:{i:0;s:8:\"Ninguno.\";i:1;s:8:\"Uno (1).\";i:2;s:8:\"Dos (2).\";i:3;s:9:\"Tres (3).\";i:4;s:11:\"Cuatro (4).\";i:5;s:10:\"Cinco (5).\";i:6;s:19:\"Más de cinco (5+).\";}', 0, 1, 30, 1, 3),
                                                                                                                                                                                                                                    (48, '¿El o la estudiante repite el año anterior?', 'Es repitente', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 32, 0, 3),
                                                                                                                                                                                                                                    (50, '¿Cuántos años el o la estudiante ha estado desescolarizado(a)? (No ha	\nestudiado) \n.', 'Años sin estudiar', 'select', NULL, NULL, 0, 'a:6:{i:0;s:21:\"Menos de un (1) año.\";i:1;s:12:\"Un (1) año.\";i:2;s:14:\"Dos (2) años.\";i:3;s:15:\"Tres (3) años.\";i:4;s:24:\"Más de tres (3+) años.\";i:5;s:32:\"No ha estado desescolarizado(a).\";}', 0, 1, 33, 0, 3),
                                                                                                                                                                                                                                    (52, 'Si el o la estudiante no se desplaza solo hasta su casa, por favor indique quienes serían las personas autorizadas para recogerlo(a), de lo contrario escriba \"No aplica\".', 'Personas autorizadas', 'input', 'text', NULL, 0, NULL, 0, 1, 53, 0, 5),
                                                                                                                                                                                                                                    (53, '¿Cuál es la tipología de la familia del o la estudiante?', 'Tipología de la familia', 'select', NULL, NULL, 0, 'a:9:{i:0;s:53:\"Familia Unipersonal: el o la estudiante vive solo(a).\";i:1;s:73:\"Compuestas: miembros de la familia y otras personas que no son parientes.\";i:2;s:100:\"Recompuesta: jefe de hogar con pareja (padrastro – madrastra) hijos de cada uno e hijos en común.\";i:3;s:28:\"Nuclear: los padres e hijos.\";i:4;s:45:\"Monoparental: uno solo de los padres e hijos.\";i:5;s:56:\"Extensa: la nuclear o monoparental con otros familiares.\";i:6;s:67:\"Homoparental: pareja del mismo sexo, con hijos propios o adoptados.\";i:7;s:25:\"Familia Sustituta (ICBF).\";i:8;s:5:\"Otro.\";}', 0, 1, 75, 1, 6),
                                                                                                                                                                                                                                    (55, '¿Desea proporcionar información adicional sobre el o la estudiante?', 'Información adicional del estudiante', 'textarea', NULL, NULL, 0, NULL, 0, 0, 80, 0, 6),
                                                                                                                                                                                                                                    (56, '¿Qué tema le gustaría recibir en las escuelas de padres?', 'Que tema le gustaría recibir en las escuelas de padres', 'input', 'text', NULL, 0, NULL, 0, 1, 77, 0, 6),
                                                                                                                                                                                                                                    (57, 'Como acudiente del o la estudiante, ¿cómo podría aportar a la comunidad educativa? Puede marcar más de una respuesta.', 'Como acudiente del o la estudiante, ¿cómo podría aportar a la comunidad educativa?', 'checkbox', NULL, NULL, 1, 'a:10:{i:0;s:30:\"Con arte manual y decoración.\";i:1;s:53:\"Con conocimientos que aporten a la escuela de padres.\";i:2;s:17:\"Con arte musical.\";i:3;s:31:\"Con arte por medio de la danza.\";i:4;s:24:\"Con asesoría en tareas.\";i:5;s:21:\"Con apoyo en deporte.\";i:6;s:19:\"Con arte culinario.\";i:7;s:42:\"Con obras de teatro para actos culturales.\";i:8;s:48:\"Con donaciones de uniformes o útiles escolares.\";i:9;s:5:\"otro.\";}', 1, 1, 78, 0, 6),
                                                                                                                                                                                                                                    (58, 'Como padre de familia, ¿de qué otra forma puede aportar a la comunidad educativa?', 'Como padre de familia de que otra forma puede aportar a la comunidad educativa?', 'input', 'text', NULL, 0, NULL, 0, 1, 79, 0, 6),
                                                                                                                                                                                                                                    (59, 'Nombres y apellidos del estudiante.', 'Nombre del estudiante', 'input', 'text', NULL, 0, NULL, 0, 1, 1, 1, 1),
                                                                                                                                                                                                                                    (60, 'Si pertenece a la población desplazada, por favor, indique el lugar donde ocurrió el desplazamiento, de lo contrario escriba \"No aplica\".', 'lugar donde ocurrió el desplazamiento', 'input', 'text', NULL, 0, NULL, 0, 1, 12, 0, 1),
                                                                                                                                                                                                                                    (61, 'Si el equipo tecnológico con el que cuenta no se encuentra entre la lista especifique cual es, de lo contrario escriba \"No aplica\".', 'Otros equipos tecnológicos', 'input', 'text', NULL, 0, NULL, 0, 1, 20, 0, 1),
                                                                                                                                                                                                                                    (62, '¿Qué habilidades deportivas y artísticas posee el o la estudiante? (Si son varias, por favor separe con una coma).', 'Habilidades deportivas', 'input', 'text', NULL, 0, NULL, 0, 1, 26, 0, 1),
                                                                                                                                                                                                                                    (63, '¿El o la estudiante tiene alguna medida de protección o pertenece al sistema de responsabilidad penal adolescente?', 'Medida de protección', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 27, 0, 1),
                                                                                                                                                                                                                                    (64, 'Si la EPS del o la estudiante no se encuentra en la lista entonces escriba el nombre, de lo contrario escriba \"No aplica\".', '', 'input', 'text', NULL, 0, NULL, 0, 1, 35, 0, 4),
                                                                                                                                                                                                                                    (65, 'Si el o la estudiante usa algún elemento que no está en la lista especifique cuál, de lo contrario escriba \"No aplica\".', '', 'input', 'text', NULL, 0, NULL, 0, 1, 37, 0, 4),
                                                                                                                                                                                                                                    (66, '¿Cuál es el grado de los hermanos del o la estudiante que estudian en la institución educativa? (Si son varios, por favor sepárelos con una coma teniendo en cuenta el orden de los nombres, en la pregunta anterior).', '', 'input', 'text', NULL, 0, NULL, 0, 1, 50, 0, 5),
                                                                                                                                                                                                                                    (67, '¿Cuál es el parentesco del acudiente del o la estudiante?', 'Parentesco del acudiente', 'select', NULL, NULL, 0, 'a:11:{i:0;s:6:\"Madre.\";i:1;s:6:\"Padre.\";i:2;s:7:\"Abuela.\";i:3;s:5:\"Tía.\";i:4;s:5:\"Tío.\";i:5;s:8:\"Hermano.\";i:6;s:8:\"Hermana.\";i:7;s:16:\"Madre sustituta.\";i:8;s:16:\"Padre sustituto.\";i:9;s:9:\"Prima(o).\";i:10;s:5:\"Otro.\";}', 0, 1, 51, 0, 6),
                                                                                                                                                                                                                                    (68, '¿Cuál es el número telefónico del acudiente del o la estudiante?', 'Teléfono del acudiente', 'input', 'number', NULL, 0, NULL, 0, 1, 55, 0, 6),
                                                                                                                                                                                                                                    (69, '¿Cuál es la ocupación del acudiente del o la estudiante?', 'Ocupación acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 55, 0, 6),
                                                                                                                                                                                                                                    (70, '¿Cuál es el número teléfono del padre del o la estudiante?', 'Teléfono del padre', 'input', 'number', NULL, 0, NULL, 0, 0, 58, 0, 6),
                                                                                                                                                                                                                                    (71, '¿Cuál es el número telefónico de la madre del o la estudiante?', '', 'input', 'number', NULL, 0, NULL, 0, 0, 61, 0, 6),
                                                                                                                                                                                                                                    (72, 'Existen antecedentes familiares que puedan afectar al estudiante. Si la respuesta es sí, escriba cuáles antecedentes.', '', 'textarea', 'text', NULL, 0, NULL, 0, 1, 63, 0, 6),
                                                                                                                                                                                                                                    (73, 'Si el tipo de documento no se encuentra en la lista por favor escribalo aqui, de lo contrario escriba \"No aplica\".', 'Tipo de documento otro', 'input', 'text', NULL, 0, NULL, 0, 1, 3, 0, 1),
                                                                                                                                                                                                                                    (74, '¿El o la estudiante es nuevo en la Institución Educativa?', 'Nuevo(a) en la institución', 'select', NULL, NULL, 0, 'a:2:{i:0;s:3:\"Si.\";i:1;s:3:\"No.\";}', 0, 1, 31, 1, 3),
                                                                                                                                                                                                                                    (75, 'Si el parentesco del acudiente es otro, por favor escríbalo aquí, de lo contrario escriba \"No aplica\".', 'Parentesco del acudiente', 'input', 'text', NULL, 0, NULL, 0, 1, 52, 0, 6),
                                                                                                                                                                                                                                    (76, 'Número del documento de identidad del acudiente  del o la estudiante.', 'Número del documento de identidad del acudiente', 'input', 'number', NULL, 0, NULL, 0, 1, 53, 0, 6),
                                                                                                                                                                                                                                    (77, 'Número del documento de identidad del padre  del o la estudiante.', 'Número del documento de identidad del padre  del o la estudiante', 'input', 'number', NULL, 0, NULL, 0, 0, 57, 0, 6),
                                                                                                                                                                                                                                    (78, 'Número del documento de identidad de la madre  del o la estudiante.', 'Número del documento de identidad de la madre  del o la estudiante', 'input', 'text', NULL, 0, NULL, 0, 0, 60, 0, 6),
                                                                                                                                                                                                                                    (79, 'Si la tipología de la familia es otra, escríbala aquí, de lo contrario escriba \"No aplica\".', 'Tipología de la familia', 'input', 'text', NULL, 0, NULL, 0, 1, 76, 0, 6);

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
                                                                                                                                                                      (1, 'Datos generales del estudiante', 1, '2025-04-22 11:04:41'),
                                                                                                                                                                      (3, 'Información académica del estudiante', 2, '2025-04-22 11:05:12'),
                                                                                                                                                                      (4, 'Información médica del estudiante', 3, '2025-04-22 11:05:12'),
                                                                                                                                                                      (5, 'Información familiar del estudiante', 4, '2025-04-22 11:05:24'),
                                                                                                                                                                      (6, 'Datos de los padres y/o acudiente', 5, '2025-04-29 16:06:53');

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

ALTER TABLE `piar_item` ADD `id_periodo` INT NOT NULL AFTER `id_materia`;

CREATE TABLE `tipo_componente_evidencia` (
                                             `id_tipo_componente` INT NOT NULL AUTO_INCREMENT,
                                             `nombre` VARCHAR(100) NOT NULL,
                                             `descripcion` LONGTEXT NOT NULL,
                                             `activo` TINYINT(1) NOT NULL DEFAULT 1,
                                             PRIMARY KEY (`id_tipo_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE `evidencia_componentes` (
                                         `id_componente` INT NOT NULL AUTO_INCREMENT,
                                         `id_evidencia_aprendizaje` INT NOT NULL,
                                         `id_tipo_componente` INT NOT NULL,
                                         `contenido` TEXT NOT NULL,
                                         `orden` TINYINT NOT NULL DEFAULT 1,
                                         PRIMARY KEY (`id_componente`),
                                         FOREIGN KEY (`id_evidencia_aprendizaje`) REFERENCES `evidencias_aprendizaje`(`id_evidencia_aprendizaje`) ON DELETE CASCADE,
                                         FOREIGN KEY (`id_tipo_componente`) REFERENCES `tipo_componente_evidencia`(`id_tipo_componente`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

ALTER TABLE `pruebas` ADD `porcentaje` DOUBLE NOT NULL AFTER `es_recuperacion`;

ALTER TABLE `tipo_componente_evidencia` ADD `orden` INT NOT NULL AFTER `activo`;


--
-- Estructura de tabla para la tabla `categorias_ajustes_razonables`
--

CREATE TABLE `categorias_ajustes_razonables` (
                                                 `id_categorias_ajustes_razonables` int(11) NOT NULL,
                                                 `nombre_categoria` text COLLATE utf8_spanish2_ci NOT NULL,
                                                 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias_ajustes_razonables`
--

INSERT INTO `categorias_ajustes_razonables` (`id_categorias_ajustes_razonables`, `nombre_categoria`, `created_at`) VALUES
                                                                                                                       (2, 'Apoyo a mediaciones discursivas en el acto pedagógico', '2025-06-04 15:28:34'),
                                                                                                                       (3, 'Apoyo a la situación de aprendizaje (Se relaciona con la didáctica con el fin de que el estudiante comprenda los saberes).', '2025-06-04 15:28:34'),
                                                                                                                       (4, 'Apoyo productos y tecnología (Cuando requieren de ayudas técnicas que favorecen el acceso a la cotidianidad escolar).', '2025-06-04 15:28:34'),
                                                                                                                       (5, 'Apoyo personas (Las personas que rodean al escolar son apoyo natural como guía o tutor y también profesionales como tiflólogo o monitor).', '2025-06-04 15:28:34'),
                                                                                                                       (6, 'Apoyo entorno físico-arquitectónico (Diseño o adaptación de espacios).', '2025-06-04 15:28:34'),
                                                                                                                       (7, 'Apoyo servicio y comunidad (Es la intervención terapéutica que requiere el estudiante y acompañamiento familiar).', '2025-06-04 15:28:34'),
                                                                                                                       (8, 'Apoyo entorno socioeducativo (Favorece la interacción social de los niños y el aprendizaje eliminando o reduciendo barreras actitudinales).', '2025-06-04 15:28:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_ajustes_razonables`
--
ALTER TABLE `categorias_ajustes_razonables`
    ADD PRIMARY KEY (`id_categorias_ajustes_razonables`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_ajustes_razonables`
--
ALTER TABLE `categorias_ajustes_razonables`
    MODIFY `id_categorias_ajustes_razonables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Estructura de tabla para la tabla `ajustes_razonables`
--

CREATE TABLE `ajustes_razonables` (
                                      `id_ajustes_razonables` int(11) NOT NULL,
                                      `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                                      `id_categoria` int(11) NOT NULL,
                                      `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes_razonables`
--
ALTER TABLE `ajustes_razonables`
    ADD PRIMARY KEY (`id_ajustes_razonables`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes_razonables`
--
ALTER TABLE `ajustes_razonables`
    MODIFY `id_ajustes_razonables` int(11) NOT NULL AUTO_INCREMENT;


--
-- Estructura de tabla para la tabla `ajustes_razonables`
--

CREATE TABLE `barreras` (
                            `id_barreras` int(11) NOT NULL,
                            `descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
                            `id_categoria` int(11) NOT NULL,
                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes_razonables`
--
ALTER TABLE `barreras`
    ADD PRIMARY KEY (`id_barreras`);

--
-- Estructura de tabla para la tabla `categorias_barreras`
--

CREATE TABLE `categorias_barreras` (
                                       `id_categoria_barrera` int(11) NOT NULL,
                                       `nombre_categoria` text COLLATE utf8_spanish2_ci NOT NULL,
                                       `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias_barreras`
--

INSERT INTO `categorias_barreras` (`id_categoria_barrera`, `nombre_categoria`, `created_at`) VALUES
     (1, 'Aprendizaje y aplicación del conocimiento', '2025-06-04 15:39:17'),
     (2, 'Tareas y demandas generales', '2025-06-04 15:39:17'),
     (3, 'Organizativas', '2025-06-04 15:39:17'),
     (4, 'Comunicación', '2025-06-04 15:39:17'),
     (5, 'Movilidad', '2025-06-04 15:39:17'),
     (6, 'Autocuidado', '2025-06-04 15:39:17'),
     (7, 'Actitudinales', '2025-06-04 15:39:17'),
     (8, 'Sociales', '2025-06-04 15:39:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_barreras`
--
ALTER TABLE `categorias_barreras`
    ADD PRIMARY KEY (`id_categoria_barrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_barreras`
--
ALTER TABLE `categorias_barreras`
    MODIFY `id_categoria_barrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `piar` ADD `diagnostico` VARCHAR(100) NOT NULL AFTER `comentarios`;

ALTER TABLE `barreras` CHANGE `id_barreras` `id_barreras` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tipo_componente_evidencia` ADD `cantidad_filas` INT NOT NULL DEFAULT '1' AFTER `orden`;

ALTER TABLE `tipo_componente_evidencia` ADD `titulos_filas` TEXT NOT NULL AFTER `cantidad_filas`;

ALTER TABLE `tipo_componente_evidencia` CHANGE `titulos_filas` `titulos_filas` TEXT CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL;

INSERT INTO `ajustes_razonables` (`id_ajustes_razonables`, `descripcion`, `id_categoria`, `created_at`) VALUES
                                                                                                            (2, 'Incorporar el apoyo de lenguaje alternativo o aumentativo, en caso que el niño/a lo requiera. (apoyar la comunicación con fotografías dibujos o imágenes de acciones, personas, lugares, objetos, familiares para el niño o niña). Para relacionarse con los demás.', 2, '2025-06-05 01:36:27'),
                                                                                                            (3, 'Crear permanentemente la oportunidad de interacciones comunicativas y verbales entre adulto-niño/a y niño/a-niño/a.', 2, '2025-06-05 01:36:50'),
                                                                                                            (4, 'Dar tiempo y organizar los espacios para el desarrollo de las habilidades de comunicación.', 2, '2025-06-05 01:37:10'),
                                                                                                            (5, 'Establecer momentos en las clases en que se realicen ayudas mutuas entre pares, buscando compañeros que apoyen al alumno y le ayuden con sus tareas.', 2, '2025-06-05 01:37:39'),
                                                                                                            (6, 'Hable a una velocidad moderada, con una intensidad normal y deteniéndose entre una idea y otra. No separe los mensajes en palabras o sílabas para evitar una distorsión del mensaje o confusión del mismo.', 2, '2025-06-05 01:38:02'),
                                                                                                            (7, 'Colóquese de frente o en un ángulo que se encuentre cerca del oído con menos pérdida auditiva del estudiante con baja audición.', 2, '2025-06-05 01:38:18'),
                                                                                                            (8, 'Utilice la expresión corporal, busque apoyo en el lenguaje con gestos que todos usamos de manera natural proporcionando ejemplos acompañados de acciones, como la dramatización.', 2, '2025-06-05 01:38:48'),
                                                                                                            (9, 'Cambiar el nivel y tono de voz durante la actividad.', 2, '2025-06-05 01:39:02'),
                                                                                                            (10, 'Tener un adulto de referencia al que acudir en caso de le haya ocurrido algo en el patio.', 2, '2025-06-05 01:39:16'),
                                                                                                            (11, 'Permitir también su propio espacio y tiempo. En esos momentos deambular, hablar solo, cantar sus canciones, ver libro sobre un tema de su interés o buscar insectos por el patio puede ser lo más relajante que le podemos ofrecer y lo que más necesiten.', 2, '2025-06-05 01:39:38'),
                                                                                                            (12, 'Cautelar el riesgo de respuestas mecánicas, intencionado las preguntas abiertas.', 2, '2025-06-05 01:39:51'),
                                                                                                            (13, 'Favorecer la realización de actividades controladas de forma individual por el profesor, teniendo previstos momentos para brindarle las ayudas en relación con los aspectos concretos en que tienen dificultades.', 3, '2025-06-05 01:40:16'),
                                                                                                            (14, 'Ofrecer diversas experiencias de abordaje multisensorial o significación para los niños y niñas.', 3, '2025-06-05 01:40:32'),
                                                                                                            (15, 'Tomar en consideración los intereses de los niños y niñas en la realización de las distintas actividades.', 3, '2025-06-05 01:40:45'),
                                                                                                            (16, 'Establecer la asociación de los conocimientos previos del niño/a con los nuevos aprendizajes. Secuenciar las tareas en pequeños pasos.', 3, '2025-06-05 01:40:59'),
                                                                                                            (17, 'Dar los apoyos necesarios, evitando la sobreprotección o exceso de ayuda.', 3, '2025-06-05 01:41:17'),
                                                                                                            (18, 'Ofrecer actividades para trabajar en conjunto con pares.', 3, '2025-06-05 01:41:33'),
                                                                                                            (19, 'Ajustar las tareas a los tiempos de ejecución de cada niño/a, tomando en consideración las ayudas técnicas que requiera.', 3, '2025-06-05 01:41:49'),
                                                                                                            (20, 'Partir siempre desde lo más significativo para el niño o niña.', 3, '2025-06-05 01:42:03'),
                                                                                                            (21, 'Ofrecer experiencias psicomotoras, considerando las posibilidades motoras del niño o niña (adecuar las actividades).', 3, '2025-06-05 01:42:16'),
                                                                                                            (22, 'Atreverse a cambiar al niño/a de posición o sacarlo de la silla de ruedas para que experimente otras sensaciones.', 3, '2025-06-05 01:42:30'),
                                                                                                            (23, 'Estimular la audición, con diferentes recursos.', 3, '2025-06-05 01:42:44'),
                                                                                                            (24, 'Relacionar las palabras con acciones. ', 3, '2025-06-05 01:43:01'),
                                                                                                            (25, 'Crear momentos de comunicación individual con el niño o niña.', 3, '2025-06-05 01:43:14'),
                                                                                                            (26, 'Representar momentos de trabajo o acciones utilizando láminas, de modo que el estudiante pueda comprenderlas, hacerse entender a través de ellas y ejecutarlas en forma autónoma. ', 3, '2025-06-05 01:43:33'),
                                                                                                            (27, 'Ofrecer variedad de materiales, invitando al descubrimiento de posibilidades de uso, función de los objetos, entre otras, utilizando las diferentes vías perceptivas.', 3, '2025-06-05 01:43:45'),
                                                                                                            (28, 'Asociar características de los objetos a nivel concreto, gráfico y verbal.', 3, '2025-06-05 01:43:58'),
                                                                                                            (29, 'Considerar los tiempos reales de atención y concentración de cada niño y niña. Seleccionar los materiales considerando cantidad, calidad y variedad.', 3, '2025-06-05 01:44:10'),
                                                                                                            (30, 'Dar la oportunidad de vivenciar por contraste (movimiento y reposo, acción y descanso) para potenciar el autoconocimiento.', 3, '2025-06-05 01:44:25'),
                                                                                                            (31, 'Organizar el espacio y los tiempos de interacción social sólo para niñas y sólo para niños. (desarrollo de identidad y sentido de pertenencia).', 3, '2025-06-05 01:44:39'),
                                                                                                            (32, 'Realizar un seguimiento individual del alumno, analizando su progreso educativo, reconociendo sus avances, revisando con frecuencia su trabajo, etc.', 3, '2025-06-05 01:44:52'),
                                                                                                            (33, 'Incluir actividades de refuerzo en la programación, buscando nuevas estrategias para llegar a los mismos aprendizajes.', 3, '2025-06-05 01:45:07'),
                                                                                                            (34, 'Planificar actividades variadas para el mismo objetivo, utilizando materiales o soportes de trabajo distintos.', 3, '2025-06-05 01:45:24'),
                                                                                                            (35, 'Diseñar dos o más recorridos de aprendizaje para cada objetivo, que ofrezcan a cada alumno oportunidades para aprender contenidos que no dominan.', 3, '2025-06-05 01:45:43'),
                                                                                                            (36, 'Reordenar y reagrupar a los alumnos de un aula en función de su nivel en diversas áreas o asignaturas.', 3, '2025-06-05 01:45:53'),
                                                                                                            (37, 'Llevar a cabo actividades con distintos tipos de agrupamientos, individuales, en gran grupo y siempre que se pueda en pequeño grupo.', 3, '2025-06-05 01:46:07'),
                                                                                                            (38, 'Realizar una distribución flexible de espacios y tiempos. Por ejemplo, distribuyendo la clase en zonas de actividad o talleres y los horarios en función del ritmo de trabajo de los alumnos.', 3, '2025-06-05 01:46:18'),
                                                                                                            (39, 'Limitar las exposiciones orales en clase, complementándolas siempre que se pueda con otras formas de trabajo.', 3, '2025-06-05 01:46:30'),
                                                                                                            (40, 'Escriba los exámenes, las tareas y las instrucciones en la pizarra, porque de esa manera el estudiante estará enterado de todas las asignaciones y no será sorprendido por un examen.', 3, '2025-06-05 01:46:43'),
                                                                                                            (41, 'Al trabajar con palabras nuevas escríbelas en la pizarra y de un sinónimo o algún ejemplo sobre esa palabra aislada del texto, eso ayudará al estudiante a comprenderla mejor.', 3, '2025-06-05 01:47:06'),
                                                                                                            (42, 'Proporcionarle el día anterior un resumen de los contenidos que van a tratar el día siguiente.', 3, '2025-06-05 01:47:19'),
                                                                                                            (43, 'Elaborar un cronograma de actividades en forma permanente para que la/el estudiante pueda anticipar las rutinas y actividades que se van a realizar. Le permiten flexibilizar su pensamiento, le da sentido a las acciones que va a desarrollarse y adecuarse a ellas con más facilidad. El cronograma debe ser una guía graficada de las acciones que se realizan el aula.', 3, '2025-06-05 01:47:35'),
                                                                                                            (44, 'El ambiente de trabajo debe ser lo más estructurado posible, predecible y fijo evitando los ambientes poco predecibles.', 3, '2025-06-05 01:47:48'),
                                                                                                            (45, 'Es de gran ayuda emplear claves visuales para que el alumno pueda reconocer, avisos, objetos, actividades y secuencias.', 3, '2025-06-05 01:48:01'),
                                                                                                            (46, 'Ser flexibles en el manejo del tiempo pues si se les presiona en el cumplimiento de las tareas, la ansiedad y la inseguridad se acentúan y no se logra los resultados deseados, es preferible respetar su ritmo de trabajo.\r\nLa realización de actividades con estrategias lúdicas, son las más adecuadas para desarrollar la afectividad, la socialización y el desarrollo motriz. Así mismo son momentos en los que pueden manejar mejor sus temores, sus impulsos, sus sentimientos y sus frustraciones permitiéndoles participar verbalmente aunque sea en forma mínima.', 3, '2025-06-05 01:48:16'),
                                                                                                            (47, 'Evitar el exceso de estímulos distractores, como ubicarlo frente a ventanas o pasadizos.', 3, '2025-06-05 01:49:41'),
                                                                                                            (48, 'Reducir la carga de escritura cuando hay problemas de grafomoticidad.', 3, '2025-06-05 01:49:55'),
                                                                                                            (49, 'Priorizar y señalar las tareas que son imprescindibles. Así todo el esfuerzo se concentrará en lo que es importante.', 3, '2025-06-05 01:50:07'),
                                                                                                            (50, 'Utilizar mapas conceptuales como organizadores previos de la información. Es importante que este mapa se presente al inicio del tema o del bloque de contenidos.', 3, '2025-06-05 01:50:20'),
                                                                                                            (51, 'Utilizar su tema de interés en la medida de lo posible. En función del contenido que estemos trabajando y del tema de interés del alumno o alumna, esta estrategia se vuelve más o menos posible. La idea es convertir su tema en nuestro aliado.', 3, '2025-06-05 01:50:44'),
                                                                                                            (52, 'Realizarle llamadas de atención cuando veamos que se ha perdido en el desarrollo de la clase. Puede ser llamarle por su nombre o con pequeños gestos más personales acordados previamente con él (un toque en la mesa, una palabra...) Así evitamos también que los compañeros nos oigan llamarle la atención continuamente.', 3, '2025-06-05 01:51:03'),
                                                                                                            (53, 'Poner en práctica otras estrategias de evaluación, modificar los instrumentos, adecuar los tiempos, graduar las exigencias, graduar el contenido e incluso considerar la posibilidad de otorgar apoyo al niño durante la realización de la evaluación.', 3, '2025-06-05 01:52:10'),
                                                                                                            (54, 'Definir los criterios de promoción del estudiante teniendo en cuenta sus habilidades y dificultades, acompañamiento familiar y externo (terapias si lo requiere), flexibilización curricular, ajustes razonables.', 3, '2025-06-05 01:52:24'),
                                                                                                            (55, 'En la evaluación dar Una orden por cada enunciado. Asegurarnos de que las órdenes e instrucciones se las planteamos de una en una. Así evitaremos que se le pase alguna por alto.', 3, '2025-06-05 01:52:39'),
                                                                                                            (56, 'Utilizar preguntas cortas o tipo test. Minimizamos así los problemas de grafía y de expresión escrita.', 3, '2025-06-05 01:52:52'),
                                                                                                            (57, 'Otra opción es hacer pruebas orales o a ordenador. Evitamos las dificultades grafomotrices.', 3, '2025-06-05 01:53:07'),
                                                                                                            (58, 'Dar más tiempo. A veces tan solo necesitan un poco más de tiempo para realizar sus procesos tranquilamente.', 3, '2025-06-05 01:53:20'),
                                                                                                            (59, 'Revisar el examen cuando lo entreguen. Si hay preguntas en blanco le podemos preguntar la razón para asegurarnos que no la ha respondido porque no la sabe y no porque la ha pasado por alto.', 3, '2025-06-05 01:53:33'),
                                                                                                            (60, 'Al inicio del examen podemos acercarnos a preguntarle si tiene alguna duda y lo ha entendido todo. Podemos aprovechar para recordarles que si tienen alguna duda, pueden levantar la mano y preguntarnos.', 3, '2025-06-05 01:53:48'),
                                                                                                            (61, 'Cuidar el diseño del examen y las preguntas. Debemos asegurarnos que cada pregunta evalúa de la forma más limpia posible lo que queremos y no otras habilidades secundarias.', 3, '2025-06-05 01:54:10'),
                                                                                                            (62, 'Revisar el examen posteriormente con el alumno para analizar los errores. No basta con entregarle el examen. Necesita que le ayudemos a buscar las alternativas adecuadas para la próxima ocasión.', 3, '2025-06-05 01:54:25'),
                                                                                                            (63, 'Enseñar explícitamente al alumno o alumna cómo se hace adecuadamente una pregunta de desarrollo y entrenarle en ello. Aunque eliminemos lo máximo posible este tipo de preguntas de nuestros exámenes, en algún momento de su trayectoria escolar se la encontrará.\r\nPor lo tanto es muy positivo que al mismo tiempo que le facilitamos el examen, le vayamos preparando para hacer otros más complicados. Para enseñarle a hacer preguntas de desarrollo lo más eficaz será que le estructuremos el contenido de la respuesta con pequeños subapartados dentro de la misma. Esta estructura se la daremos como un guión que ir completando. La idea es que con el entrenamiento, el alumno o alumna sea capaz de ir generando autónomamente la estructura de la respuesta.\r\n', 3, '2025-06-05 01:54:47'),
                                                                                                            (64, 'Permitir que lleven una copia del ex amen a casa para poder trabajar los fallos. Es importante que puedan trabajarlo con sus padres, que a efectos prácticos son quienes les ayudan a prepararlos. Para los padres también es necesario conocer dónde están los fallos de sus hijos para poder trabajarlos con ellos.', 3, '2025-06-05 01:55:09'),
                                                                                                            (65, 'Valorar la posibilidad de realizar los exámenes con el profesor de apoyo en un aula más tranquila y con la seguridad de tener una persona cercana para resolver las dudas. Aunque el profesor de apoyo vaya a hacer lo mismo que el profesor de la asignatura haría en el aula durante el examen, para el estudiante, el hecho de encontrarse en un ambiente más estructurado y controlado le aporta mayor seguridad y tranquilidad. A veces es sorprendente el efecto que puede provocar esta simple medida en el rendimiento durante un examen.\r\nAnticipar y explicitar cuales son los criterios para aprobar o suspender. Nos referimos especialmente a la letra y presentación.\r\n', 3, '2025-06-05 01:55:44'),
                                                                                                            (66, 'Sentarlos lo más cerca posible de la pizarra y el profesor: así eliminamos todo un mundo de compañeros hablando y moviéndose entre ellos y la pizarra.', 3, '2025-06-05 01:56:05'),
                                                                                                            (67, 'Permitir el uso de ordenadores y nuevas tecnologías para la escritura y entrega de trabajos. No se trata de un privilegio con respecto a sus compañeros, sino de ofrecerle las mismas posibilidades de desarrollo y éxito que a los demás.', 3, '2025-06-05 01:56:21'),
                                                                                                            (68, 'Organizadores gráficos (carteles con instrucciones escritas o graficadas, objetos concretos, láminas, letreros, fotografías, etc.) para apoyar al estudiante a comprender mejor los mensajes y evitar confusiones.', 4, '2025-06-05 01:58:09'),
                                                                                                            (69, 'Pauta y punzón, sirven para escribir en el sistema Braille, Ambos instrumentos se utilizan en conjunto ya que son complementos uno del otro. (visual)', 4, '2025-06-05 01:58:24'),
                                                                                                            (70, 'Ábaco, regleta de coussinare, sirve para realizar operaciones matemáticas (suma, resta, multiplicación, división, etc).', 4, '2025-06-05 01:58:48'),
                                                                                                            (71, 'Rueda dentada para dibujo, sirve para hacer dibujos y figuras geométricas en relieve.', 4, '2025-06-05 01:59:02'),
                                                                                                            (72, 'Tactógrafo, sirve de soporte para realizar los dibujos en relieve.', 4, '2025-06-05 01:59:20'),
                                                                                                            (73, 'Estuche de dibujo: regla, compás, escuadra y cartabón, etc, adaptados.', 4, '2025-06-05 01:59:33'),
                                                                                                            (74, 'Caja de aritmética: Equipo de dibujo de líneas en relieve (Sewell) Papel especial denominado papel de \"caña\", de un grosor similar a la cartulina fina y que no corta en los bordes. Gráficos, mapas o representaciones de láminas, realizados de forma artesanal o mediante aparatos especiales que permiten reproducciones en relieve: Thermoform, horno Ricoh, etc.\r\nPrograma GB (Gráficos para impresoras braille), programa diseñado para realizar diseños gráficos en relieve: planos de ciudades y edificios; dibujo de un repertorio de funciones matemáticas; captura y recuperación de gráficos generados por Windows. Permite añadir información en braille.\r\n', 4, '2025-06-05 01:59:54'),
                                                                                                            (75, 'Otros materiales adaptados: material de laboratorio, balones sonoros, juegos de mesa (cartas, ajedrez, dominó, parchís, etc.)', 4, '2025-06-05 02:00:09'),
                                                                                                            (76, 'Libro Hablado (magnetófono de 4 pistas)', 4, '2025-06-05 02:00:24'),
                                                                                                            (77, 'Audio con sonidos reales de animales y ambientales.', 4, '2025-06-05 02:00:37'),
                                                                                                            (78, 'Calculadoras parlantes de diferentes tipos y tamaños; realizan desde operaciones elementales hasta científicas/ financieras / estadísticas.', 4, '2025-06-05 02:00:50'),
                                                                                                            (79, 'Relojes parlantes', 4, '2025-06-05 02:01:01'),
                                                                                                            (80, 'Lupas, se utilizan para agrandar la imagen.', 4, '2025-06-05 02:01:17'),
                                                                                                            (81, 'Telescopios, Se utiliza para ver objetos distantes.', 4, '2025-06-05 02:01:30'),
                                                                                                            (82, 'Plumones delgados para escribir (de preferencia negro), facilita la lectura ya que la punta es más gruesa y nítida que la del lapicero.', 4, '2025-06-05 02:01:46'),
                                                                                                            (83, 'Lámpara, controla la intensidad de luz.', 4, '2025-06-05 02:01:57'),
                                                                                                            (84, 'Libros con letras grandes, sirven de gran ayuda cuando el alumno aprende a leer, ya que posteriormente aprenderá y utilizará la lupa.', 4, '2025-06-05 02:02:14'),
                                                                                                            (85, 'Hojas rayadas, permiten que el niño no se fatigue tratando de encontrar el renglón.', 4, '2025-06-05 02:02:34'),
                                                                                                            (86, 'Visera, es importante ya que mucho de los alumnos tienen fotofobia a la luz.', 4, '2025-06-05 02:02:50'),
                                                                                                            (87, 'Reglas con números grandes y bien marcados.', 4, '2025-06-05 02:03:01'),
                                                                                                            (88, 'Grabadora, es importante ya que sirve para que el alumno pueda grabar las clases.', 4, '2025-06-05 02:03:15'),
                                                                                                            (89, 'Uso de las tics.', 4, '2025-06-05 02:03:28'),
                                                                                                            (90, 'Uso de tablets, computadores.', 4, '2025-06-05 02:03:45'),
                                                                                                            (91, 'Sistema FM.', 4, '2025-06-05 02:04:06'),
                                                                                                            (92, 'Lectores de pantalla.', 4, '2025-06-05 02:04:20'),
                                                                                                            (93, 'Amplificadores de voz e imagen.', 4, '2025-06-05 02:04:36'),
                                                                                                            (94, 'Cambio o ajustes en puesto de trabajo.', 4, '2025-06-05 02:04:50'),
                                                                                                            (95, 'Sillas, caminadores.', 4, '2025-06-05 02:05:03'),
                                                                                                            (96, 'Valorar la posibilidad de incluir la intervención coordinada y simultánea de profesionales con el mismo grupo-aula, para apoyar a este alumno o a, otros.', 5, '2025-06-05 02:08:44'),
                                                                                                            (97, 'Organizar grupos de refuerzo fuera del horario fijo, con alumnos con dificultades semejantes, teniendo un monitor (padre de familia, convenio practicantes (normalistas..)', 5, '2025-06-05 02:09:04'),
                                                                                                            (98, 'Organizar grupos de refuerzo fuera del horario fijo, con alumnos con dificultades semejantes, teniendo un monitor (padre de familia, convenio practicantes (normalistas..)', 5, '2025-06-05 02:09:27'),
                                                                                                            (99, 'Incluir un intérprete de la lengua de señas en el aula, en lo posible. (discapacidad auditiva).', 5, '2025-06-05 02:09:43'),
                                                                                                            (100, 'Emplear monitores (estudiantes de la misma aula, rotativos) como apoyo al estudiante.', 5, '2025-06-05 02:09:55'),
                                                                                                            (101, 'Acompañamiento de acudiente bajo unos acuerdos para tareas o momentos necesarios dentro del aula.', 5, '2025-06-05 02:10:09'),
                                                                                                            (102, 'Compañeros ayudantes. Podemos proponer a algún grupo de la clase que estén atentos a nuestro chico para que lo incluyan en su grupo y lo busquen cuando lo vean solo. Para estos fines es bueno fijarnos si hay algún grupo con el que nuestro chico o chica se muestre más afín o algún compañero que muestre facilidades en las habilidades sociales y de empatía.', 5, '2025-06-05 02:10:24'),
                                                                                                            (103, 'MONITOR O PERSONA DE APOYO EN EL PATIO o espacio de recreo.', 5, '2025-06-05 02:10:39'),
                                                                                                            (104, 'Privilegiar salas en el primer piso, donde permanezca el niño o niña, si el establecimiento no cuenta con rampa o ascensor.', 6, '2025-06-05 02:10:57'),
                                                                                                            (105, 'Modificar la altura de tableros, espejos, perchas, para que puedan estar al alcance y ser utilizados por todos los estudiantes incluidos los niños y niñas con discapacidad motora.', 6, '2025-06-05 02:11:11'),
                                                                                                            (106, 'Instalar tiradores de puertas y armarios para que puedan ser utilizados por niños y niñas que presentan dificultad en la manipulación.', 6, '2025-06-05 02:11:25'),
                                                                                                            (107, 'Adecuar el mobiliario escolar de manera que el niño o niña con discapacidad motora pueda utilizarlo y trabajar junto con sus pares. En el caso de niños y niñas con dificultad en la funcionalidad de las extremidades superiores (brazos y manos), se sugiere fijar el material a la mesa de trabajo, agrandar el formato de las actividades gráficas (dibujos), simplificar y crear material de apoyo, para facilitar la manipulación y la prensión de algunos instrumentos pedagógicos (lápices, pinceles, tijeras, plumones, etc.).\r\nPara el uso del baño es necesario hacer algunas adaptaciones que brinden independencia al niño o niña, como: poner barandas laterales en la taza de baño, en dónde se pueda afirmar, especialmente en las transferencias de la silla de ruedas a la taza del baño.', 6, '2025-06-05 02:11:42'),
                                                                                                            (108, 'Probar con diferentes adaptaciones en las prendas de vestir: reemplazar cierres o botones por velcro, utilizar botones grandes, usar ropa con elástico en vez de cierre.', 6, '2025-06-05 02:12:45'),
                                                                                                            (109, 'Ubicar lavamanos a diferentes alturas (uno más bajo) y que considere el acceso de la silla de ruedas, poner el espejo inclinado para que permita al niño y niña en silla de ruedas mirar su imagen.', 6, '2025-06-05 02:13:02'),
                                                                                                            (110, 'Contar con una grifería adecuada en el lavamanos para ser manipulada con facilidad por niños y niñas que usen prótesis de brazo (gancho), o que tengan disminuida la fuerza muscular.', 6, '2025-06-05 02:13:21'),
                                                                                                            (111, 'Establecer una estrecha relación de los profesionales que ofertan una respuesta educativa a estos niños con sus familias. Llevar a cabo las mismas pautas de educación en la casa y en la escuela, enseñando a los padres las maneras más adecuadas de actuación ante las acciones de su hijo.', 7, '2025-06-05 02:14:05'),
                                                                                                            (112, 'Orientar la necesidad de acompañamiento terapéutico y retroalimentación de los profesionales, Pedirle a los padres el envío de informe o pautas puntuales de recomendación a los docentes, periódicamente.', 7, '2025-06-05 02:14:25'),
                                                                                                            (113, 'La práctica habitual de registrar los avances permite mostrar a las familias lo que se va logrando con sus hijos, y mantener de esta forma vivo y motivado el proceso de colaboración con ellas, que es tan necesario en algunos casos.', 7, '2025-06-05 02:14:42'),
                                                                                                            (114, 'La vinculación a actividades extracurriculares (artístico, deportivo, manualidades, inventivas..,) de acuerdo a sus gustos y habilidades.', 7, '2025-06-05 02:14:57'),
                                                                                                            (115, 'Programación escuela de padres donde se desarrollen temáticas del acompañamiento de la familia en el aprendizaje.', 7, '2025-06-05 02:15:10'),
                                                                                                            (116, 'Dar conocimiento de redes públicas con sus servicios y sus rutas para el desarrollo integral del estudiante con NEE.', 7, '2025-06-05 02:15:22'),
                                                                                                            (117, 'Tutoría o acompañamiento en casa bajo normas y reglas acordadas previas, que refuercen el aprendizaje del estudiante.', 7, '2025-06-05 02:15:47'),
                                                                                                            (118, 'Favorecer el bienestar físico y mental de los niños y niñas (la alimentación, el uso de su ropa o uniforme, aseo personal...).', 8, '2025-06-05 02:16:22'),
                                                                                                            (119, 'Incentivar el autocuidado (es importante que el niño/a sepa que cuidados debe tener consigo mismo para prevenir futuros problemas).', 8, '2025-06-05 02:16:35'),
                                                                                                            (120, 'Favorecer en los niños y niñas el autoconocimiento, de manera que vayan desarrollando una percepción ajustada de sí mismos.', 8, '2025-06-05 02:16:52'),
                                                                                                            (121, 'Dar modelos sociales claros y pertinentes, acordes al contexto educativo, familiar y social.', 8, '2025-06-05 02:17:08'),
                                                                                                            (122, 'Establecer normas claras y consensuadas, extensivas al trabajo en el hogar.', 8, '2025-06-05 02:17:22'),
                                                                                                            (123, 'Ofrecer oportunidades de ejercicio autónomo de conductas sociales, con apoyo de diversos materiales.', 8, '2025-06-05 02:17:35'),
                                                                                                            (124, 'Brindar oportunidades para que el niño y niña elijan la actividad o acción que van a desarrollar. ', 8, '2025-06-05 02:17:47'),
                                                                                                            (125, 'Incentivar al niño o niña para que ejecute por sí mismo la actividad, cuidando de brindar el apoyo estrictamente necesario.', 8, '2025-06-05 02:18:00'),
                                                                                                            (126, 'Considerar la edad de desarrollo del niño o niña a la hora de pedir independencia y verificar que no existan razones orgánicas que impidan la realización de una actividad (por ejemplo un niño o niña que no controla esfínteres a los tres años).', 8, '2025-06-05 02:18:17'),
                                                                                                            (127, 'Favorecer la autoestima y valoración de las capacidades de los niños y niñas. ', 8, '2025-06-05 02:18:30'),
                                                                                                            (128, 'Reforzar positivamente los logros por sobre los fracasos.', 8, '2025-06-05 02:18:42'),
                                                                                                            (129, 'Potenciar en los niños y niñas los ámbitos de mejor desempeño, ofreciendo oportunidades de desarrollo y aprendizaje en esas áreas.', 8, '2025-06-05 02:18:58'),
                                                                                                            (130, 'Estimular valores tales como de solidaridad, respeto por los otros, compañerismo, etc', 8, '2025-06-05 02:19:10'),
                                                                                                            (131, 'Estar atentos a posibles burlas y situaciones de abuso en el tiempo del recreo. Podemos preguntarle al alumno/a con quien suele estar en el recreo, qué cosas ha hecho, etc. Obviamente no es bueno hacerlo todos los días, él o ella son conscientes de que es su punto débil y como es normal, a ninguno nos gusta que nos pregunten todo el tiempo por aquello que más nos cuesta hacer.', 8, '2025-06-05 02:19:22'),
                                                                                                            (132, 'Cuidar el modelo que damos a los compañeros cuando nos dirigimos a los Estudiantes con discapacidad. El resto de alumnos lo copiaran. De manera que si solemos llamarle la atención, corregirle o enfadarnos, esa será la forma habitual en la que también sus compañeros se dirigirán a ellos. A veces es difícil, el día a día puede ser frustrante. Pero no olvidemos que el adulto de la situación somos nosotros, y quien tiene sus capacidades y herramientas socioemocionales a punto, somos nosotros, no ellos.', 8, '2025-06-05 02:19:37'),
                                                                                                            (133, 'Fomentar un clima de cooperación y trabajo en equipo, donde lo importante es el proceso conjunto y no los resultados.', 8, '2025-06-05 02:19:49'),
                                                                                                            (134, 'Comenzar con programas de mediación y resolución de conflictos.\r\nEstos programas funcionan mucho mejor cuando son un compromiso de todo el colegio y forman parte de la cultura del centro de manera generalizada. Suele haber unos alumnos ayudantes a los que los compañeros acuden en caso de conflicto y son ellos quienes ayudan a resolverlos.', 8, '2025-06-05 02:20:03'),
                                                                                                            (135, 'En el tiempo de tutoría propiciar que cualquier malestar o conflicto que haya entre los alumnos lo hablen entre ellos. Aprender a hablar en primera persona de lo que les ha molestado y hacerlo dirigiéndose directamente a la persona implicada, es una experiencia muy valiosa para todos. Al hacerlo en el tiempo de tutoría el adulto puede funcionar como mediador. Es importante que ambas partes se escuchen siempre con respeto.', 8, '2025-06-05 02:20:58'),
                                                                                                            (136, 'Será muy útil contar con la complicidad de algunos alumnos que además de integrar al alumno les podamos preguntar cada cierto tiempo por cómo ven al alumno/a con discapacidad. La idea es que funcionen como un filtro natural que nos aporte su percepción cómo iguales desde dentro del grupo.', 8, '2025-06-05 02:21:10'),
                                                                                                            (137, 'Trabajar con el termómetro de las emociones para ayudarles a determinar el grado adecuado en cada momento de la emoción que experimentan.', 8, '2025-06-05 02:21:23');
COMMIT;


INSERT INTO `barreras` (`id_barreras`, `descripcion`, `id_categoria`, `created_at`) VALUES
                                                                                        (1, 'No se emplea una exploración de los conocimientos previos para el desarrollo de la situación didáctica.', 1, '2025-06-05 02:25:54'),
                                                                                        (2, 'No se emplea ajustes razonables en el transcurso de las actividades.', 1, '2025-06-05 02:31:31'),
                                                                                        (3, 'Se desconoce los ritmos y estilos de aprendizaje de los alumnos.', 1, '2025-06-05 02:31:57'),
                                                                                        (4, 'La planeación no está realizada en consideración de la diversidad grupal.', 1, '2025-06-05 02:32:10'),
                                                                                        (5, 'No realiza ajustes razonables en la evaluación.', 1, '2025-06-05 02:32:21'),
                                                                                        (6, 'Poca actualización docente. escasa formación docente en estrategias de enseñanza-aprendizaje para realizar adaptaciones curriculares, a lo que se agrega la falta de recursos materiales y tecnológicos adaptados.', 1, '2025-06-05 02:32:33'),
                                                                                        (7, 'Falta de un sistema de identificación del estudiantado con discapacidad que participa de la asignatura.', 1, '2025-06-05 02:32:47'),
                                                                                        (8, 'Falta de diversificación de estrategias para el desarrollo de actividades.', 1, '2025-06-05 02:33:01'),
                                                                                        (9, 'Falta de implementación y diversificación de materias didácticos.', 1, '2025-06-05 02:33:12'),
                                                                                        (10, 'Poca importancia o falta de aplicación de evaluación diagnostica.', 1, '2025-06-05 02:33:25'),
                                                                                        (11, 'Falta de trabajo colegiado así como el intercambio de experiencias.', 1, '2025-06-05 02:33:36'),
                                                                                        (12, 'Clases teóricas.', 1, '2025-06-05 02:33:53'),
                                                                                        (13, 'Expectativas bajas de los alumnos que presentan dificultades de aprendizaje.', 2, '2025-06-05 02:34:08'),
                                                                                        (14, 'Exigencias poco apropiadas a las etapas de desarrollo del alumno.', 2, '2025-06-05 02:34:22'),
                                                                                        (15, 'No presentar la tarea de forma clara y atractiva.', 2, '2025-06-05 02:34:38'),
                                                                                        (16, 'Económicas. Por ejemplo, no tener dinero suficiente para la compra de material didáctico, para la compra del uniforme e incluso, para poder alimentarse adecuadamente.', 2, '2025-06-05 02:34:59'),
                                                                                        (17, 'La distancia entre el hogar y el centro educativo, que involucra la dificultad para trasladarse, la necesidad de madrugar o demorar mucho al regreso, el cansancio que esto implica, etc.', 2, '2025-06-05 02:35:14'),
                                                                                        (18, 'La dificultad para desarrollar las actividades fuera del aula: acceso a bibliotecas, acceso a internet, posibilidad de reunirse para hacer trabajos en grupo, para investigar diversas fuentes, etc.', 2, '2025-06-05 02:35:29'),
                                                                                        (19, 'No fomentar el compañerismo sino la competitividad.', 2, '2025-06-05 02:35:42'),
                                                                                        (20, 'Tiempo excedido en el desarrollo de las actividades.', 3, '2025-06-05 02:35:56'),
                                                                                        (21, 'Falta de planeación didáctica.', 3, '2025-06-05 02:36:11'),
                                                                                        (22, 'Falta de preparación previa de los materiales a utilizar.', 3, '2025-06-05 02:36:24'),
                                                                                        (23, 'Ausencia de utilización de los espacios físicos y acomodo de mobiliario, dinámicas grupales.', 3, '2025-06-05 02:36:37'),
                                                                                        (24, 'Falta de trabajo colaborativo entre el colegiado.', 3, '2025-06-05 02:37:58'),
                                                                                        (25, 'Repetición constante de tiempos muertos entre actividades.', 3, '2025-06-05 02:38:22'),
                                                                                        (26, 'Agrupación de los niños por características similares (grupos homogéneos).', 3, '2025-06-05 02:38:35'),
                                                                                        (27, 'No existe vinculación y trabajo colaborativo entre educación especial y educación regular.', 3, '2025-06-05 02:38:49'),
                                                                                        (28, 'Poco liderazgo directivo.', 3, '2025-06-05 02:39:03'),
                                                                                        (29, 'La calidad de la comunicación entre alumnos y profesores: hablar en lenguaje entendible, ser asertivo, motivador y empático con el alumno.', 4, '2025-06-05 02:40:12'),
                                                                                        (30, 'La cantidad de comunicación: tener tiempo para todos y darle a cada uno el que necesite, ya que no es igual para todos. Adaptar el contenido a cada caso, avanzar a ritmo pertinente, etc.', 4, '2025-06-05 02:40:23'),
                                                                                        (31, 'La exclusión de las necesidades comunicativas de los alumnos, desde una comunicación en una lengua indígena si es la que habla el alumno, lengua de señas si es que el alumno es sordo, conocer y comunicarse en Braille si el alumno es ciego, saber realizar e implementar Tableros de comunicación si el alumno tiene una condición que le impida comunicarse de manera oral o por medio de la lengua de señas...', 4, '2025-06-05 02:40:37'),
                                                                                        (32, 'No existen adecuaciones arquitectónicas para acceder y desplazarse en el centro escolar. barreras físicas.', 5, '2025-06-05 02:40:53'),
                                                                                        (33, 'Se puede mencionar desde edificios deteriorados, con mala iluminación o deficientes condiciones de higiene, hasta la carencia de condiciones necesarias para facilitar el acceso a alumnos con discapacidades o necesidades especiales.\r\nBaños, rampas, mesas...\r\n', 5, '2025-06-05 02:41:15'),
                                                                                        (34, 'El estudiante no sabe lo que tiene que hacer.', 6, '2025-06-05 02:41:34'),
                                                                                        (35, 'Los implementos de alimentación son de difícil acceso.', 6, '2025-06-05 02:41:46'),
                                                                                        (36, 'Las condiciones de higiene de los baños no son las pertinentes.', 6, '2025-06-05 02:42:04'),
                                                                                        (37, 'La dependencia familiar ha dificultado el aprendizaje de actividades diarias.', 6, '2025-06-05 02:42:17'),
                                                                                        (38, 'Ausencia de rutinas y hábitos en la escuela y en casa.', 6, '2025-06-05 02:42:32'),
                                                                                        (39, 'La no preparación del uso de los implementos escolares y su valor.', 6, '2025-06-05 02:42:47'),
                                                                                        (40, 'El vestido es de difícil manejo y/o higiene.', 6, '2025-06-05 02:43:03'),
                                                                                        (41, 'Interacciones y relaciones interpersonales.', 6, '2025-06-05 02:43:27'),
                                                                                        (42, 'Derivación de los alumnos con discapacidad a el especialista o centros especializados.', 7, '2025-06-05 02:43:42'),
                                                                                        (43, 'Actitud negativa ante la diversidad grupal.', 7, '2025-06-05 02:43:55'),
                                                                                        (44, 'Exclusión de los alumnos en diversas actividades.', 7, '2025-06-05 02:44:09'),
                                                                                        (45, 'Distorsión de la comunicación al utilizar un tono de voz muy bajo o muy fuerte.', 7, '2025-06-05 02:44:23'),
                                                                                        (46, 'Baja tolerancia ante acciones inapropiadas de los alumnos.', 7, '2025-06-05 02:44:51'),
                                                                                        (47, 'Sobreprotección a los alumnos que presentan discapacidad.', 7, '2025-06-05 02:45:11'),
                                                                                        (48, 'Falta de implementación de actividades inclusivas.', 7, '2025-06-05 02:45:26'),
                                                                                        (49, 'Poca disposición para llevar a cabo la educación inclusiva.', 7, '2025-06-05 02:45:39'),
                                                                                        (50, 'Indiferencia, poca o nula comunicación con los hijos.', 7, '2025-06-05 02:45:56'),
                                                                                        (51, 'Falta de apoyo por parte de los padres con las tareas escolares.', 7, '2025-06-05 02:46:10'),
                                                                                        (52, 'Poca concientización en el seguimiento de las necesidades del niño (medico, estimulacion, etc).', 7, '2025-06-05 02:46:31'),
                                                                                        (53, 'Desacuerdos entre adultos en el manejo de la conducta del niño.', 7, '2025-06-05 02:46:48'),
                                                                                        (54, 'Realización de actividades individuales dentro del grupo.', 8, '2025-06-05 02:48:28'),
                                                                                        (55, 'No fomenta la comunicación y el compañerismo de los alumnos.', 8, '2025-06-05 02:48:44'),
                                                                                        (56, 'Falta de actividades sociales a la NO discriminación.', 8, '2025-06-05 02:48:59'),
                                                                                        (57, 'Indiferencia a los conflictos entre los alumnos.', 8, '2025-06-05 02:49:18'),
                                                                                        (58, 'Poca comunicación con los padres de familia.', 8, '2025-06-05 02:49:33'),
                                                                                        (59, 'Falta de sociedad de padres de familia.', 8, '2025-06-05 02:49:47'),
                                                                                        (60, 'No se brinda orientación a los padres de familia.', 8, '2025-06-05 02:50:41'),
                                                                                        (61, 'Existe maltrato emocional, psicológico y físico.', 8, '2025-06-05 02:50:55'),
                                                                                        (62, 'Deprivación ambiental.', 8, '2025-06-05 02:51:11'),
                                                                                        (63, 'Padres con dificultades emocionales para la crianza del hijo.', 8, '2025-06-05 02:52:19');
COMMIT;