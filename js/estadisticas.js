$(document).ready( function () {
    $(document).on("click", "#btn-estadisticas-participante-grafica", function() {
        let materia = jQuery("#estadisticas-participante-grafica").val();
        let participante = jQuery("#estadisticas-participante-grafica").attr("participante");

        obtenerPruebasParticipanteMateria(participante, materia);
    });

    // Obtiene la lista de pruebas del participante
    function obtenerPruebasParticipanteMateria(participante, materia){
        let notas = [0];
        if(participante && materia){
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "EstadisticasPruebas/participante_grafica",
                type: 'POST',
                data: {
                    participante,
                    materia
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        if(data.object.length > 0){
                            for (let i = 0; i < data.object.length ; i++) {
                                const prueba = data.object[i];
                                notas.push(parseFloat(prueba.nota));
                            }
                        }
                        addDataChart(participanteChart, notas);
                    }
                    else {
                        alert(data.message);
                    }
                    $("#background-loading").css("display", "none");
                },
                error: function() { 
                    $("#background-loading").css("display", "none");
                    alert("Error!"); 
                }
            });
        }
    }

    function addDataChart(chart, newData) {
        // Limpiar los datos existentes
        chart.data.labels = [];
        chart.data.datasets[0].data = [];

        if(newData.length > 0){
            for (let i = 0; i < newData.length; i++) {
                chart.data.labels = chart.data.labels.concat(newData[i]);
                chart.data.datasets[0].data = chart.data.datasets[0].data.concat(newData[i]);
            }
        }
        chart.update();
    }
})