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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><b>Prueba</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Titulo</b></td>
                                                            <td><?= $prueba["nombre_prueba"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Descripción</b></td>
                                                            <td><?= $prueba["descripcion_prueba"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Alcance</b></td>
                                                            <td><?= $prueba["alcance_prueba"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tipo</b></td>
                                                            <td><?= $prueba["tipo_prueba"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Cantidad de preguntas</b></td>
                                                            <td><?= ($asignadas) ? count($asignadas) : "0" ?>/<?= $prueba["cantidad_preguntas"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Duración</b></td>
                                                            <td><?= $prueba["duracion"] ?> Minutos</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Disponible desde</b></td>
                                                            <td><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_inicio"])) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Disponible hasta</b></td>
                                                            <td><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_finaliza"])) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Fecha de creación</b></td>
                                                            <td><?= date("d F, Y", strtotime($prueba["created_at"])) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Dificultad</b></td>
                                                            <td>
                                                                <?php
                                                                    if($dificultad){
                                                                        echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                                        for ($i=0; $i < count($dificultad); $i++) { 
                                                                            if ($dificultad[$i] == 1) {
                                                                                $dificultad_seleccionada = "Fácil";
                                                                            } else if($dificultad[$i] == 2) {
                                                                                $dificultad_seleccionada = "Intermedia";
                                                                            }else{
                                                                                $dificultad_seleccionada = "Avanzada";
                                                                            }
                                                                            
                                                                            echo "<li>".$dificultad_seleccionada."</li>";
                                                                        }
                                                                        echo "</ul>";
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Temas</b></td>
                                                            <td>
                                                                <?php
                                                                if($temasSeleccionados){
                                                                    echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                                    for ($i=0; $i < count($temasSeleccionados); $i++) {
                                                                        echo "<li>".$temasSeleccionados[$i]['nombre_tema']."</li>";
                                                                    }
                                                                    echo "</ul>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Materias</b></td>
                                                            <td>
                                                                <?php
                                                                    if($materias){
                                                                        echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                                        foreach ($materias as $materia) {
                                                                            echo "<li>".$materia["nommateria"]." - ".$materia["grado"]."°</li>";
                                                                        }
                                                                        echo "</ul>";
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><b>Asignar preguntas</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Pregunta</th>
                                                            <th>Tema</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if($preguntas){
                                                            foreach ($preguntas as $pregunta) {
                                                    ?>
                                                        <tr>
                                                            <td><p><?= $pregunta["descripcion_pregunta"] ?></p></td>
                                                            <td><p><?= $pregunta["nombre_tema"] ?></p></td>
                                                            <td class="text-center" id="pregunta-<?= $pregunta["id_pregunta_prueba"] ?>">
                                                                <?php
                                                                    if(in_array($pregunta["id_pregunta_prueba"], $asignadas_ids)){
                                                                    ?>
                                                                        <button data-prueba="<?= $prueba["id_prueba"] ?>" data-pregunta="<?= $pregunta["id_pregunta_prueba"] ?>" class="btn btn-danger btn-sm btn-asignacion-pregunta">Desasignar</button>
                                                                    <?php
                                                                    }
                                                                    else{
                                                                    ?>
                                                                        <button data-prueba="<?= $prueba["id_prueba"] ?>" data-pregunta="<?= $pregunta["id_pregunta_prueba"] ?>" class="btn btn-success btn-sm btn-asignacion-pregunta">Asignar</button>
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