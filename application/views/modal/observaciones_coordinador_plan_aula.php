<!-- Modal observaciones plan aula -->
<div class="modal fade bd-example-modal-sm" id="observaciones-plan-aula-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="form-plan-aula-observaciones-coordinador" action="<?= base_url() ?>EvidenciasAprendizaje/AgregarObservacion" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Agregar observaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id-plan-aula-observaciones-coordinador" name="id_evidencia_aprendizaje">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="plan-aula-observaciones-coordinador">Escribir observaciones</label>
                            <textarea class="form-control" name="observaciones_coordinador" id="plan-aula-observaciones-coordinador" cols="30" rows="10" placeholder="Escriba aqui sus observaciones..."></textarea>
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