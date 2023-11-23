<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="agregar-nuevo-anuncio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregar-nuevo-anuncio-label">Crear nuevo anuncio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="text" id="nuevo-anuncio-anuncio" value="">
            <div class="form-group">
                <label for="">Titulo *</label>
                <input class="form-control input-lg" type="text" name="" id="nuevo-anuncio-titulo">
            </div>
            <div class="form-group">
                <label for="">Descripción *</label>
                <textarea id="nuevo-anuncio-descripcion" rows=10 class="form-control"></textarea>
            </div>
            <div id="image_wrapper_richtext_anuncios" class="image-list">
                <div class="file-list-info">
                    <input type="file" id="files_upload_anuncios" accept="image/*" multiple="multiple" class="files-text files-input files_upload_anuncios"/>
                    <span id="image_size_richtext_anuncios" class="total-size text-small-2">0KB</span>
                </div>
                <div class="file-list">
                    <ul id="image_list_richtext_anuncios">
                    </ul>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar_anuncio('true')" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
  let editorRichAnuncios;
  let selectedImagesAnuncios = [];

  $( document ).ready(function() {  
      let textarea = document.getElementById('nuevo-anuncio-descripcion'); 

      if(textarea){
          document.getElementById('image_wrapper_richtext');
      
          let imageList = [];
      
          editorRichAnuncios = KothingEditor.create('nuevo-anuncio-descripcion', kothingParams);
      
          editorRichAnuncios.onImageUpload = function (targetImgElement, index, state, imageInfo, remainingFilesCount) {
              if (state === 'delete') {
                  imageList.splice(findIndex(imageList, index), 1)
              } else {
                  if (state === 'create') {
                      const image = editorRichAnuncios.getImagesInfo()[findIndex(editorRichAnuncios.getImagesInfo(), index)]
                      imageList.push(image)
                  } else { }
              }
      
              if (remainingFilesCount === 0) {
                  setImageList(imageList)
              }
          }
      }

      $(document).on( "change", ".files_upload_anuncios", function(e) {
          if (e.target.files) {
              editorRichAnuncios.insertImage(e.target.files)
              e.target.value = ''
          }
      });


      // Edit image list
      function setImageList (imageList) {
          let imageTable = document.getElementById('image_list_richtext_anuncios');
          let imageSize = document.getElementById('image_size_richtext_anuncios');
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
  });

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
      let imageRemove = document.getElementById('image_remove_richtext_anuncios');
      let imageTable = document.getElementById('image_list_richtext_anuncios');
      const li = imageTable.querySelector('#img_' + index);
      const currentImageIdx = findIndex(selectedImagesAnuncios, index)

      if (currentImageIdx > -1) {
          selectedImagesAnuncios.splice(currentImageIdx, 1)
          li.className = '';
      } else {
          selectedImagesAnuncios.push(index)
          li.className = 'checked';
      }

      if (selectedImagesAnuncios.length > 0) {
          imageRemove.removeAttribute('disabled');
      } else {
          imageRemove.setAttribute('disabled', true);
      }
  }

  // Click the remove button
  function deleteCheckedImages() {
      const iamgesInfo = editorRichAnuncios.getImagesInfo();

      for (let i = 0; i < iamgesInfo.length; i++) {
          if (selectedImagesAnuncios.indexOf(iamgesInfo[i].index) > -1) {
              iamgesInfo[i].delete();
              i--;
          }
      }

      selectedImagesAnuncios = []
  }
</script>