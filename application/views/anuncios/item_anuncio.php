<div class="row" id="an-<?= $anuncio["id_anuncio"] ?>">
    <div class="col-md-12">
        <div class="card card-anuncio">
            <div class="card-header d-flex" style="justify-content: space-between;">
                <h4><?= $anuncio["titulo"] ?></h4>
                <img data-id="<?= $anuncio["id_anuncio"] ?>" class="btn-eliminar-anuncio" style="align-self: flex-end;background: #fff;padding: 2px 2px;width: 19px;border-radius: 4px;cursor:pointer;" src="<?= base_url() ?>img/iconos/borrar.png" alt="" width="15" srcset="">
            </div>
            <div class="card-body">
                <h5 class="anuncio-date"><?= date("F j, Y g:i a", strtotime($anuncio["created_at"])) ?></h5>
                <p class="card-text"><?= $anuncio["descripcion"] ?></p>
            </div>
        </div>
    </div>
</div>