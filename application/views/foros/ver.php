<!-- Modal -->
<?php
    if(strtolower(logged_user()["rol"] != "estudiante") || ((date("Y-m-d H:i") >= date("Y-m-d H:i", strtotime($foro["disponible_desde"]))) && (date("Y-m-d H:i") <= date("Y-m-d H:i", strtotime($foro["disponible_hasta"]))))){
?>
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
                    <textarea id="imageManagementrespuesta"></textarea>
                    <div id="image_wrapper_respuesta" class="image-list">
                        <div class="file-list-info">
                            <input type="file" id="files_upload_respuesta" accept="image/*" multiple="multiple" class="files-text files-input files_upload_respuesta"/>
                            <span id="image_size_respuesta" class="total-size text-small-2">0KB</span>
                        </div>
                        <div class="file-list">
                            <ul id="image_list_respuesta">
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

        <script>
        editorImageRespuesta = null;;
        let tipoRespuestaForo = "foro";
        let idRespuestaForo = null;
        let idForo = null;
        let kothingParams = {
            width: '100%',
            height: 'auto',
            toolbarItem: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor'],
                ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
                ['link', 'table', 'image', 'audio', 'video'],
                '/', // Line break
                ['lineHeight', 'paragraphStyle', 'textStyle'],
                ['showBlocks', 'codeView'],
                ['preview', 'print', 'fullScreen'],
                ['save', 'template'],
                ['removeFormat']
            ],
            templates: [{
                    name: 'Template-1',
                    html: '<p>HTML source1</p>'
                },
                {
                    name: 'Template-2',
                    html: '<p>HTML source2</p>'
                },
            ],
            charCounter: true,
        }

        $(document).on("click", ".answer-toggle", function() {
            let toggle = $(this).attr("data-toggle");
            $("." + toggle).slideDown();
        });

        $(document).on("click", ".agregar-respuesta-foro", function() {
            tipoRespuestaForo = $(this).attr("data-type");
            if (tipoRespuestaForo == "respuesta") {
                idRespuestaForo = $(this).attr("data-id");
                idForo = null;
            } else {
                idRespuestaForo = null;
                idForo = $(this).attr("data-id");
            }
        });

            document.getElementById('image_wrapper_respuesta');
            const imageSize = document.getElementById('image_size_respuesta');
            const imageRemove = document.getElementById('image_remove');
            const imageTable = document.getElementById('image_list_respuesta');

            let imageList = [];
            let selectedImages = [];

            editorImageRespuesta = KothingEditor.create('imageManagementrespuesta', kothingParams);

            editorImageRespuesta.onImageUpload = function(targetImgElement, index, state, imageInfo, remainingFilesCount) {
                if (state === 'delete') {
                    imageList.splice(findIndexRespuesta(imageList, index), 1)
                } else {
                    if (state === 'create') {
                        const image = editorImageRespuesta.getImagesInfo()[findIndexRespuesta(editorImageRespuesta.getImagesInfo(), index)]
                        imageList.push(image)
                    } else {}
                }

                if (remainingFilesCount === 0) {
                    setImageListRespuesta(imageList)
                }
            }

            $(document).on("change", ".files_upload_respuesta", function(e) {
                if (e.target.files) {
                    editorImageRespuesta.insertImage(e.target.files)
                    e.target.value = ''
                }
            });

            // Click the file size
            function selectImageRespuesta(type, index) {
                imageList[findIndexRespuesta(imageList, index)][type]();
            }

            // Image check
            function checkImageRespuesta(index) {
                const li = imageTable.querySelector('#img_respuesta_' + index);
                const currentImageIdx = findIndexRespuesta(selectedImages, index)

                if (currentImageIdx > -1) {
                    selectedImages.splice(currentImageIdx, 1)
                    li.className = '';
                } else {
                    selectedImages.push(index)
                    li.className = 'checked';
                }

                if (selectedImages.length > 0) {
                    imageRemove.removeAttribute('disabled');
                } else {
                    imageRemove.setAttribute('disabled', true);
                }
            }

            // Click the remove button
            function deleteCheckedImagesRespuesta() {
                const iamgesInfo = editorImageRespuesta.getImagesInfo();

                for (let i = 0; i < iamgesInfo.length; i++) {
                    if (selectedImages.indexOf(iamgesInfo[i].index) > -1) {
                        iamgesInfo[i].delete();
                        i--;
                    }
                }

                selectedImages = []
            }


            // Edit image list
            function setImageListRespuesta() {
                let list = '';
                let size = 0;

                for (let i = 0, image, fixSize; i < imageList.length; i++) {
                    image = imageList[i];
                    fixSize = (image.size / 1000).toFixed(1) * 1

                    list += '<li id="img_respuesta_' + image.index + '">' +
                        '<div onclick="checkImageRespuesta(' + image.index + ')">' +
                        '<div class="image-wrapper"><img src="' + image.src + '"></div>' +
                        '</div>' +
                        '<a href="javascript:void(0)" onclick="selectImageRespuesta(\'select\',' + image.index + ')" class="image-size">' + fixSize + 'KB</a>' +
                        '<div class="image-check"><svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg></div>' +
                        '</li>';

                    size += fixSize;
                }

                imageSize.innerText = size.toFixed(1) + 'KB';
                imageTable.innerHTML = list;
            }

            // Array.prototype.findIndexRespuesta
            function findIndexRespuesta(arr, index) {
                let idx = -1;

                arr.some(function(a, i) {
                    if ((typeof a === 'number' ? a : a.index) === index) {
                        idx = i;
                        return true;
                    }
                    return false;
                })

                return idx;
            }

            function guardar_respuesta(foro) {
                var url = base_url + "Foros/agregar_respuesta";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        mensaje: editorImageRespuesta.getContents(),
                        id_foro: idForo,
                        id_respuesta: idRespuestaForo,
                        tipo: tipoRespuestaForo
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        if (data.status) {
                            $('#agregar-respuesta-foro').modal('hide');

                            setTimeout(() => {
                                ver_foro(foro);
                            }, 1000)

                        }
                        alert(data.message);
                    },
                    error: function() { alert("Error!"); }
                });
            }
        </script>
<?php
    }
    else{
        echo "Foro no disponible";
    }
?>