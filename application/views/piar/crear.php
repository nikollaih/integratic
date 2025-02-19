<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= base_url() ?>PIAR" class="btn btn-primary m-b-2">Lista de estudiantes</a>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($this->session->flashdata('mensaje')) {
                        echo '<p>' . $this->session->flashdata('mensaje') . '</p>';
                    }
                    ?>
                </div>
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


            <?php require_once('templates/piar_form.php') ?>

            <?php
            if(strtolower(logged_user()["rol"]) == "docente de apoyo"){
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?= base_url() ?>PIAR/saveActivity" method="post">
                            <input type="hidden" value="<?= $estudiante["id_piar"] ?? "" ?>" name="id_piar">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <h4>En casa apoyará con las siguientes actividades:</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td><strong>Nombre de la actividad</strong></td>
                                            <td><strong>Descripción de la estrategia</strong></td>
                                            <td><strong>Frecuencia diaria, semanal ó permanente</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(isset($activities) && count($activities) > 0){
                                            foreach ($activities as $actividad) {
                                                ?>
                                                <tr id="piar-activity-<?= $actividad["id_piar_actividad"] ?>">
                                                    <td><?= $actividad["actividad"] ?></td>
                                                    <td><?= $actividad["descripcion"] ?></td>
                                                    <td><?= $actividad["frecuencia"] ?></td>
                                                    <td><a data-id="<?= $actividad["id_piar_actividad"] ?>" class="btn btn-sm btn-danger btn-delete-piar-activity">Eliminar</a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><textarea required class="form-control" placeholder="Escribir aqui..." name="actividad"></textarea></td>
                                            <td><textarea required class="form-control" placeholder="Escribir aqui..." name="descripcion"></textarea></td>
                                            <td colspan="2">
                                                <select class="form-control" name="frecuencia" id="frecuencia">
                                                    <option value="Diaria">Diaria</option>
                                                    <option value="Semanal">Semanal</option>
                                                    <option value="Permanente">Permanente</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="text-end d-flex justify-end">
                                        <button type="submit" class="btn btn-primary">Guardar actividad</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php require_once('templates/piar_row_form.php') ?>

            <!-- ITEMS DEL PIAR -->
            <?php
                if(strtolower(logged_user()["rol"]) === "docente" || strtolower(logged_user()["rol"]) === "docente de apoyo") {
                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Items del piar</b></div>
                        <div class="panel-body">
                            <div class="row text-end">
                                <div class="col-md-12 text-end">
                                    <div class="row">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Materia</th>
                                                <th>OBJETIVOS/PROPÓSITOS</th>
                                                <th>BARRERAS QUE SE EVIDENCIAN EN EL CONTEXTO SOBRE LAS QUE SE DEBEN TRABAJAR </th>
                                                <th>AJUSTES RAZONABLES</th>
                                                <th>EVALUACIÓN DE LOS AJUSTES</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(isset($item_piar) && is_array($items_piar)){
                                                foreach($items_piar as $item){
                                                    if($item["id_docente"] == logged_user()["id"]){
                                                    ?>
                                                    <tr id="piar-item-<?= $item["id_piar_item"] ?>">
                                                        <td><?= $item["nomarea"] ?? "Otras" ?> <br>(<?= $item["nommateria"] ?>)</td>
                                                        <td><?= $item["objetivos"] ?></td>
                                                        <td><?= $item["barreras"] ?></td>
                                                        <td><?= $item["ajustes_razonables"] ?></td>
                                                        <td><?= $item["evaluacion"] ?></td>
                                                        <td>
                                                            <a href="<?= base_url() ?>PIAR/edit/<?= $estudiante["id_piar"].'/'.$item["id_piar_item"] ?>">Modificar</a>
                                                            <span data-id="<?= $item["id_piar_item"] ?>" class="btn-delete-piar-item text-danger cursor-pointer">Eliminar</span>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div> <!-- container -->
    </div> <!-- content -->
</div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
<!-- PIAR -->
<script src="<?= base_url() ?>js/piar.js"></script>
<script>
    let forLength = 5;

    $( document ).ready(function() {
        let allRichtextPiar = [];
        let domElement = null;
        for (let i = 1; i < forLength; i++) {
            domElement = jQuery("#richtext-piar-" + i);
            if(domElement.length > 0){
                allRichtextPiar[i] = KothingEditor.create('richtext-piar-' + i, kothingParamsPlan);
                //jQuery("#richtext-piar-" + i).addClass("hide-textarea");
            }
        }

        $("#form-create-piar-row").on('submit', function(e) {
            e.preventDefault();

            for (let i = 1; i < forLength; i++) {
                domElement = jQuery("#richtext-piar-" + i);
                if(domElement.length) {
                    console.log(allRichtextPiar[i].getContents())
                    domElement.html(allRichtextPiar[i].getContents())
                }
            }

            this.submit();
        });

        editorEntornoPersonal.setContents(`<?= (isset($estudiante['entorno_personal'])) ? $estudiante['entorno_personal'] : "" ?>`);
        editorDescripcionGeneral.setContents(`<?= (isset($estudiante['descripcion_general'])) ? $estudiante['descripcion_general'] : "" ?>`);
        editorDescripcionQueHace.setContents(`<?= (isset($estudiante['descripcion_que_hace'])) ? $estudiante['descripcion_que_hace'] : "" ?>`);
        editorCompromisosEspecificos.setContents(`<?= (isset($estudiante['compromisos_especificos'])) ? $estudiante['compromisos_especificos'] : "" ?>`);
    })
</script>
</html>