<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("cursos/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Lista de cursos</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <table id="tabla-cursos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Grados</th>
                                                <th>Disponibilidad</th>
                                                <th>Creado por</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($cursos != false){
                                                    foreach ($cursos as $curso) {
                                                        ?>
                                                            <tr id="curso-<?= $curso["id_curso"] ?>">
                                                                <td><?= $curso["nombre_curso"] ?></td>
                                                                <td><?php 
                                                                    $grados = unserialize($curso["grados"]);
                                                                    foreach ($grados as $grado) {
                                                                        echo " - ".$grado;
                                                                    }
                                                                ?></td>
                                                                <td>
                                                                    <b>Desde:</b> <?= $fechaHoraDesde = $curso["disponible_desde"] ?><br>
                                                                    <b>Hasta:</b>  <?= $fechaHoraHasta = $curso["disponible_hasta"] ?>
                                                                </td> 
                                                                <td><?= $curso["nombres"]." ".$curso["apellidos"] ?></td>
                                                                <td class="text-center">
                                                                    <a class="btn btn-sm btn-success" href="<?= base_url() ?>Cursos/ver/<?= $curso["id_curso"] ?>">Ver</a>
                                                                    <?php
                                                                        if(strtolower(logged_user()["rol"]) == "docente"){
                                                                    ?>
                                                                        <a class="btn btn-sm btn-warning" href="<?= base_url() ?>Cursos/create/<?= $curso["id_curso"] ?>">Modificar</a>
                                                                        <a class="btn btn-sm btn-danger button-eliminar-curso" class="button-eliminar-curso" data-curso="<?= $curso["id_curso"] ?>">Eliminar</a>
                                                                    <?php
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
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>