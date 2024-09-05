<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Evidencias de aprendizaje</h3>
                        <p>A continuación se muestra la lista de planes de aula creados por los docentes.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Docente</label>
                                            <select class="form-control" name="docente">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                if($docentes){
                                                    foreach ($docentes as $l_docente) { ?>
                                                        <option <?= ($docente == $l_docente["id"]) ? "selected" : "" ?> value="<?= $l_docente["id"] ?>"><?= $l_docente["nombres"]." ".$l_docente["apellidos"] ?></option>
                                                    <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Área</label>
                                            <select class="form-control" name="area" id="plan-area-area">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($areas){
                                                        foreach ($areas as $l_area) { ?>
                                                            <option <?= ($area == $l_area["codarea"]) ? "selected" : "" ?> value="<?= $l_area["codarea"] ?>"><?= $l_area["nomarea"] ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Materia y grado </label>
                                            <select name="materia" class="form-control" id="plan-area-materia">
                                                <?php
                                                    if($materias){
                                                        foreach ($materias as $l_materia) { ?>
                                                            <option <?= ($materia == $l_materia["codmateria"]) ? "selected" : "" ?> value="<?= $l_materia["codmateria"] ?>"><?= $l_materia["nommateria"]. " - ".$l_materia["grado"]."°" ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Periodo</label>
                                            <select name="periodo" class="form-control" id="plan-area-periodo-ea">
                                                <option value="">- Todos</option>
                                                <?php
                                                    if($periodos){
                                                        foreach ($periodos as $l_periodo) { ?>
                                                            <option <?= ($periodo == $l_periodo["id_periodo"]) ? "selected" : "" ?> value="<?= $l_periodo["id_periodo"] ?>"><?= $l_periodo["periodo"] ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Semana</label>
                                            <select name="semana" class="form-control" id="plan-area-semana" >
                                                <option value="">- Todas</option>
                                                <?php
                                                    if($semanas){
                                                        foreach ($semanas as $sem) { 
                                                            ?>
                                                            <option <?= ($semana == $sem["id_semana_periodo"]) ? "selected" : "" ?> value="<?= $sem["id_semana_periodo"] ?>"><?= $sem["semana"]. " (".$sem["fecha_inicio"].") " ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <select name="estado" class="form-control" id="plan-area-estado">
                                                <option value="">- Todos</option>
                                                <option <?= ($estado == 1) ? "selected" : "" ?> value="1">Pendiente</option>
                                                <option <?= ($estado == 2) ? "selected" : "" ?> value="2">No Completado</option>
                                                <option <?= ($estado == 3) ? "selected" : "" ?> value="3">Completado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-sm btn-primary m-t-2">Aplicar filtro</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <table id="tabla-evidencias" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Docente</th>
                                        <th>Periodo</th>
                                        <th>Semanas</th>
                                        <th>Evidencia aprendizaje</th>
                                        <th>Estado</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($evidencias_aprendizaje){
                                            foreach ($evidencias_aprendizaje as $evidencia) { 
                                                $selectedSemanas = unserialize($evidencia["semanas"]);
                                                $listaSemanas = get_semanas_by_ids($selectedSemanas);
                                                ?>
                                                <tr id="plan-aula-<?= $evidencia["id_plan_area"] ?>">
                                                    <td><?= $evidencia["nombres"]." ".$evidencia["apellidos"] ?></td>
                                                    <td><?= $evidencia["periodo"] ?></td>
                                                    <td>
                                                    <?php
                                                        if(is_array($listaSemanas)){
                                                            for ($i=0; $i < count($listaSemanas); $i++) { ?>
                                                                <div class="text-center">
                                                                    <h5 class="m-b-0"><?= $listaSemanas[$i]["semana"]. " - (<span style='font-size: 12px;color:#757575;'>".$listaSemanas[$i]["fecha_inicio"]."</span>)" ?></h5>
                                                                </div>
                                                            <?php }
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?= $evidencia["evidencia_aprendizaje"] ?></td>
                                                    <td><?= ($evidencia["estado_completo"] == 3) ? "Completado" : (($evidencia["estado_completo"] == 2) ? "No Completado" : "Pendiente"); ?></td>
                                                    <td><?= $evidencia["observaciones_completo"] ?></td>
                                                    <td>
                                                        <button data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>" class="btn-sm m-b-10 btn btn-primary mostrar-evidencia-aprendizaje">Mostrar más</button>
                                                        <a target="_blank" href="<?= base_url() ?>PlanAula/ver/<?= $evidencia["id_plan_area"] ?>">
                                                            <button class="btn-sm btn m-b-10">Ver PDF</button>
                                                        </a>
                                                        <a target="_blank" href="<?= base_url() ?>PlanAula/create/<?= $evidencia["id_plan_area"] ?>">
                                                            <button class="btn-sm btn btn-primary">Ver plan</button>
                                                        </a>
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
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
<?php $this->load->view("modal/evidencia_aprendizaje") ?>
<script>
    jQuery("#tabla-evidencias").dataTable();
</script>
</html>