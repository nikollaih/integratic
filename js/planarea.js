jQuery(document).ready(function() {
    jQuery(document).on("change", "#plan-area-area", function() {
        let idArea = jQuery(this).val();
        let idMateria = jQuery("#plan-area-materia").val();
        if(idArea.trim() != ""){
            getMateriasArea(idArea);
            if(idMateria.trim() != ""){
                getEstandaresArea(idArea, idMateria);
                getDBAArea(idArea, idMateria);
            }
            else {
                setEstandaresArea([]);
                setDBAArea([]);
            }
        }
        else { 
            setMateriasArea([]);
        }
    });

    jQuery(document).on("click", "#btn-completar-evidencia", function() {
        let observaciones = jQuery("#observaciones-completar-evidencia").val();
        let idEvidencia = jQuery("#id-completar-evidencia").val();
        let estadoCompletado = jQuery("#estado-completar-evidencia").val();

        if(estadoCompletado > 1)
            completarEvidenciaAprendizaje(idEvidencia, observaciones, estadoCompletado);
        else alert("Por favor seleccione un estado");
    });

    jQuery(document).on("click", ".completar-evidencia-aprendizaje", function() {
        jQuery("#observaciones-completar-evidencia").val("");
        jQuery("#id-completar-evidencia").val("");
        let checked = jQuery(this).is(":checked");
        let idEvidencia = jQuery(this).attr("data-id");

        if(!checked && jQuery(this).hasClass("checked"))
            jQuery(this).prop("checked", true);

        if(checked || jQuery(this).hasClass("checked")){
            getEvidenciaAprendizaje(idEvidencia);
            jQuery("#id-completar-evidencia").val(idEvidencia);
            jQuery("#modal-completar-evidencia").modal("show");
        }
    });

    jQuery(document).on("click", ".mostrar-evidencia-aprendizaje", function() {
        let idEvidenciaAprendizaje = jQuery(this).attr("data-id");
        showEvidenciaAprendizaje(idEvidenciaAprendizaje);
    });

    jQuery(document).on("click", ".open-close-parte", function() {
        let parte = jQuery(this).attr("data-parte");
        jQuery("#parte-" + parte).slideToggle();
    });

    jQuery(document).on("click", ".remove-plan-aula", function() {
        let idPlanAula = jQuery(this).attr("data-id");
        removePlanAula(idPlanAula);
    });

    jQuery(document).on("click", ".remove-evidencia-aprendizaje", function() {
        let idEvidenciaAprendizaje = jQuery(this).attr("data-id");
        removeEvidenciaAprendizaje(idEvidenciaAprendizaje);
    });

    jQuery(document).on("change", "#only-row-input", function() {
        if(jQuery(this).is(":checked")){
            jQuery(".extra-info-evidencia").slideUp();
        }
        else {
            jQuery(".extra-info-evidencia").slideDown();
        }
    });


    jQuery(document).on("change", "#plan-area-materia", function() {
        let idMateria = jQuery(this).val();
        let idArea = jQuery("#plan-area-area").val();
        let selectElement = document.getElementById('plan-area-estandar');

        if(idMateria.trim() != "" && idArea.trim() != "" && selectElement){
            getEstandaresArea(idArea, idMateria);
            getDBAArea(idArea, idMateria);
        }
        else { 
            setEstandaresArea([]);
        }
    });

    jQuery(document).on("change", "#plan-area-periodo-ea", function() {
        let idPeriodo = jQuery(this).val();
        getSemanasPeriodo(idPeriodo);
    });

    function completarEvidenciaAprendizaje(idEvidencia, observaciones, estadoCompletado) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/update",
            type: 'POST',
            data: {
                id_evidencia_aprendizaje: idEvidencia,
                observaciones_completo: observaciones,
                estado_completo: estadoCompletado,
                is_completo: 1
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status){
                    alert("Evidencia completada exitosamente!");
                    location.reload();
                }
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function getSemanasPeriodo(idPeriodo){
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "SemanasPeriodo/getSemanasPeriodo/" + idPeriodo,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setSemanasPeriodo(object);
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function getEvidenciaAprendizaje(idEvidencia) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/find/" + idEvidencia,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status){
                    jQuery("#observaciones-completar-evidencia").val(object.observaciones_completo);
                    jQuery("#estado-completar-evidencia").val(object.estado_completo);
                }
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function showEvidenciaAprendizaje(idEvidencia){
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "EvidenciasAprendizaje/find/" + idEvidencia,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status){
                    setEvidenciaAprendizajeModal(object);
                }
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function setEvidenciaAprendizajeModal(evidencia){
        jQuery("#evidencia-aprendizaje-modal-evidencia").html(evidencia.evidencia_aprendizaje);
        jQuery("#evidencia-aprendizaje-modal-exploracion").html(evidencia.exploracion);
        jQuery("#evidencia-aprendizaje-modal-estructuracion").html(evidencia.estructuracion);
        jQuery("#evidencia-aprendizaje-modal-transferencia").html(evidencia.transferencia);
        jQuery("#evidencia-aprendizaje-modal-valoracion").html(evidencia.valoracion);
        jQuery("#evidencia-aprendizaje-modal-recursos").html(evidencia.recursos);
        jQuery("#evidencia-aprendizaje-modal").modal("show");
    }

    function getMateriasArea(id_area) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Materias/getMateriasArea/" + id_area,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setMateriasArea(object);
                setTimeout(() => {
                    $("#background-loading").css("display", "none");
                }, 2000)
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function setMateriasArea(materias){
        // Obtén una referencia al elemento select por su ID
        const selectElement = document.getElementById('plan-area-materia');
    
        // Limpia el select eliminando todas las opciones existentes
        selectElement.innerHTML = '<option>- Seleccionar</option>';
        // Itera sobre el arreglo y agrega nuevas opciones al select

        if(materias != false)
            materias.forEach((materia) => {
                const option = document.createElement('option');
                option.value = materia.codmateria;
                option.textContent = materia.nommateria + " - " + materia.grado + "°";
                selectElement.appendChild(option);
            });
    }

    function setSemanasPeriodo(semanas){
        // Obtén una referencia al elemento select por su ID
        const selectElement = document.getElementById('plan-area-semana');
    
        // Limpia el select eliminando todas las opciones existentes
        selectElement.innerHTML = '<option>- Seleccionar</option>';
        // Itera sobre el arreglo y agrega nuevas opciones al select

        if(semanas != false)
        semanas.forEach((semana) => {
                const option = document.createElement('option');
                option.value = semana.id_semana_periodo;
                option.textContent = semana.semana + " - (" + semana.fecha_inicio + ")";
                selectElement.appendChild(option);
            });
    }

    // GET ESTANDARES DE COMPETENCIA POR AREA
    function getEstandaresArea(idArea, idMateria) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Caracterizacion/estandarCompetenciaByAreaGrado",
            type: 'POST',
            data: {
                area: idArea,
                materia: idMateria
            },
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setEstandaresArea(object);
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function setEstandaresArea(estandares){
        // Obtén una referencia al elemento select por su ID
        const selectElement = document.getElementById('plan-area-estandar');

        if(selectElement){
            // Limpia el select eliminando todas las opciones existentes
            jQuery('#plan-area-estandar').empty();
                
            // Itera sobre el arreglo y agrega nuevas opciones al select
            if(estandares != false){
                estandares.forEach((estandar) => {
                    const option = document.createElement('option');
                    option.value = estandar.id_estandar;
                    option.textContent = estandar.descripcion_estandar;
                    selectElement.appendChild(option);
                });
            }
            jQuery('.select-2').trigger("change");
        }
    }

    // GET DBA POR AREA
    function getDBAArea(idArea, idMateria) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Caracterizacion/DBAByAreaGrado",
            type: 'POST',
            data: {
                area: idArea,
                materia: idMateria
            },
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setDBAArea(object);
                $("#background-loading").css("display", "none");
            },
            error: function() { 
                $("#background-loading").css("display", "none");
                alert("Error!") 
            }
        });
    }

    function setDBAArea(dbas){
        // Obtén una referencia al elemento select por su ID
        const selectElement = document.getElementById('plan-area-dba');

        // Limpia el select eliminando todas las opciones existentes
        jQuery('#plan-area-dba').empty();
    
        // Itera sobre el arreglo y agrega nuevas opciones al select
        if(dbas != false){
            dbas.forEach((dba) => {
                const option = document.createElement('option');
                option.value = dba.id_dba;
                option.textContent = dba.descripcion_dba;
                selectElement.appendChild(option);
            });
        }
        jQuery('.select-2').trigger("change");
    }

    function removeEvidenciaAprendizaje(idEvidenciaAprendizaje){
        if (confirm("¿Está seguro que desea eliminar la evidencia de aprendizaje?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "EvidenciasAprendizaje/remove/" + idEvidenciaAprendizaje,
                type: 'POST',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        jQuery("#evidencia-aprendizaje-" + idEvidenciaAprendizaje).remove();
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

    // Elimina el plan de aula y sus respectivas evidencias de aprendizaje
    function removePlanAula(idPlanAula){
        if (confirm("¿Está seguro que desea eliminar el plan de aula?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "PlanAula/delete/" + idPlanAula,
                type: 'POST',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        jQuery("#plan-aula-" + idPlanAula).remove();
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
})