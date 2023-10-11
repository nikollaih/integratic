<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <form action="" method="post" id="form-plan-aula">
                    <input type="hidden" name="plan[id_plan_area]" value="<?= (is_array($plan_area)) ? $plan_area["id_plan_area"] : "null" ?>">
                    <div class="row" id="migas">
                        <div class="col-md-12">
                            <h3><?= is_array($plan_area) ? "Modificar" : "Nuevo" ?> plan de aula</h3>
                            <p>Por favor ingrese todos los campos para poder generar el plan de aula, los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(isset($message)){
                                ?>
                                <div class="alert alert-<?= $message["type"] ?> alert-dismissible show" role="alert">
                                    <?= $message["message"] ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 1 DE 4</span>
                                        <h4 class="section-title">Datos generales</h4>
                                    </div>
                                    <i data-parte="1" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-1">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Área <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="plan[area]" id="plan-area-area">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($areas){
                                                            foreach ($areas as $area) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["area"] == $area["codarea"]) ? "selected" : "" ?> value="<?= $area["codarea"] ?>"><?= $area["nomarea"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Materia <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="plan[materia]" id="plan-area-materia">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($materias){
                                                            foreach ($materias as $materia) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["materia"] == $materia["codmateria"]) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]. " - ".$materia["grado"]."°" ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Periodo <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="plan[periodo]" id="plan-area-periodo">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($periodos){
                                                            foreach ($periodos as $periodo) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["periodo"] == $periodo["id_periodo"]) ? "selected" : "" ?> value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha inicio <span class="text-danger">*</span></label>
                                                <input required type="date" name="plan[fecha_inicio]" class="form-control" id="" value="<?= (is_array($plan_area)) ? $plan_area["fecha_inicio"] : "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha fin <span class="text-danger">*</span></label>
                                                <input required type="date" name="plan[fecha_fin]" class="form-control" id="" value="<?= (is_array($plan_area)) ? $plan_area["fecha_fin"] : "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Intensidad horaria (Semanal) <span class="text-danger">*</span></label>
                                                <input required type="number" placeholder="Ej. 2" name="plan[intensidad_horaria]" class="form-control" id="" value="<?= (is_array($plan_area)) ? $plan_area["intensidad_horaria"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ro">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 2 DE 4</span>
                                        <h4 class="section-title">Descripción</h4>
                                    </div>
                                    <i data-parte="2" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-2">
                                    <hr>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Diagnostico <span class="text-danger">*</span></label>
                                                <textarea name="plan[diagnostico]" id="richtext-1" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["diagnostico"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Estado actual <span class="text-danger">*</span></label>
                                                <textarea name="plan[estado_actual]" id="richtext-2" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["estado_actual"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Situación deseada <span class="text-danger">*</span></label>
                                                <textarea name="plan[situacion_deseada]" id="richtext-3" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["situacion_deseada"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Observaciones <span class="text-danger">*</span></label>
                                                <textarea name="plan[observaciones]" id="richtext-4" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["observaciones"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ro">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 3 DE 4</span>
                                        <h4 class="section-title">Estandares básicos de competencia & DBAs</h4>
                                    </div>
                                    <i data-parte="3" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-3">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Estandar básico de competencia</label>
                                                <select name="plan[estandares_basicos][]" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-estandar">
                                                    <?php
                                                        if($estandares){
                                                            foreach ($estandares as $estandar) { 
                                                                $estandaresSeleccionados = unserialize($plan_area["estandares_basicos"]);
                                                                ?>
                                                                <option <?= (in_array($estandar["id_estandar"], $estandaresSeleccionados)) ? "selected" : "" ?> value="<?= $estandar["id_estandar"] ?>"><?= $estandar["descripcion_estandar"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Derecho básicos de aprendizaje</label>
                                                <select name="plan[dbas][]" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-dba">
                                                    <?php
                                                        if($dbas){
                                                            foreach ($dbas as $dba) { 
                                                                $dbasSeleccionados = unserialize($plan_area["dbas"]);
                                                                ?>
                                                                <option <?= (in_array($dba["id_dba"], $dbasSeleccionados)) ? "selected" : "" ?> value="<?= $dba["id_dba"] ?>"><?= $dba["descripcion_dba"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if(is_array($plan_area)) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-container">
                                        <div class="section-header">
                                            <div>
                                                <span class="enumerator">PARTE 4 DE 4</span>
                                                <h4 class="section-title">Evidencias de aprendizaje</h4>
                                            </div>
                                            <i data-parte="4" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                        </div>
                                        <div class="section-content" id="parte-4">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Semanas</th>
                                                                <th>Evidencia de aprendizaje</th>
                                                                <th>Motivación y exploración saberes previos</th>
                                                                <th>Estructuración y práctica</th>
                                                                <th>Transferencia</th>
                                                                <th>Valoración</th>
                                                                <th>Recursos</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                                if($evidencias){
                                                                    foreach ($evidencias as $evidencia) { 
                                                                        $selectedSemanas = implode(" - ", unserialize($evidencia["semanas"]));
                                                                        ?>
                                                                        <tr id="evidencia-aprendizaje-<?= $evidencia["id_evidencia_aprendizaje"] ?>">
                                                                            <td><?= $selectedSemanas ?></td>
                                                                            <td colspan="<?= ($evidencia["is_only_row"]) ? 6 : 1 ?>"><?= $evidencia["evidencia_aprendizaje"] ?></td>
                                                                            <?php
                                                                                if($evidencia["is_only_row"] != 1){ ?>
                                                                            <td><?= $evidencia["exploracion"] ?></td>
                                                                            <td><?= $evidencia["estructuracion"] ?></td>
                                                                            <td><?= $evidencia["transferencia"] ?></td>
                                                                            <td><?= $evidencia["valoracion"] ?></td>
                                                                            <td><?= $evidencia["recursos"] ?></td>
                                                                                <?php }
                                                                            ?>
                                                                            <td>
                                                                                <button data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>" type="button" class="btn btn-sm btn-danger remove-evidencia-aprendizaje">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                }
                                                        ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ro">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-container">
                                        <div class="section-header">
                                            <div>
                                                <span class="enumerator">PARTE 4 DE 4</span>
                                                <h4 class="section-title">Nueva Evidencia de aprendizaje</h4>
                                            </div>
                                        </div>
                                        <div class="section-content">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Semana(s)</label>
                                                        <select name="evidencia[semanas][]" class="form-control select-2" multiple id="">
                                                            <?php
                                                                if($semanas){
                                                                    foreach ($semanas as $semana) { ?>
                                                                        <option value="<?= $semana["id_semana_periodo"] ?>"><?= $semana["semana"]. " - ( " . date("Y-m-d", strtotime($semana["fecha_inicio"])) . " )" ?></option>
                                                                    <?php }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Evidencia de aprendizaje</label>
                                                        <textarea name="evidencia[evidencia_aprendizaje]" id="richtext-5" cols="30" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class=" col-xs-12">
                                                    <div class="form-group form-check">
                                                        <input name="evidencia[is_only_row]" type="checkbox" class="form-check-input" id="only-row-input">
                                                        <label class="form-check-label" for="exampleCheck1">La(s) semana(s) seleccionada(s) cuentan con proceso de exploración, estructuracion...</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="extra-info-evidencia">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div style="background: #077b5d;" class="evidence-container">
                                                            <h5>EXPLORACIÓN</h5>
                                                            <div class="row">
                                                                <div class=" col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Motivación y exploración de saberes previos</label>
                                                                        <textarea name="evidencia[exploracion]" id="richtext-6" cols="30" rows="4" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div style="background:#0171bb;" class="evidence-container">
                                                            <h5>ESTRUCTURACIÓN</h5>
                                                            <div class="row">
                                                                <div class=" col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Momento estrucuración y práctica</label>
                                                                        <textarea name="evidencia[estructuracion]" id="richtext-7" cols="30" rows="4" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div style="background:#e73031;" class="evidence-container">
                                                            <h5>TRANSFERENCIA</h5>
                                                            <div class="row">
                                                                <div class=" col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Momento de transferencia</label>
                                                                        <textarea name="evidencia[transferencia]" id="richtext-8" cols="30" rows="4" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div style="background:#ed7202;" class="evidence-container">
                                                            <h5>VALORACIÓN</h5>
                                                            <div class="row">
                                                                <div class=" col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Momento de transferencia</label>
                                                                        <textarea name="evidencia[valoracion]" id="richtext-9" cols="30" rows="4" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div style="background:#ed7202;" class="evidence-container">
                                                            <h5>RECURSOS</h5>
                                                            <div class="row">
                                                                <div class=" col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Recursos</label>
                                                                        <textarea name="evidencia[recursos]" id="richtext-10" cols="30" rows="4" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php }
                    ?>

                    <div class="row">
                        <div class="col-md-12 m-t-15 text-right">
                            <button class="btn btn-primary m-t-15" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>
<script>
    let forLength = "<?= (is_array($plan_area)) ? 11 : 5 ?>";
    $('.select-2').select2();

    let kothingParamsPlan = {
        fontSize: ['8px', '10px', '12px', '14px', '16px', '18px', '20px'], // Lista de tamaños de letra
        defaultFontSize: '12px', // Tamaño de letra predeterminado
        width: '100%',
        height: 'auto',
        toolbarItem: [
            ['undo', 'redo'],
            ['fontSize'],
            ['bold', 'underline', 'italic'],
            ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
        ],
        charCounter: true,
    }

    $( document ).ready(function() { 
        let allRichtext = [];
        for (let i = 1; i < forLength; i++) {
            allRichtext[i] = KothingEditor.create('richtext-' + i, kothingParamsPlan);
            jQuery("#richtext-" + i).addClass("hide-textarea");
        }

        $("#form-plan-aula").on('submit', function(e) {
            for (let i = 1; i < forLength; i++) {
                if(jQuery("#richtext-" + i).length) {
                    jQuery("#richtext-" + i).html(allRichtext[i].getContents());
                }
            }
        });
    })
</script>