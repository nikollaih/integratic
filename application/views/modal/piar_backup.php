<!-- Modal observaciones plan aula -->
<?php $piarBackupYear = date("Y") ?>
<div class="modal fade bd-example-modal-sm" id="piar-backup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Generación de backups de P.I.A.R.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Año</label>
                    <select name="" id="backup-piar-year" class="form-control">
                        <?php
                            for ($year = 2020; $year <= date("Y"); $year++) { ?>
                                <option <?= ($year == $piarBackupYear) ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
                            <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary backup-piar-generate-button">Generar archivos</button>
            </div>
        </div>
    </div>
</div>