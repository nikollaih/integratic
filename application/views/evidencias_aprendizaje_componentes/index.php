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
                    <a class="btn btn-primary m-b-2" href="<?= base_url() ?>EvidenciasAprendizajeComponentes/agregar">Nuevo componente</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Componentes de evidencias de aprendizaje</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table id="tabla-estudiantes" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Descripción</td>
                                    <td>Órden</td>
                                    <td>Estado</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($componentes)){
                                    foreach ($componentes as $componente) {
                                        ?>
                                        <tr id="estudiante-<?= $componente["id_tipo_componente"] ?>">
                                            <td><?= $componente["id_tipo_componente"] ?></td>
                                            <td><?= $componente["nombre"] ?></td>
                                            <td><?= $componente["descripcion"] ?></td>
                                            <td><?= $componente["orden"] ?></td>
                                            <td><?= $componente["activo"] == 1 ? 'Activo' : 'Inactivo' ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm" href="<?= base_url() ?>EvidenciasAprendizajeComponentes/modificar/<?= trim($componente["id_tipo_componente"]) ?>">Modificar</a>
                                                <?php if($componente["orden"] != 1 || $componente["id_tipo_componente"] != 1){ ?>
                                                    <button data-id="<?= $componente["id_tipo_componente"] ?>" class="btn btn-danger btn-sm btn-eliminar-tipo-componente-evidencia">Eliminar</button>
                                                <?php }
                                                ?>
                                            </td>
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
</html>