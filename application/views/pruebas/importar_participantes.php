<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Importar Participantes</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Municipio *</label>
                                        <select required name="municipio" id="municipios-select" class="form-control">
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
                                <div class="col-md-3 col-s-12">
                                    <div class="form-group">
                                        <label for="">Institución *</label>
                                        <select required name="institucion" id="instituciones-select" class="form-control">
                                            <option value="">- Seleccionar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12"> 
                                    <div class="form-group">
                                        <label for="grado" class="control-label">Grado</label>
                                            <select required class="form-control" id="grado" name="grado">
                                            <option value="">- Seleccionar</option>    
                                            <option value="0">Transición</option>  
                                            <option value="1">Primero</option> 
                                            <option value="2">Segundo</option>
                                            <option value="3">Tercero</option>
                                            <option value="4">Cuarto</option>
                                            <option value="5">Quinto</option>
                                            <option value="6">Sexto</option>
                                            <option value="7">Séptimo</option>
                                            <option value="8">Octavo</option>
                                            <option value="9">Noveno</option>
                                            <option value="10">Décimo</option>
                                            <option value="11">Undécimo</option>
                                            <option value="C1">Ciclo I</option>
                                            <option value="C2">Ciclo II</option>
                                            <option value="C3">Ciclo III</option>
                                            <option value="C4">Ciclo IV </option>
                                            <option value="C5">Ciclo V</option> 
                                            <option value="C6">Ciclo VI</option>
                                            <option value="P1">Pensar I</option>
                                            <option value="P2">Pensar II</option>
                                            <option value="P3">Pensar III</option> 
                                            </select>
                                    </div>                
                                </div>           
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Archivo participantes (.csv)</label>
                                        <input required type="file" name="participantes" accept=".csv" class="form-control">
                                    </div>
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
                    <div class="row text-end" style="text-align:right;">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>