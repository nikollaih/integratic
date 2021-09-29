
<link href="https://kothing.github.io/editor/dist/css/kothing-editor.min.css" rel="stylesheet">
<script src="https://kothing.github.io/editor/dist/kothing-editor.min.js"></script>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="agregar-respuesta-foro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregar-respuesta-foro-label" style="color:#ff9133;"><?= $foro["titulo"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
            <textarea id="imageManagement"></textarea>
            <div id="image_wrapper" class="image-list">
                <div class="file-list-info">
                    <input type="file" id="files_upload_respuesta" accept="image/*" multiple="multiple" class="files-text files-input files_upload_respuesta"/>
                    <span id="image_size" class="total-size text-small-2">0KB</span>
                </div>
                <div class="file-list">
                    <ul id="image_list">
                    </ul>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_respuesta(<?= $foro['id_foro'] ?>)" type="button" class="btn btn-primary">Guardar Respuesta</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-100">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-12">
            <div class="card mb-4 item-foro">
                <div class="card-header">
                    <h4 style="color:#ff9133;"><?= $foro["titulo"] ?></h4>
                    <div class="media flex-wrap w-100 align-items-center">
                        <div class="media-body ml-3"> <a data-abc="true"><?= $foro["nombres"]." ".$foro["apellidos"]  ?></a>
                            <div class="text-muted small"><?= date("Y-m-d, h:i a", strtotime($foro["created_at"])) ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p><?= $foro["descripcion"] ?></p>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-comment" style="color:#ff9133;"></i>&nbsp; <span class="align-middle"><?= ($respuestas) ? count($respuestas) : "0" ?></span> </a>  </div>
                    <div class="px-4 pt-3"> <button data-toggle="modal" data-target="#agregar-respuesta-foro" data-id="<?= $foro['id_foro'] ?>" data-type="foro" type="button" class="btn btn-primary agregar-respuesta-foro"><i class="fa fa-plus"></i>&nbsp; Agregar Respuesta</button> </div>
                </div>
            </div>
        </div>
    </div>
    <?= $dom ?>
</div>
<!-- Foros -->
<script src="js/foros.js"></script>