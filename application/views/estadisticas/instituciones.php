<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h4>Aprobados / No Aprobados por institución (<?= $municipio ?>)</h4>
                        <p>A continuación se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por institución, para ver los resultados por cada área puede hacerlo a través del botón "Ver áreas".</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $institucionesEducativas = [
                        "Institucion Educativa San Juan",
                        "Colegio Santa Maria",
                        "Escuela San Pedro",
                        "Liceo Los Pajaros",
                        "Colegio San Jose",
                        "Escuela Rosa de Lima",
                        "Instituto Cervantes",
                        "Colegio San Francisco",
                        "Escuela El Bosque",
                        "Liceo Simon Bolivar"
                    ];
                        for ($i=0; $i < 10; $i++) { ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <label for=""><?= $institucionesEducativas[$i] ?></label>
                                        <canvas class="m-b-10" width="100" height="100" id="chart-<?= $i ?>"></canvas>
                                        <a href="<?= base_url() ?>EstadisticasPruebas/areas/<?= $institucionesEducativas[$i] ?>">Ver Áreas</a>
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
        for (let i = 0; i < 10; i++) {
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