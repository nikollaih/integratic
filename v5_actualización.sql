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