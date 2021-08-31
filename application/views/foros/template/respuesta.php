<div class="row" style="margin-top:30px;">
        <div class="col-md-12" style="padding-left:70px;">
            <ul style="padding:0;">
                        <li style="list-style:none;margin-bottom: 10px;">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="media flex-wrap w-100 align-items-center">
                                            <div class="media-body ml-3"> <a data-abc="true"><?= $r["nombres"]." ".$r["apellidos"]  ?></a>
                                                <div class="text-muted small"><?= date("Y-m-d, h:i a", strtotime($foro["created_at"])) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p><?= $r["descripcion"] ?></p>
                                    </div>
                                    <div class="px-4 pt-3"> <button data-toggle="modal" data-target="#agregar-respuesta-foro" type="button" data-type="respuesta" data-id="<?= $r["id_respuesta"] ?>" class="btn btn-primary agregar-respuesta-foro"><i class="fa fa-plus"></i>&nbsp; Agregar Respuesta</button> </div>
                                </div>
                            </li>
            </ul>
        </div>
    </div>