<!-- ADD NEW ROWS -->
<?php
if(isset($estudiante["id_piar"])){ ?>
    <form id="form-create-piar-row" action="<?= base_url() ?>PIAR/addItemPiar" method="post">
        <input type="hidden" value="<?= $estudiante["id_piar"] ?>" name="id_piar">
        <input type="hidden" value="<?= $item_piar ? $item_piar["id_piar_item"] : "" ?>" name="id_piar_item">
        <div class="panel panel-primary">
            <div class="panel-heading text-capitalize"><b><?= $item_piar ? "Modificar" : "Crear" ?> registro para el P.I.A.R. del estudiante</b></div>
            <div class="panel-body">
                <div class="row">
                    <?php
                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                            <div class="col-md-6">
                                <label for="id_materia">Seleccionar materia</label>
                                <select class="form-control" name="id_materia" id="id_materia" required>
                                    <option value="">- Seleccionar materia</option>
                                    <?php
                                    if($materias){
                                        foreach($materias as $mat){
                                            $selected = ($item_piar && $item_piar["id_materia"] == $mat["codmateria"]) ? "selected" : "";
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
                        <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label for="id_periodo">Periodo</label>
                        <select class="form-control" name="id_periodo" id="id_periodo" required <?= isset($item_piar["id_periodo"]) ? 'disabled' : '' ?> >
                            <option value="">- Seleccionar periodo</option>
                            <?php
                            if($periodos){
                                foreach($periodos as $periodo){
                                    $selected = ($item_piar && $item_piar["id_periodo"] == $periodo["id_periodo"]) ? "selected" : "";
                                    echo '<option '.$selected.'  value="'.$periodo["id_periodo"].'">'.$periodo["periodo"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row text-end" style="text-align:right;">
                    <div class="col-md-12 text-end">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="background: #077b5d;" class="evidence-container">
                                    <h5>OBJETIVOS/PROPÓSITOS</h5>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <textarea name="objetivos" id="richtext-piar-1" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["objetivos"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="background:#0171bb;" class="evidence-container">
                                    <h5>BARRERAS QUE SE EVIDENCIAN EN EL CONTEXTO SOBRE LAS QUE SE DEBEN TRABAJAR </h5>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <textarea name="barreras" id="richtext-piar-2" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["barreras"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="background:#e73031;" class="evidence-container">
                                    <h5>AJUSTES RAZONABLES</h5>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <textarea name="ajustes_razonables" id="richtext-piar-3" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["ajustes_razonables"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="background:#ed7202;" class="evidence-container">
                                    <h5>EVALUACIÓN DE LOS AJUSTES</h5>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <textarea name="evaluacion" id="richtext-piar-4" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["evaluacion"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }
?>