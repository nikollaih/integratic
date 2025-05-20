-- Insertar componentes desde el campo exploracion (tipo 1)
INSERT INTO evidencia_componentes (id_evidencia_aprendizaje, id_tipo_componente, contenido, orden)
SELECT id_evidencia_aprendizaje, 1 AS id_tipo_componente, exploracion AS contenido, 1 AS orden
FROM evidencias_aprendizaje
WHERE TRIM(exploracion) != '';

-- Insertar componentes desde el campo estructuracion (tipo 2)
INSERT INTO evidencia_componentes (id_evidencia_aprendizaje, id_tipo_componente, contenido, orden)
SELECT id_evidencia_aprendizaje, 2 AS id_tipo_componente, estructuracion AS contenido, 1 AS orden
FROM evidencias_aprendizaje
WHERE TRIM(estructuracion) != '';

-- Insertar componentes desde el campo transferencia (tipo 3)
INSERT INTO evidencia_componentes (id_evidencia_aprendizaje, id_tipo_componente, contenido, orden)
SELECT id_evidencia_aprendizaje, 3 AS id_tipo_componente, transferencia AS contenido, 1 AS orden
FROM evidencias_aprendizaje
WHERE TRIM(transferencia) != '';

-- Insertar componentes desde el campo valoracion (tipo 4)
INSERT INTO evidencia_componentes (id_evidencia_aprendizaje, id_tipo_componente, contenido, orden)
SELECT id_evidencia_aprendizaje, 4 AS id_tipo_componente, valoracion AS contenido, 1 AS orden
FROM evidencias_aprendizaje
WHERE TRIM(valoracion) != '';

-- Insertar componentes desde el campo recursos (tipo 5)
INSERT INTO evidencia_componentes (id_evidencia_aprendizaje, id_tipo_componente, contenido, orden)
SELECT id_evidencia_aprendizaje, 5 AS id_tipo_componente, recursos AS contenido, 1 AS orden
FROM evidencias_aprendizaje
WHERE TRIM(recursos) != '';
