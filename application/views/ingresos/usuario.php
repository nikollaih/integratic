<?php $this->load->view("in_head") ?>
    <body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>Ingresos" class="btn btn-primary m-b-10">Ver todos los ingresos</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Reporte de ingresos al sistema (<?= $usuario["nombres"].' '.$usuario["apellidos"] ?>)</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Filtro por fechas -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('ingresos/usuario/' . $documento) ?>" class="row g-3 align-items-end ">
                                            <div class="col-md-4">
                                                <label for="fecha_inicial" class="form-label">Fecha inicial</label>
                                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?= $fecha_inicial ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="fecha_final" class="form-label">Fecha final</label>
                                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?= $fecha_final ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary w-100 m-t-10">Filtrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Estadísticas -->
                        <div class="row text-center mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Total ingresos</h5>
                                        <h4><?= $total_ingresos ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Hora promedio</h5>
                                        <h4><?= date('h:i a', strtotime($hora_promedio)) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Desde</h5>
                                        <h4><?= $fecha_inicial ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Hasta</h5>
                                        <h4><?= $fecha_final ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráfico 1: Barras por fecha -->
                        <div class="card mb-4">
                            <div class="card-header">Ingresos por Fecha</div>
                            <div class="card-body">
                                <canvas id="graficoBarras"></canvas>
                            </div>
                        </div>

                        <!-- Gráfico 2 y 3 en columnas -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header">Ingresos por Día de la Semana</div>
                                    <div class="card-body">
                                        <canvas id="graficoCircular"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="card">
                                    <div class="card-header">Hora Promedio por Fecha</div>
                                    <div class="card-body">
                                        <canvas id="graficoLinea"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de ingresos -->
                        <div class="card">
                            <div class="card-header">Ingresos Detallados</div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($ingresos){ foreach($ingresos as $i): ?>
                                        <tr>
                                            <td><?= $i['fecha'] ?></td>
                                            <td><?= $i['hora'] ?></td>
                                        </tr>
                                    <?php endforeach; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(isset($message)){
                            ?>
                            <div class="alert alert-<?= $message["type"] ?> alert-dismissible show" role="alert">
                                <?= $message["message"] ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    </div>
    </body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
<!-- Scripts para gráficos -->
<script>
    const datosBarras = <?= json_encode($ingresos_por_fecha) ?>;
    const datosCircular = <?= json_encode($ingresos_por_dia_semana) ?>;
    const datosLinea = <?= json_encode($hora_promedio_por_fecha) ?>;

    const ctxBarras = document.getElementById('graficoBarras').getContext('2d');
    new Chart(ctxBarras, {
        type: 'bar',
        data: {
            labels: datosBarras.map(d => d.fecha),
            datasets: [{
                label: 'Cantidad de ingresos',
                data: datosBarras.map(d => d.cantidad),
                borderWidth: 1
            }]
        }
    });

    const ctxCircular = document.getElementById('graficoCircular').getContext('2d');
    new Chart(ctxCircular, {
        type: 'pie',
        data: {
            labels: datosCircular.map(d => d.dia_semana),
            datasets: [{
                label: 'Ingresos por día de la semana',
                data: datosCircular.map(d => d.cantidad),
                borderWidth: 1
            }]
        }
    });

    function convertirHoraDecimal(horaStr) {
        const partes = horaStr.split(':');
        return parseInt(partes[0]) + parseInt(partes[1]) / 60;
    }

    const ctxLinea = document.getElementById('graficoLinea').getContext('2d');
    new Chart(ctxLinea, {
        type: 'line',
        data: {
            labels: datosLinea.map(d => d.fecha),
            datasets: [{
                label: 'Hora promedio (formato decimal)',
                data: datosLinea.map(d => convertirHoraDecimal(d.hora_promedio)),
                fill: false,
                tension: 0.1,
                borderWidth: 2
            }]
        }
    });
</script>
    </html>