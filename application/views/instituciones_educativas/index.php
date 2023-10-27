<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>  
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Importar instituciones por municipio</b></div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Municipio</label>
                                        <select required name="municipio" id="" class="form-control">
                                            <option value="">- Seleccionar</option>
                                            <?php
                                                if($municipios){
                                                    for ($i=0; $i < count($municipios); $i++) { 
                                                        echo "<option value='".$municipios[$i]["id_municipio"]."'>".$municipios[$i]["municipio"]."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Archivo (.csv)</label>
                                        <input type="file" name="instituciones" class="form-control" accept=".csv" id="">
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary m-t-2">Importar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Lista de instituciones por municipio</b></div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Municipio</label>
                                        <select required name="municipio" id="id-select-municipio" class="form-control">
                                            <?php
                                                if($municipios){
                                                    for ($i=0; $i < count($municipios); $i++) { 
                                                        $selected = ($selected_municipio == $municipios[$i]["id_municipio"]) ? "selected" : "";
                                                        echo "<option ".$selected."  value='".$municipios[$i]["id_municipio"]."'>".$municipios[$i]["municipio"]."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha de creación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($instituciones){
                                                foreach ($instituciones as $institucion) { ?>
                                                        <tr>
                                                            <td><?= $institucion["nombre_institucion"] ?></td>
                                                            <td><?= date("Y-m-d", strtotime($institucion["created_at"])) ?></td>
                                                        </tr>
                                            <?php }
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

<script>
    $(document).ready( function () {
        $(document).on("change", "#id-select-municipio", function() {
            let id_municipio = jQuery(this).val();
            location.href = base_url + "InstitucionesEducativas/index/" + id_municipio;
        });
    })
</script>