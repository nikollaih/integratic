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
                        <a href="<?= base_url() ?>Caracterizacion/addLineamientoCurricular" class="btn btn-primary m-b-2">Agregar Lineamiento Curricular</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Lineamientos Curriculares</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabla-lineamiento-curricular" class="table table-bordered">
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
                                            if($lineamientos){
                                                foreach ($lineamientos as $lineamiento_curricular) {
                                                    ?>
                                                        <tr id="lineamiento-curricular-<?= $lineamiento_curricular["id_lineamiento_curricular"] ?>">
                                                            <td><?= $lineamiento_curricular["descripcion_area"] ?></td>
                                                            <td><?= $lineamiento_curricular["grado"] ?>°</td>
                                                            <td><?= $lineamiento_curricular["descripcion_lineamiento_curricular"] ?></td>
                                                            <td style="width:200px;" class="text-center">
                                                                <a data-lineamiento_curricular="<?= $lineamiento_curricular["id_lineamiento_curricular"] ?>" href="<?= base_url() ?>Caracterizacion/addLineamientoCurricular/<?= $lineamiento_curricular["id_lineamiento_curricular"] ?>" class="btn btn-warning btn-sm m-b-2">Modificar</a>
                                                                <button data-lineamiento-curricular="<?= $lineamiento_curricular["id_lineamiento_curricular"] ?>" class="button-eliminar-lineamiento-curricular btn btn-danger btn-sm m-b-2">Eliminar</button>
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