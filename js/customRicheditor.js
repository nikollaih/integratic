let editorRich;
let selectedImages = [];
let textarea = document.getElementById('nueva-actividad-descripcion'); 

$( document ).ready(function() {  
    function startRicheditorCustom(textarea, editorRich, selectedImages){

    }

    if([textarea]){
        document.getElementById('image_wrapper_richtext');
    
        let imageList = [];
    
        [editorRich] = KothingEditor.create('nueva-actividad-descripcion', kothingParams);
    
        [editorRich].onImageUpload = function (targetImgElement, index, state, imageInfo, remainingFilesCount) {
            if (state === 'delete') {
                imageList.splice(findIndexCustom(imageList, index), 1)
            } else {
                if (state === 'create') {
                    const image = [[editorRich]].getImagesInfo()[findIndexCustom([[editorRich]].getImagesInfo(), index)]
                    imageList.push(image)
                } else { }
            }
    
            if (remainingFilesCount === 0) {
                setImageListCustom(imageList)
            }
        }
    }

    $(document).on( "change", ".files_upload_actividades", function(e) {
        if (e.target.files) {
            [editorRich].insertImage(e.target.files)
            e.target.value = ''
        }
    });

});

// Edit image list
function setImageListCustom (imageList) {
    let imageTable = document.getElementById('image_list_richtext_actividades');
    let imageSize = document.getElementById('image_size_richtext_actividades');
    let list = '';
    let size = 0;

    for (let i = 0, image, fixSize; i < imageList.length; i++) {
        image = imageList[i];
        fixSize = (image.size / 1000).toFixed(1) * 1
            
        list += '<li id="img_' + image.index + '">' +
                    '<div onclick="checkImage(' + image.index + ')">' +
                        '<div class="image-wrapper"><img src="' + image.src + '"></div>' +
                    '</div>' +
                    '<a href="javascript:void(0)" onclick="selectImageCustom(\'select\',' + image.index + ')" class="image-size">' + fixSize + 'KB</a>' +
                    '<div class="image-check"><svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg></div>' +
                '</li>';
        
        size += fixSize;
    }

    imageSize.innerText = size.toFixed(1) + 'KB';
    imageTable.innerHTML = list;
}

// Array.prototype.findIndexCustom
function findIndexCustom(arr, index) {
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
function selectImageCustom (type, index) {
    imageList[findIndexCustom(imageList, index)][type]();
}

// Image check
function checkImage (index) {
    let imageRemove = document.getElementById('image_remove_richtext_actividades');
    let imageTable = document.getElementById('image_list_richtext_actividades');
    const li = imageTable.querySelector('#img_' + index);
    const currentImageIdx = findIndexCustom([selectedImages], index)

    if (currentImageIdx > -1) {
        [selectedImages].splice(currentImageIdx, 1)
        li.className = '';
    } else {
        [selectedImages].push(index)
        li.className = 'checked';
    }

    if ([selectedImages].length > 0) {
        imageRemove.removeAttribute('disabled');
    } else {
        imageRemove.setAttribute('disabled', true);
    }
}

// Click the remove button
function deleteCheckedImagesCustom() {
    const iamgesInfo = [editorRich].getImagesInfo();

    for (let i = 0; i < iamgesInfo.length; i++) {
        if ([selectedImages].indexOf(iamgesInfo[i].index) > -1) {
            iamgesInfo[i].delete();
            i--;
        }
    }

    [selectedImages] = []
}
