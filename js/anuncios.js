function guardar_anuncio() {
    let titulo = $("#nuevo-anuncio-titulo").val();
    let descripcion = $("#nuevo-anuncio-descripcion").val();

    if (titulo.trim() != "" && descripcion.trim() != "") {
        $.ajax({
            url: "./index.php/anuncios/create",
            type: 'POST',
            data: {
                descripcion: descripcion,
                titulo: titulo
            },
            success: function(data) {
                var data = JSON.parse(data);

                if (data.status) {
                    $('#agregar-nuevo-anuncio').modal('hide');
                    enlace_mat_est(data.object.materia);
                }

                alert(data.message);
            },
            error: function() { alert("Error!") }
        });
    } else {
        alert("Por favor complete todos los campos requeridos!");
    }
}