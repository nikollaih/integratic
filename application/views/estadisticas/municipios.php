<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h4>Estadisticas por municipios</h4>
                        <p>A continuación se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por municipio, para ver los resultados por cada institución puede hacerlo a través del botón "Ver instituciones".</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $counter = [];
                        $x = 0;
                        if(is_array($municipios)){
                            foreach ($municipios as $municipio) { 
                                $x++;
                                $counter[$x]["aprobadas"] = count($municipio["aprobadas"]);
                                $counter[$x]["no_aprobadas"] = count($municipio["no_aprobadas"]);
                                ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <label for=""><?= $municipio["municipio"] ?></label>
                                            <canvas class="m-b-10" width="100" height="100" id="chart-<?= $x ?>"></canvas>
                                            <a href="<?= base_url() ?>EstadisticasPruebas/instituciones/<?= $municipio["id_municipio"] ?>">Ver Instituciones</a>
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