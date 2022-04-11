$(document).on("change", "#prueba-participantes-grado", function() {
    let select_value = $(this).val();
    if (select_value != "null") {
        obtener_estudiantes_grado(select_value);
    } else {
        $("#prueba-participantes-estudiantes").parent().css("display", "none");
    }
});

function obtener_estudiantes_grado(grupo_grado) {
    var url = base_url + "Estudiante/estudiantes_grado_grupo/" + grupo_grado;
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            if (data.status) {
                let select_dom = "";
                if (data.object) {
                    let estudiantes = data.object;
                    for (let i = 0; i < estudiantes.length; i++) {
                        const e = estudiantes[i];
                        select_dom += "<option value='" + e.documento + "'>" + e.nombre + "</option>";
                    }
                }
                $("#prueba-participantes-estudiantes").html(select_dom).selectpicker("refresh");
                $("#prueba-participantes-estudiantes").parent().css("display", "initial");
            } else {
                if (data.object.error = "login") {
                    location.reload();
                }
                if (data.object.error = "permissions") {
                    alert(data.message);
                }
            }
            console.log(data);
        },
        error: function() { alert("Error!"); }
    });
}