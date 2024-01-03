$(document).ready(function() {
    let tabla_cursos = $('#tabla-cursos').DataTable({
        order: [],
        "language": {
            "url": base_url + "js/json/datatable_spanish.json"
        }
    });

    let tabla_archivos_curso = $('#tabla-archivos_curso').DataTable({
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

    $(document).on("click", ".btn-eliminar-archivo-curso", function() {
        let id_archivo_curso = $(this).attr("data-id");
        eliminar_archivo_curso(id_archivo_curso);
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

    function eliminar_archivo_curso(id_archivo) {
        if (confirm("¿Está seguro que desea eliminar el archivo?") == true) {
            $("#background-loading").css("display", "flex");
            $.ajax({
                url: base_url + "Cursos/deleteFile/" + id_archivo,
                type: 'GET',
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status) {
                        tabla_archivos_curso
                            .row($("#archivo-curso-" + id_archivo))
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