ALTER TABLE piar
    ADD COLUMN fecha_nacimiento VARCHAR(20) NULL,
    ADD COLUMN tipo_doc VARCHAR(20) NULL,
    ADD COLUMN num_identificacion VARCHAR(30) NULL,
    ADD COLUMN direccion VARCHAR(255) NULL,
    ADD COLUMN telefono VARCHAR(20) NULL,
    ADD COLUMN grupo_etnico VARCHAR(100) NULL,
    ADD COLUMN eps VARCHAR(100) NULL,
    ADD COLUMN diagnostico_medico TINYINT(1) NULL,   -- 0 = No, 1 = Sí
    ADD COLUMN diagnostico_cual VARCHAR(255) NULL,
    ADD COLUMN terapias TINYINT(1) NULL,             -- 0 = No, 1 = Sí
    ADD COLUMN terapias_cual VARCHAR(255) NULL,
    ADD COLUMN medicamentos TINYINT(1) NULL,         -- 0 = No, 1 = Sí
    ADD COLUMN medicamentos_frec_horario VARCHAR(255) NULL,
    ADD COLUMN productos_apoyo VARCHAR(255) NULL,
    ADD COLUMN madre_nombre VARCHAR(150) NULL,
    ADD COLUMN madre_ocupacion VARCHAR(150) NULL,
    ADD COLUMN padre_nombre VARCHAR(150) NULL,
    ADD COLUMN padre_ocupacion VARCHAR(150) NULL;

DELETE r
FROM respuestas_realizar_prueba r
JOIN (
  SELECT id_realizar_prueba, id_pregunta, id_respuesta,
         MIN(id_respuesta_realizar_prueba) AS keep_id
  FROM respuestas_realizar_prueba
  GROUP BY id_realizar_prueba, id_pregunta, id_respuesta
  HAVING COUNT(*) > 1
) d ON d.id_realizar_prueba = r.id_realizar_prueba
   AND d.id_pregunta        = r.id_pregunta
   AND d.id_respuesta       = r.id_respuesta
WHERE r.id_respuesta_realizar_prueba <> d.keep_id;

ALTER TABLE respuestas_realizar_prueba
    ADD UNIQUE unique_respuesta (id_realizar_prueba, id_pregunta, id_respuesta);
