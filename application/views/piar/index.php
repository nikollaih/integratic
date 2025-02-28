<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<?php $this->load->view("modal/observaciones_coordinador_piar") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Estudiantes</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($this->session->flashdata('mensaje')) {
                                echo '<p>' . $this->session->flashdata('mensaje') . '</p>';
                            }
                            ?>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <table id="tabla-estudiantes" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>Identificación</td>
                                    <td>Nombre completo</td>
                                    <td>Email</td>
                                    <td>Email acudiente</td>
                                    <td>Grado</td>
                                    <td>NEE</td>
                                    <td>Comentarios coordinador</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($estudiantes)){
                                    foreach ($estudiantes as $e) {
                                        ?>
                                        <tr id="estudiante-<?= $e["documento"] ?>">
                                            <td><?= $e["documento"] ?></td>
                                            <td><?= $e["nombre"] ?></td>
                                            <td><?= $e["email"] ?></td>
                                            <td><?= $e["email_acudiente"] ?></td>
                                            <td><?= $e["grado"] ?></td>
                                            <td><?= $e["nee"] === "0" ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Si</span>" ?></td>
                                            <td><?= $e["comentarios"] ?></td>
                                            <td>
                                                <?php
                                                    if($e["id_piar"] === null){
                                                        if(strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador"){
                                                            echo '<a href="'.base_url().'PIAR/create/'.$e["documento"].'" class="btn btn-primary btn-sm">Crear</a>';
                                                        }
                                                    }
                                                    else {
                                                        echo '<a href="'.base_url().'PIAR/edit/'.$e["id_piar"].'" class="btn btn-info btn-sm m-r-5">Modificar</a>';
                                                        echo '<a target="_blank" href="'.base_url().'PIAR/view/'.$e["id_piar"].'/Informe anual PIAR" class="m-r-5 btn btn-success btn-sm">Ver</a>';
                                                        if(strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador"){
                                                            echo '<a target="_blank" href="'.base_url().'PIAR/view/'.$e["id_piar"].'/2/Documento PIAR" class="btn btn-success m-r-5 btn-sm m-b-1">Ver completo</a>';
                                                            echo '<a target="_blank" href="'.base_url().'PIAR/viewAnnual/'.$e["id_piar"].'/1/Documento PIAR" class="m-r-5 btn btn-success btn-sm">Informe anual</a>';
                                                        }
                                                        if(strtolower(logged_user()["rol"]) === "coordinador"){
                                                            ?>
                                                            <a data-id="<?= $e["id_piar"] ?>" class="m-t-1 btn btn-primary btn-sm btn-agregar-observaciones-coordinador-piar">Agregar comentarios</a>
                                                            <?php
                                                        }
                                                    }
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
<!-- PIAR -->
<script src="<?= base_url() ?>js/piar.js"></script>
</html>