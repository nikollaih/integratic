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
                        <div class="panel-heading text-capitalize"><b>Nueva pregunta</b></div>
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="descripcion_pregunta">Descripción *</label>
                                            <textarea required name="pregunta[descripcion_pregunta]" id="descripcion_pregunta" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Materia *</label>
                                            <select required name="pregunta[id_materia]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                    if($materias != false){
                                                        foreach ($materias as $materia) {
                                                        ?>
                                                            <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]. " - ".$materia["grado"] . "°"; ?></option>
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
                                            <select required name="pregunta[dificultad]" id="" class="form-control">
                                                <option value="">- Seleccionar</option>
                                                <option value="1">Fácil</option>
                                                <option value="2">Intermedia</option>
                                                <option value="3">Avanzada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Agregar Imagen </label>
                                            <input type="file" name="pregunta_archivo" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Nombre Autor </label>
                                            <input type="text" name="pregunta[nombre_author]" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="descripcion_pregunta">Comentarios</label>
                                            <p><b>Nota: </b>Los comentarios serán mostrados a los participantes déspues de finalizar la prueba.</p>
                                            <textarea name="pregunta[comentarios_pregunta]" id="comentarios_pregunta" cols="30" rows="5" class="form-control"></textarea>
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
                        
                    </div>

                    <div>
                        <a data-pregunta="1" style="cursor: pointer;" class="text-primary agregar-respuesta-pregunta"><b>Agregar Respuesta</b></a>
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
</html>