$(document).on("click", ".agregar-respuesta-pregunta", function() {
    let proxima_respuesta = $(this).attr("data-pregunta");
    generar_pregunta_DOM(proxima_respuesta);
    $(this).attr("data-pregunta", parseInt(proxima_respuesta) + 1);
});

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