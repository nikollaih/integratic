<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="agregar-estudiante-recuperacion-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Agregar Estudiantes a la Recuperación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>Recuperaciones/asignar_estudiante_recuperacion" method="post">
                    <input type="hidden" name="id_recuperacion" value="<?= $recuperacion['id_recuperacion'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_estudiante" class="control-label">Estudiante</label>
                                <select required multiple name="estudiantes[]" id="" class="form-control multiple-select multiple" data-live-search="true" data-size="10" data-actions-box="true">
                                    <?php
                                    if($estudiantes_disponibles !== false){
                                        foreach ($estudiantes_disponibles as $ed) {
                                            ?>
                                            <option value="<?= $ed["documento"] ?>"><?= $ed["nombre"] ?></option>
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