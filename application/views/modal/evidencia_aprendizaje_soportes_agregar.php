<!-- Modal observaciones plan aula -->
<div class="modal fade bd-example-modal-sm" id="evidencia-aprendizaje-soportes-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="form-evidencia-aprendizaje-soporte" action="<?= base_url() ?>EvidenciasAprendizajeSoportes/create" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="">Agregar evidencias</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input required type="hidden" id="id-evidencia-aprendizaje-soportes" name="id_evidencia_aprendizaje">
                    <div class="row">
                        <div class="col-md-12 m-b-10">
                            <label for="">Seleccionar archivos</label>
                            <input required name="files[]" type="file" multiple class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="evidencia-aprendizaje-soporte-comentarios">Comentarios</label>
                            <textarea class="form-control" name="evidencia_aprendizaje_comentarios" id="evidencia-aprendizaje-soporte-comentarios" cols="30" rows="10" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>