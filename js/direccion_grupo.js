$(document).on("click", ".btn-eliminar-direccion-grupo", function() {
    let id = $(this).attr("data-id");
    eliminarDireccionGrupo(id);
});

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

function eliminarDireccionGrupo(id) {
    if (confirm("¿Está seguro que desea eliminar la dirección de grupo?") === true) {
        $.ajax({
            url: base_url + 'DireccionGrupo/delete/' + id,
            type: 'GET',
            success: function(response) {
                let data = JSON.parse(response);
                if (data.status) {
                    $("#direccion-grupo-" + id).remove();
                }
                else {
                    alert(data.message);
                }

                if (data?.object?.error === "auth") {
                    prelogin();
                }
            }
        });
    }
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
                    row += `<tr id="direccion-grupo-${list[i].id}">
                                <td>${list[i].nombres} ${list[i].apellidos}</td>
                                <td>${list[i].grado}</td>
                                <td>
                                    <a class="d-flex align-items-center justify-center btn-eliminar-direccion-grupo pointer" data-id="${list[i].id}"> 
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>`;
                }

                tbody.append(row);
            }
        },
        error: function() { alert("Error!"); }
    });
}