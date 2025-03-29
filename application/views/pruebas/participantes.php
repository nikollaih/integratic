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
                                                            <td><b>Temas</b></td>
                                                            <td>
                                                                <?php
                                                                if($temas){
                                                                    echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                                    for ($i=0; $i < count($temas); $i++) {
                                                                        echo "<li>".$temas[$i]['nombre_tema']."</li>";
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

                                            <?php
                                            if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                <div class="row m-b-2">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div>
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="file" value="false">
                                                                <label for="prueba-participantes-file">Importar participantes desde archivo</label>
                                                                <input required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" type="file" name="participantes" id="prueba-participantes-file">
                                                                <button class="btn btn-sm btn-success m-t-1" type="submit">Importar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div>
                                                            <form method="post">
                                                                <label for="prueba-participantes-file">Asignar participantes desde grupo</label>
                                                                <select required class="form-control" name="grado" id="prueba-participantes-grado">
                                                                    <option value="null">- Seleccionar grupo</option>
                                                                    <?php
                                                                    if($grupos_materia){
                                                                        foreach ($grupos_materia as $gm) {
                                                                            ?>
                                                                            <option value="<?= $gm["grado"].$gm["grupo"] ?>"><?= $gm["nommateria"]." - ".$gm["grado"]."°".$gm["grupo"] ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <select required name="estudiantes[]" id="prueba-participantes-estudiantes" class="form-control multiple-select" multiple data-live-search="true" data-actions-box="true" data-actions-box="true">
                                                                </select>
                                                                <button class="btn btn-sm btn-success m-t-1" type="submit">Asignar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                    
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <a class="btn btn-primary" href="<?= base_url() ?>Exports/exportarPruebaNotas/<?= $prueba["id_prueba"] ?>" target="_blank" rel="noopener noreferrer">Exportar Excel de Notas</a>
                                                <table id="tabla-participantes" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Identificación</th>
                                                            <th>Nombre Completo</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <?php
                                                                if(configuracion()["departamental"] == "1") {
                                                                    echo "<th>Municipio</th><th>Institución</th>";
                                                                }
                                                            ?>
                                                            <th>Grado</th>
                                                            <th>Nota</th>
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
                                                            <td><p><?= $participante["apellidos"]." ".$participante["nombres"] ?></p></td>
                                                            <td><p><?= $participante["telefono"] ?></p></td>
                                                            <td><p><?= $participante["email"] ?></p></td>
                                                            <?php
                                                                if(configuracion()["departamental"] == "1") {
                                                                    echo "<td>".$participante["municipio"]."</td>";
                                                                    ?>
                                                                    <td><p><?= $participante["nombre_institucion"] ?></p></td>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <td><p><?= ($info_prueba["porcentaje"] == null) ? $participante["grado"] : $info_prueba["grado"] ?></p></td>
                                                            <td class="text-center"><p><?= ($info_prueba["porcentaje"] == null) ? "" : $info_prueba["calificacion"] ?></p></td>
                                                            <td class="text-center">
                                                                <?php
                                                                    if($info_prueba["porcentaje"] == null && $info_prueba["cerrada"] != 1){
                                                                        if(strtolower(logged_user()["rol"]) === "docente"){
                                                                        ?>
                                                                            <button data-prueba="<?= $prueba["id_prueba"] ?>" data-participante="<?= $participante["id_participante_prueba"] ?>" class="btn btn-danger btn-sm btn-eliminar-participante">Eliminar participante</button>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <a href="<?= base_url() ?>Pruebas/resumen/<?= $prueba["id_prueba"] ?>/<?= $participante["id_participante_prueba"] ?>">
                                                                            <button class="btn btn-success btn-sm">Ver Resumen</button>
                                                                        </a>
                                                                        <a href="<?= base_url() ?>EstadisticasPruebas/participante/<?= $participante["identificacion"] ?>/<?= $participante["id_participante_prueba"] ?>">
                                                                            <button class="btn btn-info btn-sm">Ver estadisticas</button>
                                                                        </a>
                                                                        <button data-prueba="<?= $prueba["id_prueba"] ?>" data-participante="<?= $participante["id_participante_prueba"] ?>" class="btn btn-danger btn-sm btn-eliminar-intento-prueba">Eliminar intento</button>
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

<script>
    $(document).ready( function () {
        $('.multiple-select').selectpicker({
            noneSelectedText: "- Seleccionar estudiantes",
            selectAllText : "Seleccionar todos",
            deselectAllText: "Deseleccionar todos"
        });
        $('#tabla-participantes').DataTable({
            order: [1, 'asc'],
            pageLength: 25
        });
        $("#prueba-participantes-estudiantes").parent().css("display", "none");
    } );
</script>
