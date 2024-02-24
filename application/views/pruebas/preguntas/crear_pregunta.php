<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <form action="" method="post" enctype="multipart/form-data" id="form-pregunta">
                    <input type="hidden" name="pregunta[id_pregunta_prueba]" id="" value="<?= ($pregunta) ? $pregunta["id_pregunta_prueba"] : "" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Nueva pregunta</b></div>
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="descripcion_pregunta">Descripción *</label>
                                            <textarea name="pregunta[descripcion_pregunta]" id="textarea_richtext" cols="30" rows="5" class="form-control" style="display: none"></textarea>
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
                                            <label for="">Materia *</label>
                                            <select required name="pregunta[id_materia]" id="crear-prueba-materia" class="form-control select-materia">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($materias != false){
                                                        foreach ($materias as $materia) {
                                                        ?>
                                                            <option <?= (isset($pregunta["id_materia"]) && $pregunta["id_materia"] ==  $materia["codmateria"]) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]. " - ".$materia["grado"] . "°"; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Dificultad *</label>
                                            <select required name="pregunta[dificultad][]" id="" class="form-control multiple-select" multiple data-live-search="true" data-actions-box="true" data-actions-box="true">
                                                <?php $selectedDificultad = ($pregunta) ? unserialize($pregunta["dificultad"]) : []; ?>
                                                <option <?= (in_array("1", $selectedDificultad)) ? "selected" : "" ?> value="1">Facil</option>
                                                <option <?= (in_array("2", $selectedDificultad)) ? "selected" : "" ?> value="2">Intermedia</option>
                                                <option <?= (in_array("3", $selectedDificultad)) ? "selected" : "" ?> value="3">Avanzada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Tema</label>
                                            <select name="pregunta[id_tema]" id="crear-prueba-tema" class="form-control select-tema">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if(count($temas) > 0){
                                                        foreach ($temas as $tema) { ?>
                                                            <option <?= ($tema["id_tema"] == $pregunta["id_tema"]) ? "selected" : "" ?> value="<?= $tema["id_tema"] ?>"><?= $tema["nombre_tema"] ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Agregar Imagen </label>
                                            <input type="file" name="pregunta_archivo" accept="image/*" class="form-control">
                                        </div>
                                        <?php 
                                            if(isset($pregunta["archivo"]) && trim($pregunta["archivo"]) != ""){ ?>
                                                <div class="m-b-2">
                                                    <a target="_blank" href="<?= base_url() ?>uploads/preguntas/<?= $pregunta["archivo"] ?>"><?= $pregunta["nombre_archivo"] ?></a>
                                                </div>
                                            <?php }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Nombre Autor </label>
                                            <input type="text" name="pregunta[nombre_author]" class="form-control" value="<?= ($pregunta) ? $pregunta["nombre_author"] : "" ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Comentarios</label>
                                            <p><b>Nota: </b>Los comentarios serán mostrados a los participantes déspues de finalizar la prueba.</p>
                                            <textarea name="pregunta[comentarios_pregunta]" id="comentarios_pregunta" cols="30" rows="5" class="form-control"><?= ($pregunta) ? $pregunta["comentarios_pregunta"] : "" ?></textarea>
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

                    <div id="contenedor-respuestas">
                        <?php
                            $x = 1;
                            foreach ($respuestas as $respuesta) { ?>
                                <div class="panel panel-primary">
                                    <input type="hidden" name="respuesta<?= $x ?>[id_respuesta_pregunta_prueba]" id="" value="<?= $respuesta["id_respuesta_pregunta_prueba"] ?>">
                                    <div style="background-color: #0b6069;" class="panel-heading text-capitalize d-flex justify-between align-items-center">
                                        <b>Respuesta #<?= $x ?></b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Descripción </label>
                                                    <textarea name="respuesta<?= $x ?>[descripcion_respuesta]" id="" cols="30" rows="5" class="form-control"><?= $respuesta["descripcion_respuesta"] ?></textarea></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Agregar Imagen </label>
                                                    <input name="respuesta<?= $x ?>[archivo_respuesta]" accept="image/*" type="file" class="form-control">
                                                </div>
                                                <?php 
                                                    if(trim($respuesta["archivo_respuesta"]) != ""){ ?>
                                                        <a target="_blank" href="<?= base_url() ?>uploads/respuestas/<?= $respuesta["archivo_respuesta"] ?>"><?= $respuesta["nombre_archivo_respuesta"] ?></a>
                                                    <?php }
                                                ?>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-3">
                                                <div class="form-group">
                                                <label for="">Tipo respuesta </label>
                                                <select name="respuesta<?= $x ?>[tipo_respuesta]" id="" class="form-control">
                                                    <option value="">- Seleccionar</option>
                                                    <option <?= ($respuesta["tipo_respuesta"] == 1) ? "selected" : "" ?> value="1">Correcta</option>
                                                    <option <?= ($respuesta["tipo_respuesta"] == 0) ? "selected" : "" ?> value="0">Incorrecta</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            <?php 
                            $x++;
                            }
                        ?>
                    </div>

                    <div>
                        <a data-pregunta="<?= $x ?>" style="cursor: pointer;" class="text-primary agregar-respuesta-pregunta"><b>Agregar Respuesta</b></a>
                        <i class="fa fa-plus text-primary"></i>
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

<?php
    if($pregunta){ ?>
        <script>
            $(document).ready(() => {
                let contents = "<?= $pregunta["descripcion_pregunta"] ?>";
                editorRich.setContents(contents);
            })
        </script>
    <?php }
?>