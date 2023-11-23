<?php setlocale(LC_ALL, 'es_CO'); ?>
<div class="row" id="an-<?= $anuncio["id_anuncio"] ?>">
    <div class="col-md-12">
        <div class="card card-anuncio">
            <div class="card-header d-flex" style="justify-content: space-between;">
                <h4><?= $anuncio["titulo"] ?></h4>
                <?php
                    if(logged_user()["rol"] == "Docente"){
                        ?>
                            <div class="d-flex">
                                <a style="margin-right:10px;" class="d-flex align-items-center btn-editar-anuncio pointer" data-id="<?= $anuncio["id_anuncio"] ?>"> 
                                    <i class="fa fa-edit text-white"></i>
                                </a>
                                <a class="d-flex align-items-center btn-eliminar-anuncio pointer" data-id="<?= $anuncio["id_anuncio"] ?>"> 
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <div class="card-body">
                <h5 class="anuncio-date"><?= date("F j, Y g:i a", strtotime($anuncio["created_at"])) ?></h5>
                <p class="card-text"><?= $anuncio["descripcion"] ?></p>
            </div>
        </div>
    </div>
</div>