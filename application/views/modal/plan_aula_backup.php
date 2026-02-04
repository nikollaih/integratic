<!-- Modal backup plan aula -->
<?php $planAulaBackupYear = date("Y") ?>
<div class="modal fade bd-example-modal-sm" id="planaula-backup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Generaci&oacute;n de backups de plan de aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="backup-planaula-year">A&ntilde;o</label>
                    <select name="" id="backup-planaula-year" class="form-control">
                        <?php
                        for ($year = 2020; $year <= date("Y"); $year++) { ?>
                            <option <?= ($year == $planAulaBackupYear) ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="backup-planaula-area" class="control-label">Área</label>
                    <select class="form-control" id="backup-planaula-area" name="">
                        <?php
                            $areas = get_areas();
                            if($areas){
                                foreach ($areas as $area) {
                                    echo '<option value="'.$area['codarea'].'">'.$area['nomarea'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary backup-planaula-generate-button">Generar archivos</button>
            </div>
        </div>
    </div>
</div>