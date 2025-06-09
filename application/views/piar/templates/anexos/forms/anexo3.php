<form id="form-create-piar-3" action="" method="post">
    <?php
    if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador" || strtolower(logged_user()["rol"]) == "orientador"){
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="richtext-descripcion-que-hace">Incluya aquí los compromisos específicos para implementar en el aula que requieran ampliación o detalle
                        adicional al incluido en el PIAR.</label>
                    <textarea name="compromisos_especificos" id="richtext-compromisos-especificos" rows="10" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <?php
    }
    ?>

    <div class="row text-end" style="text-align:right;">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary m-t-10 m-b-10">Guardar Anexo 3</button>
        </div>
    </div>
</form>

<?php
if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
    ?>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <form action="<?= base_url() ?>PIAR/saveActivity" method="post">
                <input type="hidden" value="<?= $estudiante["id_piar"] ?? "" ?>" name="id_piar">
                        <h4>En casa apoyará con las siguientes actividades:</h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td><strong>Nombre de la actividad</strong></td>
                                <td><strong>Descripción de la estrategia</strong></td>
                                <td><strong>Frecuencia diaria, semanal ó permanente</strong></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($activities) && count($activities) > 0){
                                foreach ($activities as $actividad) {
                                    ?>
                                    <tr id="piar-activity-<?= $actividad["id_piar_actividad"] ?>">
                                        <td><?= $actividad["actividad"] ?></td>
                                        <td><?= $actividad["descripcion"] ?></td>
                                        <td><?= $actividad["frecuencia"] ?></td>
                                        <td><a data-id="<?= $actividad["id_piar_actividad"] ?>" class="btn btn-sm btn-danger btn-delete-piar-activity">Eliminar</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td><textarea required class="form-control" placeholder="Escribir aqui..." name="actividad"></textarea></td>
                                <td><textarea required class="form-control" placeholder="Escribir aqui..." name="descripcion"></textarea></td>
                                <td colspan="2">
                                    <select class="form-control" name="frecuencia" id="frecuencia">
                                        <option value="Diaria">Diaria</option>
                                        <option value="Semanal">Semanal</option>
                                        <option value="Permanente">Permanente</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="text-end d-flex justify-end">
                            <button type="submit" class="btn btn-primary">Guardar actividad</button>
                        </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<script>
    $( document ).ready(function() {
        const compromisosEspecificos = "<?= $estudiante["compromisos_especificos"] ?>";

        const obligacionesFamiliasHTML = compromisosEspecificos !== "" ? compromisosEspecificos : `
  <p><strong>Artículo 2.3.3.5.2.3.12. Obligaciones de las familias.</strong> En ejercicio de su corresponsabilidad con el proceso de educación inclusiva, las familias deberán:</p>

  <p>1. Adelantar anualmente el proceso de matrícula del estudiante con discapacidad en un establecimiento educativo.</p>

  <p>2. Aportar y actualizar la información requerida por la institución educativa que debe alojarse en la historia escolar del estudiante con discapacidad.</p>

  <p>3. Cumplir y firmar los compromisos señalados en el PIAR y en las actas de acuerdo, para fortalecer los procesos escolares del estudiante.</p>

  <p>4. Establecer un diálogo constructivo con los demás actores intervinientes en el proceso de inclusión.</p>

  <p>5. Solicitar la historia escolar, para su posterior entrega en la nueva institución educativa, en caso de traslado o retiro del estudiante.</p>

  <p>6. Participar en los espacios que el establecimiento educativo propicie para su formación y fortalecimiento, y en aquellas que programe periódicamente para conocer los avances de los aprendizajes.</p>

  <p>7. Participar en la consolidación de alianzas y redes de apoyo entre familias para el fortalecimiento de los servicios a los que pueden acceder los estudiantes, en aras de potenciar su desarrollo integral.</p>

  <p>8. Realizar veeduría permanente al cumplimiento de lo establecido en la presente sección y alertar y denunciar ante las autoridades competentes en caso de incumplimiento.</p>
`;

        setTimeout(() => {
            editorCompromisosEspecificos.setContents(obligacionesFamiliasHTML)
        }, 500)

    })
</script>
