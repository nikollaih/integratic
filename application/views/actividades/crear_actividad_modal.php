<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="agregar-nueva-actividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="agregar-nueva-actividad-label">Crear nueva actividad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="actividad-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Titulo *</label>
                    <input class="form-control input-lg" type="text" name="" id="nueva-actividad-titulo">
                </div>
                <div class="form-group">
                    <label for="">Descripción *</label>
                    <textarea id="nueva-actividad-descripcion" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Disponible hasta *</label>
                    <input class="form-control input-lg" type="date" name="" id="nueva-actividad-date">
                    <input class="form-control input-lg" type="time" name="" id="nueva-actividad-time">
                </div>
                <div class="form-group">
                    <label for="">Archivo</label>
                    <input class="form-control input-lg" type="file" name="" id="nueva-actividad-file">
                </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_actividad()" type="button" class="btn btn-primary">Guardar Respuesta</button>
      </div>
    </div>
  </div>
</div>