<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modalBarreras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Seleccionar barreras del item P.I.A.R.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="categoriaBarreraSelect" class="form-label">Categoría</label>
                        <select id="categoriaBarreraSelect" class="form-select form-control">
                            <option value="">Seleccione una categoría</option>
                            <?php

                                if($barreras_categorias){
                                    foreach($barreras_categorias as $categoria): ?>
                                        <option value="<?= $categoria->id_categoria_barrera ?>">
                                            <?= $categoria->nombre_categoria ?>
                                        </option>
                                    <?php endforeach;
                                }

                            ?>
                        </select>
                    </div>
                </div>

                <div id="barrerasContainer" class="mb-3">
                    <!-- Las barreras se llenarán vía AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>
