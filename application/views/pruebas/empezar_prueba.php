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
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                <div class="subtitle-buttons">
                                                    <h4><?= $prueba["nombre_prueba"] ?></h4>
                                                    <div class="d-flex">
                                                        <?php
                                                            if($asignadas && $prueba["cantidad_preguntas"] == count($asignadas) && $prueba["fecha_inicio"] <= date("Y-m-d H:i:s") && $prueba["fecha_finaliza"] > date("Y-m-d H:i:s")){
                                                                ?>
                                                                    <a href="<?= base_url() ?>Pruebas/resolver/<?= $prueba["id_prueba"] ?>" class="btn btn-info">Comenzar Prueba</a>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php
                                                    if(!$asignadas || $prueba["cantidad_preguntas"] != count($asignadas)){
                                                        ?>
                                                            <div class="alert alert-warning alert-dismissible show" role="alert">
                                                                La cantidad de preguntas asignadas a la prueba no corresponde con la cantidad solicitada.
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
                                                <p><?= $prueba["descripcion_prueba"] ?></p>
                                                <p><b>Tipo: </b><?= $prueba["tipo_prueba"] ?></p>
                                                <p><b>Cantidad de preguntas: </b><?= ($asignadas) ? count($asignadas) : "0" ?></p>
                                                <p><b>Tiempo disponible: </b><?= $prueba["duracion"] ?> Minutos</p>
                                                <p><b>Disponible desde: </b><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_inicio"])) ?></p>
                                                <p><b>Disponible hasta: </b><?= date("d/m/Y - h:i a", strtotime($prueba["fecha_finaliza"])) ?></p>
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
                                            <div class="col-md-6">
                                                <img src="<?= base_url() ?>images/instrucciones_prueba.png" alt="" srcset="" width="100%">
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