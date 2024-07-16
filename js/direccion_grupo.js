function guardarDireccionGrupo() {
    let url = base_url + "DireccionGrupo/guardar";
    let grupo = $("#direccion_grupos").val();
    let docente = $("#direccion_docente").val();

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            grado: grupo,
            docente: docente
        },
        success: function(data) {
            let result = JSON.parse(data);
            if(result.status)
                obtenerDireccionGrupo();

            alert(result.message);
        },
        error: function() { alert("Error!"); }
    });
}

function obtenerDireccionGrupo() {
    let url = base_url + "DireccionGrupo/get";

    $.ajax({
        url: url,
        type: 'GET',
        dataType:'json',
        success: function(data) {
            let result = eval(data);
            let list = result.object;
            let row = "";
            let tbody = jQuery("#table-direccion-grupo tbody");

            if(list && list.length > 0) {
                tbody.html("");
                for (let i = 0; i < list.length; i++) {
                    row += `<tr>
                                <td>${list[i].nombres} ${list[i].apellidos}</td>
                                <td>${list[i].grado}</td>
                            </tr>`;
                }

                tbody.append(row);
            }
        },
        error: function() { alert("Error!"); }
    });
}