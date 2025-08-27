<table class="margin-top">
    <tr>
        <td style="border: 0;" class="text-center" colspan="2">
            <p class="text-content title text-center">INFORMACI&Oacute;N GENERAL DEL ESTUDIANTE (ANEXO 1)</p>
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

<h5>1. INFORMACI&Oacute;N GENERAL DEL ESTUDIANTE</h5>
<table>
    <tr>
        <td><strong>Nombres:</strong> <?= $estudiante["nombres"] ?></td>
        <td colspan="2"><strong>Apellidos:</strong> <?= $estudiante["apellidos"] ?></td>
    </tr>
    <tr>
        <td><strong>Lugar de nacimiento:</strong> <?= $piar["lugar_nacimiento"] ?></td>
        <td><strong>Edad:</strong> <?= get_years($piar["fecha_nacimiento"], date("Y-m-d")) ?></td>
        <td><strong>Fecha de nacimiento:</strong> <?= $piar["fecha_nacimiento"] ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Tipo de documento:</strong> <?= $piar["tipo_doc"] ?></td>
        <td><strong>No de identificaci&oacute;n:</strong> <?= $piar["num_identificacion"] ?></td>
    </tr>
    <tr>
        <td><strong>Departamento:</strong> <?= $piar["departamento"] ?></td>
        <td colspan="2"><strong>Municipio:</strong> <?= $piar["municipio"] ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Direcci&oacute;n:</strong> <?= $piar["direccion"] ?></td>
    </tr>
    <tr>
        <td><strong>Tel&eacute;fono:</strong> <?= $piar["telefono"] ?></td>
        <td colspan="2"><strong>Correo electr&oacute;nico:</strong> <?= $estudiante["email"] ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Est&aacute; en centro de protecci&oacute;n?</strong> <?= ($piar["es_centro_proteccion"] === "1") ? "SI <br> <strong>¿D&oacute;nde?</strong> ".$piar["centro_proteccion"] : "NO" ?></td>
    </tr>
    <tr>
        <td colspan="3">Si el estudiante no tiene registro civil debe iniciarse la gesti&oacute;n con la familia y la Registradur&iacute;a</td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Se reconoce o pertenece a un grupo &eacute;tnico?</strong> <br><?= $piar["grupo_etnico"] === "1" ? "SI" : "NO" ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>¿Se reconoce como v&iacute;ctima del conflicto armado?</strong> <?= ($piar["es_victima_conflicto_armado"] === "1") ? "SI" : "NO" ?> <br><strong>¿Cuenta con el respectivo registro? </strong> <?= ($piar["registro_victima_conflicto_armado"] === "1") ? "SI" : "NO" ?></td>
    </tr>
</table>

<h5>2. ENTORNO SALUD</h5>
<table>
    <tr>
        <td><strong>Afiliaci&oacute;n al sistema de salud</strong> <?= ($piar["afiliacion_sistema_salud"] === "1") ? "SI" : "NO" ?></td>
        <td><strong>EPS:</strong> <?= $piar["eps"] ?></td>
        <td><?= ($piar["tipo_afiliacion_sistema_salud"] )  ?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Lugar donde lo atienden en caso de emergencia:</strong> <?= ($piar["lugar_atencion_emergencia"]) ?></td>
    </tr>
    <tr>
        <td colspan="1"><strong>¿El niño est&aacute; siendo atendido
                por el sector salud?</strong> <?= ($piar["es_atendido_sector_salud"] === "1") ? "SI" : "NO" ?>
        </td>
        <td colspan="2"><strong>Frecuencia:</strong> <?= ($piar["es_atendido_frecuencia"]) ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Tiene diagn&oacute;stico m&eacute;dico:</strong>  <?= $piar["diagnostico_medico"] === "1" ? "SI" : "NO" ?>
        </td>
        <td><strong>Cu&aacute;l:</strong> <?= $piar["diagnostico_cual"] ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>¿El niño est&aacute; asistiendo a
                terapias?</strong>
            <?= $piar["terapias"] === "1" ? "SI" : "NO" ?>
        </td>
        <td><strong>Cu&aacute;l:</strong> <?= $piar["terapias_cual"] ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>¿Actualmente recibe tratamiento m&eacute;dico por alguna
                enfermedad en particular?</strong>  <?= ($piar["recibe_tratamiento_enfermedad_particular"] === "1") ? "SI" : "NO" ?>
        </td>
        <td><strong>Cu&aacute;l:</strong> <?= ($piar["recibe_tratamiento_enfermedad_particular_cual"] )  ?></td>
    </tr>
    <tr>
        <td colspan="1"><strong>¿Consume medicamentos?</strong> <?= $piar["medicamentos"] === "1" ? "SI" : "NO" ?>
        </td>
        <td colspan="2"><strong>Frecuencia y horario:</strong> <?= $piar["medicamentos_frec_horario"] ?></td>
    </tr>
    <tr>
        <td colspan="1" style="width: 350px"><strong>¿Cuenta con productos de apoyo para favorecer su
                movilidad, comunicaci&oacute;n e independencia?</strong>
        </td>
        <td colspan="2"><?= $piar["productos_apoyo"] ?></td>
    </tr>
</table>

<h5>3. ENTORNO HOGAR</h5>
<table>
    <tr>
        <td colspan="2"><strong>Nombre de la madre:</strong> <?= $piar["madre_nombre"] ?></td>
        <td colspan="2"><strong>Nombre del padre:</strong> <?= $piar["padre_nombre"] ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Ocupaci&oacute;n de la madre:</strong> <?= $piar["madre_ocupacion"] ?></td>
        <td colspan="2"><strong>Ocupaci&oacute;n del padre:</strong> <?= $piar["padre_ocupacion"] ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Nivel educativo alcanzado:</strong> <?= ($piar["nivel_educativo_madre"]) ?></td>
        <td colspan="2"><strong>Nivel educativo alcanzado:</strong> <?= ($piar["nivel_educativo_padre"]) ?></td>
    </tr>
    <tr>
        <td><strong>Nombre cuidador:</strong> <?= ($piar["nombre_cuidador"] )  ?></td>
        <td><strong>Parentesco:</strong> <?= ($piar["parentesco_cuidador"] )  ?></td>
        <td><strong>Nivel educativo:</strong> <?= ($piar["nivel_educativo_cuidador"] )  ?></td>
        <td class="space-to-fill"><strong>Tel&eacute;fono:</strong><br><?= ($piar["telefono_cuidador"] )  ?><br><strong>Correo electr&oacute;nico:</strong> <?= ($piar["correo_electronico_cuidador"] )  ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>N&uacute;mero hermanos:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 25) ?></td>
        <td colspan="2"><strong>Lugar que ocupa:</strong> <?= ($piar["lugar_que_ocupa_hermanos"] )  ?></td>
    </tr>
    <tr>
        <td colspan="2" class="space-to-fill"><strong>Personas con quien vive:</strong> <?= obtenerRespuesta($preguntas, $respuestas, 54) ?></td>
        <td colspan="2" class="space-to-fill"><strong>¿Qui&eacute;nes apoyan la crianza del estudiante?</strong> <?= ($piar["quienes_apoyan_crianza"] )  ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>¿Est&aacute; bajo protecci&oacute;n?</strong> <?= ($piar["esta_bajo_proteccion"]  === "1") ? "Si" : "No"  ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>La familia recibe alg&uacute;n subsidio de alguna entidad o instituci&oacute;n:</strong> <?= ($piar["recibe_subsidio_entidad"]  === "1") ? "Si" : "No"  ?> <br><strong>¿Cu&aacute;l?</strong> <?= ($piar["recibe_subsidio_entidad_cual"])  ?></td>
    </tr>
</table>

<h5>4. ENTORNO EDUCATIVO</h5>
<h6>Informaci&oacute;n de la Trayectoria Educativa</h6>
<table>
    <tr>
        <td style="width: 350px;"><strong>¿Ha estado vinculado en otra instituci&oacute;n educativa,
                fundaci&oacute;n o modalidad de educaci&oacute;n inicial?</strong></td>
        <td class="space-to-fill">
            <?= ($piar["es_vinculado_otra_institucion"]  === "1") ? "Si - ¿C&uacute;al?" : "No - ¿Por qu&eacute;?"  ?><br><br>
            - <?= ($piar["es_vinculado_otra_institucion_cual"] )   ?>
        </td>
    </tr>
    <tr>
        <td><strong>Ultimo grado cursado:</strong> <?= ($piar["ultimo_grado_cursado"])  ?> <br> <strong>¿Aprob&oacute;?</strong> <?= ($piar["ultimo_grado_cursado_aprobo"]  === "1") ? "Si" : "No"  ?></td>
        <td class="space-to-fill">Observaciones: <?= ($piar["ultimo_grado_cursado_observaciones"])  ?></td>
    </tr>
    <tr>
        <td><strong>¿Se recibe informe pedag&oacute;gico cualitativo que
                describa el proceso de desarrollo y aprendizaje del
                estudiante y/o PIAR?</strong><br>
            <?= ($piar["recibe_informe_pedagogico"]  === "1") ? "Si" : "No"  ?>
        </td>
        <td class="space-to-fill"><strong>¿De qu&eacute; instituci&oacute;n o modalidad proviene el informe?</strong> <br><?= ($piar["recibe_informe_pedagogico_institucion"])  ?>
        </td>
    </tr>
    <tr>
        <td><strong>¿Est&aacute; asistiendo en la actualidad a programas
                complementarios?</strong> <br><?= ($piar["asiste_programas_complementarios"]  === "1") ? "Si" : "No"  ?>
        </td>
        <td class="space-to-fill"><strong>¿Cu&aacute;les?</strong><br><?= ($piar["asiste_programas_complementarios_cuales"]) ?></td>
    </tr>
</table>

<h6>Informaci&oacute;n de la instituci&oacute;n educativa en la que se matricula</h6>
<table>
    <tr>
        <td class="space-to-fill" style="width: 350px;"><strong>Nombre de la Instituci&oacute;n educativa a la que se matricula:</strong> <?= configuracion()["nombre_institucion"] ?></td>
        <td class="space-to-fill"><strong>Sede</strong></td>
    </tr>
    <tr>
        <td class="space-to-fill"><strong>Medio que usar&aacute; el estudiante para transportarse a la instituci&oacute;n educativa</strong><br><?= ($piar["medio_de_transporte"]) ?> </td>
        <td class="space-to-fill"><strong>Distancia entre la instituci&oacute;n educativa o sede y el hogar del
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
        <td class="space-to-fill">&Aacute;rea</td>
        <td class="space-to-fill">&Aacute;rea</td>
        <td class="space-to-fill">&Aacute;rea</td>
    </tr>
</table>-->