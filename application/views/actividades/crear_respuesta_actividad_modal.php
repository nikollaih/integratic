<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="agregar-respuesta-actividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="agregar-nueva-actividad-label">Subir una respuesta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="respuesta-actividad-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control input-lg" type="hidden" name="" id="respuesta-actividad-id">
                </div>
                <div class="form-group">
                    <label for="">Notas</label>
                    <textarea id="respuesta-actividad-notas" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Archivo</label>
                    <input class="form-control input-lg" type="file" name="" id="respuesta-actividad-file">
                </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_actividad_respuesta()" type="button" class="btn btn-primary">Guardar Respuesta</button>
      </div>
    </div>
  </div>
</div>