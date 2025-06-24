<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Importar preguntas y respuestas</b></div>
                            <div class="panel-body">
                                <form id="import-form" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Materia *</label>
                                                <select required name="id_materia" id="select-materia-importar" class="form-control">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($materias != false){
                                                            foreach ($materias as $materia) {
                                                            ?>
                                                                <option <?= ($id_materia == $materia["codmateria"]) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]. " - ".$materia["grado"] . "°"; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Preguntas</label>
                                                <input required type="file" name="archivo_preguntas" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Respuestas </label>
                                                <input type="file" name="archivo_respuestas" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <hr>
                                            <button class="btn btn-success btn-guardar-importar" type="submit">Importar ahora</button>
                                        </div>
                                    </div>
                                </form>
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
                    </div>
                </div>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>