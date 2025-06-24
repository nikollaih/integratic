<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("recuperaciones/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Nivelaciones</h3>
                        <p>A continuación, se muestra la lista de nivelaciones creadas por el docente.</p>
                        <hr>
                    </div>
                </div>
                <?php
                    if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                        <div class="row">
                            <div class="col-md-12 text-right m-b-10">
                                <a href="<?= base_url() ?>Recuperaciones/create" class="btn btn-primary">Crear nivelación</a>
                            </div>
                        </div>
                    <?php }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <?php
                            if(strtolower(logged_user()["rol"]) === "coordinador"){ ?>
                                <div class="row">
                                    <form action="" method="post" class="d-flex gap-4">
                                        <div class="col-sm-12 col-md-4 col-lg-3 m-b-2">
                                                <div>
                                                    <label for="">Docente</label>
                                                    <select required name="docente_id" id="" class="form-control">
                                                        <option value="">-Seleccionar un docente</option>
                                                        <?php
                                                        if($docentes){
                                                            foreach($docentes as $docente){ ?>
                                                                <option <?= ($docente_id === $docente["id"]) ? "selected" : "" ?> value="<?= $docente['id'] ?>"><?= $docente['nombres'].' '.$docente['apellidos'] ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3 m-b-10">
                                            <button type="submit" class="btn btn-primary" style="height: 35px; margin-top: 23px">Filtrar</button>
                                        </div>
                                    </form>
                                </div>
                            <?php }
                            ?>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Materia</th>
                                        <th>Grupo</th>
                                        <th>Periodo</th>
                                        <th>Fecha inicio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($recuperaciones) {
                                        foreach($recuperaciones as $recuperacion) { ?>
                                            <tr>
                                                <td><?= $recuperacion["title"] ?></td>
                                                <td><?= $recuperacion["nommateria"] ?></td>
                                                <td><?= $recuperacion["grado"].$recuperacion["grupo"] ?></td>
                                                <td><?= $recuperacion["periodo"] ?></td>
                                                <td><?= date('Y-m-d h:i a', strtotime($recuperacion["disponible_desde"])) ?></td>
                                                <td style="width:210px;">
                                                    <a href="<?= base_url() ?>Recuperaciones/view/<?= $recuperacion["id_recuperacion"] ?>" class="btn btn-info btn-sm">Ver</a>
                                                    <?php
                                                    if(strtolower(logged_user()["rol"]) === "docente"){ ?>
                                                        <a href="<?= base_url() ?>Recuperaciones/edit/<?= $recuperacion["id_recuperacion"] ?>" class="btn btn-warning btn-sm">Modificar</a>
                                                        <button data-id="<?= $recuperacion["id_recuperacion"] ?>" class="btn btn-danger btn-sm remove-plan-aula">Eliminar</button>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                       <?php }
                                    }
                                ?>
                                </tbody>
                            </table>
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
</html>