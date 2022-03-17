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
                                    <div class="panel-heading text-capitalize"><b>Participantes</b></div>
                                    <div class="panel-body">
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
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="m-b-2">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="file" value="false">
                                                        <label for="prueba-participantes-file">Seleccionar archivo de participantes</label>
                                                        <input required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" type="file" name="participantes" id="prueba-participantes-file">
                                                        <button class="btn btn-sm btn-success m-t-1" type="submit">Importar</button>
                                                    </form>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Identificación</th>
                                                            <th>Nombre Completo</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <th>Institución</th>
                                                            <th>Grado</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if($participantes){
                                                            foreach ($participantes as $participante) {
                                                                $info_prueba = info_prueba_realizada($prueba["id_prueba"], $participante["id_participante_prueba"]);
                                                    ?>
                                                        <tr id="participante-<?= $participante["id_participante_prueba"] ?>">
                                                            <td><p><?= $participante["identificacion"] ?></p></td>
                                                            <td><p><?= $participante["nombres"]." ".$participante["apellidos"] ?></p></td>
                                                            <td><p><?= $participante["telefono"] ?></p></td>
                                                            <td><p><?= $participante["email"] ?></p></td>
                                                            <td><p><?= ($info_prueba["porcentaje"] == null) ? $participante["institucion"] : $info_prueba["institucion"] ?></p></td>
                                                            <td><p><?= ($info_prueba["porcentaje"] == null) ? $participante["grado"] : $info_prueba["grado"] ?></p></td>
                                                            <td class="text-center">
                                                                <?php
                                                                    if($info_prueba["porcentaje"] == null){
                                                                        ?>
                                                                            <button data-prueba="<?= $prueba["id_prueba"] ?>" data-participante="<?= $participante["id_participante_prueba"] ?>" class="btn btn-danger btn-sm btn-eliminar-participante">Eliminar</button>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <a href="<?= base_url() ?>Pruebas/resumen/<?= $prueba["id_prueba"] ?>/<?= $participante["id_participante_prueba"] ?>">
                                                                            <button class="btn btn-success btn-sm">Ver Resumen</button>
                                                                        </a>
                                                                        <a href="<?= base_url() ?>EstadisticasPruebas/participante/<?= encrypt_string($participante["identificacion"], true) ?>/<?= $participante["id_participante_prueba"] ?>">
                                                                            <button class="btn btn-info btn-sm">Ver estadisticas</button>
                                                                        </a>
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