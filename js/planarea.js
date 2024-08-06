jQuery(document).ready(function() {
    let kothingParamsPlan = {
        fontSize: [8, 10, 12, 14, 16, 18, 20], // Lista de tamaños de letra
        defaultFontSize: 10, // Tamaño de letra predeterminado
        width: '100%',
        height: 'auto',
        toolbarItem: [
            ['undo', 'redo'],
            ['fontSize'],
            ['bold', 'underline', 'italic'],
            ['fontColor', 'hiliteColor'],
            ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
            ['link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView'],
            ['preview', 'print'],
        ],
        charCounter: true,
    }

    let richEditorObservacionesCoordinador = null;
    let richEditorEvidenciasAprendizajeSoportes = null;

    let element = document.getElementById("plan-aula-observaciones-coordinador");
    if(element) {
        richEditorObservacionesCoordinador = KothingEditor.create('plan-aula-observaciones-coordinador', kothingParamsPlan);
    }

    element = document.getElementById("evidencia-aprendizaje-soporte-comentarios");
    if(element) {
        richEditorEvidenciasAprendizajeSoportes = KothingEditor.create('evidencia-aprendizaje-soporte-comentarios', kothingParamsPlan);
    }

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

    $("#form-plan-aula-observaciones-coordinador").on('submit', function(e) {
        let descripcion = richEditorObservacionesCoordinador.getContents();
        jQuery("#plan-aula-observaciones-coordinador").val(descripcion);
    });

    $("#form-evidencia-aprendizaje-soporte").on('submit', function(e) {
        let comentarios = richEditorEvidenciasAprendizajeSoportes.getContents();
        jQuery("#evidencia-aprendizaje-soporte-comentarios").val(comentarios);
    });


    jQuery(document).on("click", ".btn-agregar-observaciones-coordinador", function() {
        // Get the evidencia de aprendizaje ID
        let idEvidenciaAprendizaje = jQuery(this).attr("data-id");

        jQuery.ajax({
            url: base_url + "EvidenciasAprendizaje/find/" + idEvidenciaAprendizaje,
            success: function(response) {
                let data = JSON.parse(response);
                let object = data.object;
                if (data.status) {
                    richEditorObservacionesCoordinador.setContents(object.observaciones_coordinador);
                }
            }
        });

        jQuery("#id-plan-aula-observaciones-coordinador").val(idEvidenciaAprendizaje);
        jQuery("#observaciones-plan-aula-modal").modal("show");
    });



    jQuery(document).on("click", ".btn-agregar-evidencia-aprendizaje-soportes", function() {
        jQuery("#evidencia-aprendizaje-soportes-lista-modal").modal("hide");
        jQuery("#evidencia-aprendizaje-soportes-modal").modal("show");
    })

    // Eliminar soporte de evidencia de aprendizaje
    jQuery(document).on("click", ".btn-eliminar-evidencia-aprendizaje-soporte", function() {
        // Get the soporte evidencia de aprendizaje ID
        let idSoporteEvidenciaAprendizaje = jQuery(this).attr("data-id");
        removeSoporteEvidenciaAprendizaje(idSoporteEvidenciaAprendizaje);
    })



    jQuery(document).on("click", ".btn-evidencias-aprendizaje-soportes", function() {

        // Get the evidencia de aprendizaje ID
        let idEvidenciaAprendizaje = jQuery(this).attr("data-id");

        // Obtenemos la lista de soportes
        jQuery.ajax({
            url: base_url + "EvidenciasAprendizajeSoportes/getAll/" + idEvidenciaAprendizaje,
            success: function(response) {
                let data = JSON.parse(response);
                let object = data.object;
                if (data.status) {
                    let tbody = jQuery("#table-evidencias-aprendizaje-soportes tbody");
                    jQuery(tbody).html("");

                    if(object.soportes.length > 0) {
                        for (let i = 0; i < object.soportes.length; i++) {
                            jQuery(tbody).append(obtenerItemSoporte(object.soportes[i], object.rol));
                        }
                    }
                }
            }
        });

        jQuery("#id-evidencia-aprendizaje-soportes").val(idEvidenciaAprendizaje);
        jQuery("#evidencia-aprendizaje-soportes-lista-modal").modal("show");
    });

    // Retorna una nueva fila para la tabla de soportes
    function obtenerItemSoporte(soporte, rol) {
        // Si el usuario logueado es un docente entonces muestra el boton de eliminar
        let btnEliminar = (rol === "docente") ? `<td style="width: 50px">
                        <svg data-id="${soporte.id}" style="width: 25px; color: indianred" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pointer btn-eliminar-evidencia-aprendizaje-soporte">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </td>` : '';

        // Retorna la fila del item de soporte
        return `<tr id="soporte-evidencia-aprendizaje-row-${soporte.id}">
                    <td>
                        <a href="${base_url}uploads/evidencias_aprendizaje/soportes/${soporte.nombre_archivo}" target="_blank"><p>${soporte.titulo_archivo}</p></a>
                    </td>
                    <td>
                        ${soporte.comentarios}
                    </td>
                    <td style="width: 175px">
                        <p class="p-0">${soporte.created_at}</p>
                    </td>
                    ${btnEliminar}
                </tr>`;
    }

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
        selectElement.innerHTML = '<option value="">- Todas</option>';
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

    // Elimina un soporte de las evidencias de aprendizaje
    function removeSoporteEvidenciaAprendizaje(idSoporteEvidenciaAprendizaje){
        if (confirm("¿Está seguro que desea eliminar el soporte de la evidencia de aprendizaje?") === true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "EvidenciasAprendizajeSoportes/remove/" + idSoporteEvidenciaAprendizaje,
                type: 'POST',
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status) {
                        jQuery("#soporte-evidencia-aprendizaje-row-" + idSoporteEvidenciaAprendizaje).remove();
                    }
                    $("#background-loading").css("display", "none");
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
        if (confirm("¿Está seguro que desea eliminar el plan de aula?") === true) {
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