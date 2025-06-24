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
                        <a href="<?= base_url() ?>Caracterizacion/estandarCompetencia" class="btn btn-primary m-b-2">Lista de Estandares de competencia</a>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_estandar" value="<?= (is_array($data)) ? $data["id_estandar"] : "null" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b><?= (is_array($data)) ? "Modificar" : "Agregar" ?> estandar de competencia</b></div>
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
                                        <select name="grado[]" multiple id="" class="form-control multiple-select">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                for ($i=0; $i < 12; $i++) {
                                                    $temp_grado = [];
                                                    if(is_array($data)){
                                                        $temp_grado = unserialize($data["grado"]);
                                                    }
                                                    ?>
                                                        <option <?= (is_array($data) && in_array($i, $temp_grado)) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?>°</option>
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
                                        <label for="">Descripción Estandar de Competencia *</label>
                                        <textarea class="form-control" name="descripcion_estandar" id="" cols="30" rows="10"><?= (is_array($data)) ? $data["descripcion_estandar"] : "" ?></textarea>
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
<script>
    $(document).ready( function () {
        $('.multiple-select').selectpicker({
            noneSelectedText: "- Seleccionar grados",
            selectAllText : "Seleccionar todos",
            deselectAllText: "Deseleccionar todos"
        });
    } );
</script>
</html>