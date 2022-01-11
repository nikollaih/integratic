<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Lista de preguntas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <table id="tabla-preguntas" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Materia</th>
                                                <th>Dificultad</th>
                                                <th>Pregunta</th>
                                                <th>Fecha de creación</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($preguntas != false){
                                                    foreach ($preguntas as $pregunta) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $pregunta["id_pregunta_prueba"] ?></td>
                                                                <td><?= $pregunta["nommateria"] ?></td>
                                                                <td><?= $pregunta["dificultad"] ?></td>
                                                                <td><?= $pregunta["descripcion_pregunta"] ?></td>
                                                                <td><?= date("d F Y H:i a", strtotime($pregunta["created_at"])) ?></td>
                                                                <td class="text-center"><a target="_blank" class="btn btn-success" href="<?= base_url() ?>PreguntasPrueba/ver/<?= $pregunta["id_pregunta_prueba"] ?>">Ver</a></td>
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
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>

<script>
    $(document).ready( function () {
    $('#tabla-preguntas').DataTable({
        order: []
    });
} );
</script>
</html>