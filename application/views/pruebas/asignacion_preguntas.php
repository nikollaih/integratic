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
                                    <div class="panel-heading text-capitalize"><b>Prueba</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <h4><?= $prueba["nombre_prueba"] ?></h4>
                                                <hr>
                                                <p class="m-b-1"><?= $prueba["descripcion_prueba"] ?></p>
                                                <div id="prueba-extra-info" class="m-b-1">
                                                    <p><b>Alcance: </b><?= $prueba["alcance_prueba"] ?></p>
                                                    <p><b>Tipo: </b><?= $prueba["tipo_prueba"] ?></p>
                                                    <p><b>Cantidad de preguntas: </b><?= ($asignadas) ? count($asignadas) : "0" ?>/<?= $prueba["cantidad_preguntas"] ?></p>
                                                    <p><b>Duración: </b><?= $prueba["duracion"] ?> Minutos</p>
                                                    <p><b>Disponible desde: </b><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_inicio"])) ?></p>
                                                    <p><b>Disponible hasta: </b><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_finaliza"])) ?></p>
                                                    <p><b>Fecha de creación: </b><?= date("d F, Y", strtotime($prueba["created_at"])) ?></p>
                                                    <p>
                                                        <b>Dificultad: </b>
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
                                                    </p>
                                                    <p><b>Materias: </b></p>
                                                    <?php
                                                        if($materias){
                                                            echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                            foreach ($materias as $materia) {
                                                                echo "<li>".$materia["nommateria"]." - ".$materia["grado"]."°</li>";
                                                            }
                                                            echo "</ul>";
                                                        }
                                                    ?>
                                                </div>
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
                                    <div class="panel-heading text-capitalize"><b>Asignar preguntas</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <table class="table table-hovered table-bordered table-stripped">
                                                    <thead>
                                                        <tr>
                                                            <th>Pregunta</th>
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