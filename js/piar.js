let editorEntornoPersonal = null;
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

    let domElement = null;
    domElement = jQuery("#richtext-entorno");
    if(domElement.length > 0){
        editorEntornoPersonal = KothingEditor.create('richtext-entorno', kothingParamsPlan);
        jQuery("#richtext-entorno").addClass("hide-textarea");
    }
})

$("#form-create-piar").on('submit', function(e) {
   e.preventDefault();

    let domElement = jQuery("#richtext-entorno");
    let entornoPersonal = "";
    if(domElement.length) {
        entornoPersonal = editorEntornoPersonal.getContents();
        domElement.html(entornoPersonal)
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