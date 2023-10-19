jQuery(document).ready(function() {
    // Obtiene la lkista de semanas pertenecientes a un periodo
    jQuery(document).on("click", ".periodo-container.item-periodo", function() {
        let idPeriodo = jQuery(this).attr("data-id");
        let nombrePeriodo = jQuery(this).attr("data-periodo");
        getSemanasPeriodo(idPeriodo, nombrePeriodo);
    });

    // Ingresa el id del periodo al cual se le desea agregar la nueva semana
    jQuery(document).on("click", "#nueva-semana-agregar", function() {
        limpiarAgregarSemana();
        let idPeriodo = jQuery(this).attr("data-periodo");
        let nombrePeriodo = jQuery(this).attr("data-nombre-periodo");
        jQuery("#nueva-semana-modal-title").html("Nueva semana para el periodo " + nombrePeriodo);
        jQuery("#nueva-semana-periodo").val(idPeriodo);
        $('#modalSemana').modal('show');
    });

    // Abre el modal con el formulario del nuevo periodo
    jQuery(document).on("click", "#nuevo-periodo-agregar", function() {
        limpiarAgregarPeriodo();
        jQuery("#nuevo-periodo-modal-title").html("Nuevo periodo");
        $('#modalPeriodo').modal('show');
    });

    // Abre la modal para modificar la información de la semana
    jQuery(document).on("click", ".btn-modificar-semana", function() {
        jQuery("#nueva-semana-periodo").val(jQuery(this).attr("data-periodo"));
        jQuery("#nueva-semana-semana").val(jQuery(this).attr("data-semana"));
        jQuery("#nueva-semana-inicio").val(jQuery(this).attr("data-inicio"));
        jQuery("#nueva-semana-fin").val(jQuery(this).attr("data-fin"));
        jQuery("#nueva-semana-id-semana").val(jQuery(this).attr("data-id-semana"));
        jQuery("#nueva-semana-modal-title").html("Modificar semana para el periodo " + jQuery(this).attr("data-nombre-periodo"));
        $('#modalSemana').modal('show');
    });

    // Abre la modal para modificar la información del periodo
    jQuery(document).on("click", ".btn-modificar-periodo", function() {
        jQuery("#nuevo-periodo-id-periodo").val(jQuery(this).attr("data-id-periodo"));
        jQuery("#nuevo-periodo-periodo").val(jQuery(this).attr("data-periodo"));
        jQuery("#nuevo-periodo-inicio").val(jQuery(this).attr("data-inicio"));
        jQuery("#nuevo-periodo-fin").val(jQuery(this).attr("data-fin"));
        jQuery("#nuevo-periodo-modal-title").html("Modificar periodo");
        $('#modalPeriodo').modal('show');
    });

    // Lanza una alerta de confirmación para eliminar la semana
    jQuery(document).on("click", ".btn-eliminar-semana", function() {
        let idSemana = jQuery(this).attr("data-id-semana");
        let idPeriodo = jQuery(this).attr("data-periodo");
        let nombrePeriodo = jQuery(this).attr("data-nombre-periodo");
        eliminarSemana(idSemana, idPeriodo, nombrePeriodo);
    });

    // Lanza una alerta de confirmación para eliminar el periodo
    jQuery(document).on("click", ".btn-eliminar-periodo", function() {
        let idPeriodo = jQuery(this).attr("data-id-periodo");
        eliminarPeriodo(idPeriodo);
    });

    // Obtiene los datos de la nueva semana que se desea crear
    jQuery(document).on("click", "#nueva-semana-guardar", function() {
        let postData = {
            id_semana_periodo: jQuery("#nueva-semana-id-semana").val(),
            periodo : jQuery("#nueva-semana-periodo").val(),
            semana : jQuery("#nueva-semana-semana").val(),
            fecha_inicio : jQuery("#nueva-semana-inicio").val(),
            fecha_fin : jQuery("#nueva-semana-fin").val()
        };
        
        if(postData.semana == ""){
            alert("ERROR \n\n Por favor complete todos los campos");
        }
        else setNuevaSemana(postData);
    });

    // Obtiene los datos del nuevo periodo que se desea crear
    jQuery(document).on("click", "#nuevo-periodo-guardar", function() {
        let postData = {
            id_periodo: jQuery("#nuevo-periodo-id-periodo").val(),
            periodo : jQuery("#nuevo-periodo-periodo").val(),
            fecha_inicio : jQuery("#nuevo-periodo-inicio").val(),
            fecha_fin : jQuery("#nuevo-periodo-fin").val()
        };

        if(postData.fecha_inicio == "" || postData.fecha_fin == "" || postData.periodo == ""){
            alert("ERROR \n\n Por favor complete todos los campos");
        }
        else setNuevoPeriodo(postData);
    });

    // Llamado al cotrolador para obtener la lista de semanas de un periodo
    function getSemanasPeriodo(idPeriodo, nombrePeriodo) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "SemanasPeriodo/getSemanasPeriodo/" + idPeriodo,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setSemanasPeriodo(object, idPeriodo, nombrePeriodo);
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    // Muestra la lista de semanas de un periodo
    function setSemanasPeriodo(semanas, idPeriodo, nombrePeriodo){
        let semanasPeriodoDOM = "";
        jQuery("#semanas-periodo").html("");
        jQuery("#semanas-title").html("Semanas del periodo " + nombrePeriodo);
        if(semanas.length > 0){
            for (let i = 0; i < semanas.length; i++) {
                semanasPeriodoDOM += '<div class="m-r-1">' +
                                    '<div class="card text-center bg-light" style="width: 18rem;">' +
                                        '<div class="card-body">' +
                                            '<h2 class="card-title">'+semanas[i].semana+'</h2>' +
                                            '<p class="text-muted">DESDE</p>' +
                                            '<p class="">'+semanas[i].fecha_inicio+'</p>' +
                                            '<p class="text-muted">HASTA</p>' +
                                            '<p class="">'+semanas[i].fecha_fin+'</p>' +
                                        '</div>' +
                                        '<div class="card-footer text-muted">' +
                                            '<a data-id-semana="'+semanas[i].id_semana_periodo+'" data-semana="'+semanas[i].semana+'" data-nombre-periodo="'+semanas[i].nombre_periodo+'" data-periodo="'+semanas[i].periodo+'" data-inicio="'+semanas[i].fecha_inicio+'" data-fin="'+semanas[i].fecha_fin+'" class="btn btn-primary btn-sm btn-modificar-semana">Modificar</a>' +
                                            '<a data-id-semana="'+semanas[i].id_semana_periodo+'" data-periodo="'+semanas[i].periodo+'" data-nombre-periodo="'+semanas[i].nombre_periodo+'" class="btn btn-danger btn-sm btn-eliminar-semana">Eliminar</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>';
            }
        }

        semanasPeriodoDOM +=    '<div id="nueva-semana-agregar" data-nombre-periodo="' + nombrePeriodo + '" data-periodo="'+idPeriodo+'" class="mr-3">' +
                                    '<div class="card text-center bg-info periodo-container" style="width: 18rem;min-height: 255px;">' +
                                            '<i class="fa fa-solid fa-plus text-white"></i>' +
                                            '<p class="card-text text-white">Agregar semana</p>' +
                                    '</div>' +
                                '</div>';

        jQuery("#semanas-periodo").html(semanasPeriodoDOM);
    }

    // Envia los datos de la nueva semana al controlador
    function setNuevaSemana(postData){
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "SemanasPeriodo/create",
            type: 'POST',
            data: postData,
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    getSemanasPeriodo(postData.periodo)
                    limpiarAgregarSemana();
                };
                $("#background-loading").css("display", "none");
                alert(data.message);
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    // Envia los datos del nuevo periodo al controlador
    function setNuevoPeriodo(postData){
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Periodos/create",
            type: 'POST',
            data: postData,
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    location.reload();
                };
                $("#background-loading").css("display", "none");
                alert(data.message);
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function eliminarSemana(idSemana, idPeriodo, nombrePeriodo){
        if (confirm("¿Está seguro que desea eliminar la semana del periodo?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "SemanasPeriodo/delete/" + idSemana,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    let titulo = (data.status) ? "EXITO" : "ERROR";
                    $("#background-loading").css("display", "none");
                    alert(titulo + "\n\n" + data.message);
                    if (data.status) {
                        getSemanasPeriodo(idPeriodo, nombrePeriodo)
                    }
                },
                error: function() {
                    $("#background-loading").css("display", "none");
                    alert("Error!")
                }
            });
        }
    }

    // Hace el llamado al controlador para eliminar el periodo
    function eliminarPeriodo(idPeriodo){
        if (confirm("¿Está seguro que desea eliminar el periodo?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Periodos/delete/" + idPeriodo,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    let titulo = (data.status) ? "EXITO" : "ERROR";
                    $("#background-loading").css("display", "none");
                    alert(titulo + "\n\n" + data.message);
                    if (data.status) {
                        location.reload()
                    }
                },
                error: function() {
                    $("#background-loading").css("display", "none");
                    alert("Error!")
                }
            });
        }
    }

    // Limpia los campos del formulario de semana
    function limpiarAgregarSemana(){
        $('#modalSemana').modal('hide');
        jQuery("#nueva-semana-periodo").val("");
        jQuery("#nueva-semana-semana").val("1");
        jQuery("#nueva-semana-inicio").val("");
        jQuery("#nueva-semana-fin").val("");
        jQuery("#nueva-semana-id-semana").val("");
        jQuery("#nueva-semana-modal-title").html("Agregar semana");
    }

    // Limpia los campos del formulario de periodo
    function limpiarAgregarPeriodo(){
        $('#modalPeriodo').modal('hide');
        jQuery("#nuevo-periodo-id-periodo").val("");
        jQuery("#nuevo-periodo-periodo").val("");
        jQuery("#nuevo-periodo-inicio").val("");
        jQuery("#nuevo-periodo-fin").val("");
        jQuery("#nuevo-periodo-modal-title").html("Agregar periodo");
    }
})