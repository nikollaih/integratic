DELETE FROM `respuestas_actividades` WHERE 1;
DELETE FROM `actividades` WHERE 1;
DELETE FROM `respuestas_foro` WHERE 1;
DELETE FROM `foros` WHERE 1;
DELETE FROM `anuncios` WHERE 1;
DELETE FROM `asg_materias` WHERE 1;
DELETE FROM `asg_procesos` WHERE 1;
DELETE FROM `asg_proyectos` WHERE 1;
DELETE FROM `respuestas_realizar_prueba` WHERE 1;
DELETE FROM `respuestas_preguntas_pruebas` WHERE 1;
DELETE FROM `realizar_prueba` WHERE 1;
DELETE FROM `asignacion_preguntas_prueba` WHERE 1;
DELETE FROM `preguntas_prueba` WHERE 1;
DELETE FROM `pruebas` WHERE 1;
DELETE FROM `ingresos` WHERE 1;
DELETE FROM `estudiante` WHERE 1;
DELETE FROM `core_participantes_pruebas` WHERE 1;
DELETE FROM `ci_sessions` WHERE 1;
DELETE FROM `ingresos` WHERE 1;
DELETE FROM `asignacion_participantes_prueba` WHERE 1;
DELETE FROM `usuarios` WHERE rol = 'Estudiante';