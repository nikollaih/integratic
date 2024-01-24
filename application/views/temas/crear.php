<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>Temas" class="btn btn-primary m-b-2">Temas</a>
                    </div>
                </div>
                <form action="" method="post" enctype="">
                    <input  required type="hidden" name="id_tema"  class="form-control" value="<?= (isset($tema["id_tema"])) ? $tema["id_tema"] : null ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= (isset($tema["id_tema"])) ? "Modificar" : "Nuevo" ?> tema</b></div>
                        <div class="panel-body">
                                <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Nombre tema *</label>
                                        <input required type="text" name="nombre_tema"  class="form-control" value="<?= (isset($tema["nombre_tema"])) ? $tema["nombre_tema"] : null ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Materias *</label>
                                        <select required name="materias[]" id="tema-materias" class="form-control multiple-select" data-live-search="true"  data-actions-box="true">
                                            <option value="">- Seleccionar</option>
                                            <?php
                                                if($materias != false){
                                                    foreach ($materias as $materia) {
                                                        $selected_materias = (isset($tema["materias"])) ? unserialize($tema["materias"]) : [];
                                                    ?>
                                                        <option <?= (in_array($materia["codmateria"], $selected_materias)) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]." - ".$materia["grado"]."°" ?></option>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">DBA</label>
                                        <select  name="DBA" id="dba-tema-select" class="form-control" data-live-search="true"  data-actions-box="true">
                                            <option value="0">No aplica</option>
                                            <?php
                                                if($dba){
                                            ?>
                                                    <option value="<?= $dba["id_dba"] ?>"><?= $dba["descripcion_dba"] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
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
<script>
    $('.multiple-select').selectpicker();
</script>
</html>