<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<?php $this->load->view("modal/barreras_por_categoria") ?>
<?php $this->load->view("modal/ajustes_razonables_por_categoria") ?>
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
                if(strtolower(logged_user()["rol"]) === "docente"){
                    require_once('templates/piar_annual_form.php');
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