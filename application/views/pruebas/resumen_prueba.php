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
                                                    <div class="d-flex">
                                                        <h4><?= $prueba_realizada["nota"] ?></h4>
                                                    </div>
                                                </div>
                                                <?php
                                                    if(!$asignadas || $prueba["cantidad_preguntas"] != count($asignadas)){
                                                        ?>
                                                            <div class="alert alert-warning alert-dismissible show" role="alert">
                                                                La cantidad de preguntas asignadas a la prueba no corresponde con la cantidad solicitada.
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
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
                                                            <td><b>Calificación</b></td>
                                                            <td><?= $prueba_realizada["nota"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tipo</b></td>
                                                            <td><?= $prueba["tipo_prueba"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Cantidad de preguntas</b></td>
                                                            <td>Correctas: <b><?= info_prueba_realizada($prueba["id_prueba"], $id_participante)["correctas"] ?></b>, Total: <b><?= $prueba["cantidad_preguntas"] ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tiempo disponible</b></td>
                                                            <td><?= $prueba["duracion"] ?> Minutos</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tiempo utilizado</b></td>
                                                            <td><?= intval(round(abs(strtotime($prueba_realizada["created_at"]) - strtotime($prueba_realizada["finished_at"])) / 60,2)); ?> Minutos - ( <span style="font-size: 12px;"> <b>Inicio:</b> <?= date("Y-m-d h:i a", strtotime($prueba_realizada["created_at"])) ?> - <b>Fin:</b> <?= date("Y-m-d h:i a", strtotime($prueba_realizada["finished_at"])) ?> </span>)</td>
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
                                                            <p><?= $asignadas[$i]["descripcion_pregunta"] ?>
                                                                <?php
                                                                    if($asignadas[$i]["tipo_pregunta"] === "multiple") {
                                                                        echo ($respuestas) ? "" : " - ";
                                                                        ?><span class="text-danger"><?= ($respuestas) ? "" : "Sin responder" ?></span><?php
                                                                    }
                                                                ?>
                                                                <?php
                                                                if($asignadas[$i]["tipo_pregunta"] === "abierta") {
                                                                   if($respuestas_abiertas){
                                                                       for ($m = 0; $m < count($respuestas_abiertas); $m++) {
                                                                           $respondida = false;
                                                                           if($respuestas_abiertas[$m]["id_pregunta"] === $asignadas[$i]["id_pregunta"]){
                                                                               echo '- ' . '<span class="'.get_respuesta_text_color($respuestas_abiertas[$m]["es_correcta"]).'">'.$respuestas_abiertas[$m]["respuesta"].'</span>';

                                                                                if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                                                    <hr>
                                                                                    <form method="POST" action="">
                                                                                        <input type="hidden" value="<?= $respuestas_abiertas[$m]["id_respuesta_abierta"] ?>" name="id_respuesta_abierta">
                                                                                        <div>
                                                                                            <label for="calificacion_correcto_<?= $respuestas_abiertas[$m]["id_respuesta_abierta"] ?>">
                                                                                                <input type="radio" id="calificacion_correcto_<?= $respuestas_abiertas[$m]["id_respuesta_abierta"] ?>" name="es_correcta" value="1" <?= $respuestas_abiertas[$m]["es_correcta"] === "1" ? "checked" : "" ?> required>
                                                                                                Correcto
                                                                                            </label>
                                                                                            <label for="calificacion_incorrecto_<?= $respuestas_abiertas[$m]["id_respuesta_abierta"] ?>">
                                                                                                <input type="radio" id="calificacion_incorrecto_<?= $respuestas_abiertas[$m]["id_respuesta_abierta"] ?>" name="es_correcta" value="2" <?= $respuestas_abiertas[$m]["es_correcta"] === "2" ? "checked" : "" ?>>
                                                                                                Incorrecto
                                                                                            </label>
                                                                                        </div>

                                                                                        <button type="submit">Guardar Calificación</button>
                                                                                    </form>
                                                                            <?php }

                                                                            $respondida = true;
                                                                            $m = count($respuestas_abiertas);

                                                                           }
                                                                       }

                                                                       echo (!$respondida) ? '<span class="text-danger">- Sin responder</span>' : '';
                                                                   }
                                                                   else {
                                                                       echo '<span class="text-danger">Sin responder</span>';
                                                                   }

                                                                }
                                                                ?>
                                                            </p>

                                                            <?php
                                                                if($asignadas[$i]["archivo"] && $asignadas[$i]["nombre_archivo"]){
                                                            ?>
                                                                <img src="<?= base_url() ?>uploads/preguntas/<?= $asignadas[$i]["archivo"] ?>" alt="" srcset="" width="400" class="m-t-1 m-b-3">
                                                            <?php
                                                                }
                                                            ?>
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
                                                                                <div class="form-check prueba-respuesta">
                                                                                    <input disabled <?= ($rp["id_respuesta_pregunta_prueba"] == $respuestas[$r]["id_respuesta"]) ? "checked" : "" ?> type="radio" name="" id=""> <span class="<?= (($rp["id_respuesta_pregunta_prueba"] == $respuestas[$r]["id_respuesta"] || $rp["tipo_respuesta"] == 1) && $prueba["mostrar_respuestas"]) ? ($rp["tipo_respuesta"] == 1) ? 'text-success' : 'text-danger' : '' ?>"><?= ($rp["id_respuesta_pregunta_prueba"] == $respuestas[$r]["id_respuesta"] || $rp["tipo_respuesta"] == 1) ? ($rp["tipo_respuesta"] == 1 && $prueba["mostrar_respuestas"] == 1) ? 'Correcta: ' : '' : '' ?><?= $rp["descripcion_respuesta"] ?></span>
                                                                                    <?php
                                                                                        if( $rp["archivo_respuesta"] &&  $rp["nombre_archivo_respuesta"]){
                                                                                    ?>
                                                                                        <br><img style="margin: 5px 0px 5px -1px;" src="<?= base_url() ?>uploads/respuestas/<?=  $rp["archivo_respuesta"] ?>" alt="" srcset="" width="400" class="m-t-3" style="margin-left:15px;">
                                                                                    <?php
                                                                                        }
                                                                                    ?>
                                                                                </div>
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
                                                                            <div class="form-check prueba-respuesta">
                                                                                <input disabled type="radio" name="" id=""> <span class=""><?= $rp["descripcion_respuesta"] ?></span>
                                                                                <?php
                                                                                    if( $rp["archivo_respuesta"] &&  $rp["nombre_archivo_respuesta"]){
                                                                                ?>
                                                                                    <br><img style="margin: 5px 0px 5px -1px;" src="<?= base_url() ?>uploads/respuestas/<?=  $rp["archivo_respuesta"] ?>" alt="" srcset="" width="200" class="m-t-3" style="margin-left:15px;">
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                            </div>
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