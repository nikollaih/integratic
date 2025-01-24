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
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Plan Individual de Ajustes Razonables (P.I.A.R.)</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span><b>Documento: </b> <?= $estudiante["documento"] ?></span><br>
                            <span><b>Estudiante: </b> <?= $estudiante["nombre"] ?></span><br>
                            <span><b>Grado: </b> <?= $estudiante["grado"] ?></span><br>
                            <span><b>E-mail: </b> <?= $estudiante["email"] ?></span><br>
                            <span><b>E-mail acudiente: </b> <?= $estudiante["email_acudiente"] ?></span>
                            <hr>
                            <h4>Entorno personal</h4>
                            <div><?= $estudiante["entorno_personal"] ?></div>
                        </div>
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
<!-- PIAR -->
<script src="<?= base_url() ?>js/piar.js"></script>
</html>