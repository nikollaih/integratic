<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <form action="" method="post">
                    <div class="row" id="migas">
                        <div class="col-md-12">
                            <h3>Nuevo plan de aula</h3>
                            <p>Por favor ingrese todos los campos para poder generar el plan de aula, los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 1 DE 4</span>
                                        <h4 class="section-title">Datos generales</h4>
                                    </div>
                                    <i class="fa fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="section-content">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Área <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="area" id="plan-area-area">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($areas){
                                                            foreach ($areas as $area) { ?>
                                                                <option value="<?= $area["codarea"] ?>"><?= $area["nomarea"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Materia <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="materia" id="plan-area-materia">
                                                    <option value="">- Seleccionar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Periodo <span class="text-danger">*</span></label>
                                                <select required class="form-control" name="periodo" id="plan-area-periodo">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($periodos){
                                                            foreach ($periodos as $periodo) { ?>
                                                                <option value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha inicio <span class="text-danger">*</span></label>
                                                <input required type="date" name="fecha_inicio" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha fin <span class="text-danger">*</span></label>
                                                <input required type="date" name="fecha_fin" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Intensidad horaria (Semanal) <span class="text-danger">*</span></label>
                                                <input required type="number" placeholder="Ej. 2" name="intensidad_horaria" class="form-control" id="">
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
                                </div>
                                <div class="section-content">
                                    <hr>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Diagnostico</label>
                                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Estado actual</label>
                                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Situación deseada</label>
                                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Observaciones</label>
                                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
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
                                </div>
                                <div class="section-content">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Estandar básico de competencia</label>
                                                <select name="estandares" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-estandar">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Derecho básicos de aprendizaje</label>
                                                <select name="" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-dba"></select>
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
                                        <span class="enumerator">PARTE 4 DE 4</span>
                                        <h4 class="section-title">Evidencias de aprendizaje</h4>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Semana(s)</label>
                                                <select name="" class="form-control" id=""></select>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label for="">Evidencia de aprendizaje</label>
                                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">La(s) semana(s) seleccionada(s) cuentan con proceso de exploración, estructuracion...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div style="background: #077b5d;" class="evidence-container">
                                                <h5>EXPLORACIÓN</h5>
                                                <div class="row">
                                                    <div class=" col-xs-12">
                                                        <div class="form-group">
                                                            <label for="">Motivación y exploración de saberes previos</label>
                                                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
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
                                                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
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
                                                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
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
                                                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
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
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary m-t-5" type="submit">Guardar</button>
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
    $('.select-2').select2();
</script>