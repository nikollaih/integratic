<?php
    foreach ($estudiantes as $e) {
?>
        <tr>
            <td><?= $e["documento"] ?></td>
            <td><?= $e["nombre"] ?></td>
            <td><?= ($e["respuesta"] != null) ? date("d M, Y h:i a", strtotime($e["respuesta"]["created_at"])) : "" ?></td>
            <td><?= ($e["respuesta"] != null) ? $e["respuesta"]["estudiante_notas"] : "" ?></td>
            <td class="text-center"><?= ($e["respuesta"] != null) ? "<a href='".base_url()."uploads/actividades/respuestas/".$e["respuesta"]["url_archivo"]."' target='_blank'>Ver</a>" : "" ?></td>
            <td class="text-center" style="width:60px;"><?= ($e["respuesta"] != null) ? '<input id="calificacion-respuesta-'.$e["respuesta"]["id_respuestas_actividades"].'" readonly="readonly" class="input no-calificar text-center" type="number" value="'.$e["respuesta"]["calificacion"] .'"/>' : "0" ?></td>
            <td class="text-center"><?= ($e["respuesta"] != null) ? '<button data-id="'.$e["respuesta"]["id_respuestas_actividades"].'" id="btn-modificar-calificacion-'.$e["respuesta"]["id_respuestas_actividades"].'" class="btn btn-warning btn-calificar btn-sm">Modificar calificación</button><button data-id="'.$e["respuesta"]["id_respuestas_actividades"].'" style="display:none;" id="btn-guardar-calificacion-'.$e["respuesta"]["id_respuestas_actividades"].'" class="btn btn-primary btn-guardar-calificar btn-sm">Guardar</button>': "" ?></td> 
        </tr>
<?php
    }
?>