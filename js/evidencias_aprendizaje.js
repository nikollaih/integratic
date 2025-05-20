jQuery(document).ready(function() {
    jQuery(document).on("click", ".btn-mostrar-evidencias-aprendizaje-incompletos", function() {
        let idPlanAula = jQuery(this).attr("data-id");
        getUncompletedEvidencias(idPlanAula);
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

    function getUncompletedEvidencias(idPlanAula) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/uncompleted",
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
        // Seleccionamos el tbody donde incluiremos la lista
        let tbody = jQuery("#table-evidencias-aprendizaje-incompletas tbody");
        // limpia el contenedor
        jQuery(tbody).html("");

        if(evidencias.length > 0) {
            for (let i = 0; i < evidencias.length; i++) {
                let evidencia = evidencias[i];

                let row = `<tr>
                                    <td>${evidencia.evidencia_aprendizaje}</td>
                                    <td>${evidencia.exploracion}</td>
                                    <td>${evidencia.estructuracion}</td>
                                    <td>${evidencia.transferencia}</td>
                                    <td>${evidencia.valoracion}</td>
                                    <td>${evidencia.recursos}</td>
                                    <td>
                                        <button data-mode="false" data-id-plan="${idPlanAula}" data-id="${evidencia.id_evidencia_aprendizaje}" class="btn btn-primary m-b-10 btn-use-evidencia-aprendizaje">Usar</button>
                                        <button data-mode="true" data-id-plan="${idPlanAula}" data-id="${evidencia.id_evidencia_aprendizaje}" class="btn btn-info btn-use-evidencia-aprendizaje">Usar y completar</button>
                                    </td>
                                </tr>`;

                jQuery(tbody).append(row);
            }
        }
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