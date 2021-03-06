$(document).ready(function() {
    let tabla_pruebas = $('#tabla-pruebas').DataTable({
        order: [],
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    $(document).on("click", ".agregar-respuesta-pregunta", function() {
        let proxima_respuesta = $(this).attr("data-pregunta");
        generar_pregunta_DOM(proxima_respuesta);
        $(this).attr("data-pregunta", parseInt(proxima_respuesta) + 1);
    });

    $(document).on("click", ".btn-asignacion-pregunta", function() {
        let id_pregunta = $(this).attr("data-pregunta");
        let id_prueba = $(this).attr("data-prueba");
        asignar_pregunta(id_pregunta, id_prueba);
    });

    $(document).on("click", ".btn-eliminar-participante", function() {
        let id_participante = $(this).attr("data-participante");
        let id_prueba = $(this).attr("data-prueba");
        eliminar_participante(id_participante, id_prueba);
    });

    $(document).on("click", ".btn-eliminar-intento-prueba", function() {
        let id_participante = $(this).attr("data-participante");
        let id_prueba = $(this).attr("data-prueba");
        eliminar_prueba_intento(id_prueba, id_participante);
    });

    $(document).on("click", ".button-eliminar-prueba", function() {
        let id_prueba = $(this).attr("data-prueba");
        eliminar_prueba(id_prueba);
    });

    $(document).on("click", ".ver-mas-extra-info", function() {
        $("#prueba-extra-info").slideDown();
    });

    function asignar_pregunta(id_pregunta, id_prueba) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Pruebas/asignarPreguntasProceso",
            type: 'POST',
            data: {
                id_prueba: id_prueba,
                id_pregunta: id_pregunta
            },
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (object != null) {
                    if (object.eliminado == 0) {
                        let btn_dom = ' <button data-prueba="' + id_prueba + '" data-pregunta="' + id_pregunta + '" class="btn btn-danger btn-sm btn-asignacion-pregunta">Desasignar</button>';
                        $("#pregunta-" + id_pregunta).html(btn_dom);
                    } else {
                        let btn_dom = ' <button data-prueba="' + id_prueba + '" data-pregunta="' + id_pregunta + '" class="btn btn-success btn-sm btn-asignacion-pregunta">Asignar</button>';
                        $("#pregunta-" + id_pregunta).html(btn_dom);
                    }
                }
                $("#background-loading").css("display", "none");
                alert(data.message);
            },
            error: function() { alert("Error!") }
        });
    }

    function cerrar_intento_prueba(id_realizar_prueba) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Pruebas/cerrarIntentoPrueba",
            type: 'POST',
            data: {
                id_realizar_prueba: id_realizar_prueba,
            },
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) {
                    window.open(base_url + "Pruebas/resumen/" + object, "_self")
                }
                //$("#background-loading").css("display", "none");
            },
            error: function() { alert("Error!") }
        });
    }

    function eliminar_participante(id_participante, id_prueba) {
        if (confirm("??Est?? seguro que desea eliminar el participante?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "ParticipantesPrueba/delete",
                type: 'POST',
                data: {
                    id_prueba: id_prueba,
                    id_participante: id_participante
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        $("#participante-" + id_participante).remove();
                    }
                    $("#background-loading").css("display", "none");
                    alert(data.message);
                },
                error: function() { alert("Error!") }
            });
        }
    }

    function eliminar_prueba(id_prueba) {
        if (confirm("??Est?? seguro que desea eliminar la prueba?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Pruebas/delete",
                type: 'POST',
                data: {
                    id_prueba: id_prueba
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_pruebas
                            .row($("#prueba-" + id_prueba))
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

    function eliminar_prueba_intento(id_prueba, id_participante) {
        if (confirm("??Est?? seguro que desea eliminar el registro de esta prueba?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Pruebas/deleteIntento",
                type: 'POST',
                data: {
                    id_prueba: id_prueba,
                    id_participante: id_participante
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        location.reload();
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

    function generar_pregunta_DOM(proxima_respuesta) {
        let pregunta_DOM = '<div class="panel panel-primary">' +
            '<div style="background-color: #0b6069;" class="panel-heading text-capitalize"><b>Respuesta #' + proxima_respuesta + '</b></div>' +
            '<div class="panel-body">' +
            '<div class="row">' +
            '<div class="col-md-12 col-sm-12 col-lg-12">' +
            '<div class="form-group">' +
            '<label for="">Descripci??n </label>' +
            '<textarea name="respuesta' + proxima_respuesta + '[descripcion_respuesta]" id="" cols="30" rows="5" class="form-control"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-6 col-sm-12 col-lg-3">' +
            '<div class="form-group">' +
            '<label for="">Agregar Imagen </label>' +
            '<input name="respuesta' + proxima_respuesta + '[archivo_respuesta]" accept="image/*" type="file" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-md-6 col-sm-12 col-lg-3">' +
            '<div class="form-group">' +
            '<label for="">Tipo respuesta </label>' +
            '<select name="respuesta' + proxima_respuesta + '[tipo_respuesta]" id="" class="form-control">' +
            '<option value="">- Seleccionar</option>' +
            '<option value="1">Correcta</option>' +
            '<option value="0">Incorrecta</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $("#contenedor-respuestas").append(pregunta_DOM);
    }
});