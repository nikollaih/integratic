<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("recuperaciones/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3><?= $recuperacion["title"] ?></h3>
                        <div><?= $recuperacion["description"] ?></div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Actividades</b></div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Actividad</th>
                                                    <th>Porcentaje</th>
                                                    <th>Disponible desde</th>
                                                    <th>Disponible hasta</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($actividades){
                                                    foreach($actividades as $actividad){ ?>
                                                        <tr>
                                                            <td><?= $actividad["titulo_actividad"] ?></td>
                                                            <td><?= $actividad["porcentaje"] ?>%</td>
                                                            <td><?= date("Y-m-d h:i a", strtotime($actividad["disponible_desde"])) ?></td>
                                                            <td><?= date("Y-m-d h:i a", strtotime($actividad["disponible_hasta"])) ?></td>
                                                            <td>
                                                                <button data-recuperacion="<?= $recuperacion["id_recuperacion"] ?>" data-actividad="<?= $actividad["id_actividad"] ?>" class="btn btn-sm btn-danger delete-recuperacion-actividad">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#agregar-actividad-recuperacion-modal">Agregar Actividad</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Pruebas</b></div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Prueba</th>
                                                <th>Preguntas</th>
                                                <th>Disponible desde</th>
                                                <th>Disponible hasta</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($pruebas){
                                                foreach($pruebas as $prueba){ ?>
                                                    <tr>
                                                        <td><?= $prueba["nombre_prueba"] ?></td>
                                                        <td><?= $prueba["cantidad_preguntas"] ?></td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["disponible_desde"])) ?></td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["disponible_hasta"])) ?></td>
                                                        <td>
                                                            <button data-recuperacion="<?= $recuperacion["id_recuperacion"] ?>" data-prueba="<?= $prueba["id_prueba"] ?>" class="btn btn-sm btn-danger delete-recuperacion-prueba">Eliminar</button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#agregar-prueba-recuperacion-modal">Agregar Prueba</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-capitalize"><b>Estudiantes</b></div>
                            <div class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
</div>
    <?php $this->load->view("modal/agregar_actividad_recuperacion") ?>
    <?php $this->load->view("modal/agregar_prueba_recuperacion") ?>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>