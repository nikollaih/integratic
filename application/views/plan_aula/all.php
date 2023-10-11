<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Mis planes de aula</h3>
                        <p>A continuación se muestra la lista de planes de aula creados por el docente.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <table class="table table-bordered">
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
                                                <tr>
                                                    <td><?= $plan["nomarea"] ?></td>
                                                    <td><?= $plan["nommateria"] ?></td>
                                                    <td><?= $plan["grado"] ?></td>
                                                    <td><?= $plan["periodo"] ?></td>
                                                    <td><?= $plan["fecha_inicio"] ?></td>
                                                    <td><?= $plan["fecha_fin"] ?></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>PlanAula/create/<?= $plan["id_plan_area"] ?>" class="btn btn-info btn-sm">Editar</a>
                                                        <a target="_blank" href="<?= base_url() ?>PlanAula/ver/<?= $plan["id_plan_area"] ?>" class="btn btn-primary btn-sm">Ver</a>
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