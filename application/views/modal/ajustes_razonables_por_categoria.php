<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modalAjustesRazonables" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Seleccionar ajustes razonables del item P.I.A.R.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="categoriaAjustesRazonablesSelect" class="form-label">Categoría</label>
                        <select id="categoriaAjustesRazonablesSelect" class="form-select form-control">
                            <option value="">Seleccione una categoría</option>
                            <?php

                                if($ajustes_razonables_categorias){
                                    foreach($ajustes_razonables_categorias as $categoria): ?>
                                        <option value="<?= $categoria->id_categorias_ajustes_razonables ?>">
                                            <?= $categoria->nombre_categoria ?>
                                        </option>
                                    <?php endforeach;
                                }

                            ?>
                        </select>
                    </div>
                </div>

                <div id="ajustesRazonablesContainer" class="mb-3">
                    <!-- Las ajustesRazonables se llenarán vía AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>
