<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Estudiantes</b></div>
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
                                    <td>NEE</td>
                                    <td>P.I.A.R.</td>
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
                                            <td>
                                                <?php
                                                    if($e["id_piar"] === null){
                                                        echo '<a href="'.base_url().'Piar/create/'.$e["documento"].'" class="btn btn-primary btn-sm">Crear</a>';
                                                    }
                                                    else {
                                                        echo '<a href="'.base_url().'Piar/edit/'.$e["id_piar"].'" class="btn btn-info btn-sm m-r-5">Modificar</a>';
                                                        echo '<a href="'.base_url().'Piar/view/'.$e["id_piar"].'" class="btn btn-success btn-sm">Ver</a>';
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
</html>