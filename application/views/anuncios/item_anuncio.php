<div class="row">
    <div class="col-md-12">
        <div class="card card-anuncio">
            <div class="card-header">
                <h4><?= $anuncio["titulo"] ?></h4>
            </div>
            <div class="card-body">
                <h5 class="anuncio-date"><?= date("F j, Y g:i a", strtotime($anuncio["created_at"])) ?></h5>
                <p class="card-text"><?= $anuncio["descripcion"] ?></p>
            </div>
        </div>
    </div>
</div>