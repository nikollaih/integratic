$(document).on("click", ".notificaciones-icon", function() {
    actualizar_fecha_notificaciones();
});

$(document).on("click", ".set-imagen-area", function() {
    if($(this).hasClass("selected")){
        $("#icoarea-nueva-imagen").val(null);
        $(".set-imagen-area").removeClass("selected");
        $("#selected-imagen-area").attr("src", "");
        $("#selected-imagen-area").css("display", "none");
    }
    else{
        $("#icoarea-nueva-imagen").val($(this).attr("data-imagen"));
        $(".set-imagen-area").removeClass("selected");
        $("#selected-imagen-area").attr("src", $(this).attr("data-url"));
        $("#selected-imagen-area").css("display", "block");
        $(this).addClass("selected");
        $(".open-contenedor-imagenes-area").attr("data-open", "false");
        $(".open-contenedor-imagenes-area").html("Ver Imagenes");
        $("#contenedor-imagenes-area").css("display", "none");
    }
});

$(document).on("click", ".open-contenedor-imagenes-area", function() {
    if($(this).attr("data-open") == "false"){
        $("#contenedor-imagenes-area").css("display", "inline-block");
        $(this).attr("data-open", "true");
        $(this).html("Ocultar Imagenes");
    }
    else{
        $("#contenedor-imagenes-area").css("display", "none");
        $(this).attr("data-open", "false");
        $(this).html("Ver Imagenes");
    }
});

$(document).on("click", ".button-eliminar-foro", function() {
    let id_foro = $(this).attr("data-foro");
    eliminar_foro(id_foro);
});

$(document).on("click", ".button-eliminar-respuesta-foro", function() {
    let id_foro_repsuesta = $(this).attr("data-respuesta-foro");
    eliminar_foro_respuesta(id_foro_repsuesta);
});

$(document).on("click", ".open-section", function() {
    if ($(this).hasClass("fa-chevron-down")) {
        $(this).removeClass("fa-chevron-down");
        $(this).addClass("fa-chevron-up");
    } else {
        $(this).removeClass("fa-chevron-up");
        $(this).addClass("fa-chevron-down");
    }
    $(".section-" + $(this).attr("data-section")).slideToggle();
});


function cambiar_clave() {
    var url = "./index.php/principal/cambio_clave";
    $.ajax({
        url: url,
        type: 'POST',
        data: $("#frmcambio").serialize(),
        success: function(data) {
            var data = JSON.parse(data);

            if (data.status) {
                user["clave"] = data.object.nueva;
                $("#contenedor").html('');
            }
            alert(data.message);

        },
        error: function() { alert("Error!"); }
    });

}

function ver_foro(id_foro) {
    var url = "./index.php/Foros/ver/" + id_foro;
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            $("#listacon").html(data);
        },
        error: function() { alert("Error!"); }
    });
}

function actualizar_notificaciones() {
    obtener_notificaciones();
    obtener_lista_notificaciones();
}

function obtener_notificaciones() {
    $.ajax({
        url: "./index.php/Notificaciones/obtener_contador_notificaciones",
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            if (data.status) {
                $('#contador-notificaciones').html(data.object);
            } else {
                $('#contador-notificaciones').html("0");
            }
        },
        error: function() { $('#contador-notificaciones').html("0"); }
    });
}

function actualizar_fecha_notificaciones() {
    $.ajax({
        url: "./index.php/Usuarios/actualizar_fecha_notificaciones",
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            if (data.status) {
                $('#contador-notificaciones').html("0");
            }
        },
        error: function() {}
    });
}

function obtener_lista_notificaciones() {
    $.ajax({
        url: base_url + "Notificaciones/obtener_lista_notificaciones",
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data.status) {
                $('#notificaciones-container').html(data.object);
            }
        },
        error: function() { $('#contador-notificaciones').html("0"); }
    });
}


function guardar_foro() {
    let titulo = $("#nuevo-foro-titulo").val();
    let disponible_desde = $("#nuevo-foro-disponible-desde").val();
    let disponible_hasta = $("#nuevo-foro-disponible-hasta").val();
    let materia = $("#nuevo-foro-materia").val();
    let grupo = $("#nuevo-foro-grupo").val();

    console.log({
        descripcion: editorImageForo.getContents(),
        titulo: titulo,
        materia: materia,
        grupo: grupo,
        disponible_desde: disponible_desde,
        disponible_hasta: disponible_hasta
    })

    if (titulo.trim() != "" && materia && grupo) {
        var url = "./index.php/Foros/agregar_foro";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                descripcion: editorImageForo.getContents(),
                titulo: titulo,
                materia: materia,
                grupo: grupo,
                disponible_desde: disponible_desde,
                disponible_hasta: disponible_hasta
            },
            success: function(data) {
                var data = JSON.parse(data);

                if (data.status) {
                    let titulo = $("#nuevo-foro-titulo").val("");
                    $('#agregar-nuevo-foro').modal('hide');

                    setTimeout(() => {
                        ver_foro(data.object.id_foro);
                    }, 1000)
                }

                alert(data.message);
            },
            error: function() { alert("Error!"); }
        });
    } else {
        alert("Por favor complete todos los campos requeridos!");
    }
}

function eliminar_foro(id_foro) {
    if (confirm("¿Está seguro que desea eliminar el foro?") == true) {
        $.ajax({
            url: base_url + 'Foros/delete/' + id_foro,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    $("#foro-" + id_foro).remove();
                }

                if (data.object.error == "auth") {
                    prelogin();
                }
                alert(data.message);
            }
        });
    }
}

function eliminar_foro_respuesta(id_respuesta) {
    if (confirm("¿Está seguro que desea eliminar la respuesta?") == true) {
        $.ajax({
            url: base_url + 'Foros/delete_answer/' + id_respuesta,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    $("#respuesta-foro-" + id_respuesta).remove();
                }

                if (data.object.error == "auth") {
                    prelogin();
                }
                alert(data.message);
            }
        });
    }
}

function capitalizeTheFirstLetterOfEachWord(words) {
    var separateWord = words.toLowerCase().split(' ');
    for (var i = 0; i < separateWord.length; i++) {
        if (separateWord[i].length > 1) {
            separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
                separateWord[i].substring(1);
        }
    }
    return separateWord.join(' ');
}