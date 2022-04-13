<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="data[id_configuracion]" value="<?= (is_array($data)) ? $data["id_configuracion"] : "null" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Configuración</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Logo Institución</label>
                                        <input type="file" name="logo" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Nombre institución *</label>
                                        <input required type="text" name="data[nombre_institucion]" class="form-control" value="<?= (is_array($data)) ? $data["nombre_institucion"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Color principal *</label>
                                        <input required type="color" name="data[color_principal]" class="form-control" value="<?= (is_array($data)) ? $data["color_principal"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Color secundario *</label>
                                        <input required type="color" name="data[color_secundario]" class="form-control" value="<?= (is_array($data)) ? $data["color_secundario"] : "" ?>">
                                    </div>
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
                    <div class="row text-end" style="text-align:right;">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary">Guardar</button>
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