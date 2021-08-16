let editorImageSample;

setTimeout(() => {        
     document.getElementById('image_wrapper');
    const imageSize = document.getElementById('image_size');
    const imageRemove = document.getElementById('image_remove');
    const imageTable = document.getElementById('image_list');

    let imageList = [];
    let selectedImages = [];

    editorImageSample = KothingEditor.create('imageManagement', {
        buttonList: [
            ['undo', 'redo',  'font', 'fontSize'],
            ['formatBlock'],
            ['horizontalRule', 'list', 'table'],
            ['image', 'video'],
            ['showBlocks', 'fullScreen', 'preview', 'print']
        ],
    })

    editorImageSample.onImageUpload = function (targetImgElement, index, state, imageInfo, remainingFilesCount) {
        if (state === 'delete') {
            imageList.splice(findIndex(imageList, index), 1)
        } else {
            if (state === 'create') {
                const image = editorImageSample.getImagesInfo()[findIndex(editorImageSample.getImagesInfo(), index)]
                imageList.push(image)
            } else { }
        }

        if (remainingFilesCount === 0) {
            setImageList(imageList)
        }
    }

    // Upload from outside the editor
    document.getElementById('files_upload').addEventListener('change', function (e) {
        if (e.target.files) {
            editorImageSample.insertImage(e.target.files)
            e.target.value = ''
        }
    })

    // Edit image list
    function setImageList () {
        let list = '';
        let size = 0;

        for (let i = 0, image, fixSize; i < imageList.length; i++) {
            image = imageList[i];
            fixSize = (image.size / 1000).toFixed(1) * 1
                
            list += '<li id="img_' + image.index + '">' +
                        '<div onclick="checkImage(' + image.index + ')">' +
                            '<div class="image-wrapper"><img src="' + image.src + '"></div>' +
                        '</div>' +
                        '<a href="javascript:void(0)" onclick="selectImage(\'select\',' + image.index + ')" class="image-size">' + fixSize + 'KB</a>' +
                        '<div class="image-check"><svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg></div>' +
                    '</li>';
            
            size += fixSize;
        }

        imageSize.innerText = size.toFixed(1) + 'KB';
        imageTable.innerHTML = list;
    }

    // Array.prototype.findIndex
    function findIndex(arr, index) {
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

    // Click the file size
    function selectImage (type, index) {
        imageList[findIndex(imageList, index)][type]();
    }

    // Image check
    function checkImage (index) {
        const li = imageTable.querySelector('#img_' + index);
        const currentImageIdx = findIndex(selectedImages, index)

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
    function deleteCheckedImages() {
        const iamgesInfo = editorImageSample.getImagesInfo();

        for (let i = 0; i < iamgesInfo.length; i++) {
            if (selectedImages.indexOf(iamgesInfo[i].index) > -1) {
                iamgesInfo[i].delete();
                i--;
            }
        }

        selectedImages = []
    }
}, 1000);

function guardar_respuesta(id_foro){
    var url = "./index.php/Foros/agregar_respuesta/" + id_foro;   
        $.ajax({
            url:url,
            type:'POST',
            data: {mensaje: editorImageSample.getContents() },
            success:function(data){
                var data = JSON.parse(data);
                
                if(data.status){
                    $('#agregar-respuesta-foro').modal('hide') ; 

                    setTimeout(() => {
                        ver_foro(id_foro);
                    }, 1000)

                }
                alert(data.message); 
            },
            error:function(){ alert("Error!");}                                   
    });
}