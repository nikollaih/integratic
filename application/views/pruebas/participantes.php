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
                                                <div id="prueba-extra-info" class="m-b-1" style="display: none;">
                                                    <p><b>Alcance: </b><?= $prueba["alcance_prueba"] ?></p>
                                                    <p><b>Tipo: </b><?= $prueba["tipo_prueba"] ?></p>
                                                    <p><b>Cantidad de preguntas: </b><?= ($asignadas) ? count($asignadas) : "0" ?>/<?= $prueba["cantidad_preguntas"] ?></p>
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
                                                <a href="#" class="ver-mas-extra-info m-t-2"><b>+ Ver más</b></a>
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
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="m-b-2">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="file" value="false">
                                                        <label for="prueba-participantes-file">Seleccionar archivo de participantes</label>
                                                        <input required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" type="file" name="participantes" id="prueba-participantes-file">
                                                        <button class="btn btn-sm btn-success m-t-1" type="submit">Importar</button>
                                                    </form>
                                                </div>
                                                <table class="table table-hovered table-bordered table-stripped">
                                                    <thead>
                                                        <tr>
                                                            <th>Identificación</th>
                                                            <th>Nombre Completo</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if($participantes){
                                                            foreach ($participantes as $participante) {
                                                    ?>
                                                        <tr id="participante-<?= $participante["id_participante_prueba"] ?>">
                                                            <td><p><?= $participante["identificacion"] ?></p></td>
                                                            <td><p><?= $participante["nombres"]." ".$participante["apellidos"] ?></p></td>
                                                            <td><p><?= $participante["telefono"] ?></p></td>
                                                            <td><p><?= $participante["email"] ?></p></td>
                                                            <td class="text-center"><button data-prueba="<?= $prueba["id_prueba"] ?>" data-participante="<?= $participante["id_participante_prueba"] ?>" class="btn btn-danger btn-sm btn-eliminar-participante">Eliminar</button></td>
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