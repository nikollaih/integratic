<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <form action="" method="post" enctype="multipart/form-data" id="form-prueba">
                    <input type="hidden" name="prueba[id_prueba]" value="<?= ($prueba) ? $prueba["id_prueba"] : "" ?>">
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
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= ($prueba) ? "Modificar" : "Nueva" ?> prueba</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre prueba *</label>
                                        <input required type="text" name="prueba[nombre_prueba]"  class="form-control" value="<?= ($prueba) ? $prueba["nombre_prueba"] : "" ?>">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="descripcion_pregunta">Descripción</label>
                                            <textarea name="prueba[descripcion_prueba]" id="textarea_richtext" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div id="image_wrapper_richtext" class="image-list">
                                            <div class="file-list-info">
                                                <input type="file" id="files_upload" accept="image/*" multiple="multiple" class="files-text files-input files_upload"/>
                                                <span id="image_size_richtext" class="total-size text-small-2">0KB</span>
                                            </div>
                                            <div class="file-list">
                                                <ul id="image_list_richtext">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-2">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Alcance Prueba *</label>
                                            <select required name="prueba[alcance_prueba]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($alcance_prueba != false){
                                                        foreach ($alcance_prueba as $ap) {
                                                            if(configuracion()["departamental"] == 1 && strtolower($ap["descripcion"]) == "departamental" || (configuracion()["departamental"] == 0 && strtolower($ap["descripcion"]) != "departamental")){ 
                                                                ?>
                                                                    <option <?= ($prueba && $prueba["id_alcance_prueba"] == $ap["id_alcance_prueba"]) ? "selected" : "" ?> value="<?= $ap["id_alcance_prueba"] ?>"><?= $ap["descripcion"] ?></option>
                                                                <?php
                                                            }
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
                                                            <option <?= ($prueba && $prueba["id_tipo_prueba"] == $tp["id_tipo_prueba"]) ? "selected" : "" ?> value="<?= $tp["id_tipo_prueba"] ?>"><?= $tp["descripcion"] ?></option>
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
                                            <select required name="prueba[materias][]" id="" class="form-control multiple-select <?= ($prueba) ? "select-readonly" : "" ?>" multiple data-live-search="true" data-size="10" data-actions-box="true">
                                                <?php
                                                    if($materias != false){
                                                        foreach ($materias as $materia) {
                                                            $selectedMaterias = ($prueba) ? unserialize($prueba["materias"]) : [];
                                                        ?>
                                                            <option <?= ($prueba && in_array($materia["codmateria"], $selectedMaterias)) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]." - ".$materia["grado"]."°" ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-2">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Dificultad *</label>
                                            <select required name="prueba[dificultad][]" id="" class="form-control multiple-select <?= ($prueba) ? "select-readonly" : "" ?>" multiple data-live-search="true" data-actions-box="true" data-actions-box="true">
                                                <?php $selectedDificultad = ($prueba) ? unserialize($prueba["dificultad"]) : [] ?>
                                                <option <?= ($prueba && in_array("1", $selectedDificultad)) ? "selected" : "" ?> value="1">Facil</option>
                                                <option <?= ($prueba && in_array("2", $selectedDificultad)) ? "selected" : "" ?> value="2">Intermedia</option>
                                                <option <?= ($prueba && in_array("3", $selectedDificultad)) ? "selected" : "" ?> value="3">Avanzada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Cantidad de preguntas *</label>
                                            <!-- Que el campo no sea menor a 1-->
                                            <input <?= ($prueba) ? "readonly" : "" ?> required type="number" name="prueba[cantidad_preguntas]" class="form-control" min="1" value="<?= ($prueba) ? $prueba["cantidad_preguntas"] : "" ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Duración Prueba (Minutos) *</label>
                                            <select required name="prueba[duracion]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                // Estaba de 5 en 5 a llegar 300 minutos  
                                                    for ($i=10; $i <= 180 ; $i+=10) {
                                                ?>
                                                    <option <?= ($prueba && $prueba["duracion"] == $i) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?> Minutos</option>                                                  
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-2">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fecha y hora Inicio *</label>
                                            <input required type="datetime-local"  name="prueba[fecha_inicio]" class="form-control" value="<?= ($prueba) ? $prueba["fecha_inicio"] : "" ?>">                              
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fecha y hora Finalización *</label>
                                            <input required type="datetime-local" name="prueba[fecha_finaliza]" class="form-control" value="<?= ($prueba) ? $prueba["fecha_finaliza"] : "" ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Periodo</label>
                                            <select name="prueba[id_periodo]" id="" class="form-control" data-live-search="true" data-size="10" data-actions-box="true">
                                                <option value="0">--</option>
                                                <?php
                                                    if($periodos != false){
                                                        foreach ($periodos as $periodo) {
                                                        ?>
                                                            <option <?= ($prueba && $prueba["id_periodo"] == $periodo["id_periodo"]) ? "selected" : "" ?> value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-12 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Mostrar respuestas</label>
                                            <div class="custom-control custom-switch">
                                                <input <?= ($prueba && $prueba["mostrar_respuestas"] == 1) ? "checked" : "" ?> type="checkbox" name="prueba[mostrar_respuestas]" class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Mostrar respuestas correctas al finalizar prueba</label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        if(!$prueba) { ?>
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="asignacion-preguntas-1" name="asignacion_preguntas" value="1" checked>
                                                    <label class="custom-control-label" for="asignacion-preguntas-1">Asignacion de preguntas automatica</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="asignacion-preguntas-2" name="asignacion_preguntas" value="2">
                                                    <label class="custom-control-label" for="asignacion-preguntas-2">Asignacion de preguntas manual</label>
                                                </div>                                   
                                            </div>
                                        <?php }
                                    ?>
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

<?php
    if($prueba){ ?>
        <script>
            $(document).ready(() => {
                let contents = "<?= $prueba["descripcion_prueba"] ?>";
                editorRich.setContents(contents);

                $(".select-readonly").select2({disabled: true});
            })
        </script>
    <?php }
?>
</html>