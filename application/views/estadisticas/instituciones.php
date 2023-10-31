<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h4>Estadisticas por institución (<?= $municipio["municipio"] ?>)</h4>
                        <p>A continuación se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por institución, para ver los resultados por cada área puede hacerlo a través del botón "Ver áreas".</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $counter = [];
                        $x = 0;
                        if(is_array($instituciones)){
                            foreach ($instituciones as $institucion) {
                                if(count($institucion["aprobadas"]) > 0 || count($institucion["no_aprobadas"]) > 0) {
                                    $x++;
                                    $counter[$x]["aprobadas"] = count($institucion["aprobadas"]);
                                    $counter[$x]["no_aprobadas"] = count($institucion["no_aprobadas"]);
                                    ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <label for=""><?= $institucion["nombre_institucion"] ?></label>
                                                <canvas class="m-b-10" width="100" height="100" id="chart-<?= $x ?>"></canvas>
                                                <a href="<?= base_url() ?>EstadisticasPruebas/areas/0/<?= $institucion["id_institucion_educativa"] ?>">Ver Áreas</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
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
        let jsCounter = JSON.parse('<?= json_encode($counter) ?>');
        let municipiosLength = parseInt("<?= $x; ?>")
        for (let i = 1; i <= municipiosLength; i++) {
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
    });
</script>
</html>