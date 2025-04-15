<!-- Modal observaciones plan aula -->
<div class="modal fade bd-example-modal-sm" id="plan-aula-tooltip-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="form-plan-aula-observaciones-coordinador" action="<?= base_url() ?>EvidenciasAprendizaje/AgregarObservacion" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Descripción del campo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="plan_aula_tooltip_text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>