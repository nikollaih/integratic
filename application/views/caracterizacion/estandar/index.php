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
                        <a href="<?= base_url() ?>Caracterizacion/addEstandarCompetencia" class="btn btn-primary m-b-2">Agregar Estandar de competencia</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Estandares de competencia</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabla-estandar" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Área</th>
                                            <th>Grado</th>
                                            <th>Descripción</th>
                                            <th style="width:200px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($estandares){
                                                foreach ($estandares as $ec) {
                                                    ?>
                                                        <tr id="estandar-<?= $ec["id_estandar"] ?>">
                                                            <td><?= $ec["descripcion_area"] ?></td>
                                                            <td><?= $ec["grado"] ?>°</td>
                                                            <td><?= $ec["descripcion_estandar"] ?></td>
                                                            <td style="width:200px;" class="text-center">
                                                                <a data-ec="<?= $ec["id_estandar"] ?>" href="<?= base_url() ?>Caracterizacion/addEstandarCompetencia/<?= $ec["id_estandar"] ?>" class="btn btn-warning btn-sm m-b-2">Modificar</a>
                                                                <button data-estandar="<?= $ec["id_estandar"] ?>" class="button-eliminar-estandar btn btn-danger btn-sm m-b-2">Eliminar</button>
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