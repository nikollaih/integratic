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
                        <a href="<?= base_url() ?>Caracterizacion/addDBA" class="btn btn-primary m-b-2">Agregar DBA</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>DBA's</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabla-dba" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Área</th>
                                            <th>Grado</th>
                                            <th>Descripción</th>
                                            <th style="width:150px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($dbas){
                                                foreach ($dbas as $dba) {
                                                    ?>
                                                        <tr id="dba-<?= $dba["id_dba"] ?>">
                                                            <td><?= $dba["descripcion_area"] ?></td>
                                                            <td><?php
                                                                $grados = unserialize($dba["grado"]);
                                                                if(count($grados) > 0){
                                                                    for ($i=0; $i < count($grados); $i++) { 
                                                                        echo $grados[$i]."°";
                                                                    }
                                                                }
                                                            ?></td>
                                                            <td><?= $dba["descripcion_dba"] ?></td>
                                                            <td style="width:150px;">
                                                                <a data-dba="<?= $dba["id_dba"] ?>" href="<?= base_url() ?>Caracterizacion/addDBA/<?= $dba["id_dba"] ?>" class="btn btn-warning btn-sm m-b-2">Modificar</a>
                                                                <button data-dba="<?= $dba["id_dba"] ?>" class="button-eliminar-dba btn btn-danger btn-sm m-b-2">Eliminar</button>
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