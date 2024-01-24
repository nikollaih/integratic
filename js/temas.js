$(document).ready(function() {
    let tabla_temas = $('#tabla-temas').DataTable({
        order: [],
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    $(document).on("click", ".button-eliminar-tema", function() {
        let id_tema = $(this).attr("data-tema");
        eliminar_tema(id_tema);
    });

    $(document).on("change", "#tema-materias", function() {
        let materia = $(this).val();
        getAreaGrado(materia);
        console.log(materia)
    });

    function eliminar_tema(id_tema) {
        if (confirm("¿Está seguro que desea eliminar el tema?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Temas/delete/" + id_tema,
                type: 'POST',
                data: {},
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_temas
                            .row($("#tema-" + id_tema))
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

    function getAreaGrado(materia) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Materias/get/" + materia,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    getSelectsDBAData(data.object.caracterizacion_area, data.object.grado);
                }
                else{
                    alert(data.message);
                    $("#background-loading").css("display", "none");
                }
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }

    function getSelectsDBAData(area, grado) {
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
                    let dbas = data.object.dbas;
                    setTemaDBAs(dbas);
                }
                else alert(data.message);
                $("#background-loading").css("display", "none");
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }

    function setTemaDBAs(dbas){
        // Obtén una referencia al elemento select por su ID
        const selectElement = document.getElementById('dba-tema-select');

        // Limpia el select eliminando todas las opciones existentes
        selectElement.innerHTML = '<option value="0">No aplica</option>';

        // Itera sobre el arreglo y agrega nuevas opciones al select
        if(dbas.length > 0)
            dbas.forEach((dba) => {
                const option = document.createElement('option');
                option.value = dba.id_dba;
                option.textContent = dba.descripcion_dba;
                selectElement.appendChild(option);
            });
    }
});

