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
                        <a href="<?= base_url() ?>Caracterizacion" class="btn btn-primary m-b-2">Ver listado completo</a>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_caracterizacion" value="<?= (is_array($data)) ? $data["id_caracterizacion"] : "null" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= (is_array($data)) ? "Modificar" : "Agregar" ?> Caracterización de contenido</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Área *</label>
                                        <select required name="id_area" id="area" class="form-control get-selects-data">
                                            <option value=null>- Seleccionar</option>
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
                                        <select required name="grado" id="grado" class="form-control get-selects-data">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                for ($i=0; $i < 12; $i++) { 
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
                                        <label for="">DBA</label>
                                        <select name="id_dba" id="dba-select" class="form-control">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                if($dbas){
                                                    foreach ($dbas as $dba) {
                                                        ?>
                                                            <option <?= (is_array($data) && $data["id_dba"] == $dba["id_dba"]) ? "selected" : "" ?> value="<?= $dba["id_dba"] ?>"><?= $dba["descripcion_dba"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Lineamiento curricular</label>
                                        <select name="id_lineamiento_curricular" id="lineamientos-select" class="form-control">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                if($lineamientos){
                                                    foreach ($lineamientos as $lineamiento) {
                                                        ?>
                                                            <option <?= (is_array($data) && $data["id_lineamiento_curricular"] == $lineamiento["id_lineamiento_curricular"]) ? "selected" : "" ?> value="<?= $lineamiento["id_lineamiento_curricular"] ?>"><?= $lineamiento["descripcion_lineamiento_curricular"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>-->

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Estandar de competencia</label>
                                        <select name="id_estandar" id="estandares-select" class="form-control">
                                            <option value="null">- Seleccionar</option>
                                            <?php
                                                if($estandares){
                                                    foreach ($estandares as $estandar) {
                                                        ?>
                                                            <option <?= (is_array($data) && $estandar["id_estandar"] == $data["id_estandar"]) ? "selected" : "" ?> value="<?= $estandar["id_estandar"] ?>"><?= $estandar["descripcion_estandar"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Tema *</label>
                                        <textarea required class="form-control" name="descripcion" id="" cols="30" rows="5"><?= (is_array($data)) ? $data["descripcion"] : "" ?></textarea>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Ruta del contenido *</label>
                                        <input value="<?= (is_array($data)) ? $data["ruta_contenido"] : "" ?>" required type="text" name="ruta_contenido" id="" class="form-control">
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