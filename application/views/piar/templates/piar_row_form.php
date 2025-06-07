<!-- ADD NEW ROWS -->
<?php
if(isset($estudiante["id_piar"])){ ?>
    <form id="form-create-piar-row" action="<?= base_url() ?>PIAR/addItemPiar" method="post">
        <input type="hidden" value="<?= $estudiante["id_piar"] ?>" name="id_piar">
        <input type="hidden" value="<?= $item_piar ? $item_piar["id_piar_item"] : "" ?>" name="id_piar_item">
                <div class="row">
                    <?php
                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                            <div class="col-md-6">
                                <label for="id_materia">Seleccionar materia</label>
                                <select class="form-control piar-select-materia" name="id_materia" id="id_materia" required>
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
                </div>

                <div class="row text-end" style="text-align:right;">
                    <div class="col-md-12 text-end">
                        <div class="row">
                            <?php if(strtolower(logged_user()["rol"]) === "docente de apoyo"){
                            $this->load->view("piar/templates/piar_row_admin_form"); } ?>

                            <?php if(strtolower(logged_user()["rol"]) === "docente"){
                                $this->load->view("piar/templates/piar_row_teacher_form"); } ?>

                            <div class="<?= strtolower(logged_user()["rol"]) === "docente" ? "col-sm-12" : "col-md-6 col-sm-12 col-xs-12" ?>">
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
                        <button type="submit" class="btn btn-primary m-b-30">Guardar item del P.I.A.R.</button>
                    </div>
                </div>
    </form>
<?php }
?>