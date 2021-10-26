$(document).on("click", ".notificaciones-icon", function() {
    actualizar_fecha_notificaciones();
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
        url: "./index.php/Notificaciones/obtener_lista_notificaciones",
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