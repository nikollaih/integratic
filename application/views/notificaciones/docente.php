<li class="list-group list-notificacion-anuncio">
    <a href="javascript:enlace_mat_est('<?= $codmateria ?>');listardoc('areas','<?= $nommateria ?>','<?= $nommateria.$grado ?>','<?= $grado.$grupo ?>','<?= $codmateria ?>','<?= $grupo ?>');" class="list-group-item">
        <div class="media">
            <div class="media-body clearfix">
                <div>
                    <label class="notificacion-tipo" for=""><?= $nommateria ?></label>
                    <p style="font-size: 10px;color: #828282;margin-top:-6px;" for=""><?= date("d M, Y h:i a", strtotime($fecha)) ?></p>
                </div>
                <?= $descripcion ?>
            </div>
        </div>
    </a>   
</li>