<table class="margin-top">
    <tr>
        <td style="border: 0;" class="text-center" colspan="3">
            <p class="text-content title text-center">ACTA DE ACUERDO (ANEXO 3)</p>
        </td>
    </tr>
    <tr>
        <td><strong>Fecha:</strong><br><?= date("Y-m-d") ?></td>
        <td colspan="2"><strong>Institución educativa:</strong><br><?= configuracion()["nombre_institucion"] ?></td>
    </tr>
    <tr>
        <td><strong>Nombre del estudiante:</strong><br><?= $piar["nombre"] ?></td>
        <td colspan="2"><strong>Documento de identificación:</strong><br><?= obtenerRespuesta($preguntas, $respuestas, 2) ?></td>
    </tr>
    <tr>
        <td>
            <strong>Edad: </strong><?= get_years(obtenerRespuesta($preguntas, $respuestas, 7), date("Y-m-d")) ?>
        </td>
        <td colspan="2"><strong>Grado: </strong><?= $piar["grado"] ?></td>
    </tr>
    <tr>
        <td rowspan="2" style="width: 250px">
            <strong>Nombres equipo directivos y de docentes: </strong>
        </td>
        <td colspan="2" class="space-to-fill"></td>
    </tr>
    <tr>
        <td colspan="2" class="space-to-fill"></td>
    </tr>
    <tr>
        <td rowspan="2" style="width: 250px">
            <strong>Nombres familia del estudiante: </strong>
        </td>
        <td class="space-to-fill"></td>
        <td class="space-to-fill" style="width: 150px"><span>Parentesco</span></td>
    </tr>
    <tr>
        <td class="space-to-fill"></td>
        <td class="space-to-fill"><span>Parentesco</span></td>
    </tr>
</table>

<div>
    <p>Según el Decreto 1421 de 2017 la educación inclusiva es un proceso permanente que
        reconoce, valora y responde a la diversidad de características, intereses, posibilidades y
        expectativas de los estudiantes para promover su desarrollo, aprendizaje y participación, en un
        ambiente de aprendizaje común, sin discriminación o exclusión.</p>

    <p>La inclusión solo es posible cuando se unen los esfuerzos del colegio, el estudiante y la familia.
        De ahí la importancia de formalizar con las firmas, la presente Acta Acuerdo.</p>

    <p><strong>El Establecimiento Educativo</strong> ha realizado la valoración y definido los ajustes razonables que
        facilitarán al estudiante su proceso educativo</p>

    <p><strong>La Familia se compromete a</strong> cumplir y firmar los compromisos señalados en el PIAR y en las
        actas de acuerdo, para fortalecer los procesos escolares del estudiante y en particular a:</p>
</div>

<table>
    <tr>
        <td style="height: 300px; background-color: #f0f0f0">
            <strong>Incluya aquí los compromisos específicos para implementar en el aula que requieran
                ampliación o detalle adicional al incluido en el PIAR.</strong>
            <?= $piar["compromisos_especificos"] ?>
        </td>
    </tr>
</table>

<p>Y en casa apoyará con las siguientes actividades:</p>

<table>
    <tbody>
    <tr>
        <td><strong>Nombre de la actividad</strong></td>
        <td><strong>Descripción de la estrategia</strong></td>
        <td><strong>Frecuencia Diaria, Semanal ó Permanente</strong></td>
    </tr>
    <?php
    if(count($activities) > 0){
        foreach ($activities as $actividad) {
            ?>
            <tr>
                <td class="space-to-fill"><?= $actividad["actividad"] ?></td>
                <td><?= $actividad["descripcion"] ?></td>
                <td><?= $actividad["frecuencia"] ?></td>
            </tr>
            <?php
        }
    }
    ?>
    <tr>
        <td style="height: 100px"></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

<p><strong>Firma de los actores comprometidos:</strong></p>

<hr>

<p>Estudiante</p>
<hr>

<p>Acudiente / Familia</p>
<hr>

<p>Docentes</p>
<hr>

<p>Docentes</p>
<hr>

<p>Directivo docente</p>
<hr>