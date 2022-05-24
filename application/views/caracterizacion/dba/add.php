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
                        <a href="<?= base_url() ?>Caracterizacion/DBA" class="btn btn-primary m-b-2">Lista de DBAs</a>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_dba" value="<?= (is_array($data)) ? $data["id_dba"] : "null" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= (is_array($data)) ? "Modificar" : "Agregar" ?> DBA</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Área *</label>
                                        <select name="id_area" id="" class="form-control">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                if($areas){
                                                    foreach ($areas as $area) {
                                                        ?>
                                                            <option <?= (is_array($data) && $data["id_area"] == $area["id_caracterizacion_area"]) ? "selected" : "" ?> value="<?= $area["id_caracterizacion_area"] ?>"><?= $area["descripcion_area"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Grado *</label>
                                        <select name="grado" id="" class="form-control">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                for ($i=1; $i < 12; $i++) { 
                                                    ?>
                                                        <option <?= (is_array($data) && $data["grado"] == $i) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?>°</option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Descripción DBA *</label>
                                        <textarea class="form-control" name="descripcion_dba" id="" cols="30" rows="10"><?= (is_array($data)) ? $data["descripcion_dba"] : "" ?></textarea>
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