<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Información del participante</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Identificación</td>
                                                <td><?= $participante["identificacion"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nombre</td>
                                                <td><?=  strtoupper($participante["nombres"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos</td>
                                                <td><?= strtoupper($participante["apellidos"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Teléfono</td>
                                                <td><?=  strtoupper($participante["telefono"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Correo</td>
                                                <td><?= strtoupper($participante["email"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Institución</td>
                                                <td><?=  strtoupper($participante["institucion"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Grado</td>
                                                <td><?= strtoupper($participante["grado"]) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Pruebas realizadas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>Titulo prueba</td>
                                                <td>Institución</td>
                                                <td>Grado</td>
                                                <td>Calificación</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($pruebas){
                                                    foreach ($pruebas as $prueba) {
                                            ?>
                                                        <tr>
                                                            <td><?= $prueba["nombre_prueba"] ?></td>
                                                            <td><?= $prueba["institucion"] ?></td>
                                                            <td><?= $prueba["grado"] ?></td>
                                                            <td><?= $prueba["nota"] ?></td>
                                                            <td class="text-center"><a href="<?= base_url() ?>Pruebas/ver/<?= $prueba["id_prueba"] ?>"><button class="btn btn-success">Ver prueba</button></a></td>
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