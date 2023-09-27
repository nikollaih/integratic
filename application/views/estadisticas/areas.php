<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>

    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h4>Aprobados / No Aprobados por áreas (<?= str_replace('%20', ' ', $institucion) ?>)</h4>
                        <p>A continuación se muestra el ponderado de pruebas aprobadas(azul)/no aprobadas(rojo) por area.</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $areasEscuelas = [
                            "Matemáticas",
                            "Ciencias",
                            "Historia",
                            "Arte",
                            "Educación Física",
                            "Música",
                            "Lengua y Literatura",
                            "Tecnología",
                            "Idiomas",
                            "Informática",
                            "Ciencias Sociales"
                        ];

                        for ($i=0; $i < count($areasEscuelas); $i++) { ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <label for=""><?= $areasEscuelas[$i] ?></label>
                                        <canvas class="m-b-10" width="100" height="100" id="chart-<?= $i ?>"></canvas>
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
        for (let i = 0; i < 12; i++) {
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