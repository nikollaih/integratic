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

    $(document).on("change", "#crear-prueba-materia", function() {
        let id_materia = jQuery(this).val();
        getTemasMateria(id_materia);
    });

    $("#form-prueba").on('submit', function(e) {
        jQuery("#textarea_richtext").html(editorRich.getContents());
    });

    $("#select-alcance-estadistica").on('change', function(e) {
        let alcance = jQuery(this).val();
        window.location = base_url + "EstadisticasPruebas/ver/" + alcance;
    });

    $("#municipios-select").on('change', function(e) {
        let municipio = jQuery(this).val();
        getInstitucionesMunicipio(municipio);
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

    function eliminar_participante(id_participante, id_prueba) {
        if (confirm("¿Está seguro que desea eliminar el participante?") == true) {
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
        if (confirm("¿Está seguro que desea eliminar la prueba?") == true) {
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
        if (confirm("¿Está seguro que desea eliminar el registro de esta prueba?") == true) {
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
            '<label for="">Descripción </label>' +
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

function getTemasMateria(id_materia) {
    $("#background-loading").css("display", "flex");
    $.ajax({
        url: base_url + "Temas/getTemasMateria/" + id_materia,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            let object = data.object;
            if (data.status) setTemasMateria(object);
            $("#background-loading").css("display", "none");
        },
        error: function() { 
            $("#background-loading").css("display", "none");
            alert("Error!") 
        }
    });
}

function setTemasMateria(temas){
    // Obtén una referencia al elemento select por su ID
    const selectElement = document.getElementById('crear-prueba-tema');

    // Limpia el select eliminando todas las opciones existentes
    selectElement.innerHTML = '<option>- Seleccionar</option>';
    // Itera sobre el arreglo y agrega nuevas opciones al select

    if(Array.isArray(temas)){
        temas.forEach((tema) => {
            const option = document.createElement('option');
            option.value = tema.id_tema;
            option.textContent = tema.nombre_tema;
            selectElement.appendChild(option);
        });
    }
}

function getInstitucionesMunicipio(id_municipio) {
    $("#background-loading").css("display", "flex");
    $.ajax({
        url: base_url + "InstitucionesEducativas/get_by_municipio/" + id_municipio,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            let object = data.object;
            if (data.status) setInstituciones(object);
            $("#background-loading").css("display", "none");
        },
        error: function() { 
            $("#background-loading").css("display", "none");
            alert("Error!") 
        }
    });
}

function setInstituciones(instituciones){
    // Obtén una referencia al elemento select por su ID
    const selectElement = document.getElementById('instituciones-select');

    // Limpia el select eliminando todas las opciones existentes
    selectElement.innerHTML = '<option value="">- Seleccionar</option>';

    if(instituciones.length > 0)
        // Itera sobre el arreglo y agrega nuevas opciones al select
        instituciones.forEach((tema) => {
            const option = document.createElement('option');
            option.value = tema.id_institucion_educativa;
            option.textContent = tema.nombre_institucion;
            selectElement.appendChild(option);
        });
}
