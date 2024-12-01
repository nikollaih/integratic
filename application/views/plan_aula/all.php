<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Planes de aula</h3>
                        <p>A continuación se muestra la lista de planes de aula creados por el docente.</p>
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
                                            <label for="">Materia y grado</label>
                                            <select name="materia" class="form-control" id="plan-area-materia">
                                                <option value="">- Seleccionar</option>
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
                                            <select name="periodo" class="form-control" id="">
                                                <option value="">- Seleccionar</option>
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
                            <table class="table table-bordered" id="tabla-plan-aula">
                                <thead>
                                    <tr>
                                        <th>Área</th>
                                        <th>Asignatura</th>
                                        <th>Grado</th>
                                        <th>Periodo</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha fin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($planes_aula){
                                            foreach ($planes_aula as $plan) { ?>
                                                <tr id="plan-aula-<?= $plan["id_plan_area"] ?>">
                                                    <td><?= $plan["nomarea"] ?></td>
                                                    <td><?= $plan["nommateria"] ?></td>
                                                    <td><?= $plan["grado"] ?></td>
                                                    <td><?= $plan["periodo"] ?></td>
                                                    <td><?= $plan["fecha_inicio"] ?></td>
                                                    <td><?= $plan["fecha_fin"] ?></td>
                                                    <td style="width:200px;">
                                                        <a href="<?= base_url() ?>PlanAula/create/<?= $plan["id_plan_area"] ?>" class="btn btn-info btn-sm">Editar</a>
                                                        <a target="_blank" href="<?= base_url() ?>PlanAula/ver/<?= $plan["id_plan_area"] ?>" class="btn btn-primary btn-sm">Ver</a>
                                                        <button data-id="<?= $plan["id_plan_area"] ?>" class="btn btn-danger btn-sm remove-plan-aula">Eliminar</button>
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
</html>