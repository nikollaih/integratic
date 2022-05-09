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
                        <a href="<?= base_url() ?>Estudiante/importar" class="btn btn-primary m-b-2">Importar estudiantes</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Estudiantes</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table id="tabla-estudiantes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Identificación</td>
                                            <td>Nombre completo</td>
                                            <td>Grado</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($estudiantes){
                                                foreach ($estudiantes as $e) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $e["documento"] ?></td>
                                                            <td><?= $e["nombre"] ?></td>
                                                            <td><?= $e["grado"] ?></td>
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
<script>
    $(document).ready( function () {
        $('#tabla-estudiantes').DataTable({
            "pageLength": 50,
            order: []
        });
    } );
</script>
</html>