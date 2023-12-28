$(document).ready(function() {
    let tabla_cursos = $('#tabla-cursos').DataTable({
        order: [],
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    $("#form-curso").on('submit', function(e) {
        jQuery("#textarea_richtext").html(editorRich.getContents());
    });

    $(document).on("click", ".button-eliminar-curso", function() {
        let id_curso = $(this).attr("data-curso");
        eliminar_curso(id_curso);
    });

    function eliminar_curso(id_curso) {
        if (confirm("¿Está seguro que desea eliminar el curso?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Cursos/delete/" + id_curso,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_cursos
                            .row($("#curso-" + id_curso))
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