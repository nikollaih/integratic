<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <?php
                    if(strtolower(logged_user()["rol"]) == "super"){
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?= base_url() ?>Caracterizacion/add" class="btn btn-success m-b-2">Agregar Contenido</a>
                                    <a href="<?= base_url() ?>Caracterizacion/DBA" class="btn btn-primary m-b-2">Ver DBAs</a>
                                    <a href="<?= base_url() ?>Caracterizacion/lineamientoCurricular" class="btn btn-primary m-b-2">Ver Lineamientos Curriculares</a>
                                    <a href="<?= base_url() ?>Caracterizacion/estandarCompetencia" class="btn btn-primary m-b-2">Ver Estandares de competencia</a>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Contenido</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Área *</label>
                                    <select required name="id_area" id="area" class="form-control get-contenido-data">
                                        <option value=null>- Seleccionar</option>
                                        <?php
                                            if($areas){
                                                foreach ($areas as $area) {
                                                    ?>
                                                        <option value="<?= $area["id_caracterizacion_area"] ?>"><?= $area["descripcion_area"] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Grado *</label>
                                    <select required name="grado" id="grado" class="form-control get-contenido-data">
                                        <option value="null">- Seleccionar</option>
                                        <?php
                                            for ($i=1; $i < 12; $i++) { 
                                                ?>
                                                    <option value="<?= $i ?>"><?= $i ?>°</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabla-contenido" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>DBA</th>
                                            <th>Lineamiento Curricular</th>
                                            <th>Estandar de competencias</th>
                                            <th>Tema</th>
                                            <th>Ruta</th>
                                            <?php
                                                if(strtolower(logged_user()["rol"]) == "super"){
                                                    ?>
                                                    <th style="width:150px;"></th>
                                                    <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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