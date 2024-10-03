<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="agregar-prueba-recuperacion-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Agregar Pruebas a la Recuperación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>Recuperaciones/asignar_prueba_recuperacion" method="post">
                    <input type="hidden" name="id_recuperacion" value="<?= $recuperacion['id_recuperacion'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_prueba" class="control-label">Prueba</label>
                                <select required multiple name="pruebas[]" id="" class="form-control multiple-select multiple" data-live-search="true" data-size="10" data-actions-box="true">
                                    <?php
                                    if($pruebas_disponibles !== false){
                                        foreach ($pruebas_disponibles as $p) {
                                            ?>
                                            <option value="<?= $p["id_prueba"] ?>"><?= $p["nombre_prueba"] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.multiple-select').selectpicker();
</script>