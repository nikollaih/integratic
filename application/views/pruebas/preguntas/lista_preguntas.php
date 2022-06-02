<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="" id="id-materia-preguntas">
                                    <option value="null">Todas las materias</option>
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
                        <div class="col-md-6 text-right">
                            <?php
                                if($id_materia){
                            ?>
                                    <a href="<?= base_url() ?>PreguntasPrueba/importar/<?= $id_materia ?>"><button class="btn btn-success m-b-2">Importar</button></a>
                            <?php
                                }
                            ?>

                            <?php
                                if($id_materia && $preguntas != false){
                            ?>
                                    <button data-materia="<?= $id_materia ?>" id="btn-exportar-preguntas" class="btn btn-primary m-b-2">Exportar Preguntas</button>
                                    <button data-materia="<?= $id_materia ?>" id="btn-exportar-respuestas" class="btn btn-primary m-b-2">Exportar Respuestas</button>
                            <?php
                                }
                            ?>
                        </div>    
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Lista de preguntas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                <?php
                                    if($id_materia && $preguntas != false){
                                        ?>
                                            <div class="alert alert-warning">
                                                <label style="display: inline-flex;">
                                                    <input id="exportar-todas-check" type="checkbox" name="" id="">
                                                    <h5 style="margin:3px 10px;">Exportar todas</h5>
                                                </label> 
                                            </div>
                                            <?php
                                    }
                                ?>
                                    <table id="tabla-preguntas" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <?= ($id_materia) ? "<th>Exportar</th>" : "" ?>
                                                <th>Id</th>
                                                <th>Materia</th>
                                                <th>Dificultad</th>
                                                <th>Pregunta</th>
                                                <th>Fecha de creación</th>
                                                <th style="width:150px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($preguntas != false){
                                                    foreach ($preguntas as $pregunta) {
                                                        ?>
                                                            <tr id="pregunta-<?= $pregunta["id_pregunta_prueba"] ?>">
                                                                <?php 
                                                                    if($id_materia){
                                                                        ?>
                                                                            <td><input data-id="<?= $pregunta["id_pregunta_prueba"] ?>" class="form-check-input check-exportar-pregunta" type="checkbox" name="" id=""></td>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                <td><?= $pregunta["id_pregunta_prueba"] ?></td>
                                                                <td><?= $pregunta["nommateria"]." - ".$pregunta["grado"]."°" ?></td>
                                                                <td><?= get_pregunta_dificultad($pregunta["dificultad"]) ?></td>
                                                                <td><?= $pregunta["descripcion_pregunta"] ?></td>
                                                                <td><?= date("d F Y H:i a", strtotime($pregunta["created_at"])) ?></td>
                                                                <td class="text-center">
                                                                    <a target="_blank" class="btn btn-success" href="<?= base_url() ?>PreguntasPrueba/ver/<?= $pregunta["id_pregunta_prueba"] ?>">Ver</a>
                                                                    <?php
                                                                        if(logged_user()["id"] == $pregunta["created_by"]){
                                                                            ?>
                                                                                <a data-pregunta="<?= $pregunta["id_pregunta_prueba"] ?>" class="btn btn-danger btn-eliminar-pregunta">Eliminar</a>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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