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
                        <div class="panel-body p-b-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Nombre institución *</label>
                                                <input required type="text" name="data[nombre_institucion]" class="form-control" value="<?= (is_array($data)) ? $data["nombre_institucion"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Ciudad *</label>
                                                <input required type="text" name="data[ciudad]" class="form-control" value="<?= (is_array($data)) ? $data["ciudad"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Calificación sobre *</label>
                                                <input required type="text" name="data[calificacion_sobre]" class="form-control" value="<?= (is_array($data)) ? $data["calificacion_sobre"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Es departamental *</label>
                                                <select class="form-control" required name="data[departamental]" id="">
                                                    <option <?= (is_array($data) && $data["departamental"] == 1) ? "selected" : "" ?> value="1">Si</option>
                                                    <option <?= (is_array($data) && $data["departamental"] == 0) ? "selected" : "" ?> value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color principal *</label>
                                                <input required type="color" name="data[color_principal]" class="form-control" value="<?= (is_array($data)) ? $data["color_principal"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color secundario *</label>
                                                <input required type="color" name="data[color_secundario]" class="form-control" value="<?= (is_array($data)) ? $data["color_secundario"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color venta principal *</label>
                                                <input required type="color" name="data[color_modal]" class="form-control" value="<?= (is_array($data)) ? $data["color_modal"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color botón principal *</label>
                                                <input required type="color" name="data[color_boton_primary]" class="form-control" value="<?= (is_array($data)) ? $data["color_boton_primary"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color botón exitoso *</label>
                                                <input required type="color" name="data[color_boton_success]" class="form-control" value="<?= (is_array($data)) ? $data["color_boton_success"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color botón peligro *</label>
                                                <input required type="color" name="data[color_boton_danger]" class="form-control" value="<?= (is_array($data)) ? $data["color_boton_danger"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Color botón alerta *</label>
                                                <input required type="color" name="data[color_boton_warning]" class="form-control" value="<?= (is_array($data)) ? $data["color_boton_warning"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">SMTP HOST</label>
                                                <input type="text" name="data[smtp_host]" class="form-control" value="<?= (is_array($data)) ? $data["smtp_host"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">SMTP POST</label>
                                                <input type="text" name="data[smtp_port]" class="form-control" value="<?= (is_array($data)) ? $data["smtp_port"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">SMTP USER</label>
                                                <input type="text" name="data[smtp_user]" class="form-control" value="<?= (is_array($data)) ? $data["smtp_user"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">SMTP PASS</label>
                                                <input type="text" name="data[smtp_pass]" class="form-control" value="<?= (is_array($data)) ? $data["smtp_pass"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group d-flex" style="align-items: center;">
                                                <div style="flex: 1;margin-right: 20px;">
                                                    <label for="">Logo Institución</label>
                                                    <input type="file" name="logo" accept="image/*" class="form-control">
                                                </div>
                                                <img width="50px" height="50px" src="<?= base_url() ?>img/<?= configuracion()["logo_institucion"] ?>" alt="<?= configuracion()["nombre_institucion"] ?>" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div style="flex: 1;margin-right: 20px;">
                                                    <label for="">Banner principal</label><br>
                                                    <img width="100%" src="<?= base_url() ?>img/<?= configuracion()["banner_principal"] ?>" alt="<?= configuracion()["nombre_institucion"] ?>" srcset="">
                                                    <input type="file" name="banner" accept="image/*" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group d-flex" style="align-items: center;">
                                                <div style="flex: 1;margin-right: 20px;">
                                                    <label for="">Logo Min Educación</label>
                                                    <input type="file" name="logo_min_educacion" accept="image/*" class="form-control">
                                                </div>
                                                <img width="50px" height="50px" src="<?= base_url() ?>img/<?= configuracion()["logo_min_educacion"] ?>" alt="<?= configuracion()["nombre_institucion"] ?>" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group d-flex" style="align-items: center;">
                                                <div style="flex: 1;margin-right: 20px;">
                                                    <label for="">Logo Gobierno Colombia</label>
                                                    <input type="file" name="logo_gobierno_colombia" accept="image/*" class="form-control">
                                                </div>
                                                <img width="50px" height="50px" src="<?= base_url() ?>img/<?= configuracion()["logo_gobierno_colombia"] ?>" alt="<?= configuracion()["nombre_institucion"] ?>" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row m-t-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div style="flex: 1;margin-right: 20px;">
                                                    <label for="">Modal principal</label><br>
                                                    <img width="100%" src="<?= base_url() ?>img/<?= configuracion()["modal_principal"] ?>" alt="<?= configuracion()["nombre_institucion"] ?>" srcset="">
                                                    <input type="file" name="modal" accept="image/*" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
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
                            <button class="btn btn-success">Guardar</button>
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