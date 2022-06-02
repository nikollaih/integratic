$(document).ready(function() {
    let tabla_dba = $('#tabla-dba').DataTable({
        order: [],
        "pageLength": 50,
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    let tabla_lc = $('#tabla-lineamiento-curricular').DataTable({
        order: [],
        "pageLength": 50,
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    let tabla_estandar = $('#tabla-estandar').DataTable({
        order: [],
        "pageLength": 50,
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    let tabla_contenido = $('#tabla-contenido').DataTable({
        order: [],
        "pageLength": 50,
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    $(document).on("click", ".button-eliminar-dba", function() {
        let dba = $(this).attr("data-dba");
        eliminarDBA(dba);
    });

    $(document).on("click", ".button-eliminar-lineamiento-curricular", function() {
        let lc = $(this).attr("data-lineamiento-curricular");
        eliminarLineamientoCurricular(lc);
    });

    $(document).on("click", ".button-eliminar-estandar", function() {
        let estandar = $(this).attr("data-estandar");
        eliminarEstandar(estandar);
    });


    $(document).on("change", ".get-selects-data", function() {
        let area = $("#area").val();
        let grado = $("#grado").val();
        if(area != "null" && grado != "null")
            getSelectsData(area, grado);
    });

    $(document).on("change", ".get-contenido-data", function() {
        let area = $("#area").val();
        let grado = $("#grado").val();
        if(area != "null" && grado != "null")
            getContenidoData(area, grado);
    });

    function eliminarDBA(dba) {
        if (confirm("¿Está seguro que desea eliminar el DBA?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "caracterizacion/deleteDBA/" + dba,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_dba
                            .row($("#dba-" + dba))
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

    function eliminarLineamientoCurricular(lc) {
        if (confirm("¿Está seguro que desea eliminar el Lineamiento curricular?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "caracterizacion/deleteLineamientoCurricular/" + lc,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_lc
                            .row($("#lineamiento-curricular-" + lc))
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

    function eliminarEstandar(estandar) {
        if (confirm("¿Está seguro que desea eliminar el Estandar de competencia?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "caracterizacion/deleteEstandarCompetencia/" + estandar,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_estandar
                            .row($("#estandar-" + estandar))
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

    function getSelectsData(area, grado) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "caracterizacion/getSelectsData",
            type: 'POST',
            data: {
                area: area,
                grado: grado
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    setSelectDBAs(data.object.dbas);
                    setSelectLineamientos(data.object.lineamientos);
                    setSelectEstandares(data.object.estandares);
                }
                else{
                    alert(data.message);
                }
                $("#background-loading").css("display", "none");
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }

    function getContenidoData(area, grado) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "caracterizacion/getContenidoData",
            type: 'POST',
            data: {
                area: area,
                grado: grado
            },
            success: function(data) {
                tabla_contenido.clear();
                var data = JSON.parse(data);
                if (data.status) {
                    if(data.object.contenido != false){
                        for (let i = 0; i < data.object.contenido.length; i++) {
                            const contenido = data.object.contenido[i];
                            tabla_contenido.row.add([contenido.descripcion_dba, contenido.descripcion_lineamiento_curricular, contenido.descripcion_estandar, contenido.descripcion, '<a  href="'+contenido.ruta_contenido+'" target="_blank" style="text-decoration:underline;">'+contenido.ruta_contenido+'</a>', '<a  href="'+base_url+'Caracterizacion/add/'+contenido.id_caracterizacion+'" class="btn btn-warning btn-sm m-b-2">Modificar</a>']);
                        }
                    }
                    tabla_contenido.draw(false);
                }
                else
                    alert(data.message);
                $("#background-loading").css("display", "none");
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }

    function setSelectDBAs(dbas = null){
        let select_dom = "<option value='null'>- Seleccionar</option>";
        if(dbas){
            if(dbas.length > 0){
                for (let i = 0; i < dbas.length; i++) {
                    const dba = dbas[i];
                    select_dom += "<option value="+dba["id_dba"]+">"+dba["descripcion_dba"]+"</option>";
                }
            }
        }

        $("#dba-select").html(select_dom);
    }

    function setSelectLineamientos(lineamientos = null){
        let select_dom = "<option value='null'>- Seleccionar</option>";
        if(lineamientos){
            if(lineamientos.length > 0){
                for (let i = 0; i < lineamientos.length; i++) {
                    const dba = lineamientos[i];
                    select_dom += "<option value="+dba["id_lineamiento_curricular"]+">"+dba["descripcion_lineamiento_curricular"]+"</option>";
                }
            }
        }

        $("#lineamientos-select").html(select_dom);
    }

    function setSelectEstandares(estandares = null){
        let select_dom = "<option value='null'>- Seleccionar</option>";
        if(estandares){
            if(estandares.length > 0){
                for (let i = 0; i < estandares.length; i++) {
                    const dba = estandares[i];
                    select_dom += "<option value="+dba["id_estandar"]+">"+dba["descripcion_estandar"]+"</option>";
                }
            }
        }

        $("#estandares-select").html(select_dom);
    }
});