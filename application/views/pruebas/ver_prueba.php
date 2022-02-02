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
                                    <div class="panel-heading text-capitalize">
                                        <b>Prueba</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="subtitle-buttons">
                                                    <h4><?= $prueba["nombre_prueba"] ?></h4>
                                                    <div class="d-flex">
                                                        <a href="<?= base_url() ?>Pruebas/asignarPreguntas/<?= $prueba["id_prueba"] ?>" class="btn btn-info">Configurar preguntas</a>
                                                        <a href="<?= base_url() ?>Pruebas/participantes/<?= $prueba["id_prueba"] ?>" class="btn btn-success m-l-1">Participantes</a>
                                                    </div>
                                                </div>
                                                <hr>
                                                <p><?= $prueba["descripcion_prueba"] ?></p>
                                                <p><b>Alcance: </b><?= $prueba["alcance_prueba"] ?></p>
                                                <p><b>Tipo: </b><?= $prueba["tipo_prueba"] ?></p>
                                                <p><b>Cantidad de preguntas: </b><?= ($preguntas) ? count($preguntas) : "0" ?>/<?= $prueba["cantidad_preguntas"] ?></p>
                                                <p><b>Inicia: </b><?= date("d F, Y", strtotime($prueba["fecha_inicio"])) ?></p>
                                                <p><b>Finaliza: </b><?= date("d F, Y", strtotime($prueba["fecha_finaliza"])) ?></p>
                                                <p><b>Fecha de creación: </b><?= date("d F, Y", strtotime($prueba["created_at"])) ?></p>
                                                <p>
                                                    <b>Dificultad: </b>
                                                    <?php
                                                        if($dificultad){
                                                            for ($i=0; $i < count($dificultad); $i++) { 
                                                                echo "<span>".$dificultad[$i]." </span>";
                                                            }
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
                <div class="row">
                <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Preguntas</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <?php
                                                    if($preguntas){
                                                        $x = 1;
                                                        foreach ($preguntas as $pregunta) {
                                                ?>
                                                            <p><?= "<b>".$x.".</b> ".$pregunta["descripcion_pregunta"] ?></p>
                                                <?php
                                                            $x++;
                                                        }
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
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>