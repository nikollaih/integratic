let editorEntornoPersonal = null;
let editorDescripcionGeneral = null;
let editorDescripcionQueHace = null;
let editorCompromisosEspecificos = null;
let editorComentariosCoordinadorPIAR = null;
const kothingParamsPlan = {
    fontSize: [8, 10, 12, 14, 16, 18, 20], // Lista de tamaños de letra
    defaultFontSize: 10, // Tamaño de letra predeterminado
    width: '100%',
    height: 'auto',
    toolbarItem: [
        ['undo', 'redo'],
        ['fontSize'],
        ['bold', 'underline', 'italic'],
        ['fontColor', 'hiliteColor'],
        ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
        ['link'],
        ['fullScreen', 'showBlocks', 'codeView'],
        ['preview', 'print'],
    ],
    charCounter: true,
}
$( document ).ready(function() {
    editorComentariosCoordinadorPIAR = KothingEditor.create('piar-observaciones-coordinador', kothingParamsPlan);
    jQuery("#piar-observaciones-coordinador").addClass("hide-textarea");

    let domElement = null;
    domElement = jQuery("#richtext-entorno");
    if(domElement.length > 0){
        editorEntornoPersonal = KothingEditor.create('richtext-entorno', kothingParamsPlan);
        jQuery("#richtext-entorno").addClass("hide-textarea");
    }


    domElement = jQuery("#richtext-descripcion-general");
    if(domElement.length > 0){
        editorDescripcionGeneral = KothingEditor.create('richtext-descripcion-general', kothingParamsPlan);
        jQuery("#richtext-descripcion-general").addClass("hide-textarea");
    }

    domElement = jQuery("#richtext-compromisos-especificos");
    if(domElement.length > 0){
        editorCompromisosEspecificos = KothingEditor.create('richtext-compromisos-especificos', kothingParamsPlan);
        jQuery("#richtext-compromisos-especificos").addClass("hide-textarea");
    }

    domElement = jQuery("#richtext-descripcion-que-hace");
    if(domElement.length > 0){
        editorDescripcionQueHace = KothingEditor.create('richtext-descripcion-que-hace', kothingParamsPlan);
        jQuery("#richtext-descripcion-que-hace").addClass("hide-textarea");
    }
})

jQuery(document).on("click", ".btn-agregar-observaciones-coordinador-piar", function() {
    // Get the evidencia de aprendizaje ID
    let idPiar = jQuery(this).attr("data-id");

    jQuery.ajax({
        url: base_url + "PIAR/find/" + idPiar,
        success: function(response) {
            let data = JSON.parse(response);
            let object = data.object;
            if (data.status) {
                editorComentariosCoordinadorPIAR.setContents(object.comentarios);
            }
        }
    });

    jQuery("#id-piar-observaciones-coordinador").val(idPiar);
    jQuery("#observaciones-piar-modal").modal("show");
});

$("#form-piar-observaciones-coordinador").on('submit', function(e) {
    let descripcion = editorComentariosCoordinadorPIAR.getContents();
    jQuery("#piar-observaciones-coordinador").val(descripcion);
});

$("#form-create-piar").on('submit', function(e) {
   e.preventDefault();

    let domElement = jQuery("#richtext-entorno");
    let entornoPersonal = "";
    if(domElement.length) {
        entornoPersonal = editorEntornoPersonal.getContents();
        domElement.html(entornoPersonal)
    }

    domElement = jQuery("#richtext-descripcion-general");
    let descripcionGeneral = "";
    if(domElement.length) {
        descripcionGeneral = editorDescripcionGeneral.getContents();
        domElement.html(descripcionGeneral)
    }

    domElement = jQuery("#richtext-compromisos-especificos");
    let compromisosEspecificos = "";
    if(domElement.length) {
        compromisosEspecificos = editorCompromisosEspecificos.getContents();
        domElement.html(compromisosEspecificos)
    }

    domElement = jQuery("#richtext-descripcion-que-hace");
    let descripcionQueHace = "";
    if(domElement.length) {
        descripcionQueHace = editorDescripcionQueHace.getContents();
        domElement.html(descripcionQueHace)
    }

    this.submit();
});

$(".btn-delete-piar-item").on("click", function(){
    const piarItemId = $(this).attr("data-id");
    if(piarItemId){
        if (confirm("¿Está seguro que desea eliminar el item del P.I.A.R.?") === true) {
            $("#background-loading").css("display", "flex");
            const url = base_url + "PIAR/deletePiarItem";
            console.log(url)
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id_piar_item: piarItemId,
                },
                success: function(data) {
                    const response = JSON.parse(data);
                    if (response.status) {
                        $("#piar-item-" + piarItemId).remove();
                    }
                    $("#background-loading").css("display", "none");
                    alert(response.message);
                },
                error: function() {
                    $("#background-loading").css("display", "none");
                    alert("Error!");
                }
            });
        }
    }
})

$(".btn-delete-piar-activity").on("click", function(){
    const piarItemId = $(this).attr("data-id");
    if(piarItemId){
        if (confirm("¿Está seguro que desea eliminar la actividad del P.I.A.R.?") === true) {
            $("#background-loading").css("display", "flex");
            const url = base_url + "PIAR/deletePiarActivity";
            console.log(url)
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id_piar_actividad: piarItemId,
                },
                success: function(data) {
                    const response = JSON.parse(data);
                    if (response.status) {
                        $("#piar-activity-" + piarItemId).remove();
                    }
                    $("#background-loading").css("display", "none");
                    alert(response.message);
                },
                error: function() {
                    $("#background-loading").css("display", "none");
                    alert("Error!");
                }
            });
        }
    }
})

$("#form-create-piar-row").on('submit', function(e) {
    e.preventDefault();

    for (let i = 1; i < 5; i++) {
        let domElement = jQuery("#richtext-" + i);
        let entornoPersonal = "";
        if(domElement.length) {
            entornoPersonal = editorEntornoPersonal.getContents();
            domElement.html(entornoPersonal)
        }
    }

    this.submit();
});