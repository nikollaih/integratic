<li class="list-group list-notificacion-anuncio">
    <a href="javascript:enlace_mat_est('<?= $codmateria ?>');listado('areas','<?= $nommateria ?>','<?= $nommateria.$grado ?>','<?= $grado.$grupo ?>','','<?= $codmateria ?>','<?= $grupo ?>');" class="list-group-item">
        <div class="media">
            <div class="media-body clearfix">
                <div>
                    <label class="notificacion-tipo" for="">Anuncio - <?= $nommateria ?></label>
                    <p style="font-size: 10px;color: #828282;margin-top:-6px;" for=""><?= date("d M, Y h:i a", strtotime($created_at)) ?></p>
                </div>
                <div class="media-heading not-anuncio-titulo"><?= $titulo ?></div>
                <div class="">Agregar nuevo anuncio</div>
                <p><?= (strlen($descripcion) > 100) ? substr($descripcion, 0, 100)."..." : $descripcion ?></p>
            </div>
        </div>
    </a>   
</li>