<li class="list-group list-notificacion-anuncio">
    <a href="javascript:onPressNotificacion();" class="list-group-item">
        <div class="media">
            <div class="media-body clearfix">
                <div>
                    <label class="notificacion-tipo" for="">Anuncio - <?= $nommateria ?></label>
                    <p style="font-size: 10px;color: #828282;margin-top:-6px;" for=""><?= date("d M, Y h:i a", strtotime($created_at)) ?></p>
                </div>
                <div class="media-heading not-anuncio-titulo"><?= $titulo ?></div>
                <p><?= (strlen($descripcion) > 100) ? substr($descripcion, 0, 100)."..." : $descripcion ?></p>
            </div>
        </div>
    </a>   
</li>

<script>
    function onPressNotificacion(){
        enlace_mat_est('<?= $codmateria ?>');
        listado('areas','<?= $nommateria ?>','<?= $nommateria.$grado ?>','<?= $grado.$grupo ?>','','<?= $codmateria ?>','<?= $grupo ?>');
    }
</script>