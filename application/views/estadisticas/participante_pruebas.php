<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Información del participante</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Identificación</td>
                                                <td><?= $participante["identificacion"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nombre</td>
                                                <td><?=  strtoupper($participante["nombres"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos</td>
                                                <td><?= strtoupper($participante["apellidos"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Teléfono</td>
                                                <td><?=  strtoupper($participante["telefono"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Correo</td>
                                                <td><?= strtoupper($participante["email"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Grado</td>
                                                <td><?= strtoupper($participante["grado"]) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Pruebas realizadas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>Titulo prueba</td>
                                                <td>Institución</td>
                                                <td>Grado</td>
                                                <td>Calificación</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($pruebas){
                                                    foreach ($pruebas as $prueba) {
                                            ?>
                                                        <tr>
                                                            <td><?= $prueba["nombre_prueba"] ?></td>
                                                            <td><?php
                                                                echo (configuracion()["departamental"] == 0) ? $prueba["institucion"] : $prueba["nombre_institucion"];
                                                             ?></td>
                                                            <td><?= $prueba["grado"] ?></td>
                                                            <td><?= $prueba["nota"] ?></td>
                                                            <td class="text-center"><a href="<?= base_url() ?>Pruebas/ver/<?= $prueba["id_prueba"] ?>"><button class="btn btn-success">Ver prueba</button></a></td>
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


                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Estadisticas de pruebas realizadas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Materia</label>
                                        <select participante="<?= $participante["identificacion"] ?>" class="form-control" id="estadisticas-participante-grafica">
                                            <option value="">Seleccionar</option>
                                            <?php 
                                                if($materias){
                                                    foreach ($materias as $materia) { ?>
                                                        <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"] ?></option>
                                                    <?php }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <button id="btn-estadisticas-participante-grafica" class="btn btn-primary m-t-2">Filtrar</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="max-height:300px;width:100%;">
                                        <canvas class="m-b-10" style="width:100%;" id="chart-participante"></canvas>
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

<script>
    let participanteChart = null;
    let canvasChartPArticipante
    let data = [];
    $(document).ready( function () {
        $('#tabla-pruebas').DataTable({
            order: []
        });

        canvasChartPArticipante = document.getElementById('chart-participante');
        canvasChartPArticipante.height = 300;
        

        participanteChart = new Chart(
            document.getElementById('chart-participante'),
            {
            type: 'line',
            data: {
                labels: data.map(row => row),
                datasets: [
                {
                    label: "Notas",
                    data: data.map(row => row)
                }
                ]
            }
            }
        );
    } );
</script>
<?php $this->load->view("in_script") ?>
</html>