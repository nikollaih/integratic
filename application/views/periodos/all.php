<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas">
                    <div class="col-md-12">
                        <h3>Periodos Académicos</h3>
                        <p>A continuación, se muestra la lista de periodos académicos con sus respectivas semanas.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <div class="section-header">
                                <h4 class="section-title">Periodos</h4>
                            </div>
                            <div class="section-content">
                                <hr>
                                <div class="d-flex flex-wrap">
                                    <?php 
                                        if($periodos){
                                            foreach ($periodos as $periodo) { ?>
                                                <div class="m-r-1">
                                                    <div class="card text-center bg-light" style="width: 18rem;">
                                                        <div class="card-body periodo-container item-periodo" data-periodo="<?= $periodo["periodo"] ?>" data-id="<?= $periodo["id_periodo"] ?>">
                                                            <h2 class="card-title"><?= $periodo["periodo"] ?></h2>
                                                        </div>
                                                        <div class="card-footer text-muted">
                                                            <a data-id-periodo="<?= $periodo["id_periodo"] ?>" data-periodo="<?= $periodo["periodo"] ?>" data-inicio="<?= $periodo["fecha_inicio"] ?>" data-fin="<?= $periodo["fecha_fin"] ?>" class="btn btn-primary btn-sm btn-sm btn-modificar-periodo">Modificar</a>
                                                            <a data-id-periodo="<?= $periodo["id_periodo"] ?>" class="btn btn-danger btn-sm btn-eliminar-periodo">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    ?>
                                    <div class="mr-3" id="nuevo-periodo-agregar">
                                        <div class="card text-center bg-info periodo-container" style="width: 18rem;">
                                                <i class="fa fa-solid fa-plus text-white"></i>
                                                <p class="card-text text-white">Agregar periodo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-container">
                            <div class="section-header">
                                <h4 id="semanas-title" class="section-title">Semanas</h4>
                            </div>
                            <div class="section-content">
                                <hr>
                                <div class="d-flex flex-wrap" id="semanas-periodo"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>

<!-- Modal agregar semana -->
<div class="modal" id="modalSemana" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nueva-semana-modal-title">Agregar nueva semana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <input type="hidden" name="" class="form-control" id="nueva-semana-periodo">
            <input type="hidden" name="" class="form-control" id="nueva-semana-id-semana">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Semana <span class="text-danger">*</span></label>
                    <select name="" class="form-control" id="nueva-semana-semana">
                        <?php
                            for ($i=1; $i <= 20 ; $i++) { 
                                echo "<option value='".$i."'>".$i."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Fecha de inicio</label>
                    <input type="date" name="" class="form-control" id="nueva-semana-inicio">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Fecha de finalización</label>
                    <input type="date" name="" class="form-control" id="nueva-semana-fin">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="nueva-semana-guardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal agregar semana -->

<!-- Modal agregar periodo -->
<div class="modal" id="modalPeriodo" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevo-periodo-modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <input type="hidden" name="" class="form-control" id="nuevo-periodo-id-periodo">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Periodo <span class="text-danger">*</span></label>
                    <select name="" class="form-control" id="nuevo-periodo-periodo">
                        <?php
                            for ($i=1; $i <= 10 ; $i++) { 
                                echo "<option value='".date('Y').'-'.$i."'>".date('Y')."-".$i."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Fecha de inicio <span class="text-danger">*</span></label>
                    <input type="date" name="" class="form-control" id="nuevo-periodo-inicio">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Fecha de finalización <span class="text-danger">*</span></label>
                    <input type="date" name="" class="form-control" id="nuevo-periodo-fin">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="nuevo-periodo-guardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal agregar periodo -->

</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>