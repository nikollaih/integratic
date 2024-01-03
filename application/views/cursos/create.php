<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("cursos/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <form action="" method="post" enctype="multipart/form-data" id="form-curso">
                    <input type="hidden" name="curso[id_curso]" id="" value="<?= ($curso) ? $curso["id_curso"] : "" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b><?= ($curso) ? "Modificar" : "Nuevo" ?> curso</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Titulo *</label>
                                        <input type="text" name="curso[nombre_curso]" id="" class="form-control" value="<?= ($curso) ? $curso["nombre_curso"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Grupos *</label>
                                        <select required multiple name="curso[grados][]" data-live-search="true" data-actions-box="true" data-actions-box="true" class="form-control multiple-select">
                                            <?php
                                                if($grados != false){
                                                    $selectedGrados = ($curso) ? unserialize($curso["grados"]) : [];
                                                    foreach ($grados as $grado) {
                                                    ?>
                                                        <option <?= (in_array($grado["grado"], $selectedGrados)) ? "selected" : "" ?> value="<?= $grado["grado"] ?>"><?= $grado["grado"]; ?></option>
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
                                        <input type="datetime-local" name="curso[disponible_desde]" class="form-control" id="" value="<?= ($curso) ? $curso["disponible_desde"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Disponible hasta *</label>
                                        <input type="datetime-local" name="curso[disponible_hasta]" class="form-control" id="" value="<?= ($curso) ? $curso["disponible_hasta"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Archivos</label>
                                        <input type="file" name="archivos[]" multiple class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="descripcion_curso">Descripción *</label>
                                        <textarea name="curso[descripcion_curso]" id="textarea_richtext" cols="30" rows="5" class="form-control" style="display: none"></textarea>
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
                                <?php
                                    if($archivos){ ?>
                                    <div class="col-md-12 col-sm-12 col-lg-12 m-t-2">
                                        <h5 class="m-t-2">Archivos adjuntos</h5>
                                        <table id="tabla-archivos_curso" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Fecha de creación</th>
                                                    <th></th>
                                                </tr>
                                                <tbody>
                                                    <?php
                                                        foreach ($archivos as $archivo) { ?>
                                                            <tr id="archivo-curso-<?= $archivo["id_archivo_curso"] ?>">
                                                                <td><a target="_blank" href="<?= base_url().'uploads/cursos/'.$curso["id_curso"].'/'.$archivo["slug_archivo"] ?>"><?= $archivo["nombre_archivo"] ?></a></td>
                                                                <td><?= date("Y-m-d h:i a", strtotime($archivo["created_at"])) ?></td>
                                                                <td style="width:100px;"><a  data-id="<?= $archivo["id_archivo_curso"] ?>" class="btn btn-danger btn-sm btn-eliminar-archivo-curso">Eliminar</a></td>
                                                            </tr>
                                                        <?php }
                                                    ?>
                                                </tbody>
                                            </thead>
                                        </table>
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
</html>

<?php
    if($curso){ ?>
        <script>
            $(document).ready(() => {
                let contents = '<?= $curso["descripcion_curso"] ?>';
                editorRich.setContents(contents);
            })
        </script>
    <?php }
?>