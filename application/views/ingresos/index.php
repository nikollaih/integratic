<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Reporte de ingresos al sistema</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Seleccione los siguientes filtros para resultados más específicos</p>
                            <form action="" method="post">
                                <div class="d-flex align-items-center p-10 bg-light m-b-30" style="padding: 20px;border: 1px solid #efefef;">
                                    <div class="form-group">
                                        <label for="fecha-inicial">Fecha inicial</label>
                                        <input id="fecha-inicial" name="fecha_inicial" type="date" class="form-control" value="<?= $fecha_inicial?? "" ?>">
                                    </div>
                                    <div class="form-group  m-l-10">
                                        <label for="fecha-final">Fecha final</label>
                                        <input id="fecha-final" name="fecha_final" type="date" class="form-control" value="<?= $fecha_final?? "" ?>">
                                    </div>
                                    <div class="form-group  m-l-10">
                                        <label for="rol">Rol</label>

                                        <select name="rol" id="rol" class="form-control">
                                            <option value="">Todos</option>
                                            <?php
                                                if($roles && is_array($roles)){
                                                    foreach ($roles as $role) {
                                                        ?>
                                                        <option <?= $role["rol"] == $rol ? 'selected' : '' ?> value="<?= $role["rol"] ?>"><?= $role["rol"] ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-sm  m-l-10 btn-primary" style="height: 34px; margin-top: 7px">Filtrar ingresos</button>
                                    <a href="<?= base_url() ?>ingresos" class="btn btn-sm  m-l-10 btn-danger" style="height: 34px; margin-top: 7px">Limpiar filtros</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table id="tabla-ingresos" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>Identificación</td>
                                    <td>Nombre completo</td>
                                    <td>Rol</td>
                                    <td>Email</td>
                                    <td>Grado</td>
                                    <td>Fecha ingreso</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($ingresos){
                                    foreach ($ingresos as $i) {
                                        ?>
                                            <tr>
                                                <td><?= $i["id"] ?></td>
                                                <td><?= $i["nombres"].' '.$i["apellidos"] ?></td>
                                                <td><?= $i["rol"] ?></td>
                                                <td><?= $i["email"] ?></td>
                                                <td><?= $i["grado"] ?></td>
                                                <td><?= $i["fecha"]. ' '.$i["hora"] ?></td>
                                                <td class="text-center cursor-pointer">
                                                    <a href="<?= base_url() ?>ingresos/usuario/<?= $i["id"] ?>">
                                                        <i class="fa fa-search"></i>
                                                    </a>
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
<script>
    $(document).ready( function () {
        $('#tabla-ingresos').DataTable({
            "pageLength": 50,
            order: [],
            "language": {
                "url": base_url + "js/json/datatable_spanish.json"
            }
        });
    });
</script>
</html>