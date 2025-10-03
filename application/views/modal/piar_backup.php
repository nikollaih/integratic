<!-- Modal observaciones plan aula -->
<?php $piarBackupYear = date("Y") ?>
<div class="modal fade bd-example-modal-sm" id="piar-backup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Generaci&oacute;n de backups de P.I.A.R.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="backup-piar-year">A&ntilde;o</label>
                    <select name="" id="backup-piar-year" class="form-control">
                        <?php
                            for ($year = 2020; $year <= date("Y"); $year++) { ?>
                                <option <?= ($year == $piarBackupYear) ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="backup-piar-grado" class="control-label">Grado</label>
                    <select class="form-control" id="backup-piar-grado" name="">
                        <option value="0">Transici&oacute;n</option>
                        <option value="1">Primero</option>
                        <option value="2">Segundo</option>
                        <option value="3">Tercero</option>
                        <option value="4">Cuarto</option>
                        <option value="5">Quinto</option>
                        <option value="6">Sexto</option>
                        <option value="7">S&eacute;ptimo</option>
                        <option value="8">Octavo</option>
                        <option value="9">Noveno</option>
                        <option value="10">D&eacute;cimo</option>
                        <option value="11">Und&eacute;cimo</option>
                        <option value="C1">Ciclo I</option>
                        <option value="C2">Ciclo II</option>
                        <option value="C3">Ciclo III</option>
                        <option value="C4">Ciclo IV </option>
                        <option value="C5">Ciclo V</option>
                        <option value="C6">Ciclo VI</option>
                        <option value="P1">Pensar I</option>
                        <option value="P2">Pensar II</option>
                        <option value="P3">Pensar III</option>
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