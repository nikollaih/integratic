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
                    <a href="<?= base_url() ?>Piar" class="btn btn-primary m-b-2">Lista de estudiantes</a>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($this->session->flashdata('mensaje')) {
                        echo '<p>' . $this->session->flashdata('mensaje') . '</p>';
                    }
                    ?>
                </div>
            </div>

            <?php require_once('templates/piar_form.php') ?>

            <!-- ADD NEW ROWS -->
            <?php
                if(isset($estudiante["id_piar"])){ ?>
                    <form id="form-create-piar-row" action="<?= base_url() ?>PIAR/addItemPiar" method="post">
                        <input type="hidden" value="<?= $estudiante["id_piar"] ?>" name="id_piar">
                        <input type="hidden" value="<?= $item_piar ? $item_piar["id_piar_item"] : "" ?>" name="id_piar_item">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-capitalize"><b><?= $item_piar ? "Modificar" : "Crear" ?> registro para el P.I.A.R. del estudiante</b></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="id_materia">Seleccionar materia</label>
                                        <select class="form-control" name="id_materia" id="id_materia" required>
                                            <option value="">- Seleccionar materia</option>
                                            <?php
                                            if($materias){
                                                foreach($materias as $mat){
                                                    $selected = ($item_piar && $item_piar["id_materia"] == $mat["codmateria"]) ? "selected" : "";
                                                    echo '<option '.$selected.'  value="'.$mat["codmateria"].'">'.$mat["nommateria"].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row text-end" style="text-align:right;">
                                    <div class="col-md-12 text-end">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div style="background: #077b5d;" class="evidence-container">
                                                    <h5>OBJETIVOS/PROPÓSITOS</h5>
                                                    <div class="row">
                                                        <div class=" col-xs-12">
                                                            <div class="form-group">
                                                                <textarea name="objetivos" id="richtext-piar-1" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["objetivos"] : "" ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div style="background:#0171bb;" class="evidence-container">
                                                    <h5>BARRERAS QUE SE EVIDENCIAN EN EL CONTEXTO SOBRE LAS QUE SE DEBEN TRABAJAR </h5>
                                                    <div class="row">
                                                        <div class=" col-xs-12">
                                                            <div class="form-group">
                                                                <textarea name="barreras" id="richtext-piar-2" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["barreras"] : "" ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div style="background:#e73031;" class="evidence-container">
                                                    <h5>AJUSTES RAZONABLES</h5>
                                                    <div class="row">
                                                        <div class=" col-xs-12">
                                                            <div class="form-group">
                                                                <textarea name="ajustes_razonables" id="richtext-piar-3" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["ajustes_razonables"] : "" ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div style="background:#ed7202;" class="evidence-container">
                                                    <h5>EVALUACIÓN DE LOS AJUSTES</h5>
                                                    <div class="row">
                                                        <div class=" col-xs-12">
                                                            <div class="form-group">
                                                                <textarea name="evaluacion" id="richtext-piar-4" cols="30" rows="4" class="form-control"><?= $item_piar ? $item_piar["evaluacion"] : "" ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
            ?>

            <!-- ITEMS DEL PIAR -->
            <?php
                if(strtolower(logged_user()["rol"]) === "docente") {
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
                                                foreach($items_piar as $item){ ?>
                                                    <tr id="piar-item-<?= $item["id_piar_item"] ?>">
                                                        <td><?= $item["nommateria"] ?></td>
                                                        <td><?= $item["objetivos"] ?></td>
                                                        <td><?= $item["barreras"] ?></td>
                                                        <td><?= $item["ajustes_razonables"] ?></td>
                                                        <td><?= $item["evaluacion"] ?></td>
                                                        <td>
                                                            <?php
                                                            if($item["id_docente"] == logged_user()["id"]){ ?>
                                                                <a href="<?= base_url() ?>Piar/edit/<?= $estudiante["id_piar"].'/'.$item["id_piar_item"] ?>">Modificar</a>
                                                                <span data-id="<?= $item["id_piar_item"] ?>" class="btn-delete-piar-item text-danger cursor-pointer">Eliminar</span>
                                                            <?php }
                                                            ?>
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
    })
</script>
</html>