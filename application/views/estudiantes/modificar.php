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
                        <a href="<?= base_url() ?>Estudiante/verTodos" class="btn btn-primary m-b-2">Lista de estudiantes</a>
                    </div>
                </div> 
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Nueva pregunta</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <dic class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Documento</label>
                                        <input class="form-control" readonly type="text" id="" value="<?= ($estudiante) ? $estudiante["documento"] : "" ?>">
                                    </div>
                                </dic>
                                <dic class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input class="form-control" readonly type="text" id="" value="<?= ($estudiante) ? $estudiante["nombres"]." ".$estudiante["apellidos"] : "" ?>">
                                    </div>
                                </dic>
                                <dic class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Grado</label>
                                        <input class="form-control" name="grado" type="text" id="" value="<?= ($estudiante) ? $estudiante["grado"] : "" ?>">
                                    </div>
                                </dic>
                                <dic class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave</label>
                                        <input class="form-control" name="clave" type="text" id="" value="<?= ($estudiante) ? $estudiante["clave"] : "" ?>">
                                    </div>
                                </dic>
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
                            <div class="row text-end" style="text-align:right;">
                                <div class="col-md-12 text-end">
                                    <hr>
                                    <button class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>