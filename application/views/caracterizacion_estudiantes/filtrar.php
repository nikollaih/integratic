<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Caracterización de estudiantes</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="" method="post">
                                <div class="row m-b-30">
                                    <?php
                                        if(strtolower(logged_user()['rol']) != 'docente'){ ?>
                                            <div class="col-md-3">
                                                <label for="grado">Grado</label>
                                                <select class="form-control" name="grado" id="grado">
                                                    <option value="">Todos</option>
                                                    <?php
                                                    if(isset($grados) && is_array($grados)) {
                                                        foreach ($grados as $grado) {
                                                            $selected = ($filtros["grado"] == $grado["grado"]) ? "selected" : "";
                                                            echo '<option '.$selected.' value="'.$grado["grado"].'">'.$grado["grado"].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                       <?php }
                                    ?>

                                    <div class="col-md-3 p-t-10">
                                        <button class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                            <table id="tabla-estudiantes" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>Identificación</td>
                                    <td>Nombre completo</td>
                                    <td>Grado</td>
                                    <td>Caracterización</td>
                                    <td>Completado</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($estudiantes) && is_array($estudiantes)) {
                                    foreach ($estudiantes as $e) {
                                        $e["caracterizacion_respuestas"] = json_decode($e["caracterizacion_respuestas"]);
                                        $cantidad_respuestas = (is_array($e["caracterizacion_respuestas"])) ? count($e["caracterizacion_respuestas"]) : 0;
                                        $porcentaje = getPercentFromNumber($cantidad_respuestas, count($cantidad_preguntas));
                                        $background = ($porcentaje == 100) ? "bg-success" : "bg-info";
                                ?>
                                        <tr id="estudiante-<?= $e["documento"] ?>">
                                            <td><?= $e["documento"] ?></td>
                                            <td><?= $e["nombre"] ?></td>
                                            <td><?= $e["grado"] ?></td>
                                            <td>
                                                <?php
                                                if(is_array($e["caracterizacion_respuestas"]) && count($e["caracterizacion_respuestas"]) > 0) {
                                                    echo '<a target="_blank" href="'.base_url().'CaracterizacionEstudiantes/completar/'.$e["documento"].'">Ver</a>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="progress-container position-relative">
                                                    <div class="progress" style="background-color: #939393; height: 20px; margin-bottom: 0">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?= $background ?>" role="progressbar" style="width: <?= $porcentaje ?>%;" aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="position-absolute porcentaje-valor" style=""><?= $porcentaje ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
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
        </div> <!-- container -->
    </div> <!-- content -->
</div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>

<style>
    .porcentaje-valor {
        font-size: 15px;
        left: 0;
        right: 0;
        top: 4px;
    }
</style>