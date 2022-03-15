<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Nueva prueba</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre prueba *</label>
                                        <input required type="text" name="prueba[nombre_prueba]"  class="form-control">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="descripcion_pregunta">Descripción</label>
                                            <textarea name="prueba[descripcion_prueba]" id="descripcion_pregunta" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Alcance Prueba *</label>
                                            <select required name="prueba[alcance_prueba]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($alcance_prueba != false){
                                                        foreach ($alcance_prueba as $ap) {
                                                        ?>
                                                            <option value="<?= $ap["id_alcance_prueba"] ?>"><?= $ap["descripcion"] ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Tipo Prueba *</label>
                                            <select required name="prueba[tipo_prueba]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($tipo_pruebas != false){
                                                        foreach ($tipo_pruebas as $tp) {
                                                        ?>
                                                            <option value="<?= $tp["id_tipo_prueba"] ?>"><?= $tp["descripcion"] ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Materias *</label>
                                            <select required name="prueba[materias][]" id="" class="form-control multiple-select" multiple data-live-search="true" data-size="10" data-actions-box="true">
                                                <?php
                                                    if($materias != false){
                                                        foreach ($materias as $materia) {
                                                        ?>
                                                            <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]." - ".$materia["grado"]."°" ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Dificultad *</label>
                                            <select required name="prueba[dificultad][]" id="" class="form-control multiple-select" multiple data-live-search="true" data-actions-box="true" data-actions-box="true">
                                                <option value="1">Facil</option>
                                                <option value="2">Intermedia</option>
                                                <option value="3">Avanzada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Cantidad de preguntas *</label>
                                            <input required type="number" name="prueba[cantidad_preguntas]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <select required name="prueba[estado]" id="" class="form-control">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fecha y hora Inicio *</label>
                                            <input required type="datetime-local" name="prueba[fecha_inicio]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fecha y hora Finalización *</label>
                                            <input required type="datetime-local" name="prueba[fecha_finaliza]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Duración Prueba (Minutos) *</label>
                                            <select required name="prueba[duracion]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    for ($i=5; $i <= 300 ; $i+=5) { 
                                                ?>
                                                    <option value="<?= $i ?>"><?= $i ?> Minutos</option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="asignacion-preguntas-1" name="asignacion_preguntas" value="1" checked>
                                            <label class="custom-control-label" for="asignacion-preguntas-1">Asignacion de preguntas automatica</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="asignacion-preguntas-2" name="asignacion_preguntas" value="2">
                                            <label class="custom-control-label" for="asignacion-preguntas-2">Asignacion de preguntas manual</label>
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