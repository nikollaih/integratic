let calendar = null;

document.addEventListener('DOMContentLoaded', function () {
    // Create the calendar
    let calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: 'dayGridMonth',
        events: [],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
          },
        eventMouseEnter: function (info) {
            calendarTooltip(info)
        },
        eventMouseLeave: function () {
            // Hide the tooltip when the mouse leaves the event
            tippy.hideAll();
        }
    });
    calendar.render();
    // Get the initial activities
    getAvtivitiesList();
});

// Get the materia filter
jQuery(document).on("change", ".get-calendar-activities", function () {
    let idMateria = jQuery(".get-calendar-activities.calendar-materia").val();
    let idPeriodo = jQuery(".get-calendar-activities.calendar-periodo").val();
    getAvtivitiesList(idMateria, idPeriodo);
})

// Get the activities base on parameters
function getAvtivitiesList(idMateria, idPeriodo) {
    $("#background-loading").css("display", "flex");
    $.ajax({
        url: base_url + "Calendario/getActividadesList",
        type: 'POST',
        data: {
            id_materia: idMateria,
            id_periodo: idPeriodo
        },
        success: function (data) {
            var data = JSON.parse(data);
            if (data.status) {
                console.log(data.object);
                setActivitiesCalendar(data.object);
            }
            else alert(data.message);
            $("#background-loading").css("display", "none");
        },
        error: function () {
            $("#background-loading").css("display", "none");
            alert("Error!")
        }
    });
}

// Draw the events in the calendar
function setActivitiesCalendar(activities) {
    removeAllEvents();

    activities.forEach(activity => {
        var newEvent = {
            id: activity.id_actividad,
            title: activity.titulo_actividad,
            start: activity.disponible_desde,
            end: activity.disponible_hasta,
            color: getActivityColor(activity),
            customData: activity
        };

        calendar.addEvent(newEvent);
    });
}

// Generate the tooltip for each event
function calendarTooltip(info) {
    console.log(info)
    // You can customize the tooltip content and style here
    var tooltip = new tippy(info.el, {
        content: getTooltipContent(info.event),
        arrow: true,
        placement: 'top',
        interactive: true,
        allowHTML: true,
        zIndex: 9999,
    });

    // Show the tooltip
    tooltip.show();
}

// Return the tooltip content
function getTooltipContent(event) {
    let formattedStartTime = getFormattedDate(event.start);
    let formattedEndTime = getFormattedDate(event.end);
    let status = getActivityStatus(event);
    let tempCalificacion = event.extendedProps.customData.calificacion;
    let calificacion = (tempCalificacion) ? tempCalificacion : "--";

    return '<div class="calendar-tooltip-container">' +
        '<h5 class="calendar-tooltip-title">Actividad</h5>' +
        '<p class="calendar-tooltip-text">' + event.title + '</p>' +
        '<h5 class="calendar-tooltip-title">Materia</h5>' +
        '<p class="calendar-tooltip-text">' + event.extendedProps.customData.nommateria + '</p>' +
        '<h5 class="calendar-tooltip-title">Periodo</h5>' +
        '<p class="calendar-tooltip-text">' + event.extendedProps.customData.periodo + '</p>' +
        '<h5 class="calendar-tooltip-title">Disponible desde</h5>' +
        '<p class="calendar-tooltip-text">' + formattedStartTime + '</p>' +
        '<h5 class="calendar-tooltip-title">Disponible hasta</h5>' +
        '<p class="calendar-tooltip-text">' + formattedEndTime + '</p>' +
        '<h5 class="calendar-tooltip-title">Estado</h5>' +
        '<p class="calendar-tooltip-text">' + status + '</p>' +
        '<h5 class="calendar-tooltip-title">Calificación</h5>' +
        ' <p class="calendar-tooltip-text">' + calificacion + '</p>' +
        '</div>'
}

// Format a date into calendar format
function getFormattedDate(date) {
    return date.toLocaleString('es-CO', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    });
}

// Get the activity status base on the student
function getActivityStatus(event) {
    let currentDate = new Date();
    let activity = event.extendedProps.customData;
    let disponibleHasta = new Date(activity.disponible_hasta);

    if (activity.id_respuestas_actividades) return "Entregada";
    if (event.start > currentDate) return "No disponible";
    if (disponibleHasta < currentDate) return "Vencida";

    return "Disponible";
}

// Define the activity color base on the status
function getActivityColor(activity) {
    let currentDate = new Date();
    let disponibledesde = new Date(activity.disponible_desde);
    let disponibleHasta = new Date(activity.disponible_hasta);

    if (activity.id_respuestas_actividades) return "#0B6951";
    if (disponibledesde > currentDate) return "#428cff";
    if (disponibleHasta < currentDate) return "#ff424b";

    return "#ffb142";
}

// Remove all the calendar events
function removeAllEvents() {
    var allEvents = calendar.getEvents();
    allEvents.forEach(function (event) {
        event.remove();
    });
}