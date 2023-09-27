<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h4>Aprobados / No Aprobados por municipio</h4>
                        <p>A continuación se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por municipio, para ver los resultados por cada institución puede hacerlo a través del botón "Ver instituciones".</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $municipiosQuindio = [
                            "Armenia",
                            "Buenavista",
                            "Calarca",
                            "Circasia",
                            "Cordoba",
                            "Filandia",
                            "Genova",
                            "La Tebaida",
                            "Montenegro",
                            "Pijao",
                            "Quimbaya",
                            "Salento"
                        ];

                        for ($i=0; $i < 12; $i++) { ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <label for=""><?= $municipiosQuindio[$i] ?></label>
                                        <canvas class="m-b-10" width="100" height="100" id="chart-<?= $i ?>"></canvas>
                                        <a href="<?= base_url() ?>EstadisticasPruebas/instituciones/<?= $municipiosQuindio[$i] ?>">Ver Instituciones</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
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
        for (let i = 0; i < 13; i++) {
            let aprobadas = Math.floor(Math.random() * (100 - 1)) + 1;
            let no_aprobadas = Math.floor(Math.random() * (100 - 1)) + 1;

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