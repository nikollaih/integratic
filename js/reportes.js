jQuery(document).on("click", "#reporte-actividades-estudiante-generar", function(){
    let idMateria = jQuery("#reporte-actividades-estudiante-materia").val();
    let idPeriodo = jQuery("#reporte-actividades-estudiante-periodo").val();
    let incluirPruebas = jQuery("#reporte-actividades-estudiante-pruebas").is(":checked").toString();

    window.open(
        base_url + 'Reportes/actividadesEstudiante/' + idMateria + '/' + idPeriodo + '/' + incluirPruebas,
        '_blank' // <- This is what makes it open in a new window.
      );
})