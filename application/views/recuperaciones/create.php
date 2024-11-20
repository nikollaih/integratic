<?php $this->load->view("in_head") ?>
    <body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("recuperaciones/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas"></div>
                <form action="" method="post" id="form-recuperacion" enctype="multipart/form-data">
                    <input type="hidden" name="recuperacion[id_recuperacion]" id="" value="<?= ($recuperacion) ? $recuperacion["id_recuperacion"] : "" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= ($recuperacion) ? "Modificar" : "Nuevo" ?> recuperacion</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-9">
                                    <div class="form-group">
                                        <label for="">Titulo *</label>
                                        <input type="text" required name="recuperacion[title]" id="" class="form-control" value="<?= ($recuperacion) ? $recuperacion["title"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Periodo *</label>
                                        <select required name="recuperacion[id_periodo]" class="form-control">
                                            <?php
                                            if($periodos){
                                                foreach ($periodos as $periodo) {
                                                    ?>
                                                    <option value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Materia *</label>
                                        <select required name="recuperacion[materia]" class="form-control">
                                            <?php
                                            if($materias){
                                                foreach ($materias as $materia) {
                                                    ?>
                                                    <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"].' - '.$materia["grado"]; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Grupo *</label>
                                        <select required name="recuperacion[grupo]" class="form-control">
                                            <?php
                                            if($grupos){
                                                foreach ($grupos as $grupo) {
                                                    ?>
                                                    <option value="<?= $grupo["grupo"] ?>"><?= $grupo["grupo"]; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Disponible desde *</label>
                                        <input required type="datetime-local" name="recuperacion[disponible_desde]" class="form-control" id="" value="<?= ($recuperacion) ? $recuperacion["disponible_desde"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Disponible hasta *</label>
                                        <input required type="datetime-local" name="recuperacion[disponible_hasta]" class="form-control" id="" value="<?= ($recuperacion) ? $recuperacion["disponible_hasta"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="description">Descripción *</label>
                                        <textarea name="recuperacion[description]" id="textarea_richtext" cols="30" rows="5" class="form-control" style="display: none"></textarea>
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

<?php
    if($recuperacion){ ?>
        <script>
            $(document).ready(() => {
                let contents = '<?= $recuperacion["description"] ?>';
                editorRich.setContents(contents);
            })
        </script>
    <?php }
?>