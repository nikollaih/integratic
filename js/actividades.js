function guardar_actividad() {
    if ($("#nueva-actividad-titulo").val().trim() != "" && $("#nueva-actividad-descripcion").val().trim() != "" && $("#nueva-actividad-date").val().trim() != "" && $("#nueva-actividad-time").val().trim() != "") {
        var formData = new FormData();
        formData.append("titulo", $("#nueva-actividad-titulo").val());
        formData.append("descripcion", $("#nueva-actividad-descripcion").val());
        formData.append("date", $("#nueva-actividad-date").val());
        formData.append("time", $("#nueva-actividad-time").val());
        formData.append("userfile", $('#nueva-actividad-file')[0].files[0]);

        $.ajax({
            url: 'index.php/Actividades/guardar',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                console.log(data);
                var response = JSON.parse(data);

                if (response.status) {
                    $('#actividad-form').trigger("reset");
                    $("#agregar-nueva-actividad").modal("hide");
                }

                alert(response.message);
            }
        });
    } else {
        alert("Por favor complete todos los campos requeridos");
    }
}