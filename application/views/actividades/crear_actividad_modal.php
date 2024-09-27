<!-- Modal -->
<?php $periodos = get_periodos(); ?>
<div class="modal fade bd-example-modal-lg" id="agregar-nueva-actividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-between align-items-center">
            <h5 class="modal-title" id="agregar-nueva-actividad-label">Crear nueva actividad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="actividad-form" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="" id="nueva-actividad-actividad">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Titulo *</label>
                        <input class="form-control" type="text" name="" id="nueva-actividad-titulo">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Periodo *</label>
                        <select name="" class="form-control" id="nueva-actividad-periodo">
                          <option value="">- Seleccionar</option>
                          <?php
                            if($periodos){
                              foreach ($periodos as $periodo) { ?>
                                <option value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                              <?php }
                            }
                          ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Descripción *</label>
                        <textarea id="nueva-actividad-descripcion" class="form-control" rows="5"></textarea>
                    </div>
                    <div id="image_wrapper_richtext_actividades" class="image-list">
                        <div class="file-list-info">
                            <input type="file" id="files_upload_actividades" accept="image/*" multiple="multiple" class="files-text files-input files_upload_actividades"/>
                            <span id="image_size_richtext_actividades" class="total-size text-small-2">0KB</span>
                        </div>
                        <div class="file-list">
                            <ul id="image_list_richtext_actividades">
                            </ul>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4 m-t-2">
                    <div class="form-group">
                        <label for="">Archivo</label>
                        <input class="form-control" type="file" name="" id="nueva-actividad-file">
                    </div>
                  </div>
                  <div class="col-md-4 m-t-2">
                    <div class="form-group">
                        <label for="">Es recuperación *</label>
                        <select name="" class="form-control" id="nueva-actividad-recuperacion">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-4 m-t-2">
                    <div class="form-group">
                        <label for="">Porcentaje *</label>
                        <input class="form-control" type="number" name="" id="nueva-actividad-porcentaje">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Disponible desde *</label>
                        <input class="form-control" type="datetime-local" name="" id="nueva-actividad-start">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Disponible hasta *</label>
                        <input class="form-control" type="datetime-local" name="" id="nueva-actividad-end">
                    </div>
                  </div>
                </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_actividad()" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>