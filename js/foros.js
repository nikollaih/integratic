let editorImageRespuesta;
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
    templates: [
      {
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

$(document).on( "click", ".answer-toggle", function() {
    let toggle = $(this).attr("data-toggle");
    $("." + toggle).slideDown();
});

$(document).on( "click", ".agregar-respuesta-foro", function() {
    tipoRespuestaForo = $(this).attr("data-type");
    if(tipoRespuestaForo == "respuesta"){
        idRespuestaForo = $(this).attr("data-id");
        idForo = null;
    }
    else{
        idRespuestaForo = null;
        idForo = $(this).attr("data-id");
    }
});

setTimeout(() => {        
    document.getElementById('image_wrapper');
    const imageSize = document.getElementById('image_size');
    const imageRemove = document.getElementById('image_remove');
    const imageTable = document.getElementById('image_list');

    let imageList = [];
    let selectedImages = [];

    editorImageRespuesta = KothingEditor.create('imageManagement', kothingParams);

    editorImageRespuesta.onImageUpload = function (targetImgElement, index, state, imageInfo, remainingFilesCount) {
        if (state === 'delete') {
            imageList.splice(findIndexRespuesta(imageList, index), 1)
        } else {
            if (state === 'create') {
                const image = editorImageRespuesta.getImagesInfo()[findIndexRespuesta(editorImageRespuesta.getImagesInfo(), index)]
                imageList.push(image)
            } else { }
        }

        if (remainingFilesCount === 0) {
            setImageListRespuesta(imageList)
        }
    }

    $(document).on( "change", ".files_upload_respuesta", function(e) {
        if (e.target.files) {
            editorImageRespuesta.insertImage(e.target.files)
            e.target.value = ''
        }
    });

    // Click the file size
    function selectImageRespuesta (type, index) {
        imageList[findIndexRespuesta(imageList, index)][type]();
    }

    // Image check
    function checkImageRespuesta (index) {
        const li = imageTable.querySelector('#img_' + index);
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
    function setImageListRespuesta () {
        let list = '';
        let size = 0;

        for (let i = 0, image, fixSize; i < imageList.length; i++) {
            image = imageList[i];
            fixSize = (image.size / 1000).toFixed(1) * 1
                
            list += '<li id="img_' + image.index + '">' +
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

        arr.some(function (a, i) {
            if ((typeof a === 'number' ? a : a.index) === index) {
                idx = i;
                return true;
            }
            return false;
        })

        return idx;
    }
}, 1000);

function guardar_respuesta(foro){
    var url = "./index.php/Foros/agregar_respuesta";   
        $.ajax({
            url:url,
            type:'POST',
            data: {
                mensaje: editorImageRespuesta.getContents(),
                id_foro: idForo,
                id_respuesta: idRespuestaForo,
                tipo: tipoRespuestaForo
            },
            success:function(data){
                var data = JSON.parse(data);
                
                if(data.status){
                    $('#agregar-respuesta-foro').modal('hide') ; 

                    setTimeout(() => {
                        ver_foro(foro);
                    }, 1000)

                }
                alert(data.message); 
            },
            error:function(){ alert("Error!");}                                   
    });
}

function guardar_foro(){
    let titulo = $("#nuevo-foro-titulo").val();
    let materia = $("#nuevo-foro-materia").val();
    let grupo = $("#nuevo-foro-grupo").val();

    if(titulo.trim() != "" && materia && grupo){
        var url = "./index.php/Foros/agregar_foro";   
        $.ajax({
            url:url,
            type:'POST',
            data: {
                descripcion: editorImageForo.getContents(),
                titulo: titulo,
                materia: materia,
                grupo: grupo
            },
            success:function(data){
                var data = JSON.parse(data);
                
                if(data.status){
                    let titulo = $("#nuevo-foro-titulo").val("");
                    $('#agregar-nuevo-foro').modal('hide') ; 

                    setTimeout(() => {
                        ver_foro(data.object.id_foro);
                    }, 1000)
                }

                alert(data.message); 
            },
            error:function(){ alert("Error!");}                                   
        });
    }
    else{
        alert("Por favor complete todos los campos requeridos!");
    }
}