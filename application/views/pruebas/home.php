<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Lista de pruebas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <table id="tabla-pruebas" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Alcance</th>
                                                <th>Tipo</th>
                                                <th>Cantidad de preguntas</th>
                                                <th>Fecha de creación</th>
                                                <th>Estado</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($pruebas != false){
                                                    foreach ($pruebas as $p) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $p["nombre_prueba"] ?></td>
                                                                <td><?= $p["alcance_prueba"] ?></td>
                                                                <td><?= $p["tipo_prueba"] ?></td>
                                                                <td><?= $p["cantidad_preguntas"] ?></td>
                                                                <td><?= date("d F Y H:i a", strtotime($p["created_at"])) ?></td>
                                                                <td><?= ($p["estado"] == "1") ? "<label class='text-success'>Activa</label>" : "<label class='text-danger'>Inactiva</label>" ?></td>
                                                                <td class="text-center"><a class="btn btn-success" href="<?= base_url() ?>Pruebas/ver/<?= $p["id_prueba"] ?>">Ver</a></td>
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
    $('#tabla-pruebas').DataTable({
        order: []
    });
} );
</script>
</html>