<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <?php
                            if(count($institucion) > 0){ ?>
                                <h4>Estadisticas de áreas por institución (<?= $institucion["nombre_institucion"] ?>)</h4>
                            <?php }
                            else { ?>
                                <h4>Estadisticas por áreas</h4>
                            <?php }
                        ?>
                        <p>A continuación, se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por area.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12"> 
                        <div class="card bg-light">
                             <div class="card-body">
                                <div class="form-group">
                                    <label for="grado" class="control-label">Grado</label>
                                        <select required class="form-control" id="select-grado" name="grado">
                                        <option <?= ($grado == "0") ? "selected" : "" ?> value="0">Transición</option>  
                                        <option <?= ($grado == "1") ? "selected" : "" ?> value="1">Primero</option> 
                                        <option <?= ($grado == "2") ? "selected" : "" ?> value="2">Segundo</option>
                                        <option <?= ($grado == "3") ? "selected" : "" ?> value="3">Tercero</option>
                                        <option <?= ($grado == "4") ? "selected" : "" ?> value="4">Cuarto</option>
                                        <option <?= ($grado == "5") ? "selected" : "" ?> value="5">Quinto</option>
                                        <option <?= ($grado == "6") ? "selected" : "" ?> value="6">Sexto</option>
                                        <option <?= ($grado == "7") ? "selected" : "" ?> value="7">Séptimo</option>
                                        <option <?= ($grado == "8") ? "selected" : "" ?> value="8">Octavo</option>
                                        <option <?= ($grado == "9") ? "selected" : "" ?> value="9">Noveno</option>
                                        <option <?= ($grado == "10") ? "selected" : "" ?> value="10">Décimo</option>
                                        <option <?= ($grado == "11") ? "selected" : "" ?> value="11">Undécimo</option>
                                        <option <?= ($grado == "C1") ? "selected" : "" ?> value="C1">Ciclo I</option>
                                        <option <?= ($grado == "C2") ? "selected" : "" ?> value="C2">Ciclo II</option>
                                        <option <?= ($grado == "C3") ? "selected" : "" ?> value="C3">Ciclo III</option>
                                        <option <?= ($grado == "C4") ? "selected" : "" ?> value="C4">Ciclo IV </option>
                                        <option <?= ($grado == "C5") ? "selected" : "" ?> value="C5">Ciclo V</option> 
                                        <option <?= ($grado == "C6") ? "selected" : "" ?> value="C6">Ciclo VI</option>
                                        <option <?= ($grado == "P1") ? "selected" : "" ?> value="P1">Pensar I</option>
                                        <option <?= ($grado == "P2") ? "selected" : "" ?> value="P2">Pensar II</option>
                                        <option <?= ($grado == "P3") ? "selected" : "" ?> value="P3">Pensar III</option> 
                                        </select>
                                </div>
                            </div>
                        </div>            
                    </div>       
                </div>
                <div class="row">
                    <?php
                        $counter = [];
                        $x = 0;
                        if(is_array($areas)){
                            foreach ($areas as $area) { 
                                $x++;
                                $counter[$x]["aprobadas"] = count($area["aprobadas"]);
                                $counter[$x]["no_aprobadas"] = count($area["no_aprobadas"]);
                                ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <label for=""><?= $area["nomarea"] ?></label>
                                            <canvas class="m-b-10" width="100" height="100" id="chart-<?= $x ?>"></canvas>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>

<script>
    $(document).ready( function () {
        let institucion = JSON.parse('<?= json_encode($institucion) ?>');
        let jsCounter = JSON.parse('<?= json_encode($counter) ?>');
        let areasLength = parseInt("<?= $x; ?>")
        for (let i = 1; i <= areasLength; i++) {
            let aprobadas = jsCounter[i].aprobadas;
            let no_aprobadas = jsCounter[i].no_aprobadas;

            let data = [
                { label: "Aprobadas: " + aprobadas, count: aprobadas },
                { label: "No Aprobadas: " + no_aprobadas, count: no_aprobadas }
            ];

            new Chart(
                document.getElementById('chart-' + i),
                {
                type: 'doughnut',
                data: {
                    labels: data.map(row => row.label),
                    datasets: [
                    {
                        data: data.map(row => row.count)
                    }
                    ]
                }
                }
            );
        }

        $(document).on("change", "#select-grado", function() {
            let grado = jQuery(this).val();
            let url = base_url + "EstadisticasPruebas/areas/" + grado;
            if(institucion.id_institucion_educativa)
                url += "/" + institucion.id_institucion_educativa;

            location.href = url;
        })
    });
</script>
</html>