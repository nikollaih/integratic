<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Estadisticas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-lg-3">
                                    <div class="estadisticas-top-container primary">
                                        <h1><?= $cantidad_pruebas["cantidad_pruebas"] ?></h1>
                                        <h5>Pruebas</h5>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-lg-3">
                                    <div class="estadisticas-top-container primary">
                                        <h1><?= $cantidad_preguntas["cantidad_preguntas"] ?></h1>
                                        <h5>Preguntas</h5>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-lg-3">
                                    <div class="estadisticas-top-container primary">
                                        <h1><?= $cantidad_participantes["cantidad_participantes"] ?></h1>
                                        <h5>Participantes</h5>
                                    </div>
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

<script>
    $(document).ready( function () {
    $('#tabla-pruebas').DataTable({
        order: []
    });
} );
</script>
</html>