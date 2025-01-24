let editorEntornoPersonal = null;
$( document ).ready(function() {
    let kothingParamsPlan = {
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