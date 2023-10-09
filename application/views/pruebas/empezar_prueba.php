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
                                            <?php
                                                if($asignadas && $prueba["estado"] == 1 && $prueba["cantidad_preguntas"] == count($asignadas) && $prueba["fecha_inicio"] <= date("Y-m-d H:i:s") && $prueba["fecha_finaliza"] > date("Y-m-d H:i:s")){
                                                    ?>
                                                    <div class="subtitle-buttons">
                                                        <a href="<?= base_url() ?>Pruebas/resolver/<?= $prueba["id_prueba"] ?>" class="btn btn-info">Comenzar Prueba</a>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                }
                                            ?>

                                            <?php
                                                if(isset(logged_user()["participante_prueba"])){
                                                    $info_prueba = info_prueba_realizada($prueba["id_prueba"], logged_user()["participante_prueba"]["id_participante_prueba"]);
                                                    if($info_prueba["cerrada"] == 1){
                                                        ?>
                                                            <div class="subtitle-buttons">
                                                                <a href="<?= base_url() ?>Pruebas/resumen/<?= $prueba["id_prueba"] ?>" class="btn btn-info">Ver Resumen</a>
                                                            </div>
                                                            <hr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                                                    
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