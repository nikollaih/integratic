<table class="margin-top">
    <tr>
        <td style="border: 0;" class="text-center" colspan="2">
            <p class="text-content title text-center">INFORMACIÓN GENERAL DEL ESTUDIANTE (ANEXO 1)</p>
        </td>
    </tr>
    <tr>
        <td><strong>Fecha y Lugar de Diligenciamiento</strong></td>
        <td><?= $piar["fecha_elaboracion"] ?></td>
    </tr>
    <tr>
        <td class="space-to-fill">
            <strong>Nombre de la persona que diligencia:</strong>
        </td>
        <td class="space-to-fill">
            <strong>Rol que desempeña en la SE o la IE:</strong>
        </td>
    </tr>
</table>

<h5>1. INFORMACIÓN GENERAL DEL ESTUDIANTE</h5>
<table>
    <tr>
        <td><strong>Nombres:</strong> <?= $estudiante["nombres"] ?></td>
        <td colspan="2"><strong>Apellidos:</strong> <?= $estudiante["apellidos"] ?></td>
    </tr>
    <tr>
        <td><strong>Lugar de nacimiento:</strong> <?= $piar["lugar_nacimiento"] ?></td>
        <td><strong>Edad:</strong> <?= get_years(obtenerRespuesta($preguntas, $respuestas, 7), date("Y-m-d")) ?></td>
        <td><strong>Fecha de nacimiento:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 7) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Tipo de documento:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 1) ?></td>
        <td><strong>No de identificación:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 2) ?></td>
    </tr>
    <tr>
        <td><strong>Departamento:</strong> <?= $piar["departamento"] ?></td>
        <td colspan="2"><strong>Municipio:</strong> <?= $piar["municipio"] ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Dirección:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 35) ?></td>
    </tr>
    <tr>
        <td><strong>Teléfono:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 36) ?></td>
        <td colspan="2"><strong>Correo electrónico:</strong> <?= $estudiante["email"] ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Está en centro de protección?</strong> <?= ($piar["es_centro_proteccion"] === "1") ? "SI <br> <strong>¿Dónde?</strong> ".$piar["centro_proteccion"] : "NO" ?></td>
    </tr>
    <tr>
        <td colspan="3">Si el estudiante no tiene registro civil debe iniciarse la gestión con la familia y la Registraduría</td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Se reconoce o pertenece a un grupo étnico?</strong> <br><?= obtenerRespuesta($preguntas, $respuestas, 46) ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Se reconoce como víctima del conflicto armado?</strong> <?= ($piar["es_victima_conflicto_armado"] === "1") ? "SI" : "NO" ?> <br><strong>¿Cuenta con el respectivo registro? </strong> <?= ($piar["registro_victima_conflicto_armado"] === "1") ? "SI" : "NO" ?></td>
    </tr>
</table>

<h5>2. ENTORNO SALUD</h5>
<table>
    <tr>
        <td><strong>Afiliación al sistema de salud</strong> <?= ($piar["afiliacion_sistema_salud"] === "1") ? "SI" : "NO" ?></td>
        <td><strong>EPS:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 27) ?></td>
        <td><?= ($piar["tipo_afiliacion_sistema_salud"] )  ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Lugar donde lo atienden en caso de emergencia:</strong> <?= ($piar["lugar_atencion_emergencia"]) ?></td>
    </tr>
    <tr>
        <td colspan="1"><strong>¿El niño está siendo atendido
                por el sector salud?</strong> <?= ($piar["es_atendido_sector_salud"] === "1") ? "SI" : "NO" ?>
        </td>
        <td colspan="2"><strong>Frecuencia:</strong> <?= ($piar["es_atendido_frecuencia"]) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Tiene diagnóstico médico:</strong>  <?= obtenerRespuesta($preguntas, $respuestas, 19) ?>
        </td>
        <td><strong>Cuál:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 20) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>¿El niño está asistiendo a
                terapias?</strong>
            <?= obtenerRespuesta($preguntas, $respuestas, 17) ?>
        </td>
        <td><strong>Cuál:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 18) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>¿Actualmente recibe tratamiento médico por alguna
                enfermedad en particular?</strong>  <?= ($piar["recibe_tratamiento_enfermedad_particular"] === "1") ? "SI" : "NO" ?>
        </td>
        <td><strong>Cuál:</strong> <?= ($piar["recibe_tratamiento_enfermedad_particular_cual"] )  ?></td>
    </tr>
    <tr>
        <td colspan="1"><strong>¿Consume medicamentos?</strong> <?= obtenerRespuesta($preguntas, $respuestas, 15) ?>
        </td>
        <td colspan="2"><strong>Frecuencia y horario:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 16) ?></td>
    </tr>
    <tr>
        <td colspan="1" style="width: 350px"><strong>¿Cuenta con productos de apoyo para favorecer su
                movilidad, comunicación e independencia?</strong>
        </td>
        <td colspan="2"><?= obtenerRespuesta($preguntas, $respuestas, 3) ?></td>
    </tr>
</table>

<h5>3. ENTORNO HOGAR</h5>
<table>
    <tr>
        <td colspan="2"><strong>Nombre de la madre:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 41) ?></td>
        <td colspan="2"><strong>Nombre del padre:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 39) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Ocupación de la madre:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 42) ?></td>
        <td colspan="2"><strong>Ocupación del padre:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 40) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Nivel educativo alcanzado:</strong> <?= ($piar["nivel_educativo_madre"]) ?></td>
        <td colspan="2"><strong>Nivel educativo alcanzado:</strong> <?= ($piar["nivel_educativo_padre"]) ?></td>
    </tr>
    <tr>
        <td><strong>Nombre cuidador:</strong> <?= ($piar["nombre_cuidador"] )  ?></td>
        <td><strong>Parentesco:</strong> <?= ($piar["parentesco_cuidador"] )  ?></td>
        <td><strong>Nivel educativo:</strong> <?= ($piar["nivel_educativo_cuidador"] )  ?></td>
        <td class="space-to-fill"><strong>Teléfono:</strong><br><?= ($piar["telefono_cuidador"] )  ?><br><strong>Correo electrónico:</strong> <?= ($piar["correo_electronico_cuidador"] )  ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Número hermanos:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 25) ?></td>
        <td colspan="2"><strong>Lugar que ocupa:</strong> <?= ($piar["lugar_que_ocupa_hermanos"] )  ?></td>
    </tr>
    <tr>
        <td colspan="2" class="space-to-fill"><strong>Personas con quien vive:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 54) ?></td>
        <td colspan="2" class="space-to-fill"><strong>¿Quiénes apoyan la crianza del estudiante?</strong> <?= ($piar["quienes_apoyan_crianza"] )  ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>¿Está bajo protección?</strong> <?= ($piar["esta_bajo_proteccion"]  === "1") ? "Si" : "No"  ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>La familia recibe algún subsidio de alguna entidad o institución:</strong> <?= ($piar["recibe_subsidio_entidad"]  === "1") ? "Si" : "No"  ?> <br><strong>¿Cuál?</strong> <?= ($piar["recibe_subsidio_entidad_cual"])  ?></td>
    </tr>
</table>

<h5>4. ENTORNO EDUCATIVO</h5>
<h6>Información de la Trayectoria Educativa</h6>
<table>
    <tr>
        <td style="width: 350px;"><strong>¿Ha estado vinculado en otra institución educativa,
                fundación o modalidad de educación inicial?</strong></td>
        <td class="space-to-fill">
            <?= ($piar["es_vinculado_otra_institucion"]  === "1") ? "Si - ¿Cúal?" : "No - ¿Por qué?"  ?><br><br>
            - <?= ($piar["es_vinculado_otra_institucion_cual"] )   ?>
        </td>
    </tr>
    <tr>
        <td><strong>Ultimo grado cursado:</strong> <?= ($piar["ultimo_grado_cursado"])  ?> <br> <strong>¿Aprobó?</strong> <?= ($piar["ultimo_grado_cursado_aprobo"]  === "1") ? "Si" : "No"  ?></td>
        <td class="space-to-fill">Observaciones: <?= ($piar["ultimo_grado_cursado_observaciones"])  ?></td>
    </tr>
    <tr>
        <td><strong>¿Se recibe informe pedagógico cualitativo que
                describa el proceso de desarrollo y aprendizaje del
                estudiante y/o PIAR?</strong><br>
            <?= ($piar["recibe_informe_pedagogico"]  === "1") ? "Si" : "No"  ?>
        </td>
        <td class="space-to-fill"><strong>¿De qué institución o modalidad proviene el informe?</strong> <br><?= ($piar["recibe_informe_pedagogico_institucion"])  ?>
        </td>
    </tr>
    <tr>
        <td><strong>¿Está asistiendo en la actualidad a programas
                complementarios?</strong> <br><?= ($piar["asiste_programas_complementarios"]  === "1") ? "Si" : "No"  ?>
        </td>
        <td class="space-to-fill"><strong>¿Cuáles?</strong><br><?= ($piar["asiste_programas_complementarios_cuales"]) ?></td>
    </tr>
</table>

<h6>Información de la institución educativa en la que se matricula</h6>
<table>
    <tr>
        <td class="space-to-fill" style="width: 350px;"><strong>Nombre de la Institución educativa a la que se matricula:</strong> <?= configuracion()["nombre_institucion"] ?></td>
        <td class="space-to-fill"><strong>Sede</strong></td>
    </tr>
    <tr>
        <td class="space-to-fill"><strong>Medio que usará el estudiante para transportarse a la institución educativa</strong><br><?= ($piar["medio_de_transporte"]) ?> </td>
        <td class="space-to-fill"><strong>Distancia entre la institución educativa o sede y el hogar del
                estudiante (Tiempo)</strong><br><?= ($piar["distancia_institucion_hogar"]) ?>
        </td>
    </tr>
</table>
<!--<table class="margin-top">
    <tr>
        <td class="space-to-fill">Nombre y firma</td>
        <td class="space-to-fill">Nombre y firma</td>
        <td class="space-to-fill">Nombre y firma</td>
    </tr>
    <tr>
        <td class="space-to-fill">Área</td>
        <td class="space-to-fill">Área</td>
        <td class="space-to-fill">Área</td>
    </tr>
</table>-->