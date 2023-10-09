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

    jQuery(document).on("change", "#plan-area-materia", function() {
        let idMateria = jQuery(this).val();
        let idArea = jQuery("#plan-area-area").val();

        if(idMateria.trim() != "" && idArea.trim() != ""){
            getEstandaresArea(idArea, idMateria);
            getDBAArea(idArea, idMateria);
        }
        else { 
            setEstandaresArea([]);
        }
    });

    function getMateriasArea(id_area) {
        $("#background-loading").css("display", "flex");
        $.ajax({
            url: base_url + "Materias/getMateriasArea/" + id_area,
            type: 'GET',
            success: function(data) {
                var data = JSON.parse(data);
                let object = data.object;
                if (data.status) setMateriasArea(object);
                $("#background-loading").css("display", "none");
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
})