<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Filtro de simulacros</b></div>
                        <div class="panel-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Materias *</label>
                                            <select required name="materia" id="simulacro-materias" class="form-control multiple-select">
                                                <option value="">- Seleccionar</option>
                                                <?php
                                                if($materias != false){
                                                    foreach ($materias as $materia) {
                                                        ?>
                                                        <option <?= ($data_estudiante && $data_estudiante["materia"] == $materia["grado"].$materia["grupo"].'&'.$materia["codmateria"]) ? 'selected' : ''  ?>  value="<?= $materia["grado"].$materia["grupo"].'&'.$materia["codmateria"] ?>"><?= $materia["nommateria"]." - ".$materia["grado"].$materia["grupo"] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Estudiante *</label>
                                            <select required name="estudiante" id="simulacro-estudiante" class="form-control multiple-select">
                                                <?php
                                                    if($data_estudiante){ ?>
                                                        <option value="<?= $data_estudiante["participante"]["identificacion"] ?>"><?= $data_estudiante["participante"]["nombres"].' '.$data_estudiante["participante"]["apellidos"] ?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tema</label>
                                            <select required name="temas[]" id="crear-prueba-temas" class="form-control multiple-select" data-live-search="true" data-size="10" data-actions-box="true">
                                                <?php
                                                if($data_estudiante){
                                                    for ($i = 0; $i < count($data_estudiante["temas"]); $i++) {
                                                        $tema = $data_estudiante["temas"][$i];
                                                        ?>
                                                        <option value="<?= $tema["id_tema"] ?>"><?= $tema["nombre_tema"] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <button class="btn btn-primary m-t-10">Ver estadisticas</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Estadisticas del estudiante</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Evolución del estudiante con respecto a las notas</h5>
                                <div style="max-height:300px;width:100%;">
                                    <canvas class="m-b-10" style="width:100%;" id="chart-participante-simulacro"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 m-t-20 text-center">
                                <h5>Cantidad de simulacros perdidos y ganados</h5>
                                <div style="max-height:300px;width:100%;">
                                    <canvas class="m-b-10" style="width:100%;margin:0 auto;" id="chart-participante-simulacro-pie"></canvas>
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
    let participanteChartPie = null;
    let canvasChartParticipante;
    let canvasChartParticipantePie;
    let data = JSON.parse('<?= json_encode($pruebas) ?>');

    $(document).ready( function () {
        $('#tabla-pruebas').DataTable({
            order: []
        });

        if(data.length > 0) {
            canvasChartParticipante = document.getElementById('chart-participante-simulacro');
            canvasChartParticipante.height = 300;

            canvasChartParticipantePie = document.getElementById('chart-participante-simulacro-pie');
            canvasChartParticipantePie.height = 300;

            participanteChart = new Chart(
                document.getElementById('chart-participante-simulacro'),
                {
                    type: 'line',
                    data: {
                        labels: data.map(row => row.nombre_prueba),
                        datasets: [
                            {
                                label: "Notas",
                                data: data.map(row => row.nota)
                            }
                        ]
                    }
                }
            );

            let dataPie = [
                {
                    title: "Ganadas",
                    cantidad: 0
                },
                {
                    title: "Perdidas",
                    cantidad: 0
                }
            ]

            for (let i = 0; i < data.length; i++) {
                const nota = data[i];
                if(Number(nota.nota) < 3){
                    dataPie[1].cantidad++;
                }
                else {
                    dataPie[0].cantidad++;
                }
            }

            participanteChartPie = new Chart(
                document.getElementById('chart-participante-simulacro-pie'),
                {
                    type: 'pie',
                    data: {
                        labels: dataPie.map(row => row.title),
                        datasets: [
                            {
                                label: "Cantidad",
                                data: dataPie.map(row => row.cantidad)
                            }
                        ]
                    }
                }
            );
        }
    } );
</script>
<?php $this->load->view("in_script") ?>
</html>