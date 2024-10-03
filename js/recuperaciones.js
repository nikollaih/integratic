$( document ).ready(function() {
    $(document).on("click", ".delete-recuperacion-actividad", function() {
        let idActividad = $(this).attr("data-actividad");
        let idRecuperacion = $(this).attr("data-recuperacion");
        deleteRecuperacionActividadPrueba(idRecuperacion, idActividad)
    });

    $(document).on("click", ".delete-recuperacion-prueba", function() {
        let idPrueba = $(this).attr("data-prueba");
        let idRecuperacion = $(this).attr("data-recuperacion");
        deleteRecuperacionActividadPrueba(idRecuperacion, idPrueba, "prueba")
    });
});

function deleteRecuperacionActividadPrueba (idRecuperacion, idFK, type = "actividad") {
    if (confirm(`¿Está seguro que desea eliminar la ${type} de la recuperación?`) === true) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Recuperaciones/delete",
            type: 'POST',
            data: {
                type: type,
                id_recuperacion: idRecuperacion,
                id_fk: idFK
            },
            success: function(data) {
                const result = JSON.parse(data);
                if (result.status) {
                    alert(result.message);
                    location.reload();
                }
                else {
                    $("#background-loading").css("display", "none");
                    alert(result.message);
                }
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }
}
