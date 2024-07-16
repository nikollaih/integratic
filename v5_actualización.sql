CREATE TABLE caracterizacion_estudiantes_preguntas (
   id INT AUTO_INCREMENT PRIMARY KEY,
   pregunta VARCHAR(255) NOT NULL,
   tipo_etiqueta ENUM('input', 'select', 'radio', 'checkbox', 'textarea') NOT NULL,
   es_multiple BOOLEAN DEFAULT FALSE, -- Indica si la selección múltiple es permitida (relevante para select y checkbox)
   opciones TEXT, -- Opciones posibles para las preguntas de tipo 'select', 'radio' o 'checkbox'
   es_obligatoria BOOLEAN DEFAULT FALSE, -- Indica si la pregunta es obligatoria
   orden INT, -- Para definir el orden de las preguntas
   filtro BOOLEAN DEFAULT FALSE -- Indica si la pregunta puede ser usada como filtro
);

CREATE TABLE respuestas_estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT NOT NULL, -- ID del estudiante
    id_pregunta INT NOT NULL, -- ID de la pregunta
    respuesta TEXT, -- Respuesta del estudiante
    respuesta_otro TEXT, -- Campo adicional para "otro"
    fecha_respuesta TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora de la respuesta
    FOREIGN KEY (id_pregunta) REFERENCES caracterizacion_estudiantes_preguntas(id) -- Relación con la tabla de preguntas
);

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
