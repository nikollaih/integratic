<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Alcance</label>
                                <select name="" id="select-alcance-estadistica" class="form-control">
                                    <option value="all">Todos</option>
                                    <?php
                                        if($alcances){
                                            for ($i=0; $i < count($alcances); $i++) { 
                                                $selected = ($alcance == $alcances[$i]["id_alcance_prueba"]) ? "selected" : "";
                                                echo '<option '.$selected.' value="'.$alcances[$i]["id_alcance_prueba"].'">'.$alcances[$i]["descripcion"].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Estadisticas</b></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12 col-lg-3">
                                            <div class="estadisticas-top-container primary">
                                                <h1><?= $cantidad_pruebas["cantidad_pruebas"] ?></h1>
                                                <h5>Pruebas</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-lg-3">
                                            <div class="estadisticas-top-container primary">
                                                <h1><?= $cantidad_preguntas["cantidad_preguntas"] ?></h1>
                                                <h5>Preguntas</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-lg-3">
                                            <div class="estadisticas-top-container primary">
                                                <h1><?= $cantidad_participantes["cantidad_participantes"] ?></h1>
                                                <h5>Participantes</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Materias</b></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <thead>
                                                        <tr>
                                                            <td>Materia</td>
                                                            <td>Promedio</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if($materias){
                                                                foreach ($materias as $materia) {
                                                                    $info_materia = get_materia_promedio($materia["codmateria"], $alcance);
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $materia["nommateria"]." ".$materia["grado"] ?>°</td>
                                                                            <td class="text-center"><b><?= $info_materia["promedio"] ?>%</b></td>
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><b>Pruebas</b></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>Aprobadas</td>
                                                        <td class="text-center"><?= ($pruebas_aprobadas) ? count($pruebas_aprobadas) : 0 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Aprobadas</td>
                                                        <td class="text-center"><?= ($pruebas_no_aprobadas) ? count($pruebas_no_aprobadas) : 0 ?></td>
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
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>

<script>
    $(document).ready( function () {
    $('#tabla-pruebas').DataTable({
        order: []
    });
} );
</script>
</html>