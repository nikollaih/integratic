$(document).on("click", ".btn-eliminar-anuncio", function() {
    let anuncio = $(this).attr("data-id");
    eliminarAnuncio(anuncio);
});

$(document).on("click", ".btn-editar-anuncio", function() {
    let anuncio = $(this).attr("data-id");
    getAnuncio(anuncio);
});

$(document).on("click", ".btn-agregar-anuncio", function() {
    setAnuncio();
});

function guardar_anuncio(menu_materia = "true") {
    let id_anuncio = $("#nuevo-anuncio-anuncio").val();
    let titulo = $("#nuevo-anuncio-titulo").val();
    let descripcion = editorRichAnuncios.getContents();

    if (titulo.trim() != "" && descripcion.trim() != "") {
        $.ajax({
            url: "./index.php/anuncios/create",
            type: 'POST',
            data: {
                descripcion: descripcion,
                titulo: titulo,
                id_anuncio: id_anuncio
            },
            success: function(data) {
                var data = JSON.parse(data);

                if (data.status) {
                    $('#agregar-nuevo-anuncio').modal('hide');
                    enlace_mat_est(data.object.materia, menu_materia);
                }

                alert(data.message);
            },
            error: function() { alert("Error!") }
        });
    } else {
        alert("Por favor complete todos los campos requeridos!");
    }
}

function eliminarAnuncio(id_anuncio) {
    if (confirm("¿Está seguro que desea eliminar el anuncio?") == true) {
        $.ajax({
            url: base_url + "Anuncios/delete/" + id_anuncio,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    $("#an-" + id_anuncio).remove();
                }
                alert(data.message);
            },
            error: function(e) {
                alert("Error!");
                console.log(e);
            }
        });
    }
}

function getAnuncio(id_anuncio) {
    $.ajax({
        url: base_url + "Anuncios/getAnuncio/" + id_anuncio,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            if (data.status)
                setAnuncio(data.object)
            else
                alert(data.message);
        },
        error: function(e) {
            alert("Error!");
            console.log(e);
        }
    });
}

function setAnuncio(anuncio){
    if(anuncio){
        jQuery("#agregar-nuevo-anuncio-label").html("Modificar anuncio");
        jQuery("#nuevo-anuncio-anuncio").val(anuncio.id_anuncio);
        jQuery("#nuevo-anuncio-titulo").val(anuncio.titulo);
        editorRichAnuncios.setContents(anuncio.descripcion);
    }
    else {
        jQuery("#agregar-nuevo-anuncio-label").html("Agregar nuevo anuncio");
        jQuery("#nuevo-anuncio-anuncio").val("");
        jQuery("#nuevo-anuncio-titulo").val("");
        editorRichAnuncios.setContents("");
    }
    jQuery("#agregar-nuevo-anuncio").modal("show");
}