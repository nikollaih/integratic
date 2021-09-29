<li class="list-group list-notificacion-anuncio">
    <a href="javascript:filtrar_menu('VIDEOS');" class="list-group-item">
        <div class="media">
            <div class="media-body clearfix">
                <label class="notificacion-tipo" for="">Anuncio - <?= $nommateria ?></label>
                <div class="media-heading not-anuncio-titulo"><?= $titulo ?></div>
                <p><?= (strlen($descripcion) > 100) ? substr($descripcion, 0, 100)."..." : $descripcion ?></p>
            </div>
        </div>
    </a>   
</li>