<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="agregar-nuevo-anuncio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregar-nuevo-anuncio-label">Crear nuevo anuncio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="">Titulo *</label>
                <input class="form-control input-lg" type="text" name="" id="nuevo-anuncio-titulo">
            </div>
            <div class="form-group">
                <label for="">Descripción *</label>
                <textarea id="nuevo-anuncio-descripcion" rows=10 class="form-control"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_anuncio()" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>