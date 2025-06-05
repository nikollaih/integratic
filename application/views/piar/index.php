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
                        <div class="col-sm-12 m-b-10">
                            <form method="get" class="form-inline mb-3">
                                <div class="form-group">
                                    <label for="diagnostico">Filtrar por diagnóstico:</label>
                                    <select name="diagnostico" id="diagnostico" class="form-control ml-2">
                                        <option value="">-- Todos --</option>
                                        <option value="Discapacidad" <?= ($this->input->get('diagnostico') == 'discapacidad') ? 'selected' : '' ?>>Discapacidad</option>
                                        <option value="Trastorno" <?= ($this->input->get('diagnostico') == 'trastorno') ? 'selected' : '' ?>>Trastorno</option>
                                        <option value="Sin diagnóstico" <?= ($this->input->get('diagnostico') == 'Sin diagnóstico') ? 'selected' : '' ?>>Sin diagnóstico</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-2">Filtrar</button>
                                </div>
                            </form>
                            <hr>
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
                                    <td>P.I.A.R.</td>
                                    <td>Comentarios coordinador</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($estudiantes) && is_array($estudiantes)){
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
                                            <td style="gap: 5px;" class="d-flex flex-wrap">
                                                <?php
                                                    if($e["id_piar"] === null){
                                                        if(strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador"){
                                                            echo '<a href="'.base_url().'PIAR/create/'.$e["documento"].'" class="btn btn-primary btn-sm">Crear</a>';
                                                        }
                                                    }
                                                    else {
                                                        echo '<a href="'.base_url().'PIAR/edit/'.$e["id_piar"].'" class="btn btn-info btn-sm">Modificar</a>';
                                                        echo '<a target="_blank" href="'.base_url().'PIAR/view/'.$e["id_piar"].'/1/Anexo 1" class="btn btn-success btn-sm">Anexo 1</a>';
                                                        echo '<a target="_blank" href="'.base_url().'PIAR/view/'.$e["id_piar"].'/2/Anexo 2" class="btn btn-success btn-sm">Anexo 2</a>';
                                                        echo '<a target="_blank" href="'.base_url().'PIAR/view/'.$e["id_piar"].'/3/Anexo 3" class="btn btn-success btn-sm">Anexo 3</a>';
                                                        if(strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador"){
                                                            echo '<a target="_blank" href="'.base_url().'PIAR/viewAnnual/'.$e["id_piar"].'/1/Documento PIAR" class="btn btn-success btn-sm">Informe anual</a>';
                                                        }
                                                        if(strtolower(logged_user()["rol"]) === "coordinador"){
                                                            ?>
                                                            <a data-id="<?= $e["id_piar"] ?>" class="btn btn-primary btn-sm btn-agregar-observaciones-coordinador-piar">Agregar comentarios</a>
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