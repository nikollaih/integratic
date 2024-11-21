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
                <?php
                if(strtolower(logged_user()["rol"]) === "estudiante" || strtolower(logged_user()["rol"]) === "acudiente"){ ?>
                    <div class="row m-b-2">
                        <div class="col-md-12">
                            <a class="btn btn-primary" target="_blank" href="<?= base_url() ?>Recuperaciones/estudiante/<?= logged_user()["id"]."/".$recuperacion["id_recuperacion"] ?>">Ver resumen</a>
                        </div>
                    </div>
                <?php }
                ?>
                <div class="row">
                    <div class="<?= (strtolower(logged_user()["rol"]) !== "estudiante" && strtolower(logged_user()["rol"]) !== "acudiente") ? 'col-lg-8' : 'col-lg-12' ?>">
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
                                                    <?php
                                                    if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                        <th></th>
                                                    <?php }
                                                    ?>
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
                                                            <?php
                                                            if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                                <td>
                                                                    <button data-recuperacion="<?= $recuperacion["id_recuperacion"] ?>" data-actividad="<?= $actividad["id_actividad"] ?>" class="btn btn-sm btn-danger delete-recuperacion-actividad">Eliminar</button>
                                                                </td>
                                                            <?php }
                                                            ?>
                                                        </tr>
                                                    <?php }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                            <div class="text-center">
                                                <button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#agregar-actividad-recuperacion-modal">Agregar Actividad</button>
                                            </div>
                                        <?php }
                                        ?>
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
                                                <?php
                                                if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                    <th></th>
                                                <?php }
                                                ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($pruebas){
                                                foreach($pruebas as $prueba){ ?>
                                                    <tr>
                                                        <td><a href="<?= base_url().'Pruebas/ver/'.$prueba["id_prueba"] ?>" target="_blank"><?= $prueba["nombre_prueba"] ?></a></td>
                                                        <td><?= $prueba["cantidad_preguntas"] ?></td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["fecha_inicio"])) ?></td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["fecha_finaliza"])) ?></td>
                                                        <?php
                                                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                            <td>
                                                                <button data-recuperacion="<?= $recuperacion["id_recuperacion"] ?>" data-prueba="<?= $prueba["id_prueba"] ?>" class="btn btn-sm btn-danger delete-recuperacion-prueba">Eliminar</button>
                                                            </td>
                                                        <?php }
                                                        ?>
                                                    </tr>
                                                <?php }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                            <div class="text-center">
                                                <button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#agregar-prueba-recuperacion-modal">Agregar Prueba</button>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(strtolower(logged_user()["rol"]) === "docente" || strtolower(logged_user()["rol"]) === "coordinador"){ ?>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-capitalize"><b>Estudiantes</b></div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($estudiantes){
                                            foreach($estudiantes as $estudiante){ ?>
                                                <tr>
                                                    <td><?= $estudiante["nombre"] ?></td>
                                                    <td>
                                                        <?php
                                                        if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                            <button data-recuperacion="<?= $recuperacion["id_recuperacion"] ?>" data-estudiante="<?= $estudiante["documento"] ?>" class="btn btn-sm btn-danger delete-recuperacion-estudiante">Eliminar</button>
                                                        <?php }
                                                        ?>
                                                        <a class="btn btn-sm btn-info" href="<?= base_url() ?>Recuperaciones/estudiante/<?= $estudiante["documento"] ?>/<?= $recuperacion["id_recuperacion"] ?>">Ver</a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                        <div class="text-center">
                                            <button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#agregar-estudiante-recuperacion-modal">Agregar Estudiante</button>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
</div>
    <?php $this->load->view("modal/agregar_actividad_recuperacion") ?>
    <?php $this->load->view("modal/agregar_prueba_recuperacion") ?>
    <?php $this->load->view("modal/agregar_estudiante_recuperacion") ?>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>