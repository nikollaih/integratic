let preguntas_seleccionadas = [];

$(document).ready(function() {
    let tabla_preguntas = $('#tabla-preguntas').DataTable({
        order: []
    });

    $(document).on("click", "#btn-exportar-preguntas", function() {
        if (preguntas_seleccionadas.length > 0) {
            window.open(base_url + "PreguntasPrueba/exportarPreguntas/" + $(this).attr("data-materia") + "/" + preguntas_seleccionadas.join("-"));
        }
    });

    $(document).on("click", ".btn-eliminar-pregunta", function() {
        let id_pregunta = $(this).attr("data-pregunta");
        eliminar(id_pregunta);
    });

    $(document).on("click", "#btn-exportar-respuestas", function() {
        if (preguntas_seleccionadas.length > 0) {
            window.open(base_url + "PreguntasPrueba/exportarRespuestas/" + $(this).attr("data-materia") + "/" + preguntas_seleccionadas.join("-"));
        }
    });

    $("#import-form").on('submit', function(e) {
        $(".btn-guardar-importar").attr("disabled", "disabled");
    });

    $(document).on("click", ".check-exportar-pregunta", function() {
        if (preguntas_seleccionadas.length == 1) {
            if (preguntas_seleccionadas[0] == "-1") {
                $("#exportar-todas-check").prop("checked", false);
                $(".check-exportar-pregunta").prop("checked", false);
                $(this).prop("checked", true);
                preguntas_seleccionadas = [];
            }
        }
        seleccionarExportarPregunta($(this).attr("data-id"));
    });

    $(document).on("click", "#exportar-todas-check", function() {
        if ($(this).is(":checked")) {
            preguntas_seleccionadas = ["-1"];
            $(".check-exportar-pregunta").prop("checked", true);
        } else {
            preguntas_seleccionadas = [];
            $(".check-exportar-pregunta").prop("checked", false);
        }
    });

    $(document).on("change", "#id-materia-preguntas", function() {
        if ($(this).val() && $(this).val() != "null") {
            window.open(base_url + "PreguntasPrueba/index/" + $(this).val(), "_self");
        } else {
            window.open(base_url + "PreguntasPrueba", "_self");
        }
    });

    function seleccionarExportarPregunta(id_pregunta) {
        if (preguntas_seleccionadas.includes(id_pregunta)) {
            var index = preguntas_seleccionadas.indexOf(id_pregunta);
            if (index !== -1) {
                preguntas_seleccionadas.splice(index, 1);
            }
        } else {
            preguntas_seleccionadas.push(id_pregunta);
        }
    }

    function eliminar(id_pregunta) {
        if (confirm("¿Está seguro que desea eliminar la pregunta?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "PreguntasPrueba/delete/" + id_pregunta,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_preguntas
                            .row($("#pregunta-" + id_pregunta))
                            .remove()
                            .draw();
                    }
                    $("#background-loading").css("display", "none");
                    alert(data.message);
                },
                error: function() {
                    $("#background-loading").css("display", "none");
                    alert("Error!")
                }
            });
        }
    }
});