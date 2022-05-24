$(document).ready(function() {
    let tabla_dba = $('#tabla-dba').DataTable({
        order: []
    });

    $(document).on("click", ".button-eliminar-dba", function() {
        let dba = $(this).attr("data-dba");
        eliminarDBA(dba);
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
});