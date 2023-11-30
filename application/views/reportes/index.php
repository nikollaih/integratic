<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Listado de reportes</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <button class="btn btn-lg" data-toggle="modal" data-target="#reporte-actividades-modal">Reporte de actividades</button>
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
<?php $this->load->view("modal/report_actividades_estudiante") ?>
<script src="<?= base_url() ?>js/reportes.js"></script>
</html>
