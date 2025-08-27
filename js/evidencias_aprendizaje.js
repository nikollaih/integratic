jQuery(document).ready(function() {
    jQuery(document).on("click", ".btn-mostrar-evidencias-aprendizaje-incompletos", function() {
        let idPlanAula = jQuery(this).attr("data-id");
        getUncompletedEvidencias(idPlanAula);
        let componentes = getTipoComponentes();
        console.log(componentes)
        jQuery("#modal-evidencias-aprendizaje-incompletas").modal("show");
    });

    jQuery(document).on("click", ".btn-eliminar-tipo-componente-evidencia", function() {
        let idTipoComponente = jQuery(this).attr("data-id");
        eliminarTipoComponente(idTipoComponente)
    });

    // Hace el llamado al controlador para eliminar el periodo
    function eliminarTipoComponente(idTipoComponente){
        if (confirm("¿Está seguro que desea eliminar el componente?") === true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "EvidenciasAprendizajeComponentes/eliminar/" + idTipoComponente,
                type: 'GET',
                success: function(data) {
                    data = JSON.parse(data);
                    $("#background-loading").css("display", "none");
                    alert(data.message);
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

    jQuery(document).on("click", ".btn-use-evidencia-aprendizaje", function() {
        let idPlanAula = jQuery(this).attr("data-id-plan");
        let idEvidencia = jQuery(this).attr("data-id");
        let mode = jQuery(this).attr("data-mode");
        let semanas = jQuery("#create-plan-aula-semanas-select").val();
        useUncompletedEvidencias(idPlanAula, idEvidencia, mode, semanas)
    });

    async function getTipoComponentes() {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizajeComponentes/getTipos",
            success: function (response) {
                let data = JSON.parse(response);
                let object = data.object;

                if (data.status) {
                    // Seleccionamos el encabezado de la tabla
                    let headerRow = $("#table-evidencias-aprendizaje-incompletas thead");
                    headerRow.empty(); // limpiamos los th anteriores

                    // Generamos los nuevos th dinámicamente
                    object.forEach(tipo => {
                        headerRow.append(`<th>${tipo.nombre}</th>`);
                    });

                    // Si necesitas columna extra de acciones al final:
                    headerRow.append(`<th style="width: 100px"></th>`);
                }

                $("#background-loading").css("display", "none");
            },
            error: function () {
                $("#background-loading").css("display", "none");
                alert("Error!");
            }
        });
    }

    function getUncompletedEvidencias(idPlanAula) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/uncompleted/" + idPlanAula,
            success: function(response) {
                let data = JSON.parse(response);
                let object = data.object;
                if (data.status) setUncompletedEvidencias(object, idPlanAula);
                $("#background-loading").css("display", "none");
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }

    function setUncompletedEvidencias(evidencias, idPlanAula) {
        const tbody = $("#table-evidencias-aprendizaje-incompletas tbody");
        tbody.empty();

        evidencias.forEach(ev => {
            let celdas = "";

            // recorre los componentes de esa evidencia
            (ev.componentes || []).forEach(c => {
                celdas += `<td>${c.contenido || ""}</td>`;
            });

            // botones
            const acciones = `
            <td>
                <button data-mode="false" data-id-plan="${idPlanAula}"
                        data-id="${ev.id_evidencia_aprendizaje}"
                        class="btn btn-primary m-b-10 btn-use-evidencia-aprendizaje">Usar</button>
                <button data-mode="true" data-id-plan="${idPlanAula}"
                        data-id="${ev.id_evidencia_aprendizaje}"
                        class="btn btn-info btn-use-evidencia-aprendizaje">Usar y completar</button>
            </td>
        `;

            tbody.append(`<tr>${celdas}${acciones}</tr>`);
        });
    }


    function useUncompletedEvidencias(idPlanAula, idEvidencia, mode, semanas) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/use",
            method: "post",
            data: {
              id_evidencia_aprendizaje: idEvidencia,
              id_plan_aula: idPlanAula,
              mode: mode,
              semanas: semanas
            },
            success: function(response) {
                let data = JSON.parse(response);
                alert(data.message);
                $("#background-loading").css("display", "none");
            },
            error: function() {
                $("#background-loading").css("display", "none");
                alert("Error!")
            }
        });
    }
})