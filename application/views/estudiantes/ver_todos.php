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
                        <a class="btn btn-primary m-b-2" href="<?= base_url() ?>Estudiante/modificar">Nuevo estudiante</a>
                        <a href="<?= base_url() ?>Estudiante/importar" class="btn btn-primary m-b-2">Importar estudiantes</a>
                        <button class="btn btn-danger m-b-2 btn-eliminar-todos-estudiantes">Eliminar Todos</button>
                        <a href="<?= base_url() ?>CaracterizacionEstudiantes/filtrar" class="btn btn-primary m-b-2">Caracterización</a>
                        <a href="<?= base_url() ?>Estudiante/actualizarInformacionPruebas" target="_blank" class="btn btn-warning m-b-2">Actualizar grados pruebas</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Estudiantes</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table id="tabla-estudiantes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Identificación</td>
                                            <td>Nombre completo</td>
                                            <td>Email</td>
                                            <td>Email acudiente</td>
                                            <td>Grado</td>
                                            <td>Clave</td>
                                            <td>P.I.A.R.</td>
                                            <td>Caracterización</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($estudiantes) && is_array($estudiantes)){
                                                foreach ($estudiantes as $e) {
                                                    ?>
                                                        <tr id="estudiante-<?= $e["documento"] ?>" style="background: <?= $e["nee"] === '1' ? '#e9f3ff' : 'transparent' ?>">
                                                            <td><?= $e["documento"] ?></td>
                                                            <td><?= $e["nombre"] ?></td>
                                                            <td><?= $e["email"] ?></td>
                                                            <td><?= $e["email_acudiente"] ?></td>
                                                            <td><?= $e["grado"] ?></td>
                                                            <td><?= $e["clave"] ?></td>
                                                            <td><?= $e["nee"] === "0" ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Si</span>" ?></td>
                                                            <td>
                                                                <?php
                                                                    if($e["id_pregunta"]) {
                                                                        echo '<a target="_blank" href="'.base_url().'CaracterizacionEstudiantes/completar/'.$e["documento"].'">Ver</a>';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn btn-warning btn-sm" href="<?= base_url() ?>Estudiante/modificar/<?= trim($e["documento"]) ?>">Modificar</a>
                                                                <button data-id="<?= $e["documento"] ?>" class="btn btn-danger btn-sm btn-eliminar-estudiante">Eliminar</button>
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