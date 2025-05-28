<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("recuperaciones/templates/in_aside") ?>
    <?php $notas = notas_estudiante_recuperacion($recuperacion["id_recuperacion"], $recuperacion["documento"]) ?>

    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3><?= $recuperacion["nombre"].' - '.$recuperacion["grado"] ?></h3>
                        <p><strong>Nota global: </strong> <?= $notas["ponderado"] ?></p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Actividades </b>(<?= $notas["actividades"] ?>)</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Actividad</th>
                                                    <th>Porcentaje</th>
                                                    <th>Observaciones estudiante</th>
                                                    <th>Observaciones docente</th>
                                                    <th>Calificación</th>
                                                    <th>Fecha de entrega</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($actividades){
                                                    foreach($actividades as $actividad){?>
                                                        <tr>
                                                            <td><?= $actividad["titulo_actividad"] ?></td>
                                                            <td><?= $actividad["porcentaje"] ?>%</td>
                                                            <td style="overflow-wrap: anywhere;"><?= ($actividad["respuesta"]) ? $actividad["respuesta"]["estudiante_notas"] : "" ?></td>
                                                            <td style="overflow-wrap: anywhere;"><?= ($actividad["respuesta"]) ? $actividad["respuesta"]["docente_notas"] : "" ?></td>
                                                            <td>
                                                                <?php
                                                                    if($actividad["respuesta"] > 0){
                                                                        echo "<strong>".$actividad["respuesta"]["calificacion"]. ' ('.get_percent_value_qualification($actividad["respuesta"]["calificacion"], configuracion()["calificacion_sobre"], $actividad["porcentaje"]).')'."</strong>";
                                                                    }
                                                                    else echo "Sin entregar"
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?= $actividad["respuesta"] ? date('Y-m-d h:i a', strtotime($actividad["respuesta"]["created_at"])) : "Sin entregar" ?>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Pruebas</b> (<?= $notas["pruebas"] ?>)</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Prueba</th>
                                                <th>Preguntas</th>
                                                <th>Porcentaje</th>
                                                <th>Disponible desde</th>
                                                <th>Disponible hasta</th>
                                                <th>Calificación</th>
                                                <th>Fecha de entrega</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($pruebas){
                                                foreach($pruebas as $prueba){ ?>
                                                    <tr>
                                                        <td><?= $prueba["nombre_prueba"] ?></td>
                                                        <td><?= $prueba["cantidad_preguntas"] ?></td>
                                                        <td><?= $prueba["porcentaje"] ?>%</td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["fecha_inicio"])) ?></td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($prueba["fecha_finaliza"])) ?></td>
                                                        <td>
                                                            <?= $prueba["respuesta"] ? "<strong>".$prueba["respuesta"]["nota"]."</strong>" : "Sin entregar" ?>
                                                        </td>
                                                        <td>
                                                            <?= $prueba["respuesta"] ? date('Y-m-d h:i a', strtotime($prueba["respuesta"]["finished_at"])) : "Sin entregar" ?>
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

                        <?php
                        if(strtolower(logged_user()["rol"]) !== "docente") {
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading text-capitalize"><b>Observaciones del docente</b></div>
                                        <div class="panel-body">
                                            <p><?= $recuperacion["observaciones"] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                            if(strtolower(logged_user()["rol"]) === "docente") {
                                ?>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading text-capitalize"><b>Observaciones</b></div>
                                            <div class="panel-body">
                                                <form action="" method="post">
                                                    <label for="observaciones">Agregar observaciones</label>
                                                    <textarea
                                                            name="observaciones"
                                                            id=""
                                                            cols="30"
                                                            rows="5"
                                                            class="form-control"
                                                    ><?= $recuperacion["observaciones"] ?></textarea>
                                                    <button class="btn btn-primary m-t-10">Guardar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
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