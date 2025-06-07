<form id="form-create-piar-3" action="" method="post">
    <?php
    if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
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