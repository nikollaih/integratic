<!-- ADD NEW ANUAL ROWS -->
<?php
if(isset($estudiante["id_piar"])){ ?>
    <form id="form-create-piar-row" action="<?= base_url() ?>PIAR/addItemAnnualPiar" method="post">
        <input type="hidden" value="<?= $estudiante["id_piar"] ?>" name="id_piar">
        <input type="hidden" value="<?= $item_piar_annual ? $item_piar_annual["id_piar_item_anual"] : "" ?>" name="id_piar_item_anual">
        <div class="panel panel-primary">
            <div class="panel-heading  accordion-toggle">
                <b>Crear registro anual para el P.I.A.R. del estudiante</b>
                <span class="accordion-icon">[+]</span>
            </div>
            <div class="panel-body" style="display: <?= $item_piar_annual ? "block" : "none" ?>;">
                <div class="row">
                    <?php
                    if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                            <div class="col-md-12 m-b-30">
                                <p class="alert alert-info"><strong>Nota: </strong> Aqui se debe incluir un texto...</p>
                            </div>
                        <div class="col-md-12">
                            <label for="id_materia">Seleccionar área/asignatura</label>
                            <select class="form-control" name="id_materia" id="id_materia" required>
                                <option value="">- Seleccionar área/asignatura</option>
                                <?php
                                if($materias){
                                    foreach($materias as $mat){
                                        $selected = ($item_piar_annual && $item_piar_annual["id_materia"] == $mat["codmateria"]) ? "selected" : "";
                                        echo '<option '.$selected.'  value="'.$mat["codmateria"].'">'.$mat["nommateria"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    <?php }
                    ?>
                    <?php
                    if(strtolower(logged_user()["rol"]) === "docente de apoyo"){ ?>
                        <div class="col-md-12">
                            <label for="otro_materia">Seleccionar categoría</label>
                            <select class="form-control" name="otro_materia" id="otro_materia" required>
                                <option value="">- Seleccionar</option>
                                <option value="Convivencia">Convivencia</option>
                                <option value="Socialización">Socialización</option>
                                <option value="Participación">Participación</option>
                                <option value="Autonomía">Autonomía</option>
                                <option value="Autocontrol">Autocontrol</option>
                            </select>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="row text-end">
                    <div class="col-md-12 m-t-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Competencias, habilidades y destrezas obtenidas en el año escolar</h5>
                                <div class="row">
                                    <div class=" col-xs-12">
                                        <div class="form-group">
                                            <textarea name="destrezas_obtenidas" cols="30" rows="4" class="form-control"><?= $item_piar_annual ? $item_piar_annual["destrezas_obtenidas"] : "" ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Aspectos en los que presentó dificultades</h5>
                                <div class="row">
                                    <div class=" col-xs-12">
                                        <div class="form-group">
                                            <textarea name="dificultades" cols="30" rows="4" class="form-control"><?= $item_piar_annual ? $item_piar_annual["dificultades"] : "" ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Observaciones respecto a su comportamiento en el aula</h5>
                                <div class="row">
                                    <div class=" col-xs-12">
                                        <div class="form-group">
                                            <textarea name="comportamiento" cols="30" rows="4" class="form-control"><?= $item_piar_annual ? $item_piar_annual["comportamiento"] : "" ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Observaciones respecto al nivel de desempeño en las actividades del aula</h5>
                                <div class="row">
                                    <div class=" col-xs-12">
                                        <div class="form-group">
                                            <textarea name="desempeno" cols="30" rows="4" class="form-control"><?= $item_piar_annual ? $item_piar_annual["desempeno"] : "" ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Recomendaciones para el siguiente grado escolar , técnico y/o universitario</h5>
                                <div class="row">
                                    <div class=" col-xs-12">
                                        <div class="form-group">
                                            <textarea name="recomendaciones" cols="30" rows="4" class="form-control"><?= $item_piar_annual ? $item_piar_annual["recomendaciones"] : "" ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <?php
                                if($item_piar_annual) {
                                    ?>
                                    <a href="<?= base_url() ?>PIAR/edit/<?= $estudiante["id_piar"] ?>">
                                        <button type="button" class="btn btn-secondary">Cancelar</button>
                                    </a>
                            <?php
                                }
                            ?>


                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }
?>

<!-- ITEMS ANUALES DEL PIAR -->
<?php
if(strtolower(logged_user()["rol"]) === "docente" || strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador") {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading "><b>Items anuales del piar</b></div>
        <div class="panel-body">
            <div class="row text-end">
                <div class="col-md-12 text-end">
                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Competencias, habilidades y destrezas obtenidas en el año escolar</th>
                                <th>Aspectos en los que presentó dificultades</th>
                                <th>Observaciones respecto a su comportamiento en el aula</th>
                                <th>Observaciones respecto al nivel de desempeño en las actividades del aula</th>
                                <th>Recomendaciones para el siguiente grado escolar , técnico y/o universitario</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($items_piar_annual) && is_array($items_piar_annual)){
                                foreach($items_piar_annual as $item){
                                    if($item["id_docente"] == logged_user()["id"]){
                                        ?>
                                        <tr id="piar-annual-item-<?= $item["id_piar_item_anual"] ?>">
                                            <td><?= $item["nommateria"] ?></td>
                                            <td><?= $item["destrezas_obtenidas"] ?></td>
                                            <td><?= $item["dificultades"] ?></td>
                                            <td><?= $item["comportamiento"] ?></td>
                                            <td><?= $item["desempeno"] ?></td>
                                            <td><?= $item["recomendaciones"] ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>PIAR/edit/<?= $estudiante["id_piar"].'/null/false/'.$item["id_piar_item_anual"] ?>">Modificar</a>
                                                <span data-id="<?= $item["id_piar_item_anual"] ?>" class="btn-delete-piar-annual-item text-danger cursor-pointer">Eliminar</span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
