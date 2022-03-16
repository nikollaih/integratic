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
                                        <b>Resumen</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="subtitle-buttons">
                                                    <h4><?= $prueba["nombre_prueba"] ?></h4>
                                                    <div class="d-flex">
                                                        <h4><?= $prueba_realizada["calificacion"] ?>%</h4>
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
                                                <p><b>Calificación: </b><span><?= $prueba_realizada["calificacion"] ?>%</span></p>
                                                <p><b>Tipo: </b><?= $prueba["tipo_prueba"] ?></p>
                                                <p><b>Cantidad de preguntas:  </b> Correctas: <b><?= info_prueba_realizada($prueba["id_prueba"], $id_participante)["correctas"] ?></b>, Total: <b><?= $prueba["cantidad_preguntas"] ?></b></p>
                                                <p><b>Tiempo disponible:  </b> <?= $prueba["duracion"] ?> Minutos</p>
                                                <p><b>Tiempo utilizado:  </b> <?= intval(round(abs(strtotime($prueba_realizada["created_at"]) - strtotime($prueba_realizada["finished_at"])) / 60,2)); ?> Minutos - ( <span style="font-size: 12px;"> <b>Inicio:</b> <?= date("Y-m-d h:i a", strtotime($prueba_realizada["created_at"])) ?> - <b>Fin:</b> <?= date("Y-m-d h:i a", strtotime($prueba_realizada["finished_at"])) ?> </span>)</p>
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

                        <?php
                            if($asignadas){
                                $x = 1;
                                for ($i=0; $i < count($asignadas); $i++) { 
                                    $asignadas_pregunta = obtener_respuestas_pregunta($asignadas[$i]["id_pregunta"]);
                        ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-capitalize">
                                                    <b>Pregunta <?= $x ?></b>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                            <p><?= $asignadas[$i]["descripcion_pregunta"] ?><?= ($respuestas) ? "" : " - " ?> <span class="text-danger"><?= ($respuestas) ? "" : "Sin responder" ?></span></p>
                                                            <br>
                                                            <?php
                                                                if($asignadas[$i]["comentarios_pregunta"]){
                                                                    ?>
                                                                    <div class="alert alert-warning alert-dismissible show" role="alert">
                                                                        <?= $asignadas[$i]["comentarios_pregunta"] ?>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <?php
                                                            if($asignadas_pregunta){
                                                                foreach ($asignadas_pregunta as $rp) {
                                                                    $validada = 1;
                                                                    if($respuestas){
                                                                        for ($r=0; $r < count($respuestas); $r++) {
                                                                            $validada++;
                                                                            if($asignadas[$i]["id_pregunta"] == $respuestas[$r]["id_pregunta"]){
                                                                                $validada = 1;
                                                                                ?>
                                                                                    <input disabled <?= ($rp["id_respuesta_pregunta_prueba"] == $respuestas[$r]["id_respuesta"]) ? "checked" : "" ?> type="radio" name="" id=""> <span class="<?= ($rp["id_respuesta_pregunta_prueba"] == $respuestas[$r]["id_respuesta"] || $rp["tipo_respuesta"] == 1) ? ($rp["tipo_respuesta"] == 1) ? 'text-success' : 'text-danger' : '' ?>"><?= $rp["descripcion_respuesta"] ?></span>
                                                                                    <br>
                                                                                <?php
                                                                            }
                                                                            /*else{
                                                                                if($validada == count($asignadas)){
                                                                                    echo $validada;
                                                                                echo count($asignadas);
                                                                                    $validada = 1;
                                                                                    ?>
                                                                                        <input disabled type="radio" name="" id=""> <span class=""><?= $rp["descripcion_respuesta"] ?></span>
                                                                                        <br>
                                                                                    <?php
                                                                                }
                                                                            }*/
                                                                        }
                                                                    }
                                                                    else{
                                                                        ?>
                                                                            <input disabled type="radio" name="" id=""> <span class=""><?= $rp["descripcion_respuesta"] ?></span>
                                                                            <br>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    $x++;
                                }
                            }
                        ?>
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