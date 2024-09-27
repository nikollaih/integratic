<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("recuperaciones/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Recuperaciones</h3>
                        <p>A continuación se muestra la lista de recuperaciones creados por el docente.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right m-b-10">
                        <a href="<?= base_url() ?>Recuperaciones/create" class="btn btn-primary">Crear recuperación</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <table class="table table-bordered">
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
                                                <td><?= $recuperacion["disponible_desde"] ?></td>
                                                <td style="width:150px;">
                                                    <a href="<?= base_url() ?>Recuperaciones/view/<?= $recuperacion["id_recuperacion"] ?>" class="btn btn-info btn-sm">Ver</a>
                                                    <button data-id="<?= $recuperacion["id_recuperacion"] ?>" class="btn btn-danger btn-sm remove-plan-aula">Eliminar</button>
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