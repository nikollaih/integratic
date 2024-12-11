let editorRichActividades;
let selectedImagesActividades = [];

$( document ).ready(function() {  
    let textarea = document.getElementById('nueva-actividad-descripcion'); 

    if(textarea){
        document.getElementById('image_wrapper_richtext');
    
        let imageList = [];
    
        editorRichActividades = KothingEditor.create('nueva-actividad-descripcion', kothingParams);
    
        editorRichActividades.onImageUpload = function (targetImgElement, index, state, imageInfo, remainingFilesCount) {
            if (state === 'delete') {
                imageList.splice(findIndex(imageList, index), 1)
            } else {
                if (state === 'create') {
                    const image = editorRichActividades.getImagesInfo()[findIndex(editorRichActividades.getImagesInfo(), index)]
                    imageList.push(image)
                } else { }
            }
    
            if (remainingFilesCount === 0) {
                setImageList(imageList)
            }
        }
    }

    $(document).on( "change", ".files_upload_actividades", function(e) {
        if (e.target.files) {
            editorRichActividades.insertImage(e.target.files)
            e.target.value = ''
        }
    });


    // Edit image list
    function setImageList (imageList) {
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
    let imageRemove = document.getElementById('image_remove_richtext_actividades');
    let imageTable = document.getElementById('image_list_richtext_actividades');
    const li = imageTable.querySelector('#img_' + index);
    const currentImageIdx = findIndex(selectedImagesActividades, index)

    if (currentImageIdx > -1) {
        selectedImagesActividades.splice(currentImageIdx, 1)
        li.className = '';
    } else {
        selectedImagesActividades.push(index)
        li.className = 'checked';
    }

    if (selectedImagesActividades.length > 0) {
        imageRemove.removeAttribute('disabled');
    } else {
        imageRemove.setAttribute('disabled', true);
    }
}

// Click the remove button
function deleteCheckedImages() {
    const iamgesInfo = editorRichActividades.getImagesInfo();

    for (let i = 0; i < iamgesInfo.length; i++) {
        if (selectedImagesActividades.indexOf(iamgesInfo[i].index) > -1) {
            iamgesInfo[i].delete();
            i--;
        }
    }

    selectedImagesActividades = []
}

$(document).on("click", ".crear-respuesta-boton", function() {
    let actividad = $(this).attr("data-actividad");
    $("#respuesta-actividad-id").val(actividad);
});

$(document).on("click", ".button-editar-actividad", function() {
    let actividad = $(this).attr("data-actividad");
    get_actividad(actividad);
});

$(document).on("click", ".button-agregar-nueva-actividad", function() {
    get_actividades_repositorio();
    set_actividad();
});

$(document).on("click", ".btn-habilitar-actividad", function() {
    let actividad = $(this).attr("data-actividad");
    let estudiante = $(this).attr("data-estudiante");
    habilitar_estudiante_actividad(actividad, estudiante);
});

$(document).on("click", ".btn-inhabilitar-actividad", function() {
    let actividad = $(this).attr("data-actividad");
    let estudiante = $(this).attr("data-estudiante");
    inhabilitar_estudiante_actividad(actividad, estudiante);
});

$(document).on("click", ".button-eliminar-actividad", function() {
    let actividad = $(this).attr("data-actividad");
    eliminar_actividad(actividad);
});

$(document).on("change", "#nueva-actividad-repositorio-actividad", function() {
    if(Array.isArray(ACTIVIDADES_REPOSITORIO)){
        let selected_activity_id = jQuery(this).val();
        let selected_activity = ACTIVIDADES_REPOSITORIO.find((activity) => activity.id_repositorio_actividad === selected_activity_id);
        if(selected_activity){
            jQuery("#nueva-actividad-from-repo-id").val(selected_activity.id_actividad);
            jQuery("#nueva-actividad-from-repo").val(true);
            set_actividad(selected_activity, true);
        }
    }
});

$(document).on("click", ".btn-eliminar-respuesta-actividad", function() {
    let actividad = $(this).attr("data-actividad");
    let respuesta = $(this).attr("data-id");
    eliminar_respuesta_actividad(actividad, respuesta);
});

$(document).on("click", ".cargar-respuestas-boton", function() {
    let actividad = $(this).attr("data-actividad");
    $(".items-repsuestas-estudiante").html("<tr><td colspan='7'><div class='loader'></td></div></tr>");
    $("#button-descargar-archivos-actividad").attr("data-id", actividad);
    obtener_actividad_respuestas(actividad);
});

$(document).on('click', '#button-descargar-archivos-actividad', function(){
    let idActividad = $(this).attr("data-id");
    window.open(base_url + "RespuestasActividades/downloadZIPFile/" + idActividad, '_blank');
})

$(document).on("click", ".btn-guardar-calificar", function() {
    let respuesta = $(this).attr("data-id");
    let calificacion = $("#calificacion-respuesta-nota-" + respuesta).val();
    let notas = $("#calificacion-respuesta-notas-" + respuesta).val();
    calificar_respuesta(respuesta, calificacion, notas);
});

$(document).on("click", ".btn-calificar", function() {
    let respuesta = $(this).attr("data-id");
    $(".modificar-calificacion-respuesta-" + respuesta).removeClass("no-calificar");
    $(".modificar-calificacion-respuesta-" + respuesta).prop("readonly", false);
    $(this).hide();
    $("#btn-guardar-calificacion-" + respuesta).show();
});

function guardar_actividad() {
    let id_actividad = $("#nueva-actividad-actividad").val();
    let titulo = $("#nueva-actividad-titulo").val();
    let descripcion = editorRichActividades.getContents();
    let periodo = $("#nueva-actividad-periodo").val();
    let desde = $("#nueva-actividad-start").val();
    let hasta = $("#nueva-actividad-end").val();
    let from_repo = $("#nueva-actividad-from-repo").val();
    let porcentaje = $("#nueva-actividad-porcentaje").val();
    let recuperacion = $("#nueva-actividad-recuperacion").val();
    let from_repo_id = $("#nueva-actividad-from-repo-id").val();

    if (titulo.trim() !== "" && descripcion.trim() !== "" && periodo.trim() !== "" && desde.trim() !== "" && hasta.trim() !== "" && porcentaje.trim() !== "") {
        var formData = new FormData();
        formData.append("id_actividad", $("#nueva-actividad-actividad").val());
        formData.append("titulo", titulo);
        formData.append("descripcion", descripcion);
        formData.append("disponible_desde", desde);
        formData.append("disponible_hasta", hasta);
        formData.append("id_periodo", periodo);
        formData.append("id_actividad", id_actividad);
        formData.append("porcentaje", porcentaje);
        formData.append("es_recuperacion", recuperacion);
        formData.append("from_repo", from_repo);
        formData.append("from_repo_id", from_repo_id);
        formData.append("userfile", $('#nueva-actividad-file')[0].files[0]);

        $.ajax({
            url: 'index.php/Actividades/guardar',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status) {
                    enlace_mat_est(response.object.materia, "true");
                    $('#actividad-form').trigger("reset");
                    jQuery("#nueva-actividad-from-repo").val(false);
                    editorRichActividades.setContents("");
                    $("#agregar-nueva-actividad").modal("hide");
                }
                alert(response.message);
            }
        });
    } else {
        alert("Por favor complete todos los campos requeridos");
    }
}

function guardar_actividad_respuesta() {
    if ($("#respuesta-actividad-id").val().trim() !== "" && $("#respuesta-actividad-id").val() !== null) {
        var formData = new FormData();
        formData.append("id_actividad", $("#respuesta-actividad-id").val());
        formData.append("notas", $("#respuesta-actividad-notas").val());
        formData.append("userfile", $('#respuesta-actividad-file')[0].files[0]);

        $.ajax({
            url: 'index.php/Actividades/guardar_respuesta',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                var response = JSON.parse(data);

                if (response.status) {
                    $('#respuesta-actividad-form').trigger("reset");
                    $("#agregar-respuesta-actividad").modal("hide");
                }

                alert(response.message);
            }
        });
    } else {
        alert("Por favor complete todos los campos requeridos");
    }
}

function obtener_actividad_respuestas(actividad) {
    $.ajax({
        url: 'index.php/Actividades/actividades_respuestas',
        data: { id_actividad: actividad },
        type: 'POST',
        success: function(data) {
            let response = JSON.parse(data);
            $(".items-repsuestas-estudiante").html(response.object);
        }
    });
}

function calificar_respuesta(respuesta = null, calificacion = null, notas = "") {
    if (respuesta != null && calificacion != null) {
        $.ajax({
            url: 'index.php/Actividades/calificar_respuesta',
            data: {
                id: respuesta,
                calificacion: calificacion,
                notas: notas
            },
            type: 'POST',
            success: function(data) {
                let response = JSON.parse(data);
                if (response.status) {
                    let respuestaDOM = $(".modificar-calificacion-respuesta-" + respuesta);
                    respuestaDOM.addClass("no-calificar");
                    respuestaDOM.prop("readonly", true);
                    $("#btn-modificar-calificacion-" + respuesta).show();
                    $("#btn-guardar-calificacion-" + respuesta).hide();
                }
                else {
                    alert(response.message);
                }
            }
        });
    }
}


function eliminar_actividad(id_actividad) {
    if (confirm("¿Está seguro que desea eliminar la actividad?") === true) {
        $.ajax({
            url: base_url + 'Actividades/delete/' + id_actividad,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    $("#actividad-" + id_actividad).remove();
                }
                else {
                    alert(data.message);
                }

                if (data.object.error == "auth") {
                    prelogin();
                }
            }
        });
    }
}

function habilitar_estudiante_actividad(id_actividad, id_estudiante) {
    if (confirm("¿Está seguro que desea habilitar la actividad para este estudiante?") === true) {
        $.ajax({
            url: base_url + 'Actividades/habilitar',
            data: {
                id_actividad: id_actividad,
                id_estudiante: id_estudiante
            },
            type: 'POST',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    obtener_actividad_respuestas(id_actividad);
                }
                alert(data.message);
            }
        });
    }
}

function inhabilitar_estudiante_actividad(id_actividad, id_estudiante) {
    if (confirm("¿Está seguro que desea inhabilitar la actividad para este estudiante?") === true) {
        $.ajax({
            url: base_url + 'Actividades/inhabilitar',
            data: {
                id_actividad: id_actividad,
                id_estudiante: id_estudiante
            },
            type: 'POST',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    obtener_actividad_respuestas(id_actividad);
                }
                alert(data.message);
            }
        });
    }
}

function eliminar_respuesta_actividad(id_actividad, id_respuesta) {
    if (confirm("¿Está seguro que desea eliminar la respuesta?") === true) {
        $.ajax({
            url: base_url + 'Actividades/deleteRespuesta/' + id_respuesta,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    obtener_actividad_respuestas(id_actividad);
                }

                if (data.object.error == "auth") {
                    prelogin();
                }
                alert(data.message);
            }
        });
    }
}

function get_actividad(idActividad){
    $.ajax({
        url: base_url + 'Actividades/getActividad/' + idActividad,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            if (data.status) 
                set_actividad(data.object);
            else 
                alert(data.message);

            if (data.object.error == "auth") {
                prelogin();
            }
        }
    });
}

var ACTIVIDADES_REPOSITORIO = false;
function get_actividades_repositorio(){
    $.ajax({
        url: base_url + 'RepositorioActividades/getByMateria',
        type: 'GET',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data)
            if(data.status) {
                ACTIVIDADES_REPOSITORIO = data.object;
                set_actividades_repositorio(ACTIVIDADES_REPOSITORIO);
            }

            if (data.object.error === "auth") {
                prelogin();
            }
        }
    });
}

function set_actividades_repositorio(actividades) {
    let selectInput = jQuery("#nueva-actividad-repositorio-actividad");
    selectInput.html('<option value="">- Seleccionar </option>');

    if(Array.isArray(actividades)) {
        for (let i = 0; i < actividades.length; i++) {
            let actividad = actividades[i];
            selectInput.append('<option value="'+actividad.id_repositorio_actividad+'">'+actividad.titulo+'</option>');
        }
    }
}

function set_actividad(actividad = null, is_repo = false){
    if(actividad){
        if(!is_repo){
            jQuery("#agregar-nueva-actividad-label").html("Modificar actividad");
            jQuery("#nueva-actividad-actividad").val(actividad.id_actividad);
            jQuery("#nueva-actividad-titulo").val(actividad.titulo_actividad);
            jQuery("#nueva-actividad-periodo").val(actividad.id_periodo);
            jQuery("#nueva-actividad-start").val(actividad.disponible_desde);
            jQuery("#nueva-actividad-end").val(actividad.disponible_hasta);
            jQuery("#nueva-actividad-porcentaje").val(actividad.porcentaje);
            jQuery("#nueva-actividad-recuperacion").val(actividad.es_recuperacion);
            editorRichActividades.setContents(actividad.descripcion_actividad);
        }
        else{
            jQuery("#nueva-actividad-titulo").val(actividad.titulo);
            editorRichActividades.setContents(actividad.descripcion);
        }
    }
    jQuery("#agregar-nueva-actividad").modal("show");
}